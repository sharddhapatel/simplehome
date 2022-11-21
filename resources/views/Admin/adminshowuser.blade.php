@extends('Admin.admincontent')
@section('title')
Show User
@endsection
@section('body')


<html>
 
<body class="animsition">
<div class="page-wrapper">
<div class="page-container">
<div class="main-content">
	<div class="section__content section__content--p30">
<div class="container-fluid">
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

	  <p  style="font-size:24px"><strong>User Detail</strong></p>
	   <br><br>
	  <form class="form-horizontal"  action ="" method="get">
    	<div  style="float: left;">
        {{ csrf_field() }}
      <b><label>Search:</label></b> &nbsp;
       <input type="text"  name="search" id="search" value="{{$search}}" onkeyup="myFunction()" placeholder="Search User">
	</div>

	</form>
	<br><br>
        <div class="container-fluid">
			<div class="row">
			  <div class="col-md-12">
			 
				<!-- <div class="table-responsive table-responsive-data2">
				    <table class="table table-data2" id="myTable"> -->
				   <div class="table-responsive m-b-40">
                    <table class="table table-borderless table-data3" id="myTable">
				        <thead>
				            <tr>
					       		<th><strong>FirstName</strong></th>
				     		 	<th><strong>LastName</strong></th>
				                <th><strong>Email</strong></th>
				                <th><strong>Phone</strong></th>
				                <th><strong>Address</strong></th>
				                <th><strong>Status</strong></th>
				                <th><strong>Action</strong></th>
				               
				            </tr>
				        </thead>
				        <tbody>
				        	@foreach ($data as $user)
				               <tr class="tr-shadow">
				                <td>{{$user->fname}}</td>
				                <td>{{$user->lname}}</td>
				                <td>
				                   {{$user->email}}
				                </td>
				                  <td>
				                   {{$user->phone}}
				                </td>
				                
				                 @php $address = App\Address::where('uid',$user->id)->get() @endphp
				                <td> @foreach($address as $addresses)
	                                <li> {{$addresses->address}},{{$addresses->city}},{{$addresses->zipcode}}</li>
	                              @endforeach</td>
				                <td>
				                	<input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Blocked" {{ $user->status == 'Active' ? 'checked' : ''}}>
				                </td>

				                <td>
				                	<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#largeModal{!! $user->id !!}">
											View
										</button>
				                </td>
				                 <!--  @if($user->status=='Active')
				                    <a href ='userchangestatus'><button type="submit"  id="active" name="active" class="btn btn-outline-success" value="Active" >Active</button></a>
				                  @elseif($user->status=='Blocked')
				                      <a href ='userchangestatus'><button type="submit"  id="blocked" name="blocked" class="btn btn-outline-danger" value="Blocked">Blocked</button></a>
				                 
				                  @endif -->
				                   
						<div class="modal fade" id="largeModal{!! $user->id !!}" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h3 class="modal-title" id="largeModalLabel">View User Detail</h3>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p><b>Name:</b> {{$user->fname}} {{$user->lname}}</p><br>
									<p><b>Email:</b> {{$user->email}}</p><br>
									<p><b>Phone:</b> {{$user->phone}}</p><br>
									<p><b>Address:</b>
									 @php $address = App\Address::where('uid',$user->id)->get() @endphp
				                	 @foreach($address as $addresses)
	                               <li> {{$addresses->address}},{{$addresses->city}},{{$addresses->zipcode}}</li><br>
	                              @endforeach</p>
				               
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
									
								</div>
							</div>
						</div>
						</div>
				                  
				                
				            </tr>
				            @endforeach
				           
				        </tbody>
				          @if(count($data)<=0)
                   <td colspan="10" style="color: red;"><center><b style="font-size: 20px;">Result Not Found</b></center></td>
                    @endif
				    </table>

				</div>
					<div class="pagination-bar text-center"  style="float: right;">
                    <nav aria-label="Page navigation " class="d-inline-b">
                        <ul class="pagination">
                            <li class="page-item">{{$data->appends(\Request::except('_token'))->render() }}</li>
                        </ul>
                    </nav>
                </div>
			</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script type="text/javascript">
   $('.toggle-class').on('change',function() {
        var status = $(this).prop('checked') == true ? 'Active' : 'Blocked'; 
        // alert(status);
        var user_id = $(this).data('id'); 
      
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('changeStatus') }}',
            data: {'status': status, 'id':user_id},
            success: function(data){
              console.log(data.success)
            }
           
        });
    	
    });



  function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++)
  {
	td = tr[i].getElementsByTagName("td");
 	tr[i].style.display = "none";
 
 	for(j=0;j<td.length;j++)
 	{
		if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1)
		{
		 tr[i].style.display = "";
		}     
 	}
  }
 
}

 </script>


@endsection