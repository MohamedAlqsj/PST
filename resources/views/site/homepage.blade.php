@extends('site.base_layouts.app')

@section('content')



	<!-- Main Slider -->
<section class="slider-container" style="background-image: url({{asset('front/neon-frontend/assets/images/slide-img-1-bg.png')}});">

	<div class="container">

		<div class="row">

			<div class="col-md-12">

				<div class="slides">

					<!-- Slide 1 -->
					<div class="slide">

						<div class="slide-content">
							<h2>
									مشروع وصلة 
							</h2>

							<p>
								مشروع و صلة جاء ليسهل حميع العمليات التجارية بين أصحاب المحلات و المزودين باستخدام الأساليب الحديثة و توفير الوقت و الجهد و حساب الفواتير بشكل دقيق
							</p>
						</div>

						<div class="slide-image">

							<a href="#">
								<img src="{{asset('uploads/ship.webp')}}"  class="img-rounded img-responsive" />

							</a>
						</div>

					</div>

					<!-- Slide 2 -->
					<div class="slide" data-bg="{{asset('front/neon-frontend/assets/images/slide-img-1-bg.png')}}">

						<div class="slide-image">

							<a href="#">
								<img src="{{asset('uploads/warehouse.jpg')}}"  width="350px" height="80px" class="img-rounded img-responsive" />

							</a>
						</div>

						<div class="slide-content text-right">
							<h2>
								{{-- <small>Neon - Bootstrap 3</small> --}}
									خدماتنا
 							</h2>

							<p>
								-	توفير آلية تواصل سهلة بين المزودين و أصحاب المحلات 
								<br> -	توفير آلية من خلالها يتستطيع المزودين عرض منتجاتهم على الموقع 
								<br> -	توفير تطبيق و موقع سهل الاستخدام 
								<br> -	تخزين جميع المعاملات و الفواتير بين الطرفين 
								<br> -	توفير آلية دفع إلكتروني على الموقع و التطبيق	 

							</p>

						</div>

					</div>

					<!-- Slide 3 -->
					<div class="slide">

						<div class="slide-content">
							<h2>
								{{-- <small>Neon - Bootstrap 3</small> --}}
									ما هو المميز ؟
							</h2>

							<p>
								الفكرة جديدة و تبعتر ميزة تنافسية حيث لا أحد من قبل قد طرحها في القطاع.
								ما يميزنا هو توفير تطبيق و موقع إلكتروني من خلاله يتعامل المزودين مع أصحاب المحلات بأسهل الطرق السلسة
								 موفرين بذلك الوقت و الجهد و ضمان تخزين الفواتير بينهم على الموقع و التطبيق

							</p>
						</div>

						<div class="slide-image">

							<a href="#">
								<img src="{{asset('uploads/ship2.jpg')}}"  class="img-rounded img-responsive" />
							</a>
						</div>

					</div>

					<!-- Slider navigation -->
					<div class="slides-nextprev-nav">
						<a href="#" class="prev">
							<i class="entypo-left-open-mini"></i>
						</a>
						<a href="#" class="next">
							<i class="entypo-right-open-mini"></i>
						</a>
					</div>
				</div>

			</div>

		</div>

	</div>

