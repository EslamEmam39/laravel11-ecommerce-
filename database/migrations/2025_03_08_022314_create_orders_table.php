<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable(); // ربط الطلب بالمستخدم (إذا كان مسجلًا)
            $table->string('user_ip')->nullable(); // تخزين IP المستخدم للطلبات بدون تسجيل
            $table->longText('product_id'); // ربط المنتج بالطلب
            $table->string('total'); // السعر الإجمالي بالدقة الصحيحة
            $table->longText('quantity'); // السعر الإجمالي بالدقة الصحيحة
            $table->string('ref')->nullable(); // رقم مرجعي للطلب (يمكن استخدامه للفواتير)
            $table->string('status')->default('pending'); // حالة الطلب (بانتظار المعالجة)
            $table->string('payment_method')->default('cod'); // طريقة الدفع (افتراضيًا الدفع عند الاستلام)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
