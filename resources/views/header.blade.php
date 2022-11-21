<html>

<head>
  <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Simple House @yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" />
    
    <link href="{{ URL::asset('public/css/all.min.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('public/css/templatemo-style.css') }}" rel="stylesheet" />

<!-- <link href="{{ URL::asset('public/assets/bootstrap/css/bootstrap.css') }}" rel="stylesheet" /> -->


  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/>

      <!-- <link href="{{ URL::asset('css/theme.css')}}" rel="stylesheet" media="all"> -->
</head>
  
  <body>
  <nav class="navbar  fixed-top navbar-site navbar-light bg-light navbar-expand-md"
             role="navigation">
    <div class="container">
          <div class="placeholder">
              {{ Session::get("user_fname") }}{{ Session::get("user_lname") }}
      <div class="parallax-window" data-parallax="scroll" style="background-image:url('{{ URL::asset('img/home4.png') }}')" >
         <div style="text-align: center">
             <img src="{{ URL::asset('img/simple-house-logo.png')}}" alt="Logo" class="tm-site-logo" />
              
              <div class="tm-site-text-box">
                <h1 class="tm-site-title" style="color: white">Simple House</h1>
                <h6 class="tm-site-description" style="color: white">new restaurant template</h6>  
              </div>
            
            </div>

        <div class="tm-header">
          <div class="row tm-header-inner">
            <div class="col-md-6 col-12">

            </div>

            <nav class="col-md-6 col-12 tm-nav">
              <ul class="tm-nav-ul">
        

                <li class="tm-nav-li"><a href="{{ url('/') }}" class="tm-nav-link">Home</a></li>
                <?php $user_id=Session::get('user_id'); ?>
                 @if(Session::has('user_fname'))
                  <li class="tm-nav-li"><a href="{{url('logoutuser')}}" class="tm-nav-link"><i class="fa fa-sign-out-alt" ></i>LogOut</a></li>

                    <li class="tm-nav-li"><a href="{{url('additem')}}" class="tm-nav-link">Add Item</a></li>
                    <?php $myitem=App\Order::where('u_id',$user_id)->where('status','=','Active')->count();?>
                    @if($myitem>0)
                    <li class="tm-nav-li"><a href="{{url('myitem')}}" class="tm-nav-link">My Items<span
                                                    class="w3-badge w3-white">{{$myitem}}</span></a></li>
                    @endif 


                     <?php $declineitem=App\Order::where('u_id',$user_id)->where('status','=','Decline')->count();?>
                    @if($declineitem>0)
                    <li class="tm-nav-li"><a href="{{url('declineitem')}}" class="tm-nav-link"> Decline Items<span
                                                    class="w3-badge w3-white">{{$declineitem}}</span></a></li>
                    @endif
                    
                <?php $myorder=App\MyOrder::where('user_id',$user_id)->count();?>

                    @if($myorder>0)
                    <li class="tm-nav-li"><a href="{{url('myorder')}}" class="tm-nav-link">My Order<span
                                                    class="w3-badge w3-white">{{$myorder}}</span></a></li>
                    @endif

                    <?php $mynoti=App\Notificationtb::where('uid',$user_id)->where('read_status','=','0')->count(); ?>
                   
                   
                  <li class="tm-nav-li"><a href="{{url('notification')}}" class="tm-nav-link">notification <span
                                                    class="w3-badge w3-white">{{$mynoti}}</span></a></li>
              
                    
                @else
                  <li class="tm-nav-li"><a href="{{url('userlogin')}}" class="tm-nav-link"><i class="fas fa-sign-in-alt"></i>Login</a></li>
                @endif

                
              <!--   <li class="tm-nav-li"><a href="{{url('about')}}" class="tm-nav-link">About</a></li>
                <li class="tm-nav-li"><a href="{{url('contact')}}" class="tm-nav-link">Contact</a></li> -->

                <li class="fa fa-shopping-cart">
                  <a href="{{url('cart')}}" class="tm-nav-link">Add ToCart
                  @if(count((array) session('cart'.$user_id)) == 0)
                  <span class="w3-badge w3-xlarge w3-green"> </span>
                  @else
                  <span class="w3-badge w3-xlarge w3-green">{{ count((array) session('cart'.$user_id)) }}</span>
                  @endif
                  </a>
                  
                </li>
              </ul>
            </nav>  
        </div>
        </div>
      </div>
    </div>
  
  </div>
</body>
</nav>
    <div>
        @yield('content')
    </div>  
  
<footer class="main-footer">
  <div class="footer-content">
     <div class="container" style="background-color: #ccc">
        <div class="row">
  
     <div class=" col-xl-2 col-xl-2 col-md-2 col-6  ">
        <div class="footer-col">
            
           <ul class="list-unstyled footer-nav">
                <li><a href="{{ url('about') }}"><h4 class="title"><b>About us</b></h4></a></li>
            </ul>
        </div>
    </div>
    <div class=" col-xl-2 col-xl-2 col-md-2 col-6  ">
        <div class="footer-col">
            
             <ul class="list-unstyled footer-nav">
                <li><a href="{{ url('contact') }}"><h4 class="title"><b>Contact us</b></h4></a></li>
            </ul>
            
        </div>
    </div>
     <div class=" col-xl-2 col-xl-2 col-md-2 col-6  ">
        <div class="footer-col">
            
             <ul class="list-unstyled footer-nav">
                <li><a href="{{ url('/') }}"><h4 class="title"><b>All Items</b></h4></a></li>
            </ul>
            
        </div>
    </div>


     <div style="clear: both"></div>

                    <div class="col-xl-12" style="border-top: solid 1px var(--border-color);">
                        <div class="copy-info text-center"> 
                           <p>Copyright &copy; 2020 Simple Houses
            | Design: <a rel="nofollow" href="https://templatemo.com">TemplateMo</a></p>
                        </div>

                    </div>


 <!--  <div class="tm-footer text-center">
    <p>Copyright &copy; 2020 Simple Houses
            | Design: <a rel="nofollow" href="https://templatemo.com">TemplateMo</a></p>
       </div> -->
</div>
</div>
</div>

</footer>

</html>