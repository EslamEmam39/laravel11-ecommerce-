<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   use HasFactory;

   protected  $guarded = [] ;

   protected $casts = [
    'quantity' => 'array', // الآن Laravel يحولها تلقائيًا إلى مصفوفة عند جلبها
];
   public function details()
   {
       return $this->hasOne(OrderDetail::class);
   }
 
}
