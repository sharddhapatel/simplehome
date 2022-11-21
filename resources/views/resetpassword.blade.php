@extends('header')
@section('content')
    <div class="main-container">
        <div class="container">

            <header class="row tm-welcome-section">
                <h6 class="col-12 text-center tm-section-title"> Forgot-Password</h6>
            </header>
            <div class="tm-container-inner-2 tm-contact-section">

                <div class="row">
                    <div class="col-md-6">

                        @if (Session::has('message'))
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
                        <form role="form" action="{{ url('reset') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" id="id" name="id" value="{{ $list->id }}">
                            <input type="hidden" id="token" name="token" value="{!! @$list->remember_token !!}">

                            <div class="form-group">

                                <label for="sender-email" class="control-label">New Password:</label>

                                <div class="input-icon"><i class="icon-user fa"></i>
                                    <input id="sender-email" type="password" name="npass" placeholder="New Password"
                                        class="form-control email">
                                </div>
                            </div>
                            <br>

                            <div class="form-group">

                                <label for="sender-email" class="control-label">Confirm Password:</label>

                                <div class="input-icon"><i class="icon-user fa"></i>
                                    <input id="sender-email" type="password" name="cpass" placeholder="Confirm Password"
                                        class="form-control email">
                                </div>
                            </div>
                            <br>
                            <div class="form-group">

                                <center><button type="Submit" id="button1id" class="tm-btn tm-btn-success">Login</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
