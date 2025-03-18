@extends('backend.master')

@section('title' , 'Order')

@section('content')

     <div class="sl-mainpanel">

      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('dashboard') }}">Dashboard</a>
        <span class="breadcrumb-item active">Orders</span>
      </nav>

        <div class="card pd-20 pd-sm-40 mg-t-50">
 

          <div class="table-responsive">
            <table class="table table-hover table-bordered table-primary mg-b-0">
              <thead>
                <tr>
                    <th>#</th>
                    <th>اسم المنتج</th>
                    <th>الكمية</th>
                    <th>الإجمالي</th>
                    <th>الحالة</th>
                    <th>اسم العميل</th>
                    <th>العنوان</th>
                    <th>رقم الهاتف</th>
                    <th>التاريخ</th> <!-- العمود الجديد -->
                 
                </tr>
              </thead>
              <tbody>
                @foreach($orders as $order)
                @php
                    $productIds = is_string($order->product_id) ? json_decode($order->product_id, true) : [];
                    $quantities = is_string($order->quantity) ? json_decode($order->quantity, true) : [];
                @endphp

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    {{-- عرض أسماء المنتجات --}}
                    <td>
                        @if(!empty($productIds))
                            @foreach($productIds as $index => $productId)
                                @php
                                    $product = $products->firstWhere('id', $productId);
                                @endphp
                                <span>{{ $product->name ?? 'منتج غير موجود' }}</span><br>
                            @endforeach
                        @else
                            لا يوجد منتجات
                        @endif
                    </td>

                    {{-- عرض الكميات --}}
                    <td>
                        @if(!empty($quantities))
                            {{ implode(', ', $quantities) }}
                        @else
                            غير متوفر
                        @endif
                    </td>

                    {{-- عرض إجمالي الطلب --}}
                    <td>${{ $order->total }}</td>

               

                    {{-- حالة الطلب --}}
                    <td>
                        <button class="btn btn-sm change-status 
                        {{ $order->status == 'completed' ? 'btn-success' : ($order->status == 'pending' ? 'btn-warning' : 'btn-danger') }}"
                        data-id="{{ $order->id }}">
                        {{ ucfirst($order->status) }}
                    </button>
                    </td>

                    {{-- بيانات العميل --}}
                    <td>{{ $order->details->name ?? 'غير متوفر' }}</td>
                    <td>{{ $order->details->address ?? 'غير متوفر' }}</td>
                    <td>{{ $order->details->phone ?? 'غير متوفر' }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i') }}</td>


                
                </tr>
            @endforeach
          
              </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $orders->links('pagination::bootstrap-4') }}
            </div>

          </div><!-- table-responsive -->
 
        </div><!-- card -->

 
      </div><!-- sl-pagebody -->
      
    </div><!-- sl-mainpanel -->
   
 
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.change-status').click(function() {
            let button = $(this);
            let orderId = button.data('id');

            // اختيار الحالة الجديدة
            Swal.fire({
                title: 'تغيير حالة الطلب',
                input: 'select',
                inputOptions: {
                    'pending': 'Pending (قيد التنفيذ)',
                    'completed': 'Completed (مكتمل)',
                    'canceled': 'Canceled (ملغي)'
                },
                inputPlaceholder: 'اختر الحالة الجديدة',
                showCancelButton: true,
                confirmButtonText: 'تحديث',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    let newStatus = result.value;

                    // إرسال الطلب إلى السيرفر
                    $.ajax({
                        url: "{{ route('orders.updateStatus') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            order_id: orderId,
                            status: newStatus
                        },
                        success: function(response) {
                            if (response.success) {
                                // تحديث لون الزر ونصه
                                button.text(newStatus.charAt(0).toUpperCase() + newStatus.slice(1));
                                button.removeClass('btn-success btn-warning btn-danger');
                                if (newStatus == 'completed') {
                                    button.addClass('btn-success');
                                } else if (newStatus == 'pending') {
                                    button.addClass('btn-warning');
                                } else {
                                    button.addClass('btn-danger');
                                }

                                Swal.fire('تم التحديث!', 'تم تغيير حالة الطلب بنجاح.', 'success');
                            }
                        },
                        error: function() {
                            Swal.fire('خطأ!', 'حدث خطأ أثناء تحديث الحالة.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endsection