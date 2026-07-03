<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();

        if ($orders->isEmpty()) {
            return;
        }

        $names = ['John Doe', 'Alice Smith', 'Mohamed Ali', 'Sara Ahmed', 'Emily Watson'];
        $addresses = ['123 Main St, New York, NY', '456 Oak Rd, London, UK', '789 Nile St, Cairo, Egypt', '321 Pine Ave, Sydney, Australia'];

        foreach ($orders as $order) {
            // Check if order details already exist for this order
            if (!OrderDetail::where('order_id', $order->id)->exists()) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'name' => $names[array_rand($names)],
                    'phone' => '+1 (555) ' . rand(100, 999) . '-' . rand(1000, 9999),
                    'address' => $addresses[array_rand($addresses)],
                ]);
            }
        }
    }
}
