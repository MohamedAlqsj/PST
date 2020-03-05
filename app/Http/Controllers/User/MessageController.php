<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::where(['to_id' => auth()->user()->id, 'parent_id' => null]);

        if ($request->has('title')) {
            $messages = $messages->where('title', 'like', '%'.$request->input('title').'%');
        }

        $messages = $messages->orderBy('read', 'asc')->get();
        $sent_messages_count = Message::where(['from_id' => auth()->user()->id, 'parent_id' => null])->count();

        return view('users.messages.index')->with([
            'messages' => $messages,
            'page_name' => 'messages',
            'sent_messages_count' => $sent_messages_count,
        ]);
    }

    public function sentIndex(Request $request)
    {
        $messages = Message::where(['from_id' => auth()->user()->id, 'parent_id' => null]);

        if ($request->has('title')) {
            $messages = $messages->where('title', 'like', '%'.$request->input('title').'%');
        }

        $messages = $messages->orderBy('read', 'asc')->get();
        $inbox_messages_count = Message::where(['to_id' => auth()->user()->id, 'parent_id' => null])->count();

        return view('users.messages.sentIndex')->with([
            'messages' => $messages,
            'page_name' => 'messages',
            'inbox_messages_count' => $inbox_messages_count,
        ]);
    }

    public function create()
    {
        $sent_messages_count = Message::where(['from_id' => auth()->user()->id, 'parent_id' => null])->count();
        $inbox_messages_count = Message::where(['to_id' => auth()->user()->id, 'parent_id' => null])->count();

        return view('users.messages.create')->with([
            'sent_messages_count' => $sent_messages_count,
            'inbox_messages_count' => $inbox_messages_count,
        ]);
    }

    public function store(Request $request)
    {
        //checks if he entered correct email

        $data = [];

        if ($request->has('replay')) {
            $request->validate([
                'body' => 'required',
            ]);

            $data['body'] = $request->body;
            $data['parent_id'] = $request->parent_id;
            $data['from_id'] = auth()->user()->id;

            Message::create($data);

            return redirect()->route('messages.show', $request->parent_id)->with('success', __('site.message_created'));
        } else {
            $request->validate([
                'to' => 'required|email',
                'title' => 'required',
                'body' => 'required',
            ]);
            $user = User::where('email', $request->to)->first();
            if (is_null($user)) {
                return redirect()->back()->with('error', __('site.not_found'));
            }
            $data = $request->except(['_token', 'to']);
            $data['to_id'] = $user->id;
            $data['from_id'] = auth()->user()->id;
        }

        Message::create($data);

        return redirect()->route('messages.index')->with('success', __('site.message_created'));
    }

    public function show($id)
    {
        $sent_messages_count = Message::where(['from_id' => auth()->user()->id, 'parent_id' => null])->count();
        $inbox_messages_count = Message::where(['to_id' => auth()->user()->id, 'parent_id' => null])->count();

        $message = Message::where(['parent_id' => null, 'id' => $id])->first();
        if (is_null($message)) {
            return redirect()->route('messages.index');
        }
        $message->read = 1;
        $message->save();

        return view('users.messages.show')->with([
            'message' => $message,
            'sent_messages_count' => $sent_messages_count,
            'inbox_messages_count' => $inbox_messages_count,
        ]);
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        if ($message->parent_id == null) {
            foreach ($message->replies as $replay) {
                $replay->delete();
            }

            $message->delete();

            return redirect()->route('messages.index')->with('success', __('site.deleted_successfully'));
        }
        //deletes a replay only
        $message->delete();

        return redirect()->route('messages.show', $message->parent_id)->with('success', __('site.deleted_successfully'));
    }
}