 @extends('Admin.admincontent')
@section('title')
Show User
@endsection
@section('body')
<html>

<style type="text/css">


/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 350px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  /*background-color: rgb(0,0,0); /* Fallback color */*/
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 50%;
  max-width: 500px;
}



/*#progressbar li:before {
    line-height: 29px;
    display: block;
    font-size: 12px;
    background: rgb(151, 149, 149);
    border-radius: 50%;
    margin: auto;
    z-index: -1;
    margin-bottom: 1vh
}

#progressbar li:after {
    content: '';
    height: 2px;
    background: rgb(151, 149, 149, 0.651);
    position: absolute;
    left: 0%;
    right: 0%;
    margin-bottom: 2vh;
    top: 8px;
    z-index: 1
}*/

/*ol.progtrckr {
    margin: 0;
    padding: 0;
    list-style-type none;
}

ol.progtrckr li {
    display: inline-block;
    text-align: center;
    line-height: 3.5em;
}

ol.progtrckr[data-progtrckr-steps="2"] li { width: 49%; }
ol.progtrckr[data-progtrckr-steps="3"] li { width: 33%; }
ol.progtrckr[data-progtrckr-steps="4"] li { width: 24%; }
ol.progtrckr[data-progtrckr-steps="5"] li { width: 19%; }
ol.progtrckr[data-progtrckr-steps="6"] li { width: 16%; }
ol.progtrckr[data-progtrckr-steps="7"] li { width: 14%; }
ol.progtrckr[data-progtrckr-steps="8"] li { width: 12%; }
ol.progtrckr[data-progtrckr-steps="9"] li { width: 11%; }

ol.progtrckr li.progtrckr-done {
    color: black;
    border-bottom: 4px solid yellowgreen;
}
ol.progtrckr li.progtrckr-todo {
    color: silver; 
    border-bottom: 4px solid silver;
}

ol.progtrckr li:after {
    content: "\00a0\00a0";
}
ol.progtrckr li:before {
    position: relative;
    bottom: -2.5em;
    float: left;
    left: 50%;
    line-height: 1em;
}
ol.progtrckr li.progtrckr-done:before {
    content: "\2713";
    color: white;
    background-color: yellowgreen;
    height: 2.2em;
    width: 2.2em;
    line-height: 2.2em;
    border: none;
    border-radius: 2.2em;
}
ol.progtrckr li.progtrckr-todo:before {
    content: "\039F";
    color: silver;
    background-color: white;
    font-size: 2.2em;
    bottom: -1.2em;
}*/

</style>
 <body class="animsition">
    <div class="page-wrapper">   
    <div class="page-container">
   <div class="main-content">
        <div class="section__content section__content--p30">
             <div class="container-fluid">

            <div class="row m-t-30">
            <div class="col-md-12">
                <!-- DATA TABLE-->
                <div class="table-responsive m-b-40">
                    <table class="table table-borderless table-data3">
                        <form action="{{url('updateorder')}}" method="post">
                            {{ csrf_field() }}
                           @foreach($order as $data)

               <!--  <ol class="progtrckr" data-progtrckr-steps="5">
                <li class="progtrckr-done" >Pennding</li>
                <li class="progtrckr-todo" id="conform">Order Conform</li>
                <li class="progtrckr-todo" id="inprocess">In Process</li>
                <li class="progtrckr-todo" id="readytodeliver">Ready To Deliver</li>
                <li class="progtrckr-todo" id="delivered">Delivered</li>
                </ol><br><br> -->
                 </form>
                        <thead> 
                            <tr>
                                <th>ProductId</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Product Quantity</th>
                                <th>Product Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                  <td> @php $a=explode(",",$data->item_id);  @endphp
                                   @foreach($a as $b)
                                   {{$b}}<br>
                                  @endforeach</td>

                                <td> @php  $a=explode(",",$data->item_id);  @endphp
                                    @foreach($a as $b)
                                      @foreach(App\order::where('id',$b)->get() as $itemimage)
                                        <img src="{{url('public/item_img') }}/{{ $itemimage->item_img }}" alt="image1" class="img-fluid tm-gallery-img" height="50" width="50"  data-toggle="modal" data-target="#myModal{!! $b !!}"/>&nbsp;

                                        <div id="myModal{!! $b !!}" class="modal">
                                          
                                    <img class="modal-content" src="{{ url('public/item_img') }}/{{ $itemimage->item_img }}">

                                   <!-- <span class="close" data-dismiss="modal">&times;</span> -->
                                 <center> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></center>
                                <div id="caption"></div>

                                </div>
                                      @endforeach
                                    @endforeach
                                </td>
                                <td> @php  $a=explode(",",$data->item_id);  @endphp
                                  @foreach($a as $b)
                                  @foreach(App\Order::where('id',$b)->get() as $itemnames)  
                                         {{$itemnames->item_name}}<br>
                                  @endforeach
                                  @endforeach</td>
                                <td> @php  $a=explode(",",$data->qty);  @endphp
                                   @foreach($a as $b)
                                   {{$b}}<br>
                                  @endforeach</td>

                                <td>@php $a=explode(",",$data->item_id);  @endphp
                                  @foreach($a as $b)
                                  @foreach(App\Order::where('id',$b)->get() as $itemprice)
                                    {{$itemprice->price}}<br>
                                    @endforeach
                                 @endforeach</td>
                                <td>{{$data->total_price}}</td>
                            </tr>
                           
                            @endforeach
                        </tbody>

                    </table>
                    <br>
                    <a href="{{ url('ordertrack') }}"> <i
                  class="fa fa-angle-double-left"></i> Back to Results</a>
                </div>  
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</body>
</html>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="{{ URL::asset('public/js/jquery.image-popup.js')}}"></script>
<script type="text/javascript">

$(document).on("click",".progtrckr-todo",function(){


        $("ol.progtrckr").children().removeClass("progtrckr-todo");
         
         $("ol.progtrckr").children().addClass("progtrckr-done");
        // $("ol.progtrckr > li").addClass("progtrckr-done");
                   console.log(this);
              }); 
</script>
@stop