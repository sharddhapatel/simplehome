@extends('header')
 @section('title')
Add Item
@endsection
@section('content')
<div class="main-container">
  <div class="container"> 
  <header class="row tm-welcome-section">
    <h3 class="col-12 text-center tm-section-title">Add Your Items</h3>
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
            <form class="form-horizontal" action="{{url('additem')}}" method='post' enctype="multipart/form-data">
                {{ csrf_field() }}
                <br><br>
                <div class="form-group row">
                  <label for="" class="col-form-label">Category</label>
                    <select name="category" id="category" class="form-control">
                      <option selected disabled> Select a category...</option>
                      @foreach($data as $items_each)
                      <option value="{!! $items_each->id !!}">{!! $items_each->c_name !!}</option>@endforeach
                    </select>
                </div>
                <br>

                <div class="form-group row">
                  <label for="" class="col-form-label">Item Name</label>
                  <input class="form-control" type="text" name="item_name"> 
                </div>
                <br>

                <div class="form-group row">
                  <label class="col-form-label" for="">Item Image</label><br>
                  <input  type="file" name="item_img[]" id="item_img" class="file form-control" data-preview-file-type="text">
                  <div id="item_img_preview"></div>
                </div>
                <br>
        
                <div class="form-group row">
                  <label class="  col-form-label">Price</label>
                  <input type="text" name="price" id="price" class="form-control" onkeypress="return isNumber(event)" 
                  aria-label="Amount "><p id="Price_validate"></p>
                </div>
                <br>

                <div class="form-group row">
                  <label for="" class="col-form-label">Item Description</label>
                  <textarea class="form-control" name="des" id="des" rows="2"></textarea>  
                </div>
                <br>

                <div class="form-group row">
                  <center>
                    <button type="Submit" id="button1id" class="tm-btn tm-btn-success">Submit</button>
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
  $("#item_img").change(function(){

     $('#item_img_preview').html("");
     var total_file=document.getElementById("item_img").files.length;
     for(var i=0;i<total_file;i++)
     {
      $('#item_img_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"' height='60' width='60' >");
     }
  });

function check_price()
{

   var price = $("#price").val();

   if(price !== '')
   {

      if(price.length<=0)
      {
      document.getElementById('Price_validate').innerHTML = "<font color=red>Price Must be Grater than 0 </font>";
      $("#price").css("border","1px solid red");
      error_mobile = true;
      }
       else
       {
       document.getElementById('Price_validate').innerHTML = "<font color=green></font>";
       $("#price").css("border","1px solid lightblue");
       error_mobile = false;
       }
    }
    else
    {
       document.getElementById('Price_validate').innerHTML = "<font color=red>Please Enter Price!</font>";
       $("#price").css("border","1px solid red");
       error_mobile = true;
    }
}

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
$("#price").focusout(function()
   {
    check_price();
   });

</script> 
@stop