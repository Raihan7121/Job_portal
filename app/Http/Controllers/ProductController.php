<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JobType;
use App\Models\Job;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail; 


use Illuminate\Validation\Rule;




class ProductController extends Controller
{
    public function createProduct(){
        return view('product.addproduct');
    }
    public function addProduct(Request $request){
        $id = Auth::user()->id;
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
           // 'video' => 'required|file|mimetypes:video/mp4,video/quicktime,video/x-ms-wmv,video/x-msvideo,video/mpeg,video/x-flv,application/octet-stream,application/x-troff-msvideo,video/3gpp,video/x-ms-asf,video/x-msvideo,video/x-sgi-movie,video/3gpp2,video/x-matroska', // Add appropriate video file MIME types
           
            'image' => 'required|image',
            'weight' => 'required|min:0',
            'regular_price' => 'required|min:0',
            'offer_price' => 'nullable|min:0',
            'quantity' => 'required|integer|min:0',
        ]);
    
       
        if ($validator->passes()) {
          
        // Process the product data and store it in the database
        $product = new Product();
        $product->name = $request->input('name');
        $product->category = $request->input('category');
        $product->seller_id = Auth::User()->id;
        $product->product_description = $request->input('description');
        $product->weight = $request->input('weight');
        $product->regular_price = $request->input('regular_price');
        $product->offer_price = $request->input('offer_price');
        $product->quantity = $request->input('quantity');
    
       
        if($request->hasfile('image')){
            $image = $request->file('image');
            $imageName = time(). '.' . $image->getClientOriginalName();
            $image->move(public_path('product_image'),$imageName);
            $sourcePath = public_path('/product_image/'.$imageName);
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($sourcePath);    
            $image->cover(250, 450);
            $image->toPng()->save(public_path('/product_image/thumb/'.$imageName));
            $product->product_image  = $imageName;
        }
        //$product->product_video = $request->input('video');
        
        // if ($request->hasFile('video')) {
           
        //     $filename = time() . '.' . $video->getClientOriginalExtension();
        //     $path = public_path('/product_video/' . $filename);
        //     $video->move($path);
        //    = $filename;
        // }
    
        // Save the product to the database
        $product->save();
        session()->flash('success','Product added successfully.');
        // Redirect the user with a success message
      //  return redirect()->route('panel.dashboard')->with('success', 'Product added successfully.');
            return response()->json([
                'status' => true ,
                'success' => "Product added successfully.",
                'errors' => []
            ]);

    }   else {
       // echo "h3";
            //return redirect()->route('panel.changeProfilePic');
           // return redirect()->back()->with('error', 'Product added unsuccessfully.')->withErrors($validator)->withInput();
           return response()->json([
            'status' => false ,
            'errors' => $validator->errors()
            ]);
        }
    }

    public function showProduct(){
        $userId = Auth::id();

    // Retrieve products where the seller_id is equal to the authenticated user's ID
        $products = Product::where('seller_id', $userId)->paginate(10);
        return view('product.showproduct',['products' => $products ]);
    }
    public function deleteProduct($id){
        $product = Product::find($id);
    // Check if the product exists
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

    // Delete the product
        $product->delete();
    // Redirect back with a success message
        return redirect()->back()->with('success', 'Product deleted successfully.');   
    }

    public function editProduct($id){
        $product = Product::find($id);

        // Check if the product exists
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found.');
            }  
            
        return view('product.editproduct',['product' => $product]);
    }

    public function updateProduct(Request $request,$id){
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
           //'video' => 'required|file|mimetypes:video/mp4,video/quicktime,video/x-ms-wmv,video/x-msvideo,video/mpeg,video/x-flv,application/octet-stream,application/x-troff-msvideo,video/3gpp,video/x-ms-asf,video/x-msvideo,video/x-sgi-movie,video/3gpp2,video/x-matroska', // Add appropriate video file MIME types
            //'image' => 'required|image', // Add appropriate image file MIME types and maximum file size
            'weight' => 'required|min:0',
            'regular_price' => 'required|min:0',
            'offer_price' => 'nullable|min:0',
            'quantity' => 'required|integer|min:0',
        ]);
    
        // If validation fails, return back with errors
       
        if ($validator->passes()) {
            if($request->hasfile('image')){
                $image = $request->file('image');
                $imageName = time(). '.' . $image->getClientOriginalName();
                $image->move(public_path('product_image'),$imageName);
                $sourcePath = public_path('/product_image/'.$imageName);
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($sourcePath);    
                $image->cover(250, 450);
                $image->toPng()->save(public_path('/product_image/thumb/'.$imageName));
                //$product->product_image  = $imageName;

                Product::where('id',$id)->update([
                    'name' => $request->input('name'),
                    'category' => $request->input('category'),   
                    'product_description' => $request->input('description'),
                    'weight' => $request->input('weight'),
                    'regular_price' => $request->input('regular_price'),
                    'offer_price' => $request->input('offer_price'),
                    'quantity' => $request->input('quantity'),
                    'product_image'  => $imageName,
                   // 'product_video' => $request->input('video'),
                ]);

                session()->flash('success','Product updateed successfully.');
                // Redirect the user with a success message
               // return redirect()->route('product.show')->with('success', 'Product updated successfully.');
               return response()->json([
                'status' => true ,
                'success' => "Product Updated successfully.",
                'errors' => []
                ]);
            } 

    }   else {
        
            return response()->json([
                'status' => false ,
                'errors' => $validator->errors()
                ]);
        }
    }
   // Import the Mailable class for sending emails

        public function sendemail(Request $request)
        {
            // Validate the form data
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required',
            ]);

            // Retrieve form data
            $name = $request->input('name');
            $email = $request->input('email');
            $message = $request->input('message');

            try {
                // Send email using Laravel Mail
                Mail::to('raihr7121@gmail.com')->send(new ContactFormMail($name, $email, $message));
                
                // Redirect with success message
                return redirect()->route('panel.login')->with('success', 'Your message has been sent successfully!');
            } catch (Exception $e) {
                // Handle email sending failure
                return redirect()->back()->with('error', 'Failed to send message. Please try again later.');
            }
        }

        public function addCart($id){
            $product = Product::find($id);
            $customerId = Auth::user()->id;
            // Check if the product exists
                if (!$product) {
                    return redirect()->back()->with('error', 'Product not found.');
                } 

                $existingOrder = Order::where('customer_id', $customerId)
                ->where('product_id', $id)
                ->first();

                if ($existingOrder) {
                return redirect()->back()->with('error', 'Product is already in your cart.');
                }
                 else  {

                    $order = new Order();
                    $order->customer_id = Auth::user()->id;
                    $order->product_id = $id;
                    $order->save();
                    session()->flash('success','Product added Cart successfully.');
                    
                    return redirect()->back();
                
                } 
                
           
        }
    
  
}
