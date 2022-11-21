<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use App\Cart;
use App\Http\Requests;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
use Response;
use Stripe;

// use Stripe\Refund;
// use Stripe\Charge;
use App\Order;
// use Stripe\Customer;


class SimpleHomeController extends Controller
{
  public function about()
  {
    return view('about');
  }

  public function index(Request $request)
  {
    $category = DB::table('category')->get();

    // echo "<pre>";
    // print_r($category);
    // die();

    return view('homeview')->with(["category" => $category]);
  }
  public function getData(Request $request)
  {
    $id = $request->input('id');

    // $category=DB::table('category')->get();
    $sort = $request->input('sort');
    if ($sort == 'desc') {
      $data = DB::table('hometb')
        ->where('status', '=', 'Active')
        ->where('c_id', '=', $id)
        ->orderBy('price', 'DESC')
        ->get();
    } else {
      $data = DB::table('hometb')
        ->where('status', '=', 'Active')
        ->where('c_id', '=', $id)
        ->orderBy('price', 'ASC')
        ->get();
    }

    $output = '';

    foreach ($data as $items) {

      $output .= '<article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">' .

        '<figure>
        <a href="itemdetail/' . $items->id . '">
      <img src="public/item_img/' . $items->item_img . '" alt="image1" height="250px" width="250px" /></a>
      <figcaption>
        <h4 class="tm-gallery-title">' . $items->item_name . '</h4>
        <p class="tm-gallery-description">' . $items->des . '</p>
        <p class="tm-gallery-price">Rs.' . $items->price . '</p>
        
      </figcaption>
    <hr>
      <a  href ="addtocart/' . $items->id . '"><button  type="submit" class="btn btn-success"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Add To Cart</button></a>
      </figure>
      </article>';
    }
    return Response($output);
  }

  public function checkout(Request $request)
  {
    $user_id = Session::get('user_id');
    $address = DB::table('address')
      ->where('uid', '=', $user_id)
      ->select('address', 'city', 'zipcode')
      ->get();
    return view('stripe')->with(['address' => $address]);
  }
  public function addorder(Request $request)
  {
    $user_id = Session::get('user_id');
    $fname = Session::get('user_fname');
    $lname = Session::get('user_lname');
    $name = $fname . " " . $lname;
    $email = Session::get('user_email');

    $data = $request->all();
    $cart = Session::get('cart' . $user_id);
    $total = 0;
    $qty = '';
    $item_id = '';
    foreach ($cart as $cdata) {
      $total += $cdata['price'] * $cdata['quantity'];
      $qty = $cdata['quantity'] . "," . $qty;
      $item_id = $cdata['id'] . "," . $item_id;
    }

    if (@$data['oldadd'] != '') {
      $address = $data['oldadd'];
      $oid = DB::table('ordertb')->insertGetId(["user_id" => $user_id, "item_id" => $item_id, "qty" => $qty, "total_price" => $total, "address" => $address, "status" => "Pendding"]);
    }
    if ($data['city'] != '' && $data['newaddress'] != '' && $data['zipcode'] != '') {
      DB::table('address')->insert(["uid" => $user_id, "address" => $data['newaddress'], "city" => $data['city'], "zipcode" => $data['zipcode']]);
      $address = $data['newaddress'] . " , " . $data['city'] . " , " . $data['zipcode'];

      $oid = DB::table('ordertb')->insertGetId(["user_id" => $user_id, "item_id" => $item_id, "qty" => $qty, "total_price" => $total, "address" => $address, "status" => "Pendding"]);
    }

    $month = $request->input('month');
    $year = $request->input('year');
    $expiredate = $month . "/" . $year;

    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    $customer = Stripe\Customer::create(array(
      'email' => $email,
      "name" => $name,
      'source' => $request->stripeToken
    ));

    #create charge it will display on payments tab in stripe site
    $charge = Stripe\Charge::create(array(
      'shipping' => [
                  'name' => $name, 
                  'address' => ['line1' => $address, 'country' => 'US',],
              ],
      'metadata' => array('user_id' => $user_id,),
      'customer' => $customer->id,
      'amount' => $total * 100,
      'currency' => "inr",
      'description' => "Card Payment",

    ));

    // echo "<pre>";
    // print_r($charge); 
    // die();


    DB::table('bill')->insert(["order_id" => $oid, "cardname" => $data['cardname'], "cardno" => $data['cardno'], "cvv" => $data['cvv'], "expiredate" => $expiredate, "payment_method" => "card", "payment_status" => $charge['status'], 'charge_id' => $charge['id']]);
    Session::forget('cart' . $user_id);
    return redirect('/')->with('message', ' order Insert Sucessfully!');
  }

