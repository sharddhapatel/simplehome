
@extends('header')
 @section('title')
Login 
@endsection
@section('content')

<div class="main-container">
  <div class="container"> 
    
      <header class="row tm-welcome-section">
    <h6 class="col-12 text-center tm-section-title"> User Login</h6>
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
            <form class="form-horizontal" action="{{url('loginuser')}}" method="get" >
                    {{ csrf_field() }}
                    <br><br>
                
                <div class="form-group row">
                  <label for="" class="col-form-label">User Name</label>
                   <input type="email" name="email" class="form-control" id="email"> 
                    
                </div>
                <br>
                 <div class="form-group row">
                  <label for="" class="col-form-label">Password</label>
                    
                        <input class="form-control" type="Password" name="password"> 
                    
                </div>
                <br>

                 <div class="form-group row">
               
              <center>
              <button type="Submit" id="button1id" class="tm-btn tm-btn-success">Login</button>
            
          </center>
            </div>
        <div style="float: right;">
            <p class="text-center pull-right"><a href="{{ url('forgotpassword') }}"> Lost your password? </a></p>
        </div>
         <div class="login-box-btm text-center"  style="float: left;">
                        <p> Don't have an account? <br>
                            <a href="{{ url('signup') }}"><strong>Sign Up !</strong> </a></p>
           </div>
               
            </form>
        </div>
    </div>
  </div>
</div>
</div>

  
@stop