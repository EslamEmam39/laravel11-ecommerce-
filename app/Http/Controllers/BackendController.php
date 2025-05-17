<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ContactUs;
use App\Models\GeneralSetting;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class BackendController extends Controller
{
   public function dashboard(){
     $category       = Category::count('id');
    $FeaturedProduct = Product::where('isfeatured' , '=' , 1)->count('id');
    $products        = Product::where('isfeatured' , '=' , 0)->count('id');
    $order           =Order::where('status' , '=' , 'completed')->sum('total');
    return view('backend.index' , compact('FeaturedProduct','products' ,'category', 'order'));
   } // End Method

   public function category(){
    $data = Category::latest()->paginate(10);
    return view('backend.categories.index' , compact('data'));
   }//End Method

   public function category_add(){

    return view('backend.categories.add');
   }//End Method
 

   public function add_category_store(Request $request){

         $check = Category::where('name' ,"=" , $request->name)->first();

         if(isset($check)){

          return response()->json(['data'=> 0]);
         
         } 
         
         if($request->hasFile('img')){

          $img = $request->file('img');

          $gen = hexdec(uniqid());
          $ex = strtolower($img->getClientOriginalExtension());
          $name = $gen . '.' . $ex ;
          $location = 'category/' ;
          $source = $location.$name ;
          $img->move($location,$name);
         }else{
           $source = null;
         }
  

              $data = Category::insert([
                'name'        => $request->name , 
                'order'       =>$request->order ,
                'img'         => $source , 
                'created_at'  => Carbon::now()
              ]);

            
              
            return response()->json(['data' => 1]);
         
   }//End Method

   public function category_edit($id){
      $data = Category::findOrFail($id);
    return view('backend.categories.edit' , compact('data'));

   }//End Method


   public function category_update(Request $request){

  // return response()->json($request->all());
  $category = Category::find($request->id);

  if (!$category) {
      return response()->json(['error' => 'Category not found'], 404);
  }

  if ($request->hasFile('img')) {
      // حذف الصورة القديمة إذا كانت موجودة
      if (!empty($product->img) && file_exists(public_path($category->img))) {
          unlink(public_path($category->img));
      }

      // رفع الصورة الجديدة
      $img = $request->file('img');
      $name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
      $path = 'category/' . $name;
      $img->move(public_path('category'), $name);

      $category->img = $path;
  }
  
  $category->name      = strip_tags($request->name);
  $category->order = strip_tags($request->order);
 

  $category->save() ;

  if($category){
    return response()->json( ['data' => 1]);
  }
    
  }//End Method


   public function category_delete(Request $request){

      $category = Category::where('id' ,"=" , $request->id)->delete();

      return response()->json(['data' => $category]);

   }//End Method 

 public function product(){
  $products = Product::latest()->paginate(10);
  return view('backend.products.index',compact('products'));
 }//End Method

  public function product_add(){
    $categories = Category::all();
    return view('backend.products.add' , compact('categories'));
  }//End Method

  public function product_store(Request $request){

    $category    = strip_tags($request->category);
    $namePro     = strip_tags( $request->productName);
    $oldPrice    = strip_tags($request->oldPrice);
    $newPrice    = strip_tags($request->newPrice);
    $des         = strip_tags($request->des);
 

    $img = $request->file('img');
    $gen = hexdec(uniqid());
    $ex = strtolower($img->getClientOriginalExtension());
    $name = $gen . '.' . $ex ;
    $location = 'products/' ;
    $source = $location.$name ;
    $img->move($location,$name);

   $product = Product::insert([
    'name'       => $namePro ,
    'category'   => $category ,
    'old_price'  => !empty($oldPrice) ? $oldPrice : null,
    'new_price'  => $newPrice ,
    'img'        => $source ,
    'des'        => $des ,
    'created_at' => Carbon::now()

   ]);

 return response()->json( ['data'=>$product]);

  }//End Method

    public function product_edit($id){
      $product = Product::findOrFail($id);
      $category = Category::all();
       return view('backend.products.edit',compact('product' ,'category'));
    }


    public function product_update(Request $request){
     
      $product = Product::find($request->id);

      if (!$product) {
          return response()->json(['error' => 'Product not found'], 404);
      }
  
      if ($request->hasFile('img')) {
          // حذف الصورة القديمة إذا كانت موجودة
          if (!empty($product->img) && file_exists(public_path($product->img))) {
              unlink(public_path($product->img));
          }
  
          // رفع الصورة الجديدة
          $img = $request->file('img');
          $name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
          $path = 'products/' . $name;
          $img->move(public_path('products'), $name);

          $product->img = $path;
      }
      
      $product->name      = strip_tags($request->name);
      $product->old_price = strip_tags($request->oldPrice);
      $product->new_price = strip_tags($request->newPrice);
      $product->des = strip_tags($request->des);
      $product->category  =  $request->category ;

      $product->save() ;

      if($product){
        return response()->json( ['data' => 1]);
      }
        
    }// End Method 

    public function product_delete(Request $request) {
      $product = Product::find($request->id);
  
      if (!$product) {
          return response()->json(['data' => 0, 'error' => 'Product not found'], 404);
      }
  
 
      if (!empty($product->img) && file_exists(public_path($product->img))) {
          unlink(public_path($product->img));
      }
  
      $product->delete();
  
      return response()->json(['data' => 1]);
  }//End Method

public function featured_products_list(){
  
  $products = Product::where('isfeatured' , '=' , 1 )->latest()->paginate(10);
  return view('backend.featured_products.index' ,compact('products'));

}//End Method

  public function featured_products_add(){

    $categories = Category::all();
    return view('backend.featured_products.add' ,compact('categories'));

  }//End Method
   
  public function featured_products_store(Request $request){

    $category    = $request->category;
    $namePro     = strip_tags( $request->productName);
    $oldPrice    = strip_tags($request->oldPrice);
    $newPrice    = strip_tags($request->newPrice);
    $des         = strip_tags($request->des);
 

    $img = $request->file('img');
    $gen = hexdec(uniqid());
    $ex = strtolower($img->getClientOriginalExtension());
    $name = $gen . '.' . $ex ;
    $location = 'products/' ;
    $source = $location.$name ;
    $img->move($location,$name);

   $product = Product::insert([
    'name'       => $namePro ,
    'category'   => $category ,
    'old_price'  => $oldPrice ,
    'new_price'  => $newPrice ,
    'img'        => $source ,
    'des'        => $des ,
    'isfeatured' => 1 ,
    'created_at' => Carbon::now()

   ]);

 return response()->json( ['data'=>$product]);

  }//End Method

public function featured_products_edit($id){

  $product = Product::findOrFail($id);
  $category = Category::all();

  return view('backend.featured_products.edit' , compact('product','category'));
}//End Method

public function featured_products_update(Request $request){
  $product = Product::find($request->id);

  if (!$product) {
    return response()->json(['error' => 'Product not found'], 404);
}

if ($request->hasFile('img')) {
    // حذف الصورة القديمة إذا كانت موجودة
    if(!empty($product->img) && file_exists(public_path($product->img))){
      unlink(public_path($product->img));
    }
    $img = $request->file('img');
    $name = hexdec(uniqid()) .'.'. $img->getClientOriginalName();
    $path = 'products/' . $name ;
    $img->move(public_path('products') , $name);
    $product->img = $path;
  }


  $product->name      = strip_tags($request->name);
  $product->old_price = strip_tags($request->oldPrice);
  $product->new_price = strip_tags($request->newPrice);
  $product->des = strip_tags($request->des);
  $product->category  =  $request->category ;

  $product->save() ;

  if($product){
    return response()->json( ['data' => 1]);
  }
 
}// End Method 

public function featured_products_delete(Request $request){
  $product = Product::find($request->id);
  
  if (!$product) {
      return response()->json(['data' => 0, 'error' => 'Product not found'], 404);
  }


  if (!empty($product->img) && file_exists(public_path($product->img))) {
      unlink(public_path($product->img));
  }

  $product->delete();

  return response()->json(['data' => 1]);
}//End Method


  public function  admin_profile(){

    return view('backend.profile' );

  } // End Method

  public function admin_profile_edit(Request $request){
           
          $name = $request->name;
          $email = $request->email;
          
          if( $request->password == ''){
            $password = Auth::user()->password ;
          }else{
            $password = Hash::make( $request->password);
          }

          $data = User::where('id', '=' , Auth::user()->id)->update([
            'name' => $name ,
            'email' => $email ,
            'password'=> $password
            
          ]);

           return response()->json(['data'=> $data]);
  } // End Method 

  public function general_setting(){

    $data = GeneralSetting::first();
    return view('backend.general.setting.index' ,compact('data'));
  } // End Method

  public function general_setting_edit(){
    $data = GeneralSetting::first();
    return view('backend.general.setting.edit' ,compact('data'));
  } // End Method


   public function general_setting_update(Request $request){
     
     $name1 = $request->name ;
     $email = $request->email ;
     $phone = $request->phone ;
     $address = $request->address ;

     $logo = $request->file('logo');
     $name = hexdec(uniqid()) . '.' . $logo->getClientOriginalExtension();
     $path = 'setting/' . $name;
     $logo->move(public_path('setting'), $name);

     $data = GeneralSetting::where('id' , '=' , 1)->update([
      'name'    => $name1 ,
      'email'   => $email ,
      'phone'   => $phone , 
      'address' => $address ,
      'logo'    =>  $path,
     ]);

    return response()->json(['data'=> $data]);
   }
  
   public function admin_contactUs(){
         $data = ContactUs::latest()->paginate(10) ;
    return view('backend.contactus' , compact('data'));
   } // End Method

   public function contact_delete($id){

    $data = ContactUs::where('id', '=', $id)->delete();

    if($data){
      return redirect()->back()->with('msg' , 'Delete Successfully');

    }else{
      return redirect()->back()->with('msg' , 'worng plz try agin');

    }
   }// End Method


   public function admin_users(){
    $data = User::role('user')->latest()->paginate(10);

    return view('backend.users.index' ,compact('data'));
   }// End Method 

   public function admin_users_delete($id){

    $data = User::role('user')->where('id' , '=' , $id)->delete();
    if($data){
      return redirect()->back()->with('msg' , 'Delete Successfully');
    }else{
      return redirect()->back()->with('msg' , 'worng plz try agin');
    }

   }


   
  public function admin_logout(){

      Auth::logout();
      Session::flush();

    return redirect()->route('home');
  }//End Method
}
