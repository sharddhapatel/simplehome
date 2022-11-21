@extends('header')
@section('title')
Notification
@endsection
@section('content') 

<head>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js" ></script>


<style type="text/css">
.p-3 {
    padding: 1rem !important;
}
.align-items-center {
    -ms-flex-align: center !important;
    align-items: center !important;
}
.alert-dismissible {
    padding-right: 4rem;
}
.alert {
    position: relative;
    padding: 0.75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: 0.25rem;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    
    border-color: #c3e6cb;
}
.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}

.alert-dismissible .close {
    position: absolute;
    top: 0;
    right: 0;
    padding: 0.75rem 1.25rem;

    color: inherit;
}

.close:hover, .close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

.close {
    float: right;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: .5;
    transition: 0.3s;
}
</style>	

</head>
<section>
<div class="container">
  <div class="row justify-content-md-center">
   <div class="col-lg-10">
    <div class="box">
   <div class="heading"><h1>Notifications</h1></div>
   <div class="p-3">
	 <div class="notifications-list">
	 	  <form action="" method="get"> 
	 	  	@foreach ($data as $user)
		<div class="alert alert-dismissible align-items-center">
		 	
		 	@if($user->read_status == '0')
		 		@if($user->status == 'Active')

			 	 <strong><div class="alert alert-success alert-dismissible">{{ $user->notification }} <a href="{{ url('itemdetail') }}/{{$user->item_id}}"><u> View Product</u></a><button type="button" class="close" data-dismiss="alert">&times;</button></div></strong>
			 	 @endif
			 	 @if($user->status == 'Decline')
			 	 
			 	 <strong><div class="alert alert-danger alert-dismissible">{{ $user->notification }} <a href="{{ url('itemdetail') }}/{{$user->item_id}}"><u> View Product</u></a><button type="button" class="close" data-dismiss="alert">&times;</button></div></strong>

			 	 @endif
			 @else
		 
			 	@if($user->status == 'Active')
			 	 <div class="alert alert-success alert-dismissible">{{ $user->notification }} <a href="{{ url('itemdetail') }}/{{$user->item_id}}"> <u> View Product </u></a><button type="button" class="close" data-dismiss="alert">&times;</button></div>
			 	 @endif
			 	 @if($user->status == 'Decline')
			 	
			 	 <div class="alert alert-danger alert-dismissible">{{ $user->notification }} <a href="{{ url('itemdetail') }}/{{$user->item_id}}"> <u> View Product </u></a><button type="button" class="close" data-dismiss="alert">&times;</button></div>
                 
			 	 @endif
			@endif

		</div>
			@endforeach
		</form>

	 </div>
	</div>
   </div>	
</div>
  </div>
 </div>

 </section>
 @endsection