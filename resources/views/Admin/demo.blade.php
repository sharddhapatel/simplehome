<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Change Password</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
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
                            <form action="" method="post">

                                 {{ csrf_field() }}
                               
                                <div class="form-group">
                                     <input type="hidden" id="id"  name="id" >
                                  <input type="hidden" id="token"  name="token" >
                                    <label>New Password</label>
                                    <input type="password" name="npass" id="password" class="form-control" placeholder="New Password">
                                </div>
                                  <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="cpass" id="password" class="form-control" placeholder="Confirm Password">
                                </div>
                                
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Login</button>
                                
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->












@extends('Admin.admincontent')
@section('title')
Change-Password
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
                            <form role="form" action="{{url('adminreset')}}" method="post">
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

    <!-- Jquery JS-->
    

</body>

</html>
@stop
<!-- end document-->


#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top:80px;
  right: 340px;
  color: #fffbfb;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }







    // $data=DB::table('user')->where('id',$request->id)->first();
    // if($request->status == 1)
    // {
    //    DB::table('user')->where('id',$data->id)->update(["status"=>"0"]);
    //   return redirect()->back();
    // }
    // else if($request->status == 0)
    // {
    //   DB::table('user')->where('id',$data->id)->update(["status"=>"1"]);
    //   return redirect()->back();
    // }

    // echo "<pre>";
    // print_r($data);
    // die();



  
<!-- 
     $data=DB::table('user')->where('id',$id)->first();
     if($data->status =='Active')
     {
       DB::table('user')->where('id',$data->id)->update(["status"=>"Blocked"]);
       return redirect()->back();
     }
    else if($data->status =='Blocked')
     {
       DB::table('user')->where('id',$data->id)->update(["status"=>"Active"]);
       return redirect()->back();
    } -->