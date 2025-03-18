<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPassword;
use App\Models\Cart;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Favorite;
use App\Models\GeneralSetting;
use App\Models\Product;
use App\Models\ProductViewed;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use function Pest\Laravel\json;

class FrontEndController extends Controller
{
  public function home()
  { 
      $ProductFeatured = Product::where('isfeatured', '=' , 1)->latest()->paginate(8);
      $product = Product::orderBy('id', 'desc')->first();
      $weak_deals      =Product::latest()->paginate(3);
      $categories      =Category::all();
      $onSale          = Product::where('old_price' ,'!=' , null )->latest()->paginate(8);
      $ip              = $_SERVER['REMOTE_ADDR'];
      $views           =ProductViewed::where('ip' ,'=' ,$ip)->latest()->paginate(8);
    return view('Frontend.index' ,
    compact('product'  ,'ProductFeatured','weak_deals' ,'categories','onSale','views'));
  }//End Method

  public function products_by_category($id){
   
    $product = Product::where('category' ,'=' , $id)->latest()->paginate(10);
    $category = Category::all();
    $selctCat = Category::findOrFail($id);
  

    return view('Frontend.products-by-category', 
    compact('product','category','selctCat' ));
    
  }

  public function product_view($id){

    $product = Product::findOrFail($id); 
    $category = Category::where('id', '=' , $product->category)->first();

    $ip = $_SERVER['REMOTE_ADDR'];

    // dd($id , $ip);
    $check = ProductViewed::where([
      ['ip','=',$ip],
      ['product_id' , '=' , $id],
    ])->first();
    
    if(!$check){
     ProductViewed::insert([
      'ip'  => $ip ,
      'product_id' => $id ,
      'created_at' => Carbon::now()

    ]);
  }
  return view('Frontend.products.products-view' ,compact( 'product','category'));

}// End Method


 

  public function super_deals(){

    $category= Category::all();
    $product = Product::where('old_price', '!=' , null)->latest()->paginate(20);
    $ip              = $_SERVER['REMOTE_ADDR'];
    $views           =ProductViewed::where('ip' ,'=' ,$ip)->latest()->paginate(8);
   
    return view('Frontend.super_deals' ,  compact('product' , 'category' ,'views')) ;
 }// End Method

  public function products(){
    $category= Category::all();
    $product = Product::latest()->paginate(20);
    $ip              = $_SERVER['REMOTE_ADDR'];
    $views           =ProductViewed::where('ip' ,'=' ,$ip)->latest()->paginate(8);
   
    return view('Frontend.products' ,  compact('product' , 'category' ,'views')) ;

  }//End Method

  public function product_search(Request $request){

    $product = $request->search ;

    $data = Product::where('name' , 'LIKE' , '%'.$product.'%'  )->latest()->get();


    if (count($data) > 0) {
      return response()->json(['data' => 1]);
  } else {
      return response()->json(['data' => 0]);
  }

  // return response()->json(['data'=> $request->all()]);
  
}//End Method


public function search_result($data){
    $product     = Product::where('name' , 'LIKE' , '%'.$data.'%'  )->latest()->paginate(10);
    $category = Category::all();
    $ip       = $_SERVER['REMOTE_ADDR'];
    $views    =ProductViewed::where('ip' ,'=' ,$ip)->latest()->paginate(8);

    return view('Frontend.result_search' ,  compact('product' , 'category' ,'views' )) ;

}// End Method


  public function  add_cart(Request $request){
    $product = $request->productID ; 
    $quantity = $request->quantity ; 
  
 
    if(Auth::check()){

      $check = Cart::where([
        ['user_id', '=' , Auth::user()->id],
        ['product_id' , '=' , $product]
      ])->first();

      if($check){

          return response()->json(['data'=> 0]);

      }else{
        $cart = Cart::insert([
          'user_id' => Auth::user()->id,
          'product_id' =>$product ,
          'quantity' =>$quantity  ?? 1,
          'created_at' => Carbon::now()
      ]);

      }
     
    }else{

      $ip = $_SERVER['REMOTE_ADDR'];

      $check = Cart::where([
        ['user_ip', '=' , $ip],
        ['product_id' , '=' , $product]

      ])->first();

      if($check){

        return response()->json(['data'=> 0]);
      }
    
      $cart = Cart::insert([

        'user_ip' => $ip,
        'product_id' =>$product ,
        'quantity' => $quantity ?? 1,
        'created_at' => Carbon::now()
    ]);

    }

    return response()->json(['data'=>1]);

   } // End Method

