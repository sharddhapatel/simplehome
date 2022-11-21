@extends('header')
@section('title')
HomeView Page
@endsection
@section('content')	

<div calss="main-container">
 <div class="container">
  
     <div class="row">  
	<header class="row tm-welcome-section">
		<h2 class="col-12 text-center tm-section-title">Welcome to Simple House</h2>
		<p class="col-12 text-center">Total 3 HTML pages are included in this template. Header image has a parallax effect. You can feel free to download, edit and use this TemplateMo layout for your commercial or non-commercial websites.</p>
	</header>
	</div>
	<div class="tm-paging-links">
		<nav>
			<ul>
				@foreach($category as $ct)
				<li class="tm-paging-item"><a href="javascript:void(0)" class="tm-paging-link"   data-id="{{$ct->id}}">{{$ct->c_name}}</a></li>
				@endforeach
			</ul>
		</nav>
	</div>

 	<!-- <form action="" method="get"> -->
 		<div class="col-md-12">
		<div class="tab-filter" style="float: right;" >
		    <select id="myddl" onchange='Sorting()' name="myddl" title="sort by" class="selectpicker semyddllect-sort-by" data-style="btn-select" 
		        data-width="auto">
		      <option  value="1"> Price Low to High
		        </option>
		        <option value="2"> Price High to Low
		        </option>
		        <p>detail</p>
		    </select>

		</div> 
	</div>
	<!-- </form> -->
	<br>
	<br>
	<div class="row tm-gallery">
		
		<div id="tm-gallery-page"  class="tm-gallery-page">
		</div> 
		
		<!-- preview image code -->
		<!-- <div class="show">
			  <div class="overlay"></div>
			  <div class="img-show">
			 <span class="close">&times;</span>
			    <img src="">
			  </div>
		</div> -->
	</div>
</div>
</div>

<script src="{{ URL::asset('public/js/jquery.min.js') }}"></script>
<!-- <script src="{{ URL::asset('public/js/parallax.min.js')}}"></script>-->
<script src="{{ URL::asset('public/js/jquery.image-popup.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>


var cid=1;
var sort='';
function Sorting() {
   var sorting = document.getElementById('myddl').value;
    if(sorting == 1)
    {
       sort="asc";
    }
    if(sorting == 2)
    {
      sort="desc";
    }
    $.ajax({
		headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
		url: "{{ url('getData') }}", 
		type: 'post',
		data: { id: cid,sort :sort},
		}).done(function(response) { 
			   // alert(response);
		if(response!="")
		{
	   		$("#tm-gallery-page").html(response);	
		}
	    else if(response=="")
	    {
			$("#tm-gallery-page").html('<p style="color: red; margin: auto; font-size: 20px">No More Items</p>');
		}       
	});
}


$(document).ready(function($){
	$('.tm-paging-link').click(function(e){
		e.preventDefault();
		// var cid=$(this).attr("data-id");

		// var page = $(this).text().toLowerCase();

		$('.tm-gallery-page').addClass('hidden');
		$('#tm-gallery-page').removeClass('hidden');
		$('.tm-paging-link').removeClass('active');
		$(this).addClass("active");
	});
});
// Fetch all records

$(document).ready(function(){
	 fetchRecords(1);
	$('.tm-paging-link').click(function(e){
	 cid=$(this).attr("data-id");
		  // alert(cid);
	fetchRecords(cid);
	});

});
function fetchRecords(id)
{ 
	$.ajax({
		headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
		url: "{{ url('getData') }}", 
		type: 'post',
		data: { id: id},
		}).done(function(response) { 
			   // alert(response);
		if(response!="")
		{
	    	$("#tm-gallery-page").html(response);
		}
	    else
	    {
			$("#tm-gallery-page").html('<p style="color: red; margin: auto; font-size: 20px">No More Items</p>');
		}
              
	});
}
// $(function () {
   
    
//     $(".popup img").click(function () {
//         var $src = $(this).attr("src");
//         $(".show").fadeIn();
//         $(".img-show img").attr("src", $src);
//     });
    
//     $("span, .overlay").click(function () {
//         $(".show").fadeOut();
//     });


// });

</script>
@stop



