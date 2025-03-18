@extends('Frontend.master')
 

@section('css')
 <link rel="stylesheet" type="text/css" href="{{asset('styles/shop_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('styles/shop_responsive.css')}}">
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

</style>
@endsection

@section('content')

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">Products</h2>
    </div>
</div>

<!-- Shop -->

<div class="shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">

                <!-- Shop Sidebar -->
                <div class="shop_sidebar">
                    <div class="sidebar_section">
                        <div class="sidebar_title">Categories</div>
                        <ul class="sidebar_categories">
                            @foreach ($category as $val )
                            <li><a href="{{route('products.by.category',$val->id)}}">{{$val->name}}</a></li>
                            @endforeach
                        </ul>
                  </div>  
                </div>
            </div>
            <div class="col-lg-9"> 
                <!-- Shop Content -->
                <div class="shop_content">
                    <div class="shop_bar clearfix">
                        <div class="shop_product_count"><span>{{count($product)}}</span> products found</div>
                        <div class="shop_sorting">
                        </div>
                    </div>

                    <div class="product_grid">
                        <div class="product_grid_border"></div>
                        <!-- Product Item -->
                        @foreach ($product as $val )
                        <div class="product_item discount">
                            <div class="product_border"></div>
                            <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                <img src="{{asset($val->img)}}" alt="">
                            </div>
                            <div class="product_content">
                                <div class="product_price">{{$val->old_price}}EG<span>{{$val->new_price}}EG</span></div>
                                <div class="product_name"><div><a href="{{route('products.view',$val->id)}}" tabindex="0">{{$val->name}}</a></div></div>
                            </div>
                            <div class="product_fav" productID = '{{$val->id}}'> <i class="fas fa-heart"></i></div>
                            <ul class="product_marks">
                                <li class="product_mark product_discount">-25%</li>
                                <li class="product_mark product_new">new</li>
                            </ul>
                        </div>
                      @endforeach
                    </div>
                    <!-- Shop Page Navigation -->
                  {{$product->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

	<!-- Recently Viewed -->
	<div >
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Recently Viewed</h3>
						<div class="">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<div class="viewed_slider_container ">
						
						<!-- Recently Viewed Slider -->
							@foreach ($views as $view )
							<!-- Recently Viewed Item -->
							<div class="proView ">
								@php($product = DB::table('products')->where('id','=',$view->product_id)->first())

								<div >
									<div class=""><img src="{{asset($product->img)}}" alt=""></div>
									<div class="">
                                        <div class="">{{$product->new_price}}EG
                                            @if ($product->old_price != '')
                                                <span style="text-decoration: line-through ; color: red ;">{{$product->old_price}}EG</span> 
                                            @endif
                                        </div> 
										<div class=""><a href="{{route('products.view' ,$val->id)}}">{{$product->name}}</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							@endforeach	
					</div>
				</div>
			</div>
		</div>
	</div>
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

@section('js')
 <script>
    $(document).ready(function(){

        $('.product_fav').click(function(e){
            e.preventDefault();

            let product = $(this).attr('productID')
        
                $.ajax({
                    method : 'post' , 
                    url : '/add-favorite' ,
                    data : {
                        product :product 
                    },
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response)
                            if (response.data == 1) {
                            Swal.fire({
                            title: 'Success!',
                            text: 'Product added to Favorites successfully.',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                            })
                        } else if (response.data == 0) {
                            Swal.fire({
                            title: 'Error!',
                            text: 'This product is already in your Favorites.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                            });
                            }
                        }

              
                })
          
     
        })
    })

    $('.header_search_button').click(function(e){

    e.preventDefault();

 let btnSearch  = $('.header_search_input').val();

 if( btnSearch == ''){

    Swal.fire({
    title: 'Error!',
    text: 'Please enter a product name',
    icon: 'error',
    confirmButtonText: 'Ok'
    })

 }else{
    $.ajax({
        method : 'post',
        url : '/search-product',
        data :{
            'search' : btnSearch 
        } ,
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, 
        success: function(response) {
            if(response.data == 0){
                Swal.fire({
                title: 'Error!',
                text: 'Product Not Fount',
                icon: 'error',
                confirmButtonText: 'Ok'
                })
                // console.log(response);
            }
            else{
                window.location.href = '/search-result/'+ btnSearch + ''
            }

        }
    })
 }
})
 
 </script>
@endsection