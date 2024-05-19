<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\JobType;
use App\Models\Job;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Sell;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class OrderController extends Controller
{
    
   
    public function header(){
        $products = Product::all();
        $fruits = Product::where('category', 'fruits')->get();
        $vegetables = Product::where('category', 'vegetables')->get();
        $breads = Product::where('category', 'bread')->get();
        $meats = Product::where('category', 'meat')->get();
        $best_seller_products = Product::orderBy('no_of_sales', 'desc')->paginate(10);
        $userCount = User::where('role', 'user')->count();
        $productCount = Product::count();
        $sellerCount = User::where('role', 'seller')->count();
        $orderCount = 0;
        if(Auth::check()){
            $orderCount = Order::where('customer_id',Auth::user()->id)->count();
        }
            
        return view('view.home',[ 
            'products' => $products ,
            'fruits' => $fruits,
            'vegetables' => $vegetables,
            'breads' => $breads ,
            'meats' => $meats,
            'best_seller_products' => $best_seller_products,
            'userCount' => $userCount,
            'productCount' => $productCount,
            'sellerCount' => $sellerCount,
            'orderCount' => $orderCount
        ]);
     
    }
    public function notfound(){
        return view('view.notfound');
      
    }
    public function notallow(){
        return view('view.notallow');  
    }
    public function cart(){
        $customerId = Auth::user()->id;

        $orders  = Order::with('product')
                ->where('customer_id', $customerId)
                ->get();

                //dd($orders);
        //$orders = Order::where('customer_id', Auth::User()->id);
        return view('view.cart',['orders' => $orders ]);
    }
    public function chackout(){
        return view('view.chackout');
      
    }

    public function contact(){
        return view('view.contact');
      
    }
    public function shop(){
        return view('view.shop');
      
    }
    public function productdetail($id){
        
        $product = Product::findOrFail($id);
        
        if($product){
       // $relative_products = Product::where('category',$product->category)->get();
        $relative_products = Product::where('category', $product->category)
                                ->where('id', '!=', $product->id)
                                ->get();
       // dd($product);
        return view('view.product-detail',[
            'product' => $product,
            'relative_products' => $relative_products
        ]);
        }
    }
    public function testimonial(){
        return view('view.testimonial');
    }
    public function deleteCart($id){
        $order = Order::find($id);
    // Check if the product exists
        if (!$order) {
            return redirect()->back()->with('error', 'Product not found.');
        }
    // Delete the product
        $order->delete();
    // Redirect back with a success message
        return redirect()->back()->with('success', 'Product deleted successfully.');   
    }


}
