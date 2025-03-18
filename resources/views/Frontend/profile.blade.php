@extends('Frontend.master')

@section('title' , 'My Profile')

@section('css')
<link rel="stylesheet" type="text/css" href="styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">

@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h4>تعديل الملف الشخصي</h4>
                </div>
                <div class="card-body">
            
                    <form id="profileForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم الكامل</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"  >
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"  >
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور الجديدة (اختياري)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success ">حفظ التعديلات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
   
@endsection


@section('js')
<script>

    $(document).ready(function(){
        $('#profileForm').submit(function(e){
            e.preventDefault();

         let name = $('#name').val()
         let email = $('#email').val()
         let password = $('#password').val()
       

           if(name == '' || email == ''){
                Swal.fire({
                title: 'Error!',
                text: 'Do you want to continue',
                icon: 'error',
                confirmButtonText: 'Cool'
                })
                return;
           }

           $.ajax({
            url: "{{ route('user.profile.update') }}", // تأكد أن لديك مسار تحديث الملف الشخصي في الـ routes
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                name: name,
                email: email,
                password: password,
            },
            success: function(response) {
                Swal.fire({
                    title: 'تم التحديث!',
                    text: 'تم تعديل بياناتك بنجاح.',
                    icon: 'success',
                    confirmButtonText: 'موافق'
                });
                console.log(response)
            },
            error: function() {
                Swal.fire({
                    title: 'خطأ!',
                    text: 'حدث خطأ أثناء تحديث البيانات. حاول مرة أخرى لاحقًا.',
                    icon: 'error',
                    confirmButtonText: 'حسنًا'
                });
            }
           });
        });  
    });
</script>
@endsection