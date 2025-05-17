@extends('Frontend.master')


@section('title' , 'Home')

@section('css')
<style>
	.viewed_slider_container{
		display: flex;
		align-items: center ;
	}
	.proView{
		width: 20%;
    text-align: center;
    margin-left: 10px;

	}
	.proView img {

		margin: auto;
		width: 100%;
	}

	.carousel-inner img {
    min-height: 500px;
    max-height: 500px;
    object-fit: contain; /* الصورة تظهر بالكامل */
    width: 100%;
	
}


.banner_2 {
    position: relative;
    padding: 80px 0;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}

.banner_2_content {
    background: rgba(0, 0, 0, 0.6);
    border-radius: 10px;
}

.banner_2_category {
    font-weight: bold;
    font-size: 16px;
}

.banner_2_title {
    font-size: 28px;
    font-weight: bold;
}

.banner_2_text {
    font-size: 18px;
}

.banner_2_image img {
    border-radius: 10px;
    transition: transform 0.3s ease-in-out;
}

.banner_2_image img:hover {
    transform: scale(1.05);
}

.rating_r i {
    font-size: 18px;
}

.button.banner_2_button a {
    font-size: 16px;
    font-weight: bold;
}
 



</style>
 

@endsection
 
@section('content')
<div class="container-fluid">
	<div id="imageSlider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
		<div class="carousel-inner">
			<!-- الصورة الأولى -->
			<div class="carousel-item active">
				<img src="{{ asset('images/Website-Banner-1.jpg') }}" class="d-block w-100" 
					 alt="Slider Image 1" >
			</div>
	
			<!-- الصورة الثانية -->
			<div class="carousel-item">
				<img src="{{ asset('images/WhatsApp_Image_2023-03-06_at_12.18.57_PM.webp') }}" class="d-block w-100" 
					 alt="Slider Image 2"  >
			</div>
	
			<!-- الصورة الثالثة -->
			<div class="carousel-item">
				<img src="{{ asset('images/bannner1-1-1.jpg') }}" class="d-block w-100" 
					 alt="Slider Image 3">
			</div>
		</div>
	
		<!-- أزرار التنقل -->
		<button class="carousel-control-prev" type="button" data-bs-target="#imageSlider" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#imageSlider" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
		</button>
	
		<!-- مؤشرات (Dots) -->
		<div class="carousel-indicators">
			<button type="button" data-bs-target="#imageSlider" data-bs-slide-to="0" class="active"></button>
			<button type="button" data-bs-target="#imageSlider" data-bs-slide-to="1"></button>
			<button type="button" data-bs-target="#imageSlider" data-bs-slide-to="2"></button>
		</div>
	</div>
	
</div>
  <!-- Banner -->
 


<!-- Characteristics -->

<div class="characteristics">
	<div class="container">
		<div class="row">

			<!-- Char. Item -->
			<div class="col-lg-3 col-md-6 char_col">
				
				<div class="char_item d-flex flex-row align-items-center justify-content-start">
					<div class="char_icon"><img src="{{asset('images/char_1.png')}}" alt=""></div>
					<div class="char_content">
						<div class="char_title">Free Delivery</div>
						<div class="char_subtitle">from $50</div>
					</div>
				</div>
			</div>

			<!-- Char. Item -->
			<div class="col-lg-3 col-md-6 char_col">
				
				<div class="char_item d-flex flex-row align-items-center justify-content-start">
					<div class="char_icon"><img src="{{asset('images/char_2.png')}}" alt=""></div>
					<div class="char_content">
						<div class="char_title">Free Delivery</div>
						<div class="char_subtitle">from $50</div>
					</div>
				</div>
			</div>

			<!-- Char. Item -->
			<div class="col-lg-3 col-md-6 char_col">
				
				<div class="char_item d-flex flex-row align-items-center justify-content-start">
					<div class="char_icon"><img src="{{asset('images/char_3.png')}}" alt=""></div>
					<div class="char_content">
						<div class="char_title">Free Delivery</div>
						<div class="char_subtitle">from $50</div>
					</div>
				</div>
			</div>

			<!-- Char. Item -->
			<div class="col-lg-3 col-md-6 char_col">
				
				<div class="char_item d-flex flex-row align-items-center justify-content-start">
					<div class="char_icon"><img src="{{asset('images/char_4.png')}}" alt=""></div>
					<div class="char_content">
						<div class="char_title">Free Delivery</div>
						<div class="char_subtitle">from $50</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Deals of the week -->

