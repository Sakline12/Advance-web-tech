<?php

namespace App\Http\Controllers\Auth\Admins;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Users\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Echo_;

class productsCreateController extends Controller
{
    public function productcreate(Request $request)
    {

            return view("productshow");
    }
    public function productsubmit(Request $request)
    {

        $usetable = new Product();
        $usetable->title = $request->title;
        $usetable->admin_id = session('user_id');
        $usetable->description = $request->description;

        if($request ->hasFile('image'))
        {
            $image=$request->file('image');
            $name =$image->getClientOriginalName();
            $filename=$name;
            $image->move('uploads/product',$filename);
            $usetable->image=$filename;
        }

        $usetable->quantity = $request->quantity;
        $usetable->price = $request->price;
        $usetable->save();
        return redirect('allproduct');
    }
    public function getall()
    {
        $usetable=Product::all()->toArray();
        return view('seeproduct',compact('usetable'));

    }

    public function updateproduct(Request $request)
    {
        $usetable=Product::where('id',$request->id)->get();
        // echo $usetable;
        return view('updateproductshow')->with('usetable',$usetable);


    }

    public function goproductupdate(Request $request)
    {
        $use_table=Product::where('id',$request->id)->first();
        $use_table->title = $request->title;
        $use_table->description = $request->description;
        $use_table->quantity = $request->quantity;
        $use_table->price = $request->price;
        if($request ->hasFile('image'))
        {
            $image=$request->file('image');
            $name =$image->getClientOriginalName();
            $filename=$name;
            $image->move('uploads/product',$filename);
            $use_table->image=$filename;
        }

        $use_table->save();
        return redirect('allproduct');

        }

        public function productdelete(Request $request)
        {
            $use_table=Product::where('id',$request->id)->first();
            $use_table->delete();
            return redirect('allproduct');


        }
        public function productgetapi()
        {
            return Product::all();
        }

        public function productCreateapi(Request $request)
        {
         $product=new Product();
         $product->admin_id=$request->admin_id;
         $product->title=$request->title;
         $product->description=$request->description;
         $product->quantity=$request->quantity;
         $product->price=$request->price;
         $product->image=$request->image;

         $product->save();
         return $request;
        }





}
