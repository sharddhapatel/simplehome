@extends('header')
 @section('title')
Edit MyItem
@endsection
@section('content')

<div class="main-container">
  <div class="container"> 
  <header class="row tm-welcome-section">
    <h3 class="col-12 text-center tm-section-title">Edit Your Items</h3>
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
            <form class="form-horizontal" action="{{url('editmyitem')}}" method='post' enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <br><br>
                     <input type="hidden" class="form-control" name="id" id="id" value="{{ $data->id }}">
                      <input type="hidden" class="form-control" name="uid" id="uid" value="{{ $data->u_id }}">
                <div class="form-group row">
                  <label for="" class="col-form-label">Item Name</label>
                    
                        <input class="form-control" type="text" name="item_name" value="{{$data->item_name}}"> 
                    
                </div>
                
                <br>


               <!-- @php $a = explode(",",$data->item_img); @endphp -->
      <div class="form-group row">
      <label class="col-form-label">Item Image</label>
      <div class="col-sm-8">
     <img id="blah" src="{{ url('public/item_img') }}/{{ $data->item_img }}" alt="" height="100" width="100" />
                 <br><br>
      <input class="file" data-preview-file-type="text" type = 'file' id="imgInp" name="image[]" value ="{{$data->item_img}}" />

        <input type="hidden" name="oldimg" id="oldimg" value="{{ $data->item_img }}">
              
                <div id="item_img_preview"></div>
                </div>
                </div>
                <br>
        
                <div class="form-group row">
                    <label class="col-form-label">Price</label>
                    <input type="text" name="price" id="price" class="form-control" onkeypress="return isNumber(event)" 
                    aria-label="Amount " value="{{$data->price}}"><p id="Price_validate"></p>
                </div>

                <br>
                <div class="form-group row">
                    <label for="" class="col-form-label">Item Description</label>
                    <textarea class="form-control" id="des" name="des" >{{$data->des}}</textarea>
                       
                   
                </div>
                <br>
                 <div class="form-group row">
              
              <center>
              <button type="Submit" id="button1id" class="tm-btn tm-btn-success">Edit</button>
            &nbsp;<button type="reset" class="tm-btn tm-btn-danger ">Cancel</button>
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

function readURL(input) 
   {
  if (input.files && input.files[0]) 
  {
    var reader = new FileReader();
    
    reader.onload = function(e)
     {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});

$("#image").change(function(){

     $('#image_preview').html("");

     var total_file=document.getElementById("image").files.length;

     for(var i=0;i<total_file;i++)

     {

      $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"' height='60' width='60' >");

     }

  });


 

  // $('form').ajaxForm(function() 

  //  {

  //   alert("Uploaded SuccessFully");

  //  }); 



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