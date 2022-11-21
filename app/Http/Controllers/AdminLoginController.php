<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Input;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\SendMail;
use App\User;
use App\Admin;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminResetPass;
use Password;
use Illuminate\Pagination\Paginator;


class AdminLoginController extends Controller
{
  public function admindash(Request $request)
  {
    $id = Session::get("admin_id");
    $user = DB::table('user')->get();
    $postad = DB::table('hometb')->get();

    $order = DB::table('ordertb')
      ->join('hometb', 'hometb.id', '=', 'ordertb.item_id')
      ->select('ordertb.*', 'hometb.price')
      ->orderBy('ordertb.created_at', 'DESC')
      ->get();
    return view('Admin.admindashboard')->with(['user' => $user, 'postad' => $postad, 'order' => $order]);
  }

  public function profileindex()
  {
    $id = Session::get("admin_id");
    $a = DB::table("admin")->where("id", $id)->first();
    return view('Admin.adminprofile')->with(["a" => $a]);
  }

  public function index()
  {
    if (Session::has('admin_name')) {
      return redirect('admindashboard');
    } else {
      return view('Admin.adminlogin');
    }
  }
  public function adminlogin(Request $request)
  {
    $email = $request->Input('email');
    $password = $request->Input('password');
    $same = DB::table('admin')->where(['email' => $email])->count();
    $a = DB::table('admin')->where('email', $email)->first();

    $user = DB::table('user')->get();
    $postad = DB::table('hometb')->get();
    $order = DB::table('ordertb')
      ->join('hometb', 'hometb.id', '=', 'ordertb.item_id')
      ->select('ordertb.*', 'hometb.price')
      ->get();

    if (($email != "") && ($password != "")) {
      if ($same > 0 && Hash::check($password, $a->password)) {
        session::put('admin_id', $a->id);
        session::put('admin_name', $a->name);
        session::put('admin_email', $a->email);
        session::put('admin_profile_image', $a->profile_image);
        return view('Admin.admindashboard')->with(['a' =>  $a, 'user' => $user, 'postad' => $postad, 'order' => $order]);
      } else {
        return redirect('adminlogin')->with('error', 'Email and Password has been wrong....');
      }
    } else {
      return redirect('adminlogin')->with('error', 'Email and Password Empty...');
    }
  }

  public function adminlogout()
  {
    Session()->forget('admin_id');
    Session()->forget('admin_name');
    Session()->forget('admin_email');
    Session()->forget('admin_profile_image');
    return redirect('adminlogin');
  }

  public function profileupdate(Request $request)
  {
    $id = Session::get("admin_id");
    $a = DB::table('admin')->where('id', $id)->first();
    $data = $request->all();
    if ($data['name'] != '' && $data['email'] != '') {

      if (@$data['image'] != '') {
        $name = $data['image']->getClientOriginalName();
        $t = time() . $name;
        $img = explode(".", $name);
        if ($img[1] == 'png' ||  $img[1] == "jpg" ||  $img[1] == "jpeg") {
          $data['image']->move(base_path('public\image'), $t);

          $list = DB::table('admin')->where('id', $id)->update(["name" => $data['name'], "email" => $data['email'], "profile_image" => $t]);

          $nm = DB::table('admin')->where("id", $id)->get()->toArray();
          $dd = $nm[0]->name;
          $photo = $request->input('oldimg');

          Session::put('admin_profile_image', $t);
          if ($photo != '') {
            if (file_exists('public/image/' . $photo)) {
              unlink('public/image/' . $photo);
            }
            Session::put('admin_name', $dd);
            return redirect()->back()->with('message', 'Update Successfully');
          }
        } else {
          return redirect()->back()->with('error', 'Invalid Image Type');
        }
      } else {
        $list = DB::table('admin')->where('id', $id)->update(["name" => $data['name'], "email" => $data['email']]);
        $nm = DB::table('admin')->where("id", $id)->get()->toArray();
        $dd = $nm[0]->name;
        Session::put('admin_name', $dd);
      }
      return redirect()->back()->with('message', 'Update Successfully');
    } else {
      return redirect()->back()->with('error', 'Please Fill All The Fileds');
    }
  }

  public function forgotpass()
  {
    return view('Admin.adminforgot-pass');
  }
  public function adminresendmail(Request $request)
  {
    $data = $request->all();
    $remember_token = rand(100000, 999999);
    $email = $request->input('email');
    $same = DB::table('admin')->where(['email' => $email])->count();
    $time = date('Y-m-d H:i:s', time());

    if ($same > 0) {
      $pw_reset = DB::table('admin')->where(['email' => $email])->update(['remember_token' => $remember_token, 'updated_at' => $time]);

      $list = DB::table('admin')->where(['email' => $email])->first();
      $users = Admin::where("email", $data['email'])->first();
      Notification::send($users, new AdminResetPass($remember_token));

      return redirect('adminforgotpass')->with(["message" => "Link Send Successfully...", "list" => $list]);
    } else {
      return redirect('adminforgotpass')->with('error', 'Email Must Be Registered First');
    }
  }

