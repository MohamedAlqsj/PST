@extends('site.base_layouts.app')

@section('content')

	<!-- Breadcrumb -->
<section class="portfolio-item-details">
@if (!is_null($product))

	<div class="container">

		<!-- Title and Item Details -->
		<div class="row item-title">

            @include('partials.messages')
			<div  style="float:right"  class="col-sm-9">
				<h1>
					<a href="#">{{$product->name}}</a>
				</h1>

				<div class="categories">
					<span> الصنف:</span>
					<a href="#">{{$product->category->name}}</a>
				</div>
				<div class="item-detail">
					<span> التاريخ :</span>
					{{$product_date}}
				</div>
			</div>

			<div  style="float:left"  class="col-sm-3">

				<div class="text-right">


					<div class="item-detail">
						{{-- <form action="{{route('site.cart.addItem',['id'=>$product->id])}}" method="post"> --}}
							@if(auth()->user()->type === 1)

						<i class="entypo-basket">
								<a href="{{route('site.cart.addItem',['id'=>$product->id])}}" type="submit" class="btn btn-secondary" >
								اضف إلى السلة
								</a>
						</i>
						@endif

						<br>
						<br>
							{{-- <div class="callout-button">
								<i class="entypo-tag ">
									<a href="index.html" class="btn btn-secondary"> طلب البضاعة</a>

								</i>

							</div> --}}
					</div>
				</div>

			</div>

		</div>

		<!-- Portfolio Images Gallery -->

		<div class="row">
			<div class="column">
			  <img src="{{$product->getImage()}}" alt="Nature" style="width:100%" onclick="myFunction(this);">
			</div>
			<div class="column">
			  <img src="{{$product->getImage()}}" alt="Snow" style="width:100%" onclick="myFunction(this);">
			</div>
			<div class="column">
			  <img src="{{$product->getImage()}}" alt="Mountains" style="width:100%" onclick="myFunction(this);">
			</div>
			<div class="column">
			  <img src="{{$product->getImage()}}" alt="Lights" style="width:100%" onclick="myFunction(this);">
			</div>
		  </div>

		  <div class="containerImage">
			<span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
			<img id="expandedImg" style="width:100%">
			<div id="imgtext"></div>
		  </div>

		  <br>
		  <br>
		  <hr>

{{--
		<div class="row">
			<div class="text-center">

				<img src="{{$product->getImage()}}" class="img-rounded" >
		</div>
		</div> --}}



		{{-- <div class="row">
			<div class="col-md-12">

				<div class="item-images">

					<a href="#">
						<img src="{{$product->getImage()}}" class="img-rounded" />
					</a>

					<div class="next-prev-nav">
						<a href="#" class="prev"></a>
						<a href="#" class="next"></a>
					</div>

					<div class="items-nav">
					</div>
				</div>

			</div>
		</div> --}}

		<script>
			function myFunction(imgs) {
			  var expandImg = document.getElementById("expandedImg");
			  var imgText = document.getElementById("imgtext");
			  expandImg.src = imgs.src;
			  imgText.innerHTML = imgs.alt;
			  expandImg.parentElement.style.display = "block";
			}
		</script>

		{{-- <script type="text/javascript">
			jQuery(document).ready(function($)
			{
				$(".item-images").cycle({
					slides: '> a',
					prev: '.next-prev-nav .prev',
					next: '.next-prev-nav .next',
					pager: '.items-nav',
					pagerActiveClass: 'active',
					pagerTemplate: '<a href="#"></a>',
					swipe: true
				});
			});
		</script> --}}

		<!-- Portfolio Description and Other Details -->
		<div class="row item-description">

			<div class="col-sm-8">

				<p class="text-justify">
                    {{$product->description}}
                  </p>


			</div>

			<div dir="ltr" class="col-sm-4">

				<dl>
					<dt>{{$product->user->first_name.' '.$product->user->last_name}}</dt>
					<dd><b>:المزود<b></dd>

						<dt>{{$product->category->name}}</dt>
						<dd><b>:الصنف<b></dd>


							<dt>{{$product->name}}</dt>
							<dd><b>:البضاعة<b></dd>


				</dl>

			</div>

		</div>

	</div>


</section>


<hr>


<section class="portfolio-container">

	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h3>أضف تقييمك</h3>
			</div>
		</div>

		<br>
		<div class="row">

            <form action="{{route('site.productReview.store',$product->id)}}" method="post"
                role="form" class="form-horizontal form-groups-bordered">
                        @csrf()
                    <span class="star-rating star-5">
                        <input type="radio" name="stars" value="1"><i></i>
                        <input type="radio" name="stars" value="2"><i></i>
                        <input type="radio" name="stars" value="3"><i></i>
                        <input type="radio" name="stars" value="4"><i></i>
                        <input type="radio" name="stars" value="5"><i></i>
                    </span>

                    <div class="row">
                        <div class="col-md-12">
                            <h3>أضف مراجعتك</h3>
                        </div>
                    </div>
                    <br>
                    <textarea name="body" cols="30" rows="10">

                    </textarea>
                    <div class="callout-button">
                        <button type="submit" class="btn btn-success"><i class="entypo-star"></i>تأكيد</button>

                    </div>
                </form>
	</div>
</div>
<br>
<br>

<div class="container">

<h3>
	<i class="entypo-chat"></i>
		مراجعات التجار
</h3>

<div class="sidebar-content">

	<div style="color:gold;font-size:20px" class="details">
		<i class="entypo-star"> عدد النجوم من 5 هنا </i>
	</div>
	<ul class="discussion-list">
        @foreach ($product->reviews as $review)

        {{-- <a href="{{route('site.providers.show',$item->id)}}" class="thumb">
            <img src="{{$item->getImage()}}" width="43" class="img-circle')}}" />
        </a> --}}

        {{-- <div class="details">
            <a href="{{route('site.providers.show',$item->id)}}">{{$item->first_name.' '.$item->last_name}}</a>
        </div> --}}
        <hr>
        <br>
        <li>
            <p>
                <img src="{{$review->seller->getImage()}}" width="43" class="img-circle')}}" />
                <a href="#">{{$review->seller->first_name.' '.$review->last_name}}</a>
                <p style="margin-right: 60px">
                    {{$review->body}}
                </p>
            </p>

        </li>

    @endforeach
	</ul>


	</div>

</div>

</section>

<hr>

<section class="portfolio-container">

	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h3>بضائع مشابهة</h3>
			</div>
		</div>

		<div class="row">

          @if(count($related_products) >= 1)
          @foreach ($related_products as $item)
          <div class="col-sm-4 col-xs-6">

              <div class="portfolio-item">
				<div class="index-items">

                  <a href="{{route('site.products.show',$item->id)}}" class="image">
                      <img src="{{$item->getImage()}}" class="img-rounded" />
                      <span class="hover-zoom"></span>
                  </a>

                  <h4>
                      <a href="#" class="like">
                          <i class="entypo-heart"></i>
                      </a>

                      <a href="{{route('site.products.show',$item->id)}}" class="name">{{$item->name}}</a>
                  </h4>

                  <div class="categories">
                      <a href="{{route('site.products.index',['category_id'=>$item->category->id])}}">{{$item->category->name}}</a>
                  </div>
              </div>
			</div>

          </div>
          @endforeach
          @else
          <h3 class="text-center">لا يوجد بضائع مشابهة</h3>
          @endif

		</div>

	</div>

</section>

@else

    <h3 class="text-center" >البضاعه غير موجودة </h3>
</section>

@endif

{{-- @section('script')


@endsection --}}

@endsection()
