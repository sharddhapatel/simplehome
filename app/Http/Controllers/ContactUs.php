<?php

namespace App\Http\Controllers;
use Mail;
use DB;
use Illuminate\Http\Request;

class ContactUs extends Controller
{
    //
   public function contact()
    {
      return view('contact');
    }

    public function insertcontact(Request $request)
    {
    	if ($request->isMethod('get')) 
		{
			return view('contact');
		}
		else
		{
		   	$data = $request->all();
		   	$msg = $request->input('message'); 
		   	$name = $request->input('name'); 
			$emails =$request->input('email');
			$all="Name: ".$name."\n"."Email: ".$emails."\n"."Message: ".$msg;

		    Mail::raw($all,function ($message) use ($request, $emails,$name)
		    {
		        $message->from($emails);
		        $message->to('hinahirpara64@gmail.com');
		        $message->subject("");
		    });
		    if($data['name']!='' && $data['email']!='' && $data['message']!='')
		 	{
		      
		            $id = DB::table('contactus')->insert(["name"=> $data['name'],"email"=>$data['email'],"message"=>$data['message']]);
		             return redirect()->back();
		    }
		 	else
		 	{
		    return redirect()->back();
		 	}
		}
	}

}



class ContactUs1 extends Controller
{
	public function contact()
	{
		return view('contact');
	}

	public function insertcontact(Request $request)
	{
		if($request->isMethod('get'))
		{
			return view('contact');	
		}
		else
		{
			$data=$request->all();
			$msg=$request->input('message');
			$name=$request->input('name');
			$emil=$request->input('email');
			$all ="Name:".$name."\n"."Email:".$emial."\n"."Message:".$msg;

			Mail::raw($all,function($message) use ($request,$email,$name)
			{
				$message->from($email);
				$message->to("patelreena172@gmail.com");
				$message->subject("");
			});

			if($data['name']!='' && $data['email']!='' && $data['message']!='')
			{
				$id=DB::table('contact')->insert(["name"=>$data['name'],"email"=>$data['email'],"message"=>$data['message']]);
				return redirect()->back();
			}
			else
			{
				return redirect()->back();
			}	
		}
	}


}
