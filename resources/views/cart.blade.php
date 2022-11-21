@extends('header')
 @section('title')
Shopping Cart
@endsection
@section('content') 

<div class="main-container">
  <div class="container"> 
    
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
           
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:15%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>
        <?php $total = 0 ?>
        <?php $user_id=Session::get('user_id'); ?>
        @if(session('cart'.$user_id))
            @foreach(session('cart'.$user_id) as $id => $details)
                <?php $total += $details['price'] * $details['quantity'] ?>
                <tr>
                    <td data-th="Product">
                        <div class="row">
                   
                            <div class="col-sm-3 hidden-xs"><img src="{{url('public\item_img')}}/{{ $details['item_img'] }}" width="60" height="60" class="img-responsive"/></div>
                             <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['item_name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price" class="product-price">Rs.{{ $details['price'] }}</td>
    
                    <td data-th="Quantity">
                        <input type="number"   data-id="{{$id}}" name="quantity" value="{{ $details['quantity'] }}" id="quantity" class="form-control update-cart" step="any" min="1" />
                    </td>

                    <td data-th="Subtotal" id="subtotal" class="text-center">RS.{{ $details['price']  *$details['quantity'] }}</td>
                    <td class="actions" data-th="">
                     <!--    <button  id="update" class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh">Update</i></button>  
                        <br><br>    -->              
                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o" aria-hidden="true">remove</i></button>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>    
        <tfoot>
       <!--  <tr class="visible-xs" style="float: right;">
            <td class="text-center"><strong>Total {{ $total }}</strong></td>
        </tr> -->
        <tr>
            <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
             <td colspan="1">
                 <a href="{{url('checkout')}}" class="btn btn-success"><button class="btn btn-success" >Order Now</button></a>
            </td>

            <td colspan="1" class="hidden-xs"></td>
            <td class="hidden-xs text-center" id="maintotal"><strong>Total Rs.{{ $total }}</strong></td> 
             <td><a href="{{url('removeitem')}}" id="btnEmpty">Clear Cart</a></td>
        </tr>
        </tfoot>
    </table>
</div></div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
    


$(document).on("click",".update-cart",function(e){
   e.preventDefault();
   var ele = $(this);
   
     // alert(ele.attr("data-id"));
    $.ajax({
    // headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
    url:  '{{ url('update-cart') }}', 
    type: 'get',
    data: {id: ele.attr("data-id"),quantity :ele.val()},
      success: function (response) {
        window.location.reload();
     }
  });
});



      // $(".update-cart").click(function (e) {
      //      e.preventDefault();
      //      var ele = $(this);
      //       $.ajax({
      //          url: '{{ url('update-cart') }}',
      //          method: "patch",
      //          data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
      //          success: function (response) {
      //              window.location.reload();
      //          }
      //       });
      //   });

              $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
             if(confirm("Are you sure Remove your Product into the Cart")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                     }
                });
            }
        });




// var $subTotal = $('#subtotal');
// var $maintotal = $('#maintotal');

// $('input[type="number"]').on('input', function() {
//   if (!$(this).val().trim().length) return;
//   var ele = $(this);
//   var total = $(this).val() * ele.parents("tr").find('.product-price').text();

//   $subTotal.text("Rs."+total);
//   $maintotal.text("Rs."+total);

// })

</script>


@endsection