</section>
<!-- Features Blocks -->
{{-- <section class="features-blocks">

	<div class="container">

		<div class="row vspace"><!-- "vspace" class is added to distinct this row -->

			<div class="col-sm-4">

				<div class="feature-block">
					<h3>
						<i class="entypo-cog"></i>
						Settings
					</h3>

					<p>
						Fifteen no inquiry cordial so resolve garrets as. Impression was estimating surrounded solicitude indulgence son shy.
					</p>
				</div>

			</div>

			<div class="col-sm-4">

				<div class="feature-block">
					<h3>
						<i class="entypo-gauge"></i>
						Dashboard
					</h3>

					<p>
						On am we offices expense thought. Its hence ten smile age means. Seven chief sight far point any. Of so high into easy.
					</p>
				</div>

			</div>

			<div class="col-sm-4">

				<div class="feature-block">
					<h3>
						<i class="entypo-lifebuoy"></i>
						24/7 Support
					</h3>

					<p>
						Extremely eagerness principle estimable own was man. Men received far his dashwood subjects new.
					</p>
				</div>

			</div>

		</div>

		<!-- Separator -->
		<div class="row">
			<div class="col-md-12">
				<hr />
			</div>
		</div>

	</div>

</section> --}}
<!-- Portfolio -->
<section  class="portfolio-widget">

	<div  class="container">

		<div  class="row">

			<div class="container">
				<div class="row vspace">
					<div class="col-md-12">
			
						<div class="callout-action">
							<h3>
								أفضل البضائع
							</h3>			
							
						</div>
			
					</div>
				</div>
			</div>

		

		@foreach ($products as $product)
        <div style="float:right" class="col-sm-3">


			<div class="portfolio-item">
				<div class="index-items">
				<a href="{{route('site.products.show',$product->id)}}" class="image">
                    <img src="{{$product->getImage()}}" class="img-rounded"  style="width:100%"/>
                    <span class="hover-zoom"></span>
                </a>

                <h4>
                    <a href="portfolio-single.html" class="like">
                        <i class="entypo-heart"></i>
                    </a>

                    <a href="{{route('site.products.show',$product->id)}}" class="name">{{$product->name}}</a>
                </h4>

                <div class="categories">
                    <a href="{{route('site.products.index',['category_id'=>$product->category->id])}}">{{$product->category->name}}</a>
                </div>
			  </div>
			</div>

            <!-- Portfolio Item in Widget -->
            {{-- <div class="portfolio-item">
                <a href="{{route('site.products.show',$product->id)}}" class="image">
                    <img src="{{$product->getImage()}}" class="img-rounded" />
                    <span class="hover-zoom"></span>
                </a>

                <h4>
                    <a href="portfolio-single.html" class="like">
                        <i class="entypo-heart"></i>
                    </a>

                    <a href="{{route('site.products.show',$product->id)}}" class="name">{{$product->name}}</a>
                </h4>

                <div class="categories">
                    <a href="{{route('site.products.index',['category_id'=>$product->category->id])}}">{{$product->category->name}}</a>
                </div>
            </div> --}}

        </div>
        @endforeach

			{{-- <div class="col-sm-3">

				<!-- Portfolio Item in Widget -->
				<div class="portfolio-item">
					<a href="portfolio-single.html" class="image">
						<img src="{{asset('front/neon-frontend/assets/images/portfolio-thumb-1.png')}}" class="img-rounded" />
						<span class="hover-zoom"></span>
					</a>

					<h4>
						<a href="portfolio-single.html" class="like liked">
							<i class="entypo-heart"></i>
						</a>

						<a href="portfolio-single.html" class="name">Motorola</a>
					</h4>

					<div class="categories">
						<a href="portfolio-single.html">Photography</a>
					</div>
				</div>

			</div>

			<div class="col-sm-3">

				<!-- Portfolio Item in Widget -->
				<div class="portfolio-item">
					<a href="portfolio-single.html" class="image">
						<img src="{{asset('front/neon-frontend/assets/images/portfolio-thumb-1.png')}}" class="img-rounded" />
						<span class="hover-zoom"></span>
					</a>

					<h4>
						<a href="portfolio-single.html" class="like">
							<i class="entypo-heart"></i>
						</a>

						<a href="portfolio-single.html" class="name">Dribbble</a>
					</h4>

					<div class="categories">
						<a href="portfolio-single.html">UI Design</a>
					</div>
				</div>

			</div> --}}

		</div>

	</div>

</section>
<!-- Call for Action Button -->
<div class="container">
	<div class="row vspace">
		<div class="col-md-12">

			<div class="callout-action">
				<h2>تصفح جميع البضائع </h2>

				<div class="callout-button">
					<a href="{{route('site.products.index')}}" class="btn btn-secondary">تصفح</a>
				</div>
			</div>

		</div>
	</div>
</div>

<!-- Testimonails -->
<section class="testimonials-container">

	<div class="container">

		<div class="col-md-12">

			<div class="testimonials carousel slide" data-interval="8000">

				<div class="carousel-inner">

					<div class="item active">

						<blockquote>
							<p>
								أفضل المزودين<br />
								Pellentesque fermentum, ante ac interdum ullamcorper.
							</p>
							<small>
								<cite>Art Ramadani</cite> - co-founder at Laborator
							</small>
						</blockquote>

					</div>

					<div class="item">

						<blockquote>

							<small>
								<cite>Larry Page</cite> - co-founder at Google
							</small>
						</blockquote>

					</div>

					<div class="item">

						<blockquote>
							<p>
								Of regard warmth by unable sudden garden ladies. No kept hung am size spot no. <br />
								Likewise led and dissuade rejoiced welcomed husbands boy.
							</p>
							<small>
								<cite>Bill Gates</cite> - ceo at Microsoft
							</small>
						</blockquote>

					</div>

				</div>

			</div>

		</div>

	</div>

</section>


<!-- Client Logos -->
{{-- <section class="clients-logos-container">

	<div class="container">

		<div class="row">

			<div class="client-logos carousel slide" data-ride="carousel" data-interval="5000">

				<div class="carousel-inner">

					<div class="item active">

						<a href="#">
							<img src="assets/images/client-logo-1.png" />
						</a>

						<a href="#">
							<img src="assets/images/client-logo-1.png" />
						</a>

						<a href="#">
							<img src="assets/images/client-logo-1.png" />
						</a>

						<a href="#">
							<img src="assets/images/client-logo-1.png" />
						</a>

					</div>

					<div class="item">

						<a href="#">
							<img src="assets/images/client-logo-1.png" />
						</a>

						<a href="#">
							<img src="assets/images/client-logo-1.png" />
						</a>

						<a href="#">
							<img src="assets/images/client-logo-1.png" />
						</a>

						<a href="#">
							<img src="assets/images/client-logo-1.png" />
						</a>

					</div>

				</div>

			</div>

		</div>

	</div>

</section>	 --}}

@endsection()
