  	
	<header class="header">

		<!-- Top Bar -->

		<div class="top_bar">
			<div class="container">
				@php($data = DB::table('general_settings')->first())
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{asset('images/phone.png')}}" alt=""></div>{{ $data->phone }}</div>
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{asset('images/mail.png')}}" alt=""></div><a href="mailto:zm72235@gmail.com">{{ $data->email }}</a></div>
						<div class="top_bar_content ml-auto">
						 
							<div class="top_bar_user">
								<div class="user_icon"><img src="{{asset('images/user.svg')}}" alt=""></div>
								@if(Auth::check())
								@role('user')
								<div><a href="{{route('user.logout')}}">Logout</a></div>
								<div><a href="{{ route('user.profile') }}">My Account</a></div>
								@endrole
								@role('admin')
								<div><a href="{{route('admin.logout')}}">Logout</a></div>
								<div><a href="{{route('dashboard')}}">Dashboard</a></div>
								@endrole
								@else
									<div><a href="{{route('register')}}">Register</a></div>
									<div><a href="{{route('login')}}">Sign in</a></div>
								@endif
								 <div style="margin-left: 1rem"><a href="{{route('my.orders')}}">My Orders</a></div>
							</div> 
							
						</div>
					</div>
				</div>
			</div>		
		</div>

		<!-- Header Main -->

		<div class="header_main">
			<div class="container">
				<div class="row">
                @php($categories =DB::table('categories')->orderBy( 'order','asc')->get())
					<!-- Logo -->
					<div class="col-lg-2 col-sm-3 col-3 order-1">
						<div class="logo_container">
						 
							<div class="logo">
							<a href="{{route('home')}}">
								<img src="{{ asset($data->logo) }}" alt="" style="width: 200px">
							</a>
						</div>
						</div>
					</div>

					<!-- Search -->
				 @include('Frontend.layouts.search')

					<!-- Wishlist -->
					<div class="col-lg-4  col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist_icon"><img src="{{asset('images/heart.png')}}" alt=""></div>
								<div class="wishlist_content">
									@if (Auth::check())
									@php($favorite =DB::table('favorites')->where('user_id' , '=' , Auth::user()->id)->count('id'))
									@else
									@php($ip = $_SERVER['REMOTE_ADDR'])
									@php($favorite =DB::table('favorites')->where('user_ip' , '=' , $ip)->count('id'))
									@endif
									<div class="wishlist_text"><a href="{{route('favorite.view')}}">Wishlist</a></div>
									<div class="wishlist_count text-primary" >{{$favorite}}</div>
								</div>
							</div>

							<!-- Cart -->
							@if (Auth::check())
							@php($cart =DB::table('carts')->where('user_id' , '=' , Auth::user()->id)->count('id'))
							@else
							@php($ip = $_SERVER['REMOTE_ADDR'])
							@php($cart =DB::table('carts')->where('user_ip' , '=' , $ip)->count('id'))
							@endif
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<img src="{{asset('images/cart.png')}}" alt="">
										<div class="cart_count"><span>{{$cart}}</span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="{{route('cart.view')}}">Cart</a></div>
										<div class="cart_price"></div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Main Navigation -->

		<nav class="main_nav">
			<div class="container">
				<div class="row">
					<div class="col">
						
						<div class="main_nav_content d-flex flex-row">

							<!-- Categories Menu -->

							<div class="cat_menu_container">
								<div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
									<div class="cat_burger"><span></span><span></span><span></span></div>
									<div class="cat_menu_text">categories</div>
								</div>
								
					<ul class="cat_menu">
						@foreach ($categories as $category)
					<li><a href="{{route('products.by.category',$category->id)}}">{{$category->name}} <i class="fas fa-chevron-right ml-auto"></i></a></li>

						@endforeach
							 
								</ul>
							</div>

							<!-- Main Nav Menu -->

							<div class="main_nav_menu ml-auto">
								<ul class="standard_dropdown main_nav_dropdown">
									<li><a href="{{route('home')}}">Home<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="{{route('super.deals')}}">Super Deals<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="{{route('products')}}">Products<i class="fas fa-chevron-down"></i></a></li>
									{{-- <li><a href="blog.html">Blog<i class="fas fa-chevron-down"></i></a></li> --}}
									<li><a href="{{ route('contact.us') }}">Contact<i class="fas fa-chevron-down"></i></a></li>
								</ul>
							</div>

							<!-- Menu Trigger -->

							<div class="menu_trigger_container ml-auto">
								<div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
									<div class="menu_burger">
										<div class="menu_trigger_text">menu</div>
										<div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</nav>
		
		<!-- Menu -->

		<div class="page_menu">
			<div class="container">
				<div class="row">
					<div class="col">
						
						<div class="page_menu_content">
							
							<div class="page_menu_search">
								<form action="#">
									<input type="search" id="btnSearch" required="required" class="page_menu_search_input" placeholder="Search for products...">
								</form>
							</div>
							<ul class="page_menu_nav">
								<li class="page_menu_item has-children">
									<a href="#">Language<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">English<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Italian<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Spanish<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Japanese<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item has-children">
									<a href="#">Currency<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">US Dollar<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">EUR Euro<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">GBP British Pound<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">JPY Japanese Yen<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item">
									<a href="#">Home<i class="fa fa-angle-down"></i></a>
								</li>
								<li class="page_menu_item has-children">
									<a href="#">Super Deals<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">Super Deals<i class="fa fa-angle-down"></i></a></li>
										<li class="page_menu_item has-children">
											<a href="#">Menu Item<i class="fa fa-angle-down"></i></a>
											<ul class="page_menu_selection">
												<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
												<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
												<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
												<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
											</ul>
										</li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item has-children">
									<a href="#">Featured Brands<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">Featured Brands<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item has-children">
									<a href="#">Trending Styles<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">Trending Styles<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item"><a href="blog.html">blog<i class="fa fa-angle-down"></i></a></li>
								<li class="page_menu_item"><a href="contact.html">contact<i class="fa fa-angle-down"></i></a></li>
							</ul>
							
							<div class="menu_contact">
								<div class="menu_contact_item"><div class="menu_contact_icon"><img src="{{asset('images/phone_white.png"')}}" alt=""></div>+38 068 005 3570</div>
								<div class="menu_contact_item"><div class="menu_contact_icon"><img src="{{asset('images/mail_white.png')}}" alt=""></div><a href="mailto:fastsales@gmail.com">fastsales@gmail.com</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</header>


	@section('js')
   <script>

	$(document).ready(function(){

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
	});
   </script>
	@endsection