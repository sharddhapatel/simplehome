@extends('header')
@section('title')
Shopping Cart
@endsection
@section('content') 

<div class="main-container">
  <div class="container"> 
     <h3 class="col-12 text-center tm-section-title">My Order</h3>
     <div class="col-lg-9">
        <div class="table-responsive table--no-card m-b-40">
      <div class="table-responsive">
              <div class="table-action">
              <div class="table-search pull-right col-sm-7">
              <form class="form-horizontal"  action = "" >
                    <div class="row" style="float: right;">
                         {{ csrf_field() }}

                         <div class="searchpan">
                              <input type="text" class="form-control"  name="search" id="search" value="{{$search}}">

                          </div>&nbsp;&nbsp;
                          <button type="submit">Search</button>
                       </div>
                          </form>

                      </div>
                   </div>
              </div>
              <br>


         
         <?php  $aa=count($order);?>
            @foreach($order as $data)
            <table class="table table-borderless table-striped table-earning">
              <hr>
              <b><p>My Order: <?php echo $aa-- ?></p></b>
            
         <!-- <div class="progress-track">
                    <ul id="progressbar">
                        <li class="step0 active" id="step1">{{$data->status}}</li>
                        <li class="step0  text-center" id="step2">In Transit</li>
                        <li class="step0 text-center" id="step3"><span id="three">Out for Delivery</span></li>
                        <li class="step0 text-right" id="step4">Delivered</li>
                    </ul>
                </div> -->
                <thead style="background-color: lightgray;">
                    <tr>
                      <th style="width:10%">Product</th>
                      <th style="width:10%">Item Name</th>
                      <th style="width:10%">Price</th>
                      <th style="width:8%">Quantity</th>
                      <th style="width:8%">Total price</th>
                      <th style="width:12%">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <tr>
                  <td data-th="Product">
                      @php  $a=explode(",",$data->item_id);  @endphp
                    @foreach($a as $b)
                      @foreach(App\Order::where('id',$b)->get() as $itemimage)
                        <img src="{{ url('public/item_img') }}/{{ $itemimage->item_img }}" alt="image1" class="img-fluid tm-gallery-img" height="80" width="80" />&nbsp;
                      @endforeach
                    @endforeach
                  </td>

                  <td data-th="Item Name">
                      @php  $a=explode(",",$data->item_id);  @endphp
                  @foreach($a as $b)
                  @foreach(App\Order::where('id',$b)->get() as $itemnames)  
                              <h4 class="nomargin">{{$itemnames->item_name}}</h4>
                  @endforeach
                  @endforeach

                  </td>
                  <td data-th="Price">
                       @php  $a=explode(",",$data->item_id);  @endphp
                  @foreach($a as $b)
                  @foreach(App\Order::where('id',$b)->get() as $itemprice)

                  <h4 class="nomargin">Rs. {{$itemprice->price}}</h4>
                     @endforeach
                    @endforeach</td>

                  <td data-th="Quantity">
                   @php  $a=explode(",",$data->qty);  @endphp
                   @foreach($a as $b)
                   <h4 class="nomargin">{{$b}}</h4>
                  @endforeach</td>

                  <td data-th="totalprice">
                   <h4 class="nomargin">Rs. {{$data->total_price}}</h4>
                  </td> 

                  <td data-th="Action">

                     @if($data->status=="Pendding")
                           <p style="color:orange">{{$data->status}}</p>
                       @elseif($data->status=="Conform")
                      <p style="color:green" >{{$data->status}}</p>
                      @elseif($data->status=="InProcess")
                      <p style="color:purple  " >{{$data->status}}</p>
                       @elseif($data->status=="Ready To Deliver")
                      <p style="color:cyan" >{{$data->status}}</p>
                      @elseif($data->status=="Delivered")
                      <p style="color:green" >{{$data->status}}</p>
                     @endif
                    <!-- {{$data->status}} -->


                      @if($data->status=="OrderCancel")
                      <p style="color:red" >{{$data->status}}</p>
                      @else
                    <a href ='ordercancel/{{ $data->id }}'><button type="submit" id="cancel" class="btn btn-danger btn-sm" value="active">Cancel Order</button></a>
                    @endif
                  </td>
                </tr>

                    @endforeach
                
                </tbody>
            </table>
          
            <div class="pagination-bar text-center" style="text-align: right;">
                <nav aria-label="Page navigation " class="d-inline-b">
                  <ul class="pagination" role="navigation">
                    <li class="page-item active">{{$order->appends(\Request::except('_token'))->render() }}</li>
                  </ul>
                </nav>
              </div>
              <br>
            
        </div>
         
    </div>
</div>
</div>
  
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).on("click",".btn-danger",function(){
  if($order['status']=="OrderCancel")
  {
    $("#cancel").hidden();
  }
  console.log(this);
}); 
</script> -->
@endsection