  public function cart(Request $request)
  {
    return view('cart');
  }

  public function addToCart(Request $request, $id)
  {
    $user_id = Session::get('user_id');
    $product = DB::select('select * from hometb where id=' . $id);
    // echo "<pre>";
    // print_r($product);
    // die();

    $cart = Session::get('cart' . $user_id);
    if (isset($cart[$id])) {

      $cart[$id]['quantity'] += 1;
      session()->put('cart' . $user_id, $cart);
      return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    $cart[$product[0]->id] = array(
      "id" => $product[0]->id,
      "c_id" => $product[0]->c_id,
      "item_name" => $product[0]->item_name,
      "price" => $product[0]->price,
      "item_img" => $product[0]->item_img,
      "quantity" => 1,
    );

    Session::put('cart' . $user_id, $cart);
    // dd($cart);

    return redirect()->back()->with(["message" => "Product added to cart successfully!"]);
  }

  public function updateCart(Request $request)
  {
    if ($request->id and $request->quantity) {
      $user_id = Session::get('user_id');
      $cart = session()->get('cart' . $user_id);
      $cart[$request->id]["quantity"] = $request->quantity;
      session()->put('cart' . $user_id, $cart);
      session()->flash('message', 'Cart Updated Successfully');
    }
    return redirect()->back();
  }
  public function deleteCart(Request $request)
  {
    $user_id = Session::get('user_id');
    if ($request->id) {
      $cart = session()->get('cart' . $user_id);
      if (isset($cart[$request->id])) {
        unset($cart[$request->id]);
        session()->put('cart' . $user_id, $cart);
      }
      session()->flash('message', 'Product removed successfully');
    }
    return redirect()->back();
  }

  public function removeitem(Request $request)
  {
    $user_id = Session::get('user_id');
    $cart = session()->get('cart' . $user_id);
    Session::forget('cart' . $user_id);
    return redirect()->back();
  }


  public function additemindex()
  {
    $data = DB::table('category')->where("status", "Active")->get();
    return view('additem')->with(['data' => $data]);
  }

  public function additem(Request $request)
  {
    $uid = Session::get("user_id");

    if ($request->isMethod('get')) {
      return view('additem');
    } else {
      $data = $request->all();
      $price = $request->input('price');
      if ($price != 0) {
        if (@$data['item_img'] != '') {
          $img = array();
          if ($files = $request->file('item_img')) {
            foreach ($files as $file) {

              $name = $file->getClientOriginalName();
              $t = time() . $name;
              // $t=time().".".$name;
              $img = explode(".", $t);

              $file->move(public_path('item_img'), $t);
              $image[] = $t;
            }
          }

          if ($img[1] == 'png' ||  $img[1] == "jpg" ||  $img[1] == "jpeg") {
            $ans = DB::table('hometb')->insertGetId(["u_id" => $uid, "c_id" => $data['category'], "item_name" => ucfirst($data['item_name']), "item_img" => implode(",", $image), "des" => $data['des'], "price" => $data['price'], "status" => "Pendding"]);

            return redirect()->back()->with('message', ' Item Insert Sucessfully!');
          } else {
            return redirect()->back()->with('error', 'Invalid Image Type');
          }
        } else {
          return redirect()->back()->with('error', 'Please Enter Item Images');
        }
      } else {
        return redirect()->back()->with('error', 'Enter Price must be Ggrater than 0');
      }
    }
  }

  public function myitem(Request $request)
  {
    $user = Session::get('user_id');
    $requestData = ['item_name', 'price'];
    $search = $request->input('search');

    $data = DB::table('hometb')
      ->join('user', 'user.id', '=', 'hometb.u_id')
      ->where('hometb.u_id', '=', $user)
      ->where('hometb.status', '=', 'Active')
      ->where(function ($q) use ($requestData, $search) {
        foreach ($requestData as $field)
          $q->orWhere($field, 'like', "%{$search}%");
      })
      ->select('hometb.*')
      ->orderBy('hometb.created_at', 'DESC')
      ->paginate(5);
    return view('myitem')->with(["data" => $data, "search" => $search]);
  }
  public function deleteitem($id)
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

  public function updatemyitem($id)
  {
    $data = DB::table('hometb')->where('id', $id)->first();
    return view('editmyitem')->with(['data' => $data]);
  }

  public function editmyitem(Request $request)
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
            $name = $file->getClientOriginalName();
            $img = explode(".", $name);
            $t = time() . "." . $img[1];
            if ($img[1] == 'png' ||  $img[1] == "jpg" ||  $img[1] == "jpeg") {
              $file->move(base_path('public/item_img'), $t);
              DB::table('hometb')->where('id', $data['id'])->update(["item_name" => ucfirst($data['item_name']), "item_img" => $t, "price" => $data['price'], "des" => $data['des'], "status" => "Pendding", 'updated_at' => $time]);


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
          return redirect()->back()->with('message', 'Update Product Sucessfully!');
        }
      } else {
        DB::table('hometb')->where('id', $data['id'])->update(["item_name" => ucfirst($data['item_name']), "price" => $data['price'], "des" => $data['des'], "status" => "Pendding", 'updated_at' => $time]);

        return redirect()->back()->with('message', 'Update Product Sucessfully!');
      }
    } else {
      return redirect()->back()->with('message', 'Price graterthan 0');
    }
  }

  public function itemdetail($imageid)
  {
    $user = Session::get('user_id');
    $data = DB::table('hometb')
      ->join('user', 'user.id', '=', 'hometb.u_id')
      ->join('address', 'address.uid', '=', 'user.id')
      ->where('address.primaryadd', '=', 'true')
      ->where("hometb.id", $imageid)
      ->select('hometb.*', 'user.fname', 'user.lname', 'user.phone', 'address.city')
      ->get();


    $a1 = DB::table('notification')->where('item_id', $imageid)->update(["read_status" => '1']);
    $noty = DB::table('notification')
      ->join('hometb', 'hometb.id', '=', 'notification.item_id')
      ->join('user', 'user.id', '=', 'hometb.u_id')
      ->where('notification.read_status', "0")
      ->where('user.id', '=', $user)
      ->select('notification.*', 'user.id as user_id')
      ->count();

    // echo "<pre>";
    // print_r($noty);
    // die();         
    session::put('noti', $noty);

    return view('itemdetail')->with(["data" => $data]);
  }

  public function myorder(Request $request)
  {
    $user_id = Session::get('user_id');
    $requestData = ['item_name', 'price', 'ordertb.status', 'total_price'];
    $search = $request->input('search');

    $order = DB::table('ordertb')
      ->join('hometb', 'hometb.id', '=', 'ordertb.item_id')
      ->where('ordertb.user_id', "=", $user_id)
      ->where(function ($q) use ($requestData, $search) {
        foreach ($requestData as $field)
          $q->orWhere($field, 'like', "%{$search}%");
      })
      ->select('ordertb.*', 'hometb.price', 'hometb.item_name')
      ->orderBy('ordertb.created_at', 'DESC')
      ->paginate(3);
    return view('myorder')->with(['order' => $order, 'user_id' => $user_id, 'search' => $search]);
  }

  public function ordercancel(Request $request, $id)
  {

    $data = DB::table('ordertb')
      ->join('bill', 'bill.order_id', '=', 'ordertb.id')
      ->where('order_id', $id)->first();
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    $refund = \Stripe\Refund::create(array(
      "charge" => $data->charge_id,
      'amount' => $data->total_price
     
    ));

    $balanceTransaction = \Stripe\BalanceTransaction::retrieve($refund->balance_transaction);

    // echo "<pre>";
    // print_r($refund);
    // die;

    $data1 = DB::table('ordertb')->where('id', $id)->first();

    $s = DB::table('ordertb')->where('id', $data1->id)->update(["status" => "OrderCancel"]);

    $ss = DB::table('bill')->where('order_id', $data1->id)->update(["payment_status" => $refund['object']]);

    return redirect()->back();
  }


  public function demo()
  {
    return view('demo');
  }
}
