
@extends('header')
 @section('title')
SignUp
@endsection
@section('content')


<div class="main-container">
  <div class="container"> 
  <header class="row tm-welcome-section">
    <h4 class="col-12 text-center tm-section-title">Billing Details</h4>
  </header>
<div class="tm-container-inner-2 tm-contact-section">
 
    <div class="row">
        <div class="col-md-6">

           @if(Session::has('message'))
          <div class="alert-success">
              <i class="fa-lg fa fa-warning"></i>
              {!! session('message') !!}
          </div>
          @elseif(Session::has('error'))
          <div class="alert-danger">
              <i class="fa-lg fa fa-warning"></i>
              {!! session('error') !!}
          </div>
          @endif
            <form class="form-horizontal" action="{{url('addorder')}}" method='post'

             >
                    {{ csrf_field() }}
                    <br><br>
               
                
                 <div class="form-group row">
                  <label for="" class="col-form-label">New Address</label>
                        <input class="form-control" type="text" name="newaddress">   
                </div>
                <br>
                <div class="form-group row">
                  <label for="" class="col-form-label">Card Name</label><span class="error">*</span>
                        <input class="form-control" type="text" name="cardname" placeholder="Card Name"> 
                </div>
                 <br>
                <div class="form-group row">
                  <label for="" class="col-form-label">Card Number</label><span class="error">*</span>
                        <input class="form-control" id="credit-card" type="text" name="cardno" placeholder="Card No" maxlength="20"  onkeypress="return isNumber(event)">  
                </div>
                <br>
                <div class="form-group row">
                  <label for="" class="col-form-label">CVV </label><span class="error">*</span>
                        <input class="form-control" type="text" name="cvv"  placeholder="CVV" onkeypress="return isNumber(event)" maxlength="3" id="cvv">  
                </div> 

                <br>
                <div class="form-group row">
                  <label for="" class="col-form-label">Expire Date </label><span class="error">*</span>
                  <br><br>

                  

                        <!-- <input class="form-control" type="Date" name="expiredate">   --> 
                   <select name="month" style="width: 20%;" >

                             <?php
                        foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $monthNumber => $month) {
                            echo "<option value='$monthNumber'>{$month}</option>";
                        }
                        ?>
                  </select>

                  <select name="year">
                    <option>Year</option>
                         @for ($year = 2022; $year <= 2030 ; $year++)
                         <option value = "{{ $year }}">{{ $year }}</option>  
                         @endfor 
                        
                  </select>
                </div>

                <br>
      
              <div class="form-group row">
               
              <center>
              <button type="Submit" id="button1id" class="tm-btn tm-btn-success">Place Order</button>
            &nbsp;<button type="reset" class="tm-btn tm-btn-danger ">cancel</button>
          </center>
          
            </div>
        
               
            </form>
        </div>
    </div>
  </div>
</div>
</div>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
  
              $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            // if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                     }
                });
            // }
        });


function isNumber(evt)
{
   evt = (evt) ? evt : window.event;
   var charCode = (evt.which) ? evt.which : evt.keyCode;
   if (charCode > 31 && (charCode < 48 || charCode > 57)) 
   {
      return false;
   }
   return true;
}


$('#credit-card').on('keypress change blur', function () {
  $(this).val(function (index, value) {
    return value.replace(/[^a-z0-9]+/gi, '').replace(/(.{4})/g, '$1 ');
  });
});

</script>
@stop