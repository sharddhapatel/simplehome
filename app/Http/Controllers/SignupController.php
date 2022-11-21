<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Input;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    //
    public function index()
    {
    	return view('signup');
    }

     public function userloginindex()
    {
      if(Session::has('user_id'))
      {
          return redirect('additem');
      }
      else
      {
          return view('login');  
      }	
    }

    public function loginuser(Request $request)
    {
    	
        $email=$request->Input('email');
        $password=$request->Input('password');
        $a=DB::table('user')
       ->join('address','address.uid',"=",'user.id')
       ->where('user.email',"=",$email)
       ->select('user.*','address.address',"address.city","address.zipcode")
       ->first();
   
        $same=DB::table('user')->where(['email'=>$email])->count();
        $db=DB::table('user')->where(['email'=>$email])->where('status','=',"Blocked")->count();
	
        if(($email !="") && ($password !=""))
        {
           if($db>0)
            {
                return redirect('userlogin')->with('error','User Blocked');
            }
            else
            {
                if($same>0)
                {
                   if(Hash::check($password,$a->password))
                   {
                      session::put('user_fname',$a->fname);
                      session::put('user_lname',$a->lname);
                      session::put('user_email',$a->email);                   
                      session::put('user_id',$a->id);

                    return redirect('additem');  
                   }
                   else
                   {
                     return redirect('userlogin')->with('error','Password Has been Wrong....');
                   }
                   
                }
                else
                {
                    return redirect('userlogin')->with('error','Email Has been Wrong....');
                }
            }
        }
        else
        {
            return redirect('userlogin')->with('error','Email and Password Empty...');
        }   
    }

    public function logoutuser()
    {
        Session()->forget('user_fname');
        Session()->forget('user_lname');
        Session()->forget('user_email');
        Session()->forget('user_id');
        
        return redirect("/");
    }

    public function insertuser(Request $request)
    {
        
    	if ($request->isMethod('get')) 
      {
        	return view('signup');
     	}
     	else
     	{
        $data = $request->all();
	         // echo "<pre>";
	         // print_r($data);
          //  die();
        $email=DB::table('user')->where('email',$data['email'])->count();
        if($email>0)
        {
          return redirect()->back()->with('error','Email has been exist...please enter unique email');
        }
        else
        {
  	      if($data['fname']!='' && $data['lname']!='' && $data['email']!='' && $data['address'] !='' && $data['city'] !='' && $data['phone']!='') 
          {
  	   
      		$ans=DB::table('user')->insertGetId(["fname"=> $data['fname'],"lname"=>$data['lname'],"email"=> $data['email'],"password"=>Hash::make($data['password']),"phone"=>$data['phone'],"status"=>"Active"]);

          DB::table('address')->insert(["uid"=> $ans,"address"=>$data["address"],"city"=>ucfirst($data['city']),"zipcode"=>$data['zipcode'],"primaryadd"=>'true']);
       
           return redirect()->back()->with('message','Registarion Sucessfully!');
          }
          else
          {
             return redirect()->back()->with('error',' please Fill All the Fileds...');
           
          }
        }
             
             
    	}
     
    }
}
