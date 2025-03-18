@extends('backend.master')

@section('title' , 'Edit Category')

@section('content')
<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{route('dashboard')}}">Dashboard</a>
    <a class="breadcrumb-item" href="{{route('category')}}">Category</a>

    <span class="breadcrumb-item active">Category Edit</span>
  </nav>

  <div class="sl-pagebody">




    <div class="row row-sm mg-t-20">
      <div class="col-xl-12">
        <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
          <h6 class="card-body-title">Edit Category</h6>

          <div class="row">
            <label class="col-sm-4 form-control-label">Category Name: </label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
              <input type="text" value="{{$data->name}}" id="name" class="form-control" placeholder="Category Name">
            </div>
          </div><!-- row -->
          <input type="hidden" id="id" value="{{$data->id}}">
          <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label">Order: </label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
              <input type="number" value="{{$data->order}}" id="order" class="form-control" placeholder="Order">
            </div>
          </div>
          <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label">Category Image: <span class="tx-danger">*</span></label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
              <input type="file" id="img" class="form-control">
            </div>
          </div>


          <div class="form-layout-footer mg-t-30">
            <button class="btn btn-info mg-r-5 addCat">Save</button>

          </div><!-- form-layout-footer -->
        </div><!-- card -->
      </div><!-- col-6 -->

    </div><!-- row -->



  </div><!-- sl-pagebody -->

</div><!-- sl-mainpanel -->
@endsection

@section('js')
<script>
  $(document).ready(function (){
     
        $('.addCat').click(function(e){
            e.preventDefault()

        var name = $('#name').val() ; // الحصول على اسم الفئة
        var id = $('#id').val() ; // الحصول على اسم الفئة

// الحصول على صورة باستخدام prop() بدلاً من val()
var img = $('#img').prop('files')[0];  // الحصول على الملف من حقل input

         if (name == '' || !img) { // التحقق إذا كانت الحقول فارغة
            Swal.fire({
              title: 'Error!',
              text: 'Please enter category name and select an image.',
              icon: 'error',
              confirmButtonText: 'Ok'
            });
         } else {
    // إنشاء كائن FormData
    var formData = new FormData();
    formData.append('name', name);  // إضافة الحقل name
    formData.append('order', $('#order').val());  // إضافة الحقل order
    formData.append('img', img);  // إضافة الصورة
    formData.append('id', id);  
  

    // إرسال البيانات عبر AJAX
    $.ajax({
        method: 'POST',
        url: '/category/update',
        processData: false,  // لا يتم معالجة البيانات
        contentType: false,  // لا يتم تعيين contentType
        data: formData,
        headers : {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
 
            if (response.data == 1) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Category updated successfully',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                })
            
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong while updating the category.',
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                title: 'Error!',
                text: 'An error occurred while updating the category. Please try again.',
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        }
    });
}
        });
    });
</script>
@endsection