   public function cart_view(){
    
    if(Auth::check()){

       $data = DB::table('carts')->where('user_id' , '=' , Auth::user()->id)
       ->join('products' , 'carts.product_id' , 'products.id')
       ->select('products.*' , 'carts.quantity')
       ->latest()->paginate(10);

       $totalPrice = DB::table('carts')
       ->where('user_id', Auth::user()->id)
       ->join('products', 'carts.product_id', '=', 'products.id')
       ->selectRaw('SUM(products.new_price * carts.quantity) as total')
       ->value('total');
    
       $all = $totalPrice ?? 0;
  

    }else{
      $ip = $_SERVER['REMOTE_ADDR'];
 
      $data = DB::table('carts')
      ->where('user_ip', $ip)
      ->join('products', 'carts.product_id', '=', 'products.id') // تم تصحيح الـ JOIN
      ->select('products.*', 'carts.quantity')
      ->latest()
      ->paginate(10);

      $totalPrice = DB::table('carts')
      ->where('user_ip', $ip)
      ->join('products', 'carts.product_id', '=', 'products.id')
      ->selectRaw('SUM(products.new_price * carts.quantity) as total')
      ->value('total');
   
      $all = $totalPrice ?? 0;
 
    }
 
    return view('Frontend.carts' , compact('data' ,'all'));
   }


    public function cart_delete($id){

          if(Auth::check()){
              $data = Cart::where([
                ['user_id' , '=', Auth::user()->id],
                ['product_id', '=', $id]

               ])->delete();

          }else{
              $ip = $_SERVER['REMOTE_ADDR'];

              $data = Cart::where([
                  ['user_ip' , '=', $ip],
                  ['product_id', '=', $id]
               ])->delete();
          }

    return response()->json(['data'=> 1]);

    }// End Method

     public function empty_cart(){
    
      if(Auth::check()){
        $cart = Cart::where('user_id' ,  Auth::user()->id)->delete();

      }else{
        $ip = $_SERVER['REMOTE_ADDR'];
        $cart = Cart::where('user_ip' ,  $ip)->delete();

      }


         return response()->json(['data'=> $cart]);
 
     }// End Method

     public function favorite_view(){
        if(Auth::check()){
         $data = DB::table('favorites')->where('user_id' ,'=' , Auth::user()->id)
         ->join('products' , 'favorites.product_id' , 'products.id' )
         ->select('products.*')
         ->latest()->paginate(10);
        }else{
          $ip = $_SERVER['REMOTE_ADDR'];
          $data = DB::table('favorites')->where('user_ip' ,'=' , $ip)
          ->join('products' , 'favorites.product_id' , 'products.id' )
          ->select('products.*')
          ->latest()->paginate(10);
        }
      return view ('Frontend.favorite-product' ,compact('data'));
     }
     public function add_favorite(Request $request) {
      $product = $request->product;
  
     
      if(Auth::check()) {
  
       
          $check = Favorite::where([
              ['user_id', '=', Auth::user()->id],
              ['product_id', '=', $product]
          ])->first();
  
          if ($check) {
            
              return response()->json(['data' => 0]);
          } else {
          
              $favorite = Favorite::create([
                  'user_id' => Auth::user()->id,
                  'product_id' => $product,
              ]);
          }   
  
      } else {
      
          $ip = $_SERVER['REMOTE_ADDR'];
  
 
          $check = Favorite::where([
              ['user_ip', '=', $ip],
              ['product_id', '=', $product]
          ])->first();
  
          if ($check) {
               return response()->json(['data' => 0]);
          } else {
               $favorite = Favorite::create([
                  'user_ip' => $ip,
                  'product_id' => $product,
              ]);
          }
      }
  
       return response()->json(['data' => 1]);
  }// End Method 

  public function delete_favorite($id){

    if(Auth::check()){

      $favorite = Favorite::where( [
           ['product_id' , '=' , $id],
           ['user_id' , '=' , Auth::user()->id]
      ])->delete();

    }else{

      $ip = $_SERVER['REMOTE_ADDR'];
      $favorite = Favorite::where( [
        ['product_id' , '=' , $id],
        ['user_ip' , '=' ,$ip]

   ])->delete();

    }

  return response()->json(['data'=>  $favorite ]);
  }// End Method

