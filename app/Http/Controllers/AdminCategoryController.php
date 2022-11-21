<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

use Illuminate\Pagination\Paginator;


class AdminCategoryController extends Controller
{
	public function categoryindex(Request $request)
  	{
   	 return view('Admin.category');
  	}

  	public function insertcategory(Request $request)
    {
	     if ($request->isMethod('get')) 
	     {
	        return view('Admin.category');
	     }
     else
     {
        $data = $request->all();
        $same=DB::table('category')->where('c_name',$data['c_name'])->count();
        if($same>0)
        { 
          return redirect()->back()->with('error','exist');
        }
         else
         {
            if($data['c_name']!='')
          	{
              DB::table('category')->insert(["c_name"=>$data['c_name'],"status"=>'Active']);

              return redirect()->back()->with('message','Insert Category Successfully');
            }
            else
          	{
            return redirect()->back()->with('error','Category Are Not Inserted');
         	}
        }
     }
    }

     public function showcategory(Request $request)
    {
      $requestData = ['id','c_name','status'];
      $search=$request->input('search');
    	$data = DB::table('category')
      // ->where('c_name','LIKE','%'.$search.'%')
      ->where(function($q) use($requestData, $search) {
              foreach ($requestData as $field)
                 $q->orWhere($field, 'like', "%{$search}%");
      })
      ->Paginate(5);
    	
      return view('Admin.showcategory')->with(['data'=>$data,"search"=>$search]);
    }

    public function update($id) 
   {
   	  $data = DB::table('category')->where('id',$id)->first();
      return view('Admin.updatecategory')->with('data',$data);
   }

   public function adminedit(Request $request)
  {
  		$data = $request->all();
  		$time=date('Y-m-d H:i:s',time());
   
	     if($data['c_name']!='' )
	     {

	  		  DB::table('category')->where('id',$data['id'])->update(["c_name"=>$data['c_name'],'updated_at'=>$time]);
	        return redirect()->back()->with('message','Update Category Successfully!');
	  	  }     
		else
		{
		 return redirect()->back()->with('error','Category Are Not Updated!');
		}
  }

   public function admindelete($id)
  { 
     $data=DB::table('category')->where('id',$id)->delete();   
     return redirect()->back();   
  }

  public function changestatus($id)
    {
    	 $data=DB::table('category')->where('id',$id)->first();
     
       if($data->status =='Active')
      	{
          DB::table('category')->where('id',$data->id)->update(["status"=>"Blocked"]);
      		return redirect()->back();
      	}
      	else
      	{
      		DB::table('category')->where('id',$data->id)->update(["status"=>"Active"]);
      		return redirect()->back();
      	}

     }


  public function adminitemdetail($imageid)
  {
    $user=Session::get('user_id');
    $data=DB::table('hometb')
    ->join('user','user.id','=','hometb.u_id')
    ->join('category','category.id','=','hometb.c_id')
    ->where("hometb.id",$imageid)
    ->select('hometb.*','category.c_name','user.fname','user.lname')
    ->get();

  // echo "<pre>";
  // print_r($data);
  // die();

    return view('Admin.adminshowitemdetail')->with(["data"=>$data]);  
  }
}
