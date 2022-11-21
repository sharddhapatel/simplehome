@extends('header')
 @section('title')
My Items
@endsection
@section('content') 

<style type="text/css">
 ul, menu, dir, li, ol {
    list-style-type: none;
    padding-left: 15;}

    
 </style>

<div class="hold-transition sidebar-mini layout-fixed">
<div class="main-container">
       <div class="container">
    
     <div class="col-md-15 page-content">
     <div class="inner-box">
     <header class="row tm-welcome-section">
    <h3 class="col-12 text-center tm-section-title">My Items</h3>
  </header>

        <div class="table-responsive">
        <div class="table-action">
        <div class="table-search pull-right col-sm-7">
        <form class="form-horizontal"  action = "" >
              <div class="row" style="float: right;">
                   {{ csrf_field() }}

                   <div class="searchpan">
                        <input type="text" class="form-control"  name="search" id="search" value="{{$search}}">

                    </div>&nbsp;&nbsp;
                    <button type="submit">Search</button>
                 </div>
                    </form>

                </div>
             </div>
        </div>
        <br>
        <br>
         <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo"
         data-filter="#filter" data-filter-text-only="true">

        <thead>

        <tr>
           <th> Photo</th>
            <th data-sort-ignore="true"> Items Details</th>
            <th data-type="numeric"> Price</th>
            <th> Option</th>
        </tr>
        </thead>
        
        <tbody>
          
          @foreach($data as $image)   
        <tr>
           
             @php $a = explode(",",$image->item_img); @endphp
            
            <td style="width:10%" class="add-img-td">

                    <li> @foreach($a as $b)
                <a href="{{ url('itemdetail') }}/{{ $image->id }}">
                   <!--  <a href="{{ url('public/item_img') }}/{{ $b }}" target="_blank"> -->
                    <img src="{{ url('public/item_img') }}/{{ $b }}" alt="image1" class="img-fluid tm-gallery-img" height="180px" width="180px" /></a>@endforeach</li>
                </td>
                    
            <td style="width:14%" class="add-img-td">
            <strong>{{$image->item_name}}</strong><br><br>
            
            <p class="tm-gallery-description">{{$image->des}}</p>           
            </td>

           <td style="width:10%" class="add-img-td"><strong>Rs.</strong>{{$image->price}}</td>
           
            <td style="width:8%" class="action-td">
                <div>
                    <a href ='updatemyitem/{{ $image->id }}'><button type="submit" class="btn btn-success btn-sm">Edit</button></a>
                   
                    <a href ='deleteitem/{{ $image->id }}'><button type="submit" class="btn btn-danger btn-sm">Delete</button></a>
                </div>
            </td>
             @endforeach
               @if(count($data)<=0)
            <td colspan="4" style="color: red;"><center><b style="font-size: 20px;">No More Items</b></center></td>
            @endif
        </tr>
        </tbody>   
    </table>
   <div class="pagination-bar text-center" style="float: right;">
        <nav aria-label="Page navigation " class="d-inline-b">
            <ul class="pagination" role="navigation">
                <li class="page-item active">{{$data->appends(\Request::except('_token'))->render() }}</li>
            </ul>
        </nav>
    </div>

      </div>
     </div>
        
    </div>      
 <br>
</div>
</div>
</div>
@stop

