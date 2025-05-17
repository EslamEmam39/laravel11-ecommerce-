 
    $(document).ready(function(){

        $(document).on('click','.cart_button',function(e){

            e.preventDefault()

             let product  = $(this).attr('productID')
             let quantity   = $('#quantity_input').val()

            $.ajax({
             method : 'post' ,
             url : '/add-cart' ,
             data: {
                productID : product ,
                quantity : quantity 
             },
             headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             } , 
             success: function(response){
               if(response.data == 1){
                Swal.fire({
                    title: 'Done!',
                    text: 'The Product Add to Cart Successfully',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                    })
               }else if( response.data == 0){
                Swal.fire({
                    title: 'Error!',
                    text: 'The Product Alrady Existe Cart ',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                    })
               }
             }
            })
            
              
       })
    })
 