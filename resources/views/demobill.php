  <div class="sidebar-product">
        <div id="shopping-cart" tabindex="1">
        <div id="tbl-cart">
          <div id="txt-heading">
            <div id="cart-heading">Your Shopping Cart</div>
            <div id="close"></div>
          </div>
          <div id="cart-item"><input type="hidden" id="cart-item-count" value="1">
          <table width="100%" id="cart-table" cellpadding="10" cellspacing="1" border="0">
            <tbody>
              <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th class="text-right">Price</th>
                 <th class="text-right">Action</th>
              
              </tr>   
            <?php $total = 0 ?>
            <?php $user_id=Session::get('user_id'); ?>
              @if(session('cart'.$user_id))
                @foreach(session('cart'.$user_id) as $id => $details)
                  <?php $total += $details['price'] * $details['quantity'] ?>
                  <tr>
                    <td>{{ $details['item_name'] }}</td>
                    
                    <td data-th="Quantity">
                      <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" /></td>
                
                    <td data-th="Price">Rs.{{ $details['price'] }}</td>
                          
                    <td class="actions" data-th="">
                      <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o" aria-hidden="true">remove</i></button></td>
                  </tr>
                @endforeach
              @endif
            <tr id="tot">
                
            <td class="hidden-xs text-center" colspan="8"><strong>Total Rs. </strong> <span id="total">{{ $total }}</span></td>            
            <td><a href="{{url('removeitem')}}" id="btnEmpty">Empty Cart</a></td>
               
            </tr> 

          </tbody>
          </table>
          </div>
          </div>
          </div>
        </div>













         <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  
<script type="text/javascript">
$(function() {
    var $form         = $(".require-validation");
  $('form.require-validation').bind('submit', function(e) {
    var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('hide');
 
        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorMessage.removeClass('hide');
        e.preventDefault();
      }
    });
  
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }
  
  });
  
  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
  
});


$('#credit-card').on('keypress change blur', function () {
  $(this).val(function (index, value) {
    return value.replace(/[^a-z0-9]+/gi, '').replace(/(.{4})/g, '$1 ');
  });
});
</script>




<!--   @foreach($order as $data)
    <div class="info">
        <div class="row">
            <div class="col-7"> <span id="heading">Date</span><br> <span id="details">{{$data->created_at}}</span> </div>
            <div class="col-5 pull-right"> <span id="heading">Order No.</span> <span id="details">{{$data->id}}</span> </div>
        </div>
    </div>
    <div class="pricing">
        <div class="row">
           @php  $a=explode(",",$data->item_id);  @endphp
              @foreach($a as $b)
              @foreach(App\Order::where('id',$b)->get() as $itemnames)  
            <div class="col-9"> <span id="name">{{$itemnames->item_name}}</span> </div> @endforeach
           &nbsp; 
            @foreach(App\Order::where('id',$b)->get() as $itemprice)

            <div class="col-3"> <span id="price">{{$itemprice->price}}<br><br></span> </div>
            @endforeach
         
            @endforeach

        </div>
        
    </div>
    <div class="total">
        <div class="row">
            <div class="col-9"></div>
            <div class="col-3"><big>Rs.{{$data->total_price}}</big></div>
        </div>
    </div>
    <div class="tracking">
        <div class="title">Tracking Order</div>
    </div>
    <div class="progress-track">
        <ul id="progressbar">
            <li class="step0 active " id="step1">Ordered</li>
            <li class="step0 active text-center" id="step2">Shipped</li>
            <li class="step0 text-right" id="step3">On the way</li>
            <li class="step0 text-right" id="step4">Delivered</li>
        </ul>
    </div>
  @endforeach
 -->



 