<div class="deals_featured">
	<div class="container">
		<div class="row">
			<div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">
				
				<!-- Deals -->

				<div class="deals">
					<div class="deals_title">Deals of the Week</div>
					<div class="deals_slider_container">
						
						<!-- Deals Slider -->
						<div class="owl-carousel owl-theme deals_slider">
							@foreach ($weak_deals as $val )
							<!-- Deals Item -->
							<div class="owl-item deals_item">
								<div class="deals_image"><img src="{{asset($val->img)}}" alt=""></div>
								<div class="deals_content">
									<div class="deals_info_line d-flex flex-row justify-content-start">
										@php($category = DB::table('categories')->where('id' ,'=' , $val->category)->first())
										<div class="deals_item_category"><a href="{{route('products.by.category',$category->id)}}">{{$category->name}}</a></div>
										<div class="deals_item_price_a ml-auto">
											@if ($val->old_price != '')
												<span style="text-decoration: line-through;color:red">LE {{$val->old_price}}</span>
											@endif
											 </div>
									</div>
									<div class="deals_info_line d-flex flex-row justify-content-start">
										<div class="deals_item_name">{{$val->name}}</div>
										<div class="deals_item_price ml-auto text-dark">LE {{$val->new_price}}</div>
									</div>
									<div class="available">
										<div class="available_line d-flex flex-row justify-content-start">
											<div class="available_title">Available: <span>6</span></div>
											<div class="sold_title ml-auto">Already sold: <span>28</span></div>
										</div>
										<div class="available_bar"><span style="width:17%"></span></div>
									</div>
									<div class="deals_timer d-flex flex-row align-items-center justify-content-start">
										<div class="deals_timer_title_container">
											<div class="deals_timer_title">Hurry Up</div>
											<div class="deals_timer_subtitle">Offer ends in:</div>
										</div>
										<div class="deals_timer_content ml-auto">
											<div class="deals_timer_box clearfix" data-target-time="">
												<div class="deals_timer_unit">
													<div id="deals_timer1_hr" class="deals_timer_hr"></div>
													<span>hours</span>
												</div>
												<div class="deals_timer_unit">
													<div id="deals_timer1_min" class="deals_timer_min"></div>
													<span>mins</span>
												</div>
												<div class="deals_timer_unit">
													<div id="deals_timer1_sec" class="deals_timer_sec"></div>
													<span>secs</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						   @endforeach
						</div>

					</div>

					<div class="deals_slider_nav_container">
						<div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
						<div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
					</div>
				</div>
				
				<!-- Featured -->
				<div class="featured">
					<div class="tabbed_container">
						<div class="tabs">
							<ul class="clearfix">
								<li class="active">Featured</li>
								<li>On Sale</li>
							 
							</ul>
							<div class="tabs_line"><span></span></div>
						</div>

						<!-- Product Panel Feature-->
						<div class="product_panel panel active">
							<div class="featured_slider slider">

								<!-- Slider Item -->
								@foreach ($ProductFeatured  as $val )
					
								<div class="featured_slider_item">
									<div class="border_active"></div>
									<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
										<div class="product_image d-flex flex-column align-items-center justify-content-center"><img style="width:180px;" src="{{asset($val->img)}}" alt=""></div>
										<div class="product_content">
											<div class="product_price discount text-uppercase" style="color: black;margin-top: 33px;">
												LE {{$val->new_price}}
										     	@if ($val->old_price != '')
												<span style="text-decoration: line-through;color:red">LE {{$val->old_price}}</span>
											   @endif
										 
											</div>
											<div class="product_name"><div><a href="{{route('products.view',$val->id)}}">{{$val->name}}</a></div></div>
											<div class="product_extras">
									 
												<button class="product_cart_button cart_button" productID='{{ $val->id }}'>Add to Cart</button>
											</div>
										</div>
										<div class="product_fav" productID = '{{$val->id}}'> <i class="fas fa-heart"></i></div>
										<ul class="product_marks">
											<li class="product_mark product_discount">new</li>
											<li class="product_mark product_new">new</li>
										</ul>
									</div>
								</div>
							@endforeach
			 

							</div>
							<div class="featured_slider_dots_cover"></div>
						</div>

						<!-- Product Panel OneSale -->

						<div class="product_panel panel">
							<div class="featured_slider slider">
								   
								@foreach ( $onSale as $val )
								<!-- Slider Item -->
								<div class="featured_slider_item">
									<div class="border_active"></div>
									<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
										<div class="product_image d-flex flex-column align-items-center justify-content-center"><img style="width:180px;" src="{{asset($val->img)}}" alt=""></div>
										<div class="product_content">
											<div class="product_price discount text-uppercase" style="color: black;margin-top: 33px;">
												LE {{$val->new_price}}
										     	@if ($val->old_price != '')
												<span style="text-decoration: line-through;color:red">LE {{$val->old_price}}</span>
											   @endif
										 
											</div>
											<div class="product_name"><div><a href="{{route('products.view',$val->id)}}">{{$val->name}}.</a></div></div>
											<div class="product_extras">
												<button class="product_cart_button cart_button" productID='{{ $val->id }}'>
													Add to Cart
												</button>
											</div>
										</div>
										<div class="product_fav" productID = '{{$val->id}}'> <i class="fas fa-heart"></i></div>
										<ul class="product_marks">
											<li class="product_mark product_new">new</li>
											<li class="product_mark product_discount">-25%</li>
										 
										</ul>
									</div>
								</div>
								@endforeach

							</div>
							<div class="featured_slider_dots_cover"></div>
						</div>

			

						 
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<!-- Popular Categories -->

<div class="popular_categories">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="popular_categories_content">
					<div class="popular_categories_title">Popular Categories</div>
					<div class="popular_categories_slider_nav">
						<div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
						<div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
					</div>
				 
				</div>
			</div>
			
			<!-- Popular Categories Slider -->

			<div class="col-lg-9">
				<div class="popular_categories_slider_container">
					<div class="owl-carousel owl-theme popular_categories_slider">

						<!-- Popular Categories Item -->
						@foreach ($categories as $val )
						<div class="owl-item">
							<div class="popular_category d-flex flex-column align-items-center justify-content-center">
								<div class="popular_category_image"><img src="{{$val->img}}" alt=""style=" "> </div>
							<a href="{{route('products.by.category',$val->id)}}">	<div class="popular_category_text">{{$val->name}}</div></a> 
							</div>
						</div>
					   @endforeach
					</div> 
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Banner -->

<div class="banner_2">
    <div class="banner_2_background" style="background-image:url('{{ asset('images/WhatsApp Image 2025-02-13 at 01.13.42_7a19c16e.jpg') }}');"></div>
    <div class="banner_2_container">
        <div class="banner_2_dots"></div>

        <!-- Banner 2 Slider -->
        <div class="owl-carousel owl-theme banner_2_slider">
            @foreach ($weak_deals as $val)
            <div class="owl-item">
                <div class="banner_2_item d-flex align-items-center">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-md-6">
                                <div class="banner_2_content p-4">
                                    @php($category = DB::table('categories')->where('id', $val->category)->first())
                                    <div class="banner_2_category text-uppercase text-white bg-primary px-3 py-1 rounded">
                                        {{ $category->name }}
                                    </div>
                                    <h2 class="banner_2_title text-white mt-3">{{ $val->name }}</h2>
                                    <p class="banner_2_text text-light">{{ $val->des }}</p>
                                    <div class="rating_r rating_r_4 banner_2_rating mb-3">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star text-muted"></i>
                                    </div>
                                    <a href="{{ route('products.view', $val->id) }}" class="btn btn-warning px-4 py-2 shadow">Explore</a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6 text-center">
                                <div class="banner_2_image_container">
                                    <img src="{{ asset($val->img) }}" alt="Product Image" class="img-fluid rounded shadow-lg" 
                                         style="max-height: 400px; width: auto; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