  public function favorite_add_cart($id){

   if(Auth::check()){
  
    $check = Cart::where([
      ['user_id', '=' , Auth::user()->id ],
      ['product_id' , '=' , $id]
    ])->first();

    if($check){

      return response()->json(['data'=> 0]);

    }else{
      
          $data = Cart::create([
         'user_id' => Auth::user()->id ,
         'product_id'=> $id ,
         'quantity' => '1' ,
    ]);

    }


    Favorite::where([
      ['user_id' , '=' , Auth::user()->id ],
      ['product_id' , '=' , $id]
    ])->delete();

   }else{

    $ip = $_SERVER['REMOTE_ADDR'];
    $check = Cart::where([
      ['user_ip', '=' , $ip],
      ['product_id' , '=' , $id]
    ])->first();

    if($check){

      return response()->json(['data'=> 0]);
    }else{

      $data = Cart::create([
        'user_ip' => $ip,
        'product_id'=> $id ,
        'quantity' => '1' ,
        ]);
    }

      Favorite::where([
        ['user_ip' , '=' , $ip],
        ['product_id' , '=' , $id]
      ])->delete();
   }

   return response()->json(['data'=> 1]);
  }// End Method
  

   public function user_login(Request $request)
  {
    if ($request->isMethod('post')) {

      $check = $request->all();

      if (Auth::guard('web')->attempt(['email' => $check['email'], 'password' => $check['password']])) {

        $user = User::where('email', "=", $check['email'])->first();

        if (Auth::user()->hasRole('admin')) {

          Auth::login($user);
          return response()->json(['data' => 1]);
        } else {
          Auth::login($user);
          return response()->json(['data' => 2]);
        }
      } else {

        return response()->json(['data' => 0]);
      }
    } else {

      return redirect()->route('home');
    }
  }// End Method

  public function new_Account(Request $request)
  {

    if ($request->isMethod('post')) {

      $credentials = User::where('email', "=", $request->email)->first();
      if (isset($credentials)) {

        return response()->json(['data' => 0]);
        
      } else {
        $user = new User;
        $user->name = strip_tags($request->name);
        $user->email = strip_tags($request->email);
        $user->password = Hash::make($request->password);
        $user->save();

        $user->assignRole('user');
        Auth::login($user);

        return response()->json(['data' => 1]);
      }
    } else {
      return redirect()->route('home');
    }
  }// End Method

  public function user_forget_password()
  {
    return view('auth.forgot-password');
  }// End Method

  public function user_reset_password(Request $request)
  {


    $check = User::where('email', "=", $request->email)->first();

    if (isset($check)) {
      Mail::to($check->email)->send(new ForgetPassword(route('user.update.password', ['id' => $check->id])));

      return response()->json(['data' => 1]);
    } else {
      return response()->json(['data' => 0]);
    }
  }// End Method

  public function user_update_password($id)
  {
    return view('auth.reset-password', compact('id'));
  }// End Method
  

  public function contact_us(){
     $data = GeneralSetting::first();
    return view('Frontend.contact', compact('data'));
  }

  public function contact_us_update(Request $request){

    $request->validate([
      'name' => 'required|string|max:255',
      'phone' => 'required|numeric',
      'email' => 'required|email' ,
      'message' => 'required|' ,
    ]);

    $name    = $request->name ;
    $email   = $request->email ; 
    $phone   = $request->phone ;
    $message = $request->message ; 

    $contactUS = ContactUs::create([
        'name'  => $name ,
        'email' => $email ,
        'phone' => $phone ,
        'message' => $message
    ]);
       

   if($contactUS){

      return  redirect()->back()->with('msg' ,  'Yoyr Message Send Successfully');

   }else{
    return  redirect()->back()->with('msg' ,  'worng plz try agin');

   }
  }// End Method 
  public function user_profile(){

    if(Auth::check()){
      $user = User::where('id' , '=' , Auth::user()->id)->first();
    }

    return view('Frontend.profile' , compact('user'));
  } //End Method

  public function updateProfile(Request $request)
{
   // التحقق من أن المستخدم ليس أدمن
    if (auth()->user()->hasRole('admin')) {
        return response()->json([
            'success' => false,
            'message' => 'غير مسموح لك بتعديل بيانات الحساب.'
        ], 403);
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . auth()->id(),
        'password' => 'nullable|min:6'
    ]);

    $user = auth()->user();
    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return response()->json([
        
        'data' => 1,
        'message' => 'تم تحديث الملف الشخصي بنجاح!'
    ]);
}// End Method


  public function user_logout()
  {

    Auth::logout();
    Session::flush();

    return redirect()->route('home');
  }// End Method
}
