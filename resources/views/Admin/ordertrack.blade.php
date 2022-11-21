@extends('Admin.admincontent')
@section('title')
Show User
@endsection
@section('body')
<html>
<style type="text/css">
 a {
    display: inline-block;
    padding-left:15px;
}
 </style>
<body class="animsition">
<div class="page-wrapper">
<div class="page-container">
<div class="main-content">
	<div class="section__content section__content--p30">
	  <p  style="font-size:24px"><strong>Order Table</strong></p>
	  <br><br>
	  <form class="form-horizontal"  action ="" method="get">
	  	 {{ csrf_field() }}
    	<div  style="float: left;">

    		<b><label>Search:</label></b> &nbsp;
       <input type="text"  name="search" id="search" value="{{$search}}" placeholder="Search Order">
	</div>

	</form>
	<br><br>
	
        <div class="container-fluid">
			<div class="row">
			  <div class="col-md-12">
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
				<div class="table-responsive m-b-40">
                    <table class="table table-borderless table-data3" id="myTable">
				        <thead>
				            <tr>
				     		 	<th><strong>OrderId</strong></th>
				                <th><strong>Customer Name</strong></th>
				           		<th><strong>Address</strong></th>
				           		<th><strong>Payment Method</strong></th>
				                <th><strong>Payment Status</strong></th>
				                <th><strong>Total</strong></th>
				                <th><strong>Order Status</strong></th>
				                <th><strong>Action</strong></th>
				            </tr>
				        </thead>
				        <tbody>
				        	@foreach ($order as $data)
				            <tr class="tr-shadow">
				                
				                <td>{{$data->id}}</td>
				                <td>{{$data->fname}} {{$data->lname}}</td>
				                <td>{{$data->address}}</td>
				                <td>{{$data->payment_method}}</td>
				                <td>
				                 @if($data->payment_status=="succeeded")
			                     <p style="color:green" >{{$data->payment_status}}</p>
			                     @elseif($data->payment_status=="refund")
			                     <p style="color:red" >{{$data->payment_status}}</p>
			                     @endif
			                	 </td>

				             
				                <td>Rs.{{$data->total_price}}</td>
		                      	
		                      	<td>

		                      	 @if($data->status=='Pendding')
			                      <a href ='changestatus/{{ $data->id }}'><button type="submit"  id="approve" name="approve" class="badge badge-pill badge-warning" value="active">Pendding</button></a>

			                       @elseif($data->status=='Conform')
			                      <a href ='changestatus/{{ $data->id }}'><button type="submit"  id="approve" name="approve" class="badge badge-pill badge-success" value="active">Conform</button></a>

			                       @elseif($data->status=='InProcess')
			                      <a href ='changestatus/{{ $data->id }}'><button type="submit"  id="approve" name="approve" class="badge badge-pill badge-secondary" value="active">In Process</button></a>

			                       @elseif($data->status=='Ready To Deliver')
			                      <a href ='changestatus/{{ $data->id }}'><button type="submit"  id="approve" name="approve" class="badge badge-pill badge-secondary" value="active">Ready To Deliver</button></a>

			                        @elseif($data->status=='Delivered')
			                      <a href ='changestatus/{{ $data->id }}'><button type="submit"  id="approve" name="approve" class="badge badge-success" value="active">Delivered</button></a>

			                       @elseif($data->status=='OrderCancel')
			                      <button type="submit"  id="approve" name="approve" class="badge badge-pill badge-danger" value="active">OrderCancel</button></a>

			                      	@endif
			                     </td>
		                     <td>
		                      	 <a href ='showorder/{{ $data->id }}'><button type="submit"  id="active" name="active" class="btn btn-outline-primary" value="Active" >View Detail</button></a>

		                      	</td>
				            </tr>
				            @endforeach
				           
				        </tbody>
				    </table>
				    	<div class="pagination-bar text-center"  style="float: right;">
                    <nav aria-label="Page navigation " class="d-inline-b">
                        <ul class="pagination">
                            <li class="page-item">{{$order->appends(\Request::except('_token'))->render() }}</li>
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
@endsection



