$(document).ready(function(){

    $(document).on("click",'.product_fav',function(e){
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