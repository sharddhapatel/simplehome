@extends('header')
 @section('title')
Item Detail
@endsection
@section('content') 

<!-- <style type="text/css">
a {
color: #007bff;
text-decoration: none;
background-color: transparent;
-webkit-text-decoration-skip: objects;
}
</style> -->

<div class="main-container">
        <div class="container">
            <br>
            <div>
             &nbsp;<a href="{{ url('/') }}"> <i
            class="fa fa-angle-double-left"></i>Home</a>

                    
                </div>
            <div class="row">
                <div class="col-md-9 page-content col-thin-right">
                    <div class="inner inner-box ads-details-wrapper">
                          @foreach($data as $image) 
                        <h3><strong>{{$image->item_name}}</strong></h3>
                        <div class="item-slider">
                            <h3 class="pricetag"> Rs.{{$image->price}}</h3>
                            <ul class="bxslider" >
                                
                                @php $a = explode(",",$image->item_img); @endphp
                                <li> @foreach($a as $b)
                            <img class="myImages" id="myImg" src="{{ url('public/item_img') }}/{{ $b }}" alt="" height='380' width='330'/> @endforeach</li> 

                                
                            </ul>

                        </div>
                     <div class="Ads-Details">
                            <h5 class="list-title"><strong>Ads Details</strong></h5>

                            <div class="row">
                                <div class="ads-details-info col-md-8">
                                   <h5>{{$image->des}}</h5>
                                 </div>
                                 <div class="col-md-4">
                                    <aside class="panel panel-body panel-details">
                                        <ul>
                                            <li>
                                                <p class=" no-margin "><strong>Price:</strong>Rs.{{$image->price}}</p>
                                            </li>
                                            <li>
                                                <p class="no-margin"><strong>Title:</strong> {{$image->item_name}}</p>
                                            </li>
                                            <li>
                                                <p class="no-margin"><strong>Location:</strong>{{$image->city}} </p>
                                            </li>
                                            
                                           
                                        </ul>
                                    </aside>
                                      
                                </div>
                            </div>
                          
                        </div>
                        @endforeach
                    </div>
                   
                </div>
                <div class="col-md-3 page-sidebar-right">
                    <aside>
                         @foreach($data as $image1) 
                        <div class="card card-user-info sidebar-card">
                            <div class="block-cell user">
                                 <div class="cell-media"> <img class="thumbnail no-margin" src="{{ URL::asset('public/item_img/user.jpg')}}" alt="img" height="60px" width="60px"></div>
                                <div class="cell-content">
                                    <h5 class="title">Posted by</h5>
                                     <span class="name">{{$image1->fname}}  {{$image1->lname}} </span>
                                     </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body text-left">
                                    <div class="grid-col">
                                        <div class="col from">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>Location</span>
                                        </div>
                                        <div class="col to">
                                            <span> {{$image1->city}} </span>
                                        </div>
                                    </div>

                                    <div class="grid-col">
                                        <div class="col from">
                                            <i class="far fa-calendar-alt"></i>
                                            <span>Posted</span>
                                        </div>
                                        <div class="col to">
                                            <span>{{ date('d-M-y', strtotime($image1->created_at)) }}
                                            </span>
                                        </div>
                                    </div>
                                        
                                </div>

                                <div class="ev-action">
                                    <a class="btn  btn-warning btn-block">
                                        (+91) {{$image1->phone}} </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        </aside>
                </div>
              </div>
        </div>
    </div>
<!-- <div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



<!-- <script type ="text/javascript">

var modal = document.getElementById('myModal');
var images = document.getElementsByClassName('myImages');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
for (var i = 0; i < images.length; i++) {
  var img = images[i];
  img.onclick = function(evt) {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }
}

var span = document.getElementsByClassName("close")[0];
span.onclick = function() {
  modal.style.display = "none";
}
</script>
 -->@endsection