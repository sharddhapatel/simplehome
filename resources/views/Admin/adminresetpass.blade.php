@extends('Admin.admincontent')
@section('title')
Change Password
@endsection
@section('body')
<html>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <h4>Change Password</h4>
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
                            <form action="{{url('adminreset')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                     <input type="hidden" id="id"  name="id" value="{{$list->id}}">
                                  <input type="hidden" id="token"  name="token" value="{!! @$list->remember_token !!}">

                                    <label>New password</label>
                                    <input class="au-input au-input--full" type="password" name="npass" placeholder="New Password">
                                </div>
                                 <div class="form-group">
                                    <label>Confirm password</label>
                                    <input class="au-input au-input--full" type="password" name="cpass" placeholder="Confirm Password">
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">submit</button>

                              
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
