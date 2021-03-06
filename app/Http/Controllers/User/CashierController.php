<?php

namespace App\Http\Controllers\User;

use App\Shop;
use App\ProductShop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Item;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CashierController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:cashier|all-shoppermissions')->only(['getProduct', 'store', 'show']);
    }

    public function getProduct($shop_id, $product_id)
    {
        $product = ProductShop::with(['product', 'shop'])->where(['product_id' => $product_id, 'shop_id' => $shop_id])->first();

        return response()->json([
            'product' => $product,
            'success' => 'Got Sample Ajax Request',
        ]);
    }

    public function show($id)
    {
        $shop = Shop::findOrFail($id);
        $products = ProductShop::where(['shop_id' => $id, 'status' => 1])->get();

        return view('users.cashier.show')->with([
            'shop' => $shop,
            'products' => $products,
        ]);
    }

    public function store(Request $request, $id)
    {
        // $validation = Validator::make($request->all(), $this->rules());
        // if ($validation->fails()) {
        //     return parent::error($validation->errors(), 404);
        // }

        $date = Carbon::now()->toDateTimeString();

        $invoice = Invoice::create(['date' => $date, 'total' => '0', 'shop_id' => $id]);
        $items_id = array();
        $sum = 0;
        $error_quantity = false;

        foreach ($request->data as $row) {
            $product = ProductShop::where(['product_id' => $row['product_id'], 'shop_id' => $id])->first();

            if ($row['quantity'] > $product->quantity || $row['quantity'] == 0) {
                $error_quantity = true;
                break;
            }
        }

        if (!$error_quantity) {
            foreach ($request->data as $index => $row) {
                //product not in invoice decerment the product qunaintity
                $product = ProductShop::where('product_id', $row['product_id'])->first();
                $product->quantity -= $row['quantity'];
                ++$product->sell_count; //increment the sell count
                $product->save();

                //create first row (item) in transaction
                $item = Item::create(['product_id' => $row['product_id'], 'quantity' => $row['quantity'], 'price' => $row['price']]);
                $items_id[$index] = $item->id;
                // $item->invoices()->attach($invoice->id);
                $sum += $row['price'];
            }
        } else {
            return response()->json(['error' => 1]);
        }
        $invoice->items()->attach($items_id);
        $invoice->update(['total' => $sum]);

        return response()->json(['id' => $invoice->id, 'error' => 0]);
    }

    // private function rules()
    // {
    //     return   [
    //         'data' => 'required',
    //     ];
    // }
}
