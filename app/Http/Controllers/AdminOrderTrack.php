<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
class AdminOrderTrack extends Controller
{
     public function index(Request $request)
    {

   	$requestData = ['fname','lname','total_price','ordertb.id','address','payment_status','ordertb.status'];
   
    $search=$request->input('search');
	    $order=DB::table('ordertb')
      ->join('user', 'user.id', '=', 'ordertb.user_id')
        ->join('bill', 'bill.order_id', '=', 'ordertb.id')
      ->select('ordertb.id','ordertb.status','ordertb.total_price','ordertb.address','user.fname','user.lname','bill.payment_status','bill.payment_method')
      ->where(function($q) use($requestData, $search) { 
            foreach ($requestData as $field)
               $q->orWhere($field, 'like', "%{$search}%");
    	}) 
      ->orderBy('ordertb.id','DESC')
      ->paginate(7);
    
    	return view('Admin.ordertrack')->with(['order'=>$order,'search'=>$search]);   
    }
    
    public function showorder($orderid)
    {
       $order=DB::table('ordertb')
      ->join('hometb', 'hometb.id', '=', 'ordertb.item_id')
      ->where('ordertb.id',"=",$orderid)
      ->select('ordertb.*','hometb.price')
      ->get();
      return view('Admin.orderdetail')->with(["order"=>$order]);
   } 

   public function changestatus(Request $request,$id)
    {
       $data1=DB::table('ordertb')->where('id',$id)->first();
     

      if($data1->status == 'Pendding')
      {
         $s=DB::table('ordertb')->where('id',$data1->id)->update(["status"=>"Conform"]);
          return redirect()->back();
      }
      else if($data1->status == 'Conform')
      {
         DB::table('ordertb')->where('id',$data1->id)->update(["status"=>"InProcess"]);
        return redirect()->back();
      }
       else if($data1->status == 'InProcess')
      {
         DB::table('ordertb')->where('id',$data1->id)->update(["status"=>"Ready To Deliver"]);
        return redirect()->back();
      }
       else if($data1->status == 'Ready To Deliver')
      {
         DB::table('ordertb')->where('id',$data1->id)->update(["status"=>"Delivered"]);
        return redirect()->back();
      }
    }


   // public function updateorder(Request $request,$id)
   //  {

   //    $input=$request->all();
   //      $order=DB::table('ordertb')
   //    ->join('hometb', 'hometb.id', '=', 'ordertb.item_id')
   //    ->where('ordertb.id',"=",$orderid)
   //    ->select('ordertb.*','hometb.price')
   //    ->get();
        
   //     // echo "<pre>";
   //     //  print_r($order);
   //     //  die();
   //    if($order->status =='Pendding')
   //    {
   //      DB::table('ordertb')->where('id',$order->id)->update(["status"=>"Pendding"]);
   //      return redirect()->back();
   //    }
   //     if($order->status =='Conform')
   //    {
   //      DB::table('ordertb')->where('id',$order->id)->update(["status"=>"Conform"]);
   //      return redirect()->back();
   //    }
   //     if($order->status =='In Process')
   //    {
   //      DB::table('ordertb')->where('id',$order->id)->update(["status"=>"In Processg"]);
   //      return redirect()->back();
   //    }
       



       
   //      return view('Admin.orderdetail')->with(["order"=>$order]);
      
   //  }
}
