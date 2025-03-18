@extends('auth.master')
@section('title','login')
 @section('content')

 <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
      <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Forget  <span class="tx-info tx-normal">Password   </span></div>
  <br>

      <div class="form-group">
        <input type="email" class="form-control" id="email"   placeholder="Enter your email">
      </div><!-- form-group -->
 <br>
      <button type="submit" class="btn btn-info btn-block">Sign In</button>

      <div class="mg-t-60 tx-center">Not yet a member? <a href="{{route('register')}}" class="tx-info">Sign Up</a></div>
    </div><!-- login-wrapper -->
  </div><!-- d-flex -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 @endsection

 @section('js')

 <script>
  
  $(document).ready(function( ){
    
      $('.btn-block').click(function(e){
      e.preventDefault();

      let email = $('#email').val()
 
    if(email == '' ){

          Swal.fire({
          title: 'Error!',
          text: 'plz Enter Email',
          icon: 'error',
          confirmButtonText: 'Ok'
          })
    }else{

      $.ajax({
            url: "/user/reset-password",
            method: "POST",
            data: {
                email: email,
                _token: $('meta[name="csrf-token"]').attr('content') // جلب CSRF Token
            },
            success: function (response) {
                if (response.data === 1) {
                    Swal.fire({
                        title: "Success!",
                        text: "An email has been sent to your inbox.",
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                } else {
                    Swal.fire({
                        title: "Error!",
                        text: "Email not found. Please check and try again.",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                Swal.fire({
                    title: "Error!",
                    text: "Something went wrong. Please try again later.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        });

       }
    
    })   
  })


 </script>
 
 @endsection