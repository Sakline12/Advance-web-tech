<?php

namespace App\Http\Controllers\Auth\Admins;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Users\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Echo_;

class planCreateCotroller extends Controller
{
    public function plancreate(Request $request)
    {

            return view("auth.Admins.planshow");
    }
    public function plansubmit(Request $request)
    {
        $usetable = new Plan();
        $usetable->planName = $request->planName;
        $usetable->admin_id = session('user_id');
        $usetable->description = $request->description;
        $usetable->price = $request->price;
        $usetable->orderDiscount = $request->orderDiscount;
        $usetable->save();
        return redirect('allplan');

    }
    public function getall()
    {
        $usetable=Plan::all()->toArray();
        return view('seeplan',compact('usetable'));
    }

    public function updateplan(Request $request)
    {
        $usetable=Plan::where('id',$request->id)->get();
        // echo $usetable;
        return view('updateplanshow')->with('usetable',$usetable);


    }
    public function goplanupdate(Request $request)
    {
        $use_table=Plan::where('id',$request->id)->first();
        $use_table->planName = $request->planName;
        $use_table->description = $request->description;
        $use_table->price = $request->price;
        $use_table->orderDiscount = $request->orderDiscount;
        $use_table->save();
        return redirect('allplan');

        }

        public function plandelete(Request $request)
        {
            $use_table=Plan::where('id',$request->id)->first();
            $use_table->delete();
            return redirect('allplan');


        }

        public function APIlist()
        {
            return Plan::all();
        }
         public function planCreateapi(Request $request)
         {
          $plan=new Plan();
          $plan->planName=$request->planName;
          $plan->description=$request->description;
          $plan->price=$request->price;
          $plan->orderDiscount=$request->orderDiscount;
          $plan->save();
          return $request;
         }

         public function planupdateapi($id)
         {
            // $plan=Plan::find($id);
            // $plan->admin_id=$request->session('user_id');
            // $plan->planName=$request->input('planName');
            // $plan->description=$request->input('description');
            // $plan->price=$request->input('price');
            // $plan->orderDiscount=$request->input('orderDiscount');
            // $plan->save();
            // return response()->json($plan);
           $plan=Plan::find($id);
           $plan->update(request()->all);
           return response()->json($plan,200);

         }

         public function deleteplansapi($id)
         {
             $plan=Plan::where('id',$id)->delete();
             if($plan)
             {
                 return ["plan"=>"plan is delete"];
             }
             else
             {
                 return["plan"=>"plan is not delete"];
             }
         }




}
?>
