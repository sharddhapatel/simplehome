
@extends('header')
@section('content')
<div class="main-container">
  <div class="container"> 
    
      <header class="row tm-welcome-section">
    <h6 class="col-12 text-center tm-section-title">Forgotpassword Link</h6>
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
            <form class="form-horizontal" action="{{url('resendmail')}}" method="post" >
                    {{ csrf_field() }}
                    <br><br>
                
                 <div class="form-group">
                                    <label for="sender-email" class="control-label">Email:</label>

                                    <div class="input-icon"><i class="icon-user fa"></i>
                                        <input id="email" name="email" type="text" placeholder="Email"
                                               class="form-control email">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group" style="text-align: center">
                                    <button type="submit" class="tm-btn tm-btn-success">Send me my password
                                    </button>
                                </div>
            
          </center>
          

           <div style="float: right;">
            <p class="text-center "><a href="{{ url('userlogin') }}"> Back to Login </a></p>
        </div>
         

          
               
            </form>
        </div>
    </div>
  </div>
</div>
</div>

  
@stop