  public function adminresetpass1(Request $request)
  {
    $data = $request->all();
    $npass = $request->input('npass');
    $cpass = $request->input('cpass');
    $id = $request->input('id');
    $time = date('Y-m-d H:i:s', time());

    $list = DB::table('admin')->where('id', $data['id'])->get();
    if ($npass != '' && $cpass != '') {
      if ($npass == $cpass) {
        $b = DB::table('admin')->where('id', $id)->update(["password" => Hash::make($npass), 'updated_at' => $time]);
        return redirect('/adminlogin');
      } else {
        return redirect()->back()->with("error", "New Password and Confirm Password not same");
      }
    } else {
      return redirect()->back()->with("error", "Please Fill All Fields");
    }
  }

  public function adminresetpass(Request $request, $token)
  {
    $email = $request->input('email');
    $time = date('Y-m-d H:i:s', time());
    $query = DB::table('admin')->where('remember_token', $token)->get();
    if (count($query) > 0) {
      DB::table('admin')->where('remember_token', $token)->whereRaw('ABS(TIMESTAMPDIFF(MINUTE, "' . $query[0]->updated_at . '", ?)) >= 1', [$time])->update(array("remember_token" => "", "updated_at" => $time));
    }

    $list = DB::table('admin')->where(['remember_token' => $token])->first();

    if ($list) {
      return view('Admin.adminresetpass')->with(["list" => $list]);
    } else {
      return redirect('adminforgotpass')->with('error', 'Link Expire Please Resend Link');
    }
  }

  public function demo()
  {
    return view('Admin.demo');
  }

  public function showuser(Request $request)
  {
    $id = Session::get("admin_id");
    $requestData = ['fname', 'lname', 'email', 'address', 'city', 'status'];

    $search = $request->input('search');
    $data = DB::table('user')
      ->join('address', 'address.uid', "=", 'user.id')
      ->where('address.primaryadd', "=", 'true')
      ->where(function ($q) use ($requestData, $search) {
        foreach ($requestData as $field)
          $q->orWhere($field, 'like', "%{$search}%");
      })
      ->select('user.*', 'address.address', "address.city", "address.zipcode")
      ->paginate(4);

    // echo "<pre>";
    // print_r($data);
    // die();

    return view('Admin.adminshowuser')->with(['data' => $data, 'search' => $search]);
  }

  public function userchangestatus(Request $request)
  {
    $user = DB::table('user')->where('id', $request->id)->update(['status' => $request->status]);
    return redirect()->back()->with(['message' => 'Status changed successfully.']);
  }


  public function showads(Request $request)
  {
    $items = $request->items ?? 10;
    $requestData = ['item_name', 'id', 'price', 'status'];
    $search = $request->input('search');

    $status_data = $request->input('status_data');
    $start = $request->start; // min price value
    $end = $request->end; // max price value

  

    $alpha = $request->input('char');

    if (preg_match("/^[a-zA-Z]$/", $alpha)) {
      $data = DB::table('hometb')
        ->where('hometb.item_name', 'LIKE',  $alpha . '%')
        ->orderBy('created_at', 'DESC')
        ->paginate($items);
    }
    
    elseif ($request->start && $request->end) {
       
      $data = DB::table('hometb')
        ->whereBetween('hometb.price', array($start, $end))
        // ->where(function ($q) use ($requestData, $search) {
        //   foreach ($requestData as $field)
        //     $q->orWhere($field, 'like', "%{$search}%");
        // })
        ->orderby('price', 'ASC')->paginate($items);

        // echo "<pre>";
        // print_r($data);
        
        // die;

    } 
    
    else {
      $data = DB::table('hometb')

        ->where(function ($q) use ($requestData, $search) {
          foreach ($requestData as $field)
            $q->orWhere($field, 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'DESC')
        ->paginate($items);

      // echo "<pre>";
      // print_r($data);
      // die;
    }

    return view('Admin.showpostitem')->with(['data' => $data, 'search' => $search, 'items' => $items,'start'=>$start,'end'=>$end]);
  }

  public function changestatusads(Request $request, $id)
  {
    $data1 = DB::table('hometb')->where('id', $id)->first();
    $d1 = DB::table('hometb')
      ->join('user', 'user.id', '=', 'hometb.u_id')
      ->where('hometb.id', $id)
      ->select('hometb.*', 'user.email', 'user.fname', 'user.lname')
      ->first();

    if ($data1->status == 'Pendding') {
      $s = DB::table('hometb')->where('id', $data1->id)->update(["status" => "Active"]);
      $ab = DB::table('notification')->where('item_id', $id)->count();
      $time = date('Y-m-d H:i:s', time());
      if ($ab > 0) {
        DB::table('notification')->where('item_id', $id)->update(['notification' => 'Your Product Has been Approve', 'read_status' => '0', 'updated_at' => $time]);
      } else {
        DB::table('notification')->insert(['item_id' => $id, 'uid' => $d1->u_id, 'notification' => 'Your Product Has been Approve', 'read_status' => '0']);
      }

      $emails = $d1->email;
      $item_id = $d1->id;
      $item_name = $d1->item_name;
      $allmsg = "Product_Id:" . $item_id . "\n" . "Product Name:" . $item_name . "\n" . "Your Product Has been Approve Successfully...";

      Mail::raw($allmsg, function ($message) use ($request, $emails) {
        $message->from(Session::get('admin_email'));
        $message->to($emails);
        $message->subject("Product Approve");
      });


      return redirect()->back()->with("message", "Approve Item SucessFully");
    } else if ($data1->status == 'Active') {
      DB::table('hometb')->where('id', $data1->id)->update(["status" => "Blocked"]);
      return redirect()->back()->with("message", "Item Has been Blocked...");;
    } else if ($data1->status == 'Blocked') {
      DB::table('hometb')->where('id', $data1->id)->update(["status" => "Active"]);
      return redirect()->back()->with("message", "Item Has been Active...");;
    }
  }

  public function changestatusadsdec(Request $request, $id)
  {
    $data1 = DB::table('hometb')->where('id', $id)->first();

    $d1 = DB::table('hometb')
      ->join('user', 'user.id', '=', 'hometb.u_id')
      ->where('hometb.id', $id)
      ->select('hometb.*', 'user.email', 'user.fname', 'user.lname')
      ->first();

    $image = $d1->item_img;
    if ($data1->status == 'Pendding') {
      DB::table('hometb')->where('id', $data1->id)->update(["status" => "Decline"]);
      $ab = DB::table('notification')->where('item_id', $id)->count();
      $time = date('Y-m-d H:i:s', time());
      // echo "<pre>";
      // print_r($ab);
      // die();
      if ($ab > 0) {
        DB::table('notification')->where('item_id', $id)->update(['notification' => "Your Product Has been Decline", 'read_status' => '0', 'updated_at' => $time]);
      } else {
        DB::table('notification')->insert(['item_id' => $id, 'uid' => $d1->u_id, 'notification' => "Your Product Has been Decline", 'read_status' => '0']);
      }

      $emails = $d1->email;
      $name = $d1->fname;
      $item_id = $d1->id;
      $item_name = $d1->item_name;
      $allmsg = "Product_Id:" . $item_id . "\n" . "Product Name:" . $item_name . "\n" . "Your Product has been Decline...";

      Mail::raw($allmsg, function ($message) use ($request, $emails) {
        $message->from(Session::get('admin_email'));
        $message->to($emails);
        $message->subject("Product Decline");
        // $message->attach($file->getRealPath(), array(
        //     'as'=>'files.' . $file->getClientOriginalName(),
        //    'mime' => $file->getMimeType())
        //        );
      });


      return redirect()->back()->with(['image' => $image, "message" => "Item has been Decline..."]);
    }
  }





  //     public function admineditpass(Request $request)
  //   {
  //       $id= Session::get("admin_id");
  //       $data = $request->all();
  //       $opass = $request->input('opass');
  //       $npass = $request->input('npass');
  //       $cpass = $request->input('cpass');

  //       $a1=DB::table('admin')->where(["id"=>$id])->first();

  //     if(Hash::check($opass,$a1->password))
  //     {
  //        if($npass == $cpass )
  //         {
  //           $b=DB::table('admin')->where('id',$data['id'])->update(["password"=>Hash::make($npass)]);
  //           $list = DB::table('admin')->where('id',$data['id'])->get();
  //           Session()->forget('admin_name');
  //           Session()->forget('admin_email');
  //           Session()->forget('admin_id');
  //           Session()->forget('admin_profile_image');
  //           return redirect('adminreset');
  //         }
  //         else
  //         {
  //             return redirect('adminreset')->with('error','New Password And Confirm Password are Wrong.....');
  //         }
  //     }
  //     else  
  //     {
  //       return redirect('adminreset')->with('error','Old Password are Wrong.....'); 
  //     }
  // }

}
