@extends('Admin.admincontent')
@section('title')
Forgot-Password
@endsection
@section('body')
<html>

<head>
   
    <title>Forget Password</title>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <h4>Forgot Password</h4>
                        </div>
                        <div class="login-form">
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
                            <form action="{{url('adminresendmail')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">submit</button>

                                <p class="text-center "><a href="{{ url('adminlogin') }}"> Back to Login </a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

   
</body>

</html>
@stop


