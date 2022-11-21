@extends('Admin.admincontent')
@section('title')
Profile
@endsection
@section('body')
<body class="animsition">
    <div class="page-wrapper">
        <div class="page-container">
        <div class="main-content">
        <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <h4>Admin Profile</h4>
                        </div>
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
                           <form class="form-horizontal" action="{{ url('profileupdate') }}" method="post" enctype='multipart/form-data' >
                          {{ csrf_field() }}
                      <div class="form-group">
                        <input type="hidden" class="form-control" name="id" id="id" value="{{ $a->id }}">
                      <label>Name</label>
                      <input type="text" class="form-control" placeholder="Name"  onkeypress="return checkNum(event)"  name="name" id="name" value="{{ $a->name }}"><p id="name_validation"></p>
                      </div>

                      <div class="form-group">
                      <label>Email </label>
                      <input type="text" class="form-control" placeholder="Email" name="email" id="email" value="{{ $a->email }}"><p id="email_validation"></p>
                      </div>
                      
                      <div class="form-group">
                      <label>Profile Picture</label>
                     <div>
                      <img id="blah" src="{{ url('public/image') }}/{{ $a->profile_image }}" alt="" height="100" width="100" />
                      <br><br><input type = 'file' id="imgInp" name="image" value="{{$a->profile_image}}" />
                    <input type="hidden"  name="oldimg" id="oldimg" value="{{ $a->profile_image }}">            
                       <br><br>
                      <div class="form-group row">
                        <div class="offset-sm-0 col-sm-10">
                         <button type="submit" class="btn btn-primary">Save</button> <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                   
                            
                        </div>
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

function readURL(input, imgControlName) 
        {
          if (input.files && input.files[0]) 
          {
            var reader = new FileReader();
            reader.onload = function(e) 
            {
             
              $(imgControlName).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
          }
        }

    $("#imgInp").change(function() {
      var imgControlName = "#blah";
      readURL(this, imgControlName);
    
    });

function checkNum(event)
{

   if ((event.keyCode > 64 && event.keyCode < 91) || (event.keyCode > 96 && event.keyCode < 123) || event.keyCode == 8)
      return true;
   else
   {
       return false;
   }

}

   
$("#name").focusout(function()
   {
      var name = $("#name").val();
   if(name == '')
   {
      $("#name").css({"border-color": "red", "border-style":"solid"});
      document.getElementById("name_validation").innerHTML = "<font style=color:red> Please enter name</font>";
   }
   else 
     {
      var a=/^[A-Za-z\s]+$/;

      if(!name.match(a))
      {
         $("#name").css({"border-color": "red","border-style":"solid"});
      document.getElementById("name_validation").innerHTML = "<font style=color:red>Name can have only alphabets, spaces and dashes</font>";
      }
      else
      {
         $("#name").css({"border-color": "black","border-style":"solid"});
      document.getElementById("name_validation").innerHTML = "<font style=color:white></font>";
      }

   }
});

 $("#email").focusout(function()
   {
      var email = $("#email").val();
   if(email == '')
   {

      $("#email").css({"border-color": "red","border-style":"solid"});
      document.getElementById("email_validation").innerHTML = "<font style=color:red> Please enter email</font>";
   }
   else if(email !='')
   {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z]{2,4})+$/;
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

</script>
  @endsection