<!-- Hot New Arrivals -->

<div class="new_arrivals">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="tabbed_container">
					<div class="tabs clearfix tabs-right">
						<div class="new_arrivals_title">Hot New Arrivals</div>
						<ul class="clearfix">
							<li class="active">Featured</li>
		 
						</ul>
						<div class="tabs_line"><span></span></div>
					</div>
					<div class="row">
						<div class="col-lg-12" style="z-index:1;">

							<!-- Product Panel -->
							<div class="product_panel panel active">
								<div class="arrivals_slider slider">

								 @foreach ( $ProductFeatured as $val )
									<!-- Slider Item -->
									<div class="arrivals_slider_item">
										<div class="border_active"></div>
										<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img style="width: 180px" src="{{asset($val->img)}}" alt=""></div>
											<div class="product_content">
												<div class="product_price discount text-uppercase mt-5" style="color: black;margin-top: 33px;">
													LE {{$val->new_price}}
													 @if ($val->old_price)
													<span style="text-decoration: line-through;color:red">LE {{$val->old_price}}</span>
												   @endif
											 
												</div>
												<div class="product_name"><div><a href="{{route('products.view',$val->id)}}">{{$val->name}}</a></div></div>
												<div class="product_extras">
												 
													<button class="product_cart_button cart_button" productID='{{ $val->id }}'>Add to Cart</button>
												</div>
											</div>
											<div class="product_fav" productID = '{{$val->id}}'> <i class="fas fa-heart"></i></div>
											<ul class="product_marks">
												<li class="product_mark product_discount">-25%</li>
												<li class="product_mark product_new">new</li>
											</ul>
										</div>
									</div>
								  @endforeach
							 
								</div>
								<div class="arrivals_slider_dots_cover"></div>
							</div>

						</div>

					</div>
							
				</div>
			</div>
		</div>
	</div>		
</div>

<!-- Recently Viewed -->

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="viewed_title_container d-flex justify-content-between align-items-center">
                <h3 class="viewed_title">Recently Viewed</h3>
                <div class="viewed_navs">
                    <button class="viewed_nav viewed_prev btn btn-outline-primary">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="viewed_nav viewed_next btn btn-outline-primary">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <div class="viewed_slider_container">
                <!-- Recently Viewed Slider -->
                <div class="row">
                    @forelse($views as $view)
                        @php($product = DB::table('products')->where('id', '=', $view->product_id)->first())

                        @if ($product)
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4">
                                <div class="proView">
                                    <div class="product_image">
                                        <img class="img-fluid" src="{{ asset($product->img) }}" alt="" />
                                    </div>
                                    <div class="product_details">
                                        <div class="product_price discount text-uppercase" style="color: black;">
                                            LE {{ $product->new_price }}
                                            @if ($product->old_price)
                                                <span style="text-decoration: line-through; color: red;">LE {{ $product->old_price }}</span>
                                            @endif
                                        </div>
                                        <div class="product_name">
                                            <a href="{{ route('products.view', $product->id) }}">{{ $product->name }}</a>
                                        </div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>
                        @endif

                    @empty
                        <p class="text-center text-danger" style="font-size: 22px;">لا توجد منتجات شاهدتها مؤخرًا.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Brands -->

 

<!-- Newsletter -->

<div class="newsletter">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
					<div class="newsletter_title_container">
						<div class="newsletter_icon"><img src="images/send.png" alt=""></div>
						<div class="newsletter_title">Sign up for Newsletter</div>
						<div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
					</div>
					<div class="newsletter_content clearfix">
						<form action="#" class="newsletter_form">
							<input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
							<button class="newsletter_button">Subscribe</button>
						</form>
						<div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

 

 

 