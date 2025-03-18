@extends('Frontend.master')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('styles/contact_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('styles/contact_responsive.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('styles/cart_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('styles/cart_responsive.css')}}">

@endsection

@section('content')
 

<div class="container mt-5">
    <div class="row">
        <!-- قسم الفورم -->
        <div class="col-lg-6">
            <div class="card p-4 shadow">
                <h4 class="mb-3">معلومات الفاتورة</h4>
                <form>
                    <div class="mb-3">
                        <label class="form-label">الاسم الكامل</label>
                        <input type="text" id="name" class="form-control"  placeholder="أدخل اسمك">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" id="email" class="form-control" placeholder="example@email.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">العنوان الأول</label>
                        <input type="text" id="address1" class="form-control" placeholder="عنوانك الأساسي">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">العنوان الثاني (اختياري)</label>
                        <input type="text" id="address2" class="form-control" placeholder="عنوان إضافي">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">رقم الهاتف</label>
                        <input type="tel" id="phone" class="form-control" placeholder="+20 10XXXXXXX">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">كود الخصم</label>
                        <div class="input-group">
                            <input type="text" id="coupon" name="coupon" class="form-control" placeholder="أدخل الكوبون">
                            {{-- <button class="btn btn-primary" id="applyCoupon">تفعيل</button> --}}
                        </div>
                        {{-- <small id="discountMessage" class="text-success d-none"></small> --}}
                    </div>
                    
                 

                    {{-- إجمالي الطلب --}}
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">المحافظه</label>
                            <input type="text" id="city" class="form-control">

                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">العاصمة</label>
                            <input type="text" id="country" class="form-control" placeholder="أدخل العاصمة">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- قسم الجدول -->
        <div class="col-lg-6">
            <div class="card p-4 shadow">
                <h4 class="mb-3">تفاصيل الطلب</h4>
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>اسم المنتج</th>
                            <th>العدد</th>
                            <th>السعر</th>
                            <th>الإجمالي</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $cart as $val )
                        <tr>
                            @php($product = DB::table('products')->where('id' , '=' , $val->product_id)->first())
                            <td>{{$product->name}}</td>
                            <td>{{$val->quantity}}</td>
                            <td>{{$product->new_price}}</td>
                            <td>{{$product->new_price * $val->quantity}}</td>
                        </tr>
                        @endforeach
                    
                        <tr class="table-secondary">
                            <td colspan="3">    <strong > {{ $all  }}</strong>  </td>
                            <td><strong>الإجمالي الكلي</strong> </td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-primary w-100 btnOrder">إتمام الشراء</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 

 
 
@endsection

@section('js')

<script>

    $(document).ready(function(){
        
        $('.btnOrder').click(function(e){

            e.preventDefault();

            let name = $('#name').val();
            let email = $('#email').val();
            let address1 = $('#address1').val();
            let address2 = $('#address2').val();
            let phone = $('#phone').val();
            let coupon = $('#coupon').val();
            let country = $('#country').val();
            let city = $('#city').val();
         

            if(name == '' || email == "" || address1 == '' || phone == ''|| country == '' || city == ''){
                Swal.fire({
            title: 'Error!',
            text: 'Please fill in all required fields.',
            icon: 'error',
            confirmButtonText: 'Try Again'
        });
            }

            $.ajax({
                url: "/checkout", // تأكد من إنشاء الراوت المناسب
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name,
                    email: email,
                    address1: address1,
                    address2: address2,
                    phone: phone,
                    coupon: coupon,
                    country: country,
                    city: city,
                    
                 
                },
                success: function(response) {

          
                    if (response.data) { // التحقق من أن هناك بيانات

                     
                    Swal.fire({
                        title: 'Success!',
                        text: 'Order Added Successfully',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then(() => {
                                window.location.href = "/";
                            });
                        } else {
                            Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while adding the order.',
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                            });
                        }
                    // console.log(response)
                 }
            });
        });

    


    });
 
</script>

@endsection