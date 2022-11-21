@extends('Admin.admincontent')
@section('title')
Category
@endsection
@section('body')

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                  <div  style="float: left;">
                       <button type="submit" class="btn btn-primary"><a href="{{ url('showcategory') }}" style="color: white;">Show Category</a></button> 
                    </div>
                      <br><br>
                    <div class="login-content">
                        <!-- <div class="login-logo">
                            <h4>Category</h4>
                        </div> -->
                        <div class="login-form">

                           @if(Session::has('message'))
                      <div class="alert alert-success">
                          <i class="fa-lg fa fa-warning"></i>
                          {!! session('message') !!}
                      </div>
                      @elseif(Session::has('error'))
                      <div class="alert alert-danger">
                          <i class="fa-lg fa fa-warning"></i>
                          {!! session('error') !!}
                      </div>
                      @endif
                      
                     
                        <form class="form-horizontal" action="{{ url('insertcategory')}}" method="post">
                          {{ csrf_field() }}
                      <div class="form-group">
                       
                      <label>Category Name</label>
                      <input type="text" class="form-control" placeholder=" Category Name"  onkeypress="return checkNum(event)"  name="c_name" id="c_name" ><p id="c_name_validation"></p>
                      </div>

                              
                       <br><br>
                      <div class="form-group row">
                        <div class="offset-sm-0 col-sm-10">
                         <button type="submit" class="btn btn-success">Save Category</button> <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>
                      </div>
                    </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type ="text/javascript">



function checkNum(event)
{

   if ((event.keyCode > 64 && event.keyCode < 91) || (event.keyCode > 96 && event.keyCode < 123) || event.keyCode == 8)
      return true;
   else
   {
       return false;
   }

}

   
$("#c_name").focusout(function()
   {
      var c_name = $("#c_name").val();
   if(c_name == '')
   {
      $("#c_name").css({"border-color": "red", "border-style":"solid"});
      document.getElementById("c_name_validation").innerHTML = "<font style=color:red> Please enter c_name</font>";
   }
   else 
     {
      var a=/^[A-Za-z\s]+$/;

      if(!c_name.match(a))
      {
         $("#c_name").css({"border-color": "red","border-style":"solid"});
      document.getElementById("c_name_validation").innerHTML = "<font style=color:red>Name can have only alphabets, spaces and dashes</font>";
      }
      else
      {
         $("#name").css({"border-color": "black","border-style":"solid"});
      document.getElementById("name_validation").innerHTML = "<font style=color:white></font>";
      }

   }
});


</script>
  @endsection


