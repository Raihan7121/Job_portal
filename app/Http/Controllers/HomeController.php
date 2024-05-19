<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\JobType;
use App\Models\Job;
use App\Models\User;
use App\Models\Product;
use App\Models\Sell;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



class HomeController extends Controller
{
   
    public function rai(){
        return view('home');
    }

    public function dashboard(){
        $best_seller_products = Product::orderBy('no_of_sales', 'desc')->paginate(10);
        return view('panel.dashboard',['best_seller_products' => $best_seller_products ]);
      
    }
    public function profile(){
        return view('panel.profile');
      
    }
    public function login(){
        return view('panel.login');
      
    }
    public function registration(){
        return view('panel.registration'); 
    }
    //This method will save a user
    public function processRegistration(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        if($validator->passes()){

            $user =new User();

            $user->name = $request->name;
            $user->role = $request->role;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success','You have registerd successfully.');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',     
        ]);

        if($validator->passes()){

            if(Auth::attempt(['email' => $request->email , 'password' => $request->password ])){
                return redirect()->route('panel.dashboard');
            }else {
                return redirect()->route('panel.login')->with('error','Either Email/Password is incorrect ');
            }

        } else {
            return redirect()->route('panel.login')
            ->withErrors($validator)
            ->withInput($request->only('email'));
        }
    }

    public function changeProfilePic(){
        return view('panel.changeProfilePic');
    }
    public function updateProfilePic(Request $request){
        //dd($request->all());
        $id = Auth::user()->id;

        $validator = Validator::make($request->all(),[
            'image' => 'required|image'
        ]);

        if($validator->passes()){

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = $id.'-'.time().'.'.$ext;
            $image->move(public_path('/profile_pic/'), $imageName );

            //create a small thumbnail
            $sourcePath =public_path('/profile_pic/'.$imageName);
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($sourcePath);

            // crop the best fitting 5:3 (600x360) ratio and resize to 600x360 pixel
            $image->cover(150, 150);
            $image->toPng()->save(public_path('/profile_pic/thumb/'.$imageName));

            //Delete Old Profile picture
            File::delete(public_path('/profile_pic/thumb/'.Auth::user()->image));
            File::delete(public_path('/profile_pic/'.Auth::user()->image));


            User::where('id',$id)->update(['image' => $imageName]);

            session()->flash('success','Profile picture updated successfully.');
           // return redirect()->route('panel.dashboard');

            return response()->json([
                'status' => true ,
                'errors' => []
            ]);

        } else {
            return response()->json([
                'status' => false ,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('panel.login');
    }

    public function updateProfile(Request $request){

        $id = Auth::user()->id;

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users,email,'. $id .',id'          
        ]);


        if($validator->passes()){

           $user = User::find($id);
           $user->name = $request->name;
           $user->email = $request->email;
           $user->bio = $request->bio;
           $user->mobile = $request->mobile;
           $user->designation = $request->designation;
           $user->save();

           session()->flash('success','Profile updated successfully.');

           return redirect()->route('panel.dashboard');

        } else {
            return redirect()->back()->with('error', 'Product update unsuccessfully.')->withErrors($validator)->withInput();
        }

    }

    public function updatePassword(Request $request){

        $id = Auth::user()->id;

        $validator = Validator::make($request->all(),[
            'currentpassword' => 'required',
            'newpassword' => 'required|min:5|same:renewpassword',
            'renewpassword' => 'required',          
        ]);


        if($validator->passes() && Hash::check($request->currentpassword, Auth::user()->password)){

           $user = User::find($id);
           $user->password = Hash::make($request->newpassword);
           
           $user->save();

           session()->flash('success','Password updated successfully.');

           return redirect()->route('panel.profile');

        } else {
            return redirect()->back()->with('error', 'Password update unsuccessfully.')->withErrors($validator)->withInput();
        }

    }
}
