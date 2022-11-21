<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use App\Cart;
use App\Http\Requests;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
use Stripe;

class ItemController extends Controller
{
  public function declineitem(Request $request)
  {
    $user = Session::get('user_id');
    $requestData = ['item_name', 'price'];
    $search = $request->input('search');

    $data = DB::table('hometb')
      ->join('user', 'user.id', '=', 'hometb.u_id')
      ->where('hometb.u_id', '=', $user)
      ->where('hometb.status', '=', 'Decline')
      ->where(function ($q) use ($requestData, $search) {
        foreach ($requestData as $field)
          $q->orWhere($field, 'like', "%{$search}%");
      })
      ->select('hometb.*')
      ->orderBy('hometb.created_at', 'DESC')
      ->paginate(5);

    return view('declineitem')->with(["data" => $data, "search" => $search]);
  }

  public function updatedeclineitem($id)
  {
    $data = DB::table('hometb')->where('id', $id)->first();
    return view('editmyitem')->with(['data' => $data]);
  }

  public function editdeclineitem(Request $request)
  {
    $time = date('Y-m-d H:i:s', time());
    $data = $request->all();

    $price = $request->input('price');
    $data = $request->all();
    if ($price != 0) {
      if (@$data['image'] != '') {
        $img = array();
        if ($files = $request->file('image')) {
          foreach ($files as $file) {
            //$name = @$data['image']->getClientOriginalName();
            $name = $file->getClientOriginalName();
            // $t=time().$name;

            $img = explode(".", $name);
            $t = time() . "." . $img[1];
            if ($img[1] == 'png' ||  $img[1] == "jpg" ||  $img[1] == "jpeg") {
              $file->move(base_path('public/item_img'), $t);
              // $image[]=$t;

              DB::table('hometb')->where('id', $data['id'])->update(["item_name" => ucfirst($data['item_name']), "item_img" => $t, "price" => $data['price'], "des" => $data['des'], "status" => "Pendding"]);

              $photo = $request->input('oldimg');

              if ($photo != '') {
                if (file_exists('public/item_img/' . $photo)) {
                  unlink('public/item_img/' . $photo);
                } else {
                  echo "file not exist";
                }
              }
            } else {
              return redirect()->back()->with('error', 'Invalid Image Type');
            }
          }
          return redirect()->back()->with('message', 'Update  Sucessfully!');
        }
      } else {
        DB::table('hometb')->where('id', $data['id'])->update(["item_name" => ucfirst($data['item_name']), "price" => $data['price'], "des" => $data['des'], "status" => "Pendding"]);
        return redirect()->back()->with('message', 'Update  Sucessfully!');
      }
    } else {
      return redirect()->back()->with('message', 'Price graterthan 0');
    }
  }

  public function deletedeclineitem($id)
  {
    $image = DB::table('hometb')->where("id", $id)
      ->pluck("item_img")->toArray();

    if ($image[0] != '') {
      if (file_exists('public/item_img/' . $image[0])) {
        $data = DB::table('hometb')->where('id', $id)->delete();

        unlink('public/item_img/' . $image[0]);
        return redirect()->back()->with('message', 'Delete Product Successfully!');
      } else {
        echo "file not exist";
      }
    }
  }

  public function notification()
  {
    $user = Session::get('user_id');
    $data = DB::table('notification')
      ->join('hometb', 'notification.item_id', '=', 'hometb.id')
      ->where('hometb.u_id', "=", $user)
      ->orderBy('notification.created_at', 'DESC')
      ->get();

    // echo "<pre>";
    // print_r($data);
    // die();

    return view('notification')->with("data", $data);
  }

  // public function notificationviewdata()
  // {
  //    return view('notifications');
  // }



}
