<!DOCTYPE html>
<html lang="en">
<head>
@php($data = DB::table('general_settings')->first())
<title>{{$data->name}} -@yield('title')</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{asset('styles/bootstrap4/bootstrap.min.css')}}">
<link href="{{asset('plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/OwlCarousel2-2.2.1/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/slick-1.8.0/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('styles/main_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('styles/responsive.css')}}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
 
 
@yield('css')

<style>
 
/* حاوية عناصر القائمة التي ستعرض بجانب بعضها */
.menu_items {
    display: flex;  /* لعرض العناصر بجانب بعضها */
    justify-content: space-around;  /* توزيع العناصر بشكل متساوي */
	padding: 4px 0;
    
}

/* تنسيق الروابط داخل القائمة */
.menu_items a {
    text-decoration: none;  /* إزالة التسطير */
    color: #333;  /* لون النص */
	padding: 0px 9px;
    font-size: 16px;
}

.menu_items a:hover {
    color: #ff7f00;  /* تغيير اللون عند التمرير على الرابط */
}

/* تنسيق زر البرغر */
.menu_burger {
    display: block;
    cursor: pointer;  /* تغيير شكل المؤشر عند التمرير فوق الزر */
}

.menu_burger span {
    display: block;
    width: 25px;
    height: 4px;
    margin: 5px;
    background-color: #333;  /* لون الأشرطة */
}

 
			
</style>
 
</head>

<body>
 
 
<div class="super_container">
	
	<!-- Header -->
	
	
   @include('Frontend.layouts.header')
	
	
	<!-- Banner -->

   @yield('content')

	<!-- Footer -->

   @include('Frontend.layouts.footer')

	<!-- Copyright -->

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col">
					
					<div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
						<div class="copyright_content"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with Eslam Crespo <i class="fa fa-heart" aria-hidden="true"></i>  
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</div>
					 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
 
// إضافة الـ active class عند النقر على الزر
document.getElementById("menuTrigger").addEventListener("click", function() {
    // التبديل بين إضافة وإزالة الـ active class
    document.querySelector('.menu_trigger_container').classList.toggle("active");
});




</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{asset( 'js/jquery-3.3.1.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{asset('styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('plugins/slick-1.8.0/slick.js')}}"></script>
<script src="{{asset('plugins/easing/easing.js')}}"></script>
<script src="{{asset('plugins/Isotope/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('plugins/jquery-ui-1.12.1.custom/jquery-ui.js')}}"></script>
<script src="{{asset('plugins/parallax-js-master/parallax.min.js')}}"></script>

<script src="{{ asset('js/addToFav.js') }}"></script>
<script src="{{ asset('js/addToCart.js') }}"></script>
<script src="{{ asset('js/search.js') }}"></script>
 
<script src="{{asset('js/shop_custom.js')}}"></script>
<script src="{{asset('js/cart_custom.js')}}"></script>
<script src="{{asset('js/product_custom.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
 
 
@yield('js')


</body>

</html>