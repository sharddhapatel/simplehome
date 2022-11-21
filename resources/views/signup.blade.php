
@extends('header')
 @section('title')
SignUp
@endsection
@section('content')
<div class="main-container">
  <div class="container"> 
  <header class="row tm-welcome-section">
    <h4 class="col-12 text-center tm-section-title">Add Your Details</h4>
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
            <form class="form-horizontal" action="{{url('signup')}}" method='post' enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <br><br>
                <div class="form-group row">
                  <label for="" class="col-form-label">First Name</label>
                    
                        <input class="form-control" type="text" name="fname"  id="fname" placeholder="Firstname" onkeypress="return checkNum(event)"/> <p id="name_validation" ></p>
                    
                </div>
                <br>
                 <div class="form-group row">
                  <label for="" class="col-form-label">Last Name</label>
                    
                        <input class="form-control" type="text" id="lname" name="lname" placeholder="Lastname" onkeypress="return checkNum(event)" /><p id="lname_validation" ></p> 
                    
                </div>
                <br>

                <div class="form-group row">
                  <label for="" class="col-form-label">Email</label>
                   <input type="email" name="email" class="form-control" id="email"  placeholder="Email"><p  id="email_validation" ></p> 
                    
                </div>
                <br>
               
                 <div class="form-group row">
                  <label for="" class="col-form-label">Password</label>
                        <input class="form-control" type="Password" id="password" name="password" placeholder="Password"> <p id="password_validation" ></p> 
                </div>

                <br>
                <div class="form-group row">
                  <label for="" class="col-form-label">Address</label>
                  <textarea class="form-control" id="textarea" name="address" placeholder="Address"></textarea>
                </div>
              
                <br>
                <div class="form-group row">
                    <label for="" class="col-form-label">City</label>
                    <input type="text" name="city" id="city" class="form-control" placeholder="City" onkeypress="return checkNum(event)" /><p id="city_validation" ></p>
                </div>

                <br>
                <div class="form-group row">
                    <label for="" class="col-form-label">Zip Code</label>
                    <input type="text" name="zipcode"  id="zipcode" class="form-control" placeholder="ZipCode" onkeypress="return isNumber(event)"  /><p id="zipcode_validation" ></p>
                </div>

                 <br>
                <div class="form-group row">
                    <label for="" class="col-form-label">Phone Number</label>
                    <input type="text" name="phone"  id="phone" class="form-control" placeholder="Phone Number" maxlength="10" onkeypress="return isNumber(event)"  /><p id="Mobile_validate"></p> 
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

<script type ="text/javascript">

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

function    (event)
{

   if ((event.keyCode > 64 && event.keyCode < 91) || (event.keyCode > 96 && event.keyCode < 123) || event.keyCode == 8 || event.keyCode == 32)
      return true;
   else
   {
       return false;
   }
}
$("#fname").focusout(function()
   {
      var name = $("#fname").val();
   if(name == '')
   {
      $("#fname").css({"border-color": "red", "border-style":"solid"});
      document.getElementById("name_validation").innerHTML = "<font style=color:red> Please Enter First Name</font>";
   }
   else 
     {
      var a=/^[A-Za-z\s]+$/;

      if(!name.match(a))
      {
         $("#fname").css({"border-color": "red","border-style":"solid"});
      document.getElementById("name_validation").innerHTML = "<font style=color:red>Name can have only alphabets, spaces and dashes</font>";
      }
      else
      {
         $("#fname").css({"border-color": "black","border-style":"solid"});
      document.getElementById("name_validation").innerHTML = "<font style=color:white></font>";
      }

   }
});


$("#lname").focusout(function()
   {
      var name = $("#lname").val();
   if(name == '')
   {
      $("#lname").css({"border-color": "red", "border-style":"solid"});
      document.getElementById("lname_validation").innerHTML = "<font style=color:red> Please Enter Last Name</font>";
   }
   else if(name !='')
   {
      var a=/^[A-Za-z\s]+$/;

      if(!name.match(a))
      {
         $("#lname").css({"border-color": "red","border-style":"solid"});
      document.getElementById("lname_validation").innerHTML = "<font style=color:red>Name can have only alphabets, spaces and dashes</font>";
      }
      else
      {
         $("#lname").css({"border-color": "black","border-style":"solid"});
      document.getElementById("lname_validation").innerHTML = "<font style=color:white></font>";
      }

   }
});

$("#city").focusout(function()
   {
      var name = $("#city").val();
   if(name == '')
   {
      $("#city").css({"border-color": "red", "border-style":"solid"});
      document.getElementById("city_validation").innerHTML = "<font style=color:red> Please Enter City</font>";
   }
   else 
     {
      var a=/^[A-Za-z\s]+$/;

      if(!city.match(a))
      {
         $("#city").css({"border-color": "red","border-style":"solid"});
      document.getElementById("city_validation").innerHTML = "<font style=color:red>city can have only alphabets, spaces and dashes</font>";
      }
      else
      {
         $("#city").css({"border-color": "black","border-style":"solid"});
      document.getElementById("city_validation").innerHTML = "<font style=color:white></font>";
      }

   }
});


$("#email").focusout(function()
   {
      var email = $("#email").val();
   if(email == '')
   {

      $("#email").css({"border-color": "red","border-style":"solid"});
      document.getElementById("email_validation").innerHTML = "<font style=color:red> Please Enter Email</font>";
   }
   else if(email !='')
   {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if(!regex.test(email))
      {
         $("#email").css({"border-color": "red","border-style":"solid"});
      document.getElementById("email_validation").innerHTML = "<font style=color:red>Enter valid email</font>";
      }
      else
      {
         $("#email").css({"border-color": "black","border-style":"solid"});
      document.getElementById("email_validation").innerHTML = "<font style=color:white></font>";
      }
   }
});

 $("#password").focusout(function()
 {
    var password = $("#password").val();
    if(password == '')
    {
       $("#password").css({"border-color": "red","border-style":"solid"});
       document.getElementById("password_validation").innerHTML = "<font style=color:red> Please Enter Password</font>";
    }
    else 
    {
       var b = password.length;
       if(b == 6)
       {
          $("#password").css({"border-color": "black","border-style":"solid"});
          document.getElementById("password_validation").innerHTML = "<font style=color:white></font>"; 
       }
       else
       {
           $("#password").css({"border-color": "red","border-style":"solid"});
       document.getElementById("password_validation").innerHTML = "<font style=color:red>Enter six characher password</font>";
       }
    }

} );  
   
function check_email()
{

   var email = $("#email").val();

   if(email !== '')
   {
     function isEmail(email) 
     {
        var regex = /^([a-zA-Z0-9_.+-])+\@@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9] {2,4})+$/;
        return regex.test(email);
     }
   }

   else
   {
   document.getElementById('email_validation').innerHTML = "<font color=red>Please Enter Email</font>";
   $("#email").css("border","1px solid red");
   error_email = true;
   }
}

 $("#zipcode").focusout(function()
 {
    var zipcode = $("#zipcode").val();
    if(zipcode == '')
    {
       $("#zipcode").css({"border-color": "red","border-style":"solid"});
       document.getElementById("zipcode_validation").innerHTML = "<font style=color:red> Please Enter zipcode</font>";
    }
    else 
    {
       var b = zipcode.length;
       if(b == 6)
       {
          $("#zipcode").css({"border-color": "black","border-style":"solid"});
          document.getElementById("zipcode_validation").innerHTML = "<font style=color:white></font>"; 
       }
       else
       {
           $("#zipcode").css({"border-color": "red","border-style":"solid"});
       document.getElementById("zipcode_validation").innerHTML = "<font style=color:red>Enter six digit zipcode</font>";
       }
    }

} );  

 function check_mobile()
{

   var mobile = $("#phone").val();

   if(mobile !== '')
   {

      if(mobile.length!=10)
      {
      document.getElementById('Mobile_validate').innerHTML = "<font color=red>Please Enter 10 digit Mobile Number!</font>";
      $("#phone").css("border","1px solid red");
      error_mobile = true;
      }
       else
       {
       document.getElementById('Mobile_validate').innerHTML = "<font color=green></font>";
       $("#phone").css("border","1px solid lightblue");
       error_mobile = false;
       }
    }
    else
    {
       document.getElementById('Mobile_validate').innerHTML = "<font color=red>Please Enter Mobile Number!</font>";
       $("#phone").css("border","1px solid red");
       error_mobile = true;
    }
}

$("#phone").focusout(function()
   {
    check_mobile();
   });

</script>
@stop

