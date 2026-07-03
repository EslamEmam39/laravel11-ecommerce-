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
        Schema::table('coupons', function (Blueprint $table) {
            $table->enum('type', ['fixed', 'percent'])->default('percent');
            $table->decimal('value', 10, 2)->default(0);
            $table->dropColumn('discount');
        });
    }

    public function down(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->integer('discount');
            $table->dropColumn(['type', 'value']);
        });
    }
};
