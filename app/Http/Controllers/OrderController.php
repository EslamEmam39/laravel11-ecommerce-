<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class OrderController extends Controller
 
{

    public function showDetails()
    {
        if(Auth::check()){
          
            $cart = Cart::where('user_id', '=' , Auth::user()->id)->get();
              
            $totalPrice = DB::table('carts')->where('user_id' , '=' , Auth::user()->id)
            ->join('products', 'carts.product_id' , 'products.id')
            ->selectRaw('SUM(products.new_price *carts.quantity) as total')
            ->value('total') ;

            $all = $totalPrice ?? 0 ;

         

        }else{
        
            $ip = $_SERVER['REMOTE_ADDR'];

            $cart = Cart::where('user_ip' , '=' , $ip)->get() ;
    
            $totalPrice = DB::table('carts')
            ->where('user_ip', $ip)
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->selectRaw('SUM(products.new_price * carts.quantity) as total')
            ->value('total');
         
            $all = $totalPrice ?? 0;
           
        }


        return  view('Frontend.checkout-details' , compact('cart' , 'all')) ;


      
    }// End Method

    public function confirmOrder(Request $request)
    {

      if(Auth::check()){
        $cartItems = Cart::where('user_id' , '=' ,  Auth::user()->id)->get();
      
        if($cartItems->isEmpty()){
            return redirect()->route('cart.view')->with('error' , 'Cart is Empty');
        }

           $total = 0 ;
           $quantity = [] ;
        foreach($cartItems as $val){

            $product = Product::find($val->product_id);
           if($product){
            $total += $product->new_price * $val->quantity ;
            $quantity[] = $val->quantity ; 
           }
        }

        $order = Order::create([
            'user_id' => Auth::user()->id ,
            'product_id' => json_encode($cartItems->pluck('product_id')->toArray()),
            'total' => $total ,
            'quantity' => json_encode($quantity) , 
            'status' => 'pending' ,
        ]);

          $orderDetails = OrderDetail::create([
            'order_id' =>  $order->id , 
            'name'     =>  $request->name ,
            'phone'   =>  $request->phone , 
            'address' => $request->address1
          ]);
           
          Cart::where('user_id' ,'=', Auth::user()->id)->delete();
 
      }else{


        $user_ip = $_SERVER['REMOTE_ADDR'];
    
        // جلب جميع المنتجات من السلة
        $cartItems = Cart::where('user_ip', $user_ip)->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'السلة فارغة!');
        }
    
        $total = 0; 
        $quantity = [];
    
        foreach ($cartItems as $val) {
            $product = Product::where('id', $val->product_id)->first();
            
            if ($product) { 
                $total += $product->new_price * $val->quantity; // ضرب السعر في الكمية
                $quantity[] = $val->quantity;
            }
        }
 
        
        
    
        // إنشاء الطلب
        $order = Order::create([
            'user_ip'     => $user_ip,
            'product_id'  => json_encode($cartItems->pluck('product_id')->toArray()), // تخزين المنتجات كمصفوفة JSON
            'quantity'    => json_encode($quantity), // تخزين الكميات كمصفوفة JSON
            'total'       => $total, // حفظ الإجمالي بدون JSON
            'status'      => 'pending',
        ]);
    
        // حفظ بيانات التوصيل
        $orderDetails = OrderDetail::create([
            'order_id' => $order->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address1,
        ]);
    
        // حذف المنتجات من السلة
        Cart::where('user_ip', $user_ip)->delete();
    
       
      }

      return response()->json(['data' =>  [$order,$orderDetails]]);
 
    }// End Method
    public function admin_orders(){
        $orders = Order::latest()->with('details')->paginate(10);
        $products = Product::all();
     
         return view('backend.orders.index' ,compact('orders' ,'products'));
      }// End Method
     

public function updateStatus(Request $request)
{
    $order = Order::find($request->order_id);
    
    if (!$order) {
        return response()->json(['success' => false, 'message' => 'الطلب غير موجود!']);
    }

    $order->status = $request->status;
    $order->save();

    return response()->json(['success' => true, 'message' => 'تم تحديث حالة الطلب بنجاح!']);
}// End Method


 public function my_orders(){
     
   if(Auth::check()){
    $orders = Order::where('user_id' , '=' , Auth::user()->id)
    ->latest()->paginate(10);
    
   }else{
    $ip = $_SERVER['REMOTE_ADDR'];

    $orders =Order::where('user_ip' , '=' , $ip)

    ->latest()->paginate(10);
   }

    return view('Frontend.myOrders' , compact('orders'));
 }
  
}
