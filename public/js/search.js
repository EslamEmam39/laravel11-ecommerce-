 

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
 