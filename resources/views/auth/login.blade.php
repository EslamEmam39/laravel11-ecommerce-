 @extends('auth.master')
@section('title','login')
 @section('content')

 <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
      <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">starlight <span class="tx-info tx-normal">admin</span></div>
      <div class="tx-center mg-b-60">Professional Admin Template Design</div>

      <div class="form-group">
        <input type="email" class="form-control" id="email"   placeholder="Enter your email">
      </div><!-- form-group -->
      <div class="form-group">
        <input type="password" id="password"  class="form-control" placeholder="Enter your password">
        <a href="{{route('user.forget.password')}}" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
      </div><!-- form-group -->
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

      let email = $('#email').val();
      let password = $('#password').val();
 
 
    if(email == '' || password == ''){

          Swal.fire({
          title: 'Error!',
          text: 'plz Enter password&Email',
          icon: 'error',
          confirmButtonText: 'Ok'
          })
    }else{

      $.ajax({

        method : 'post',
        url:'/user/login',

        data : {
       
          email:email,
          password:password
        },

        headers : {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        },

        success: function(response){
 
 
            if(response.data == 0){
                  Swal.fire({
                  title: 'Error!',
                  text: 'password&email worng',
                  icon: 'error',
                  confirmButtonText: 'Ok'
                  })

            }else if(response.data == 1){

              window.location.href = '/dashboard'
          
            }else if(response.data == 2){

            window.location.href = '/'
            
            }
 
        }

      })
    }
    
           })   
  })


 </script>
 
 @endsection