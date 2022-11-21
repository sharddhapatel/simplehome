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

                        <p style="font-size:24px"><strong>Posted Item</strong></p>
                        <br>
                        Alphabetic Search:

                        <?php
                        $alphas = range('A', 'Z');
                        echo '<ul class="pagination" role="navigation">'; ?>
                        <a href="{{ url('showads') }}"
                            style="position: relative; display: block; padding: .5rem .75rem;margin-left: -10px;  line-height: 1.25;"><?php echo '<u> All Records </u>'; ?></a>
                        <?php foreach ($alphas as $key) {?>
                        <a href="{{ url('showads') }}?char=<?php echo $key; ?>"
                            style="position: relative; display: block; padding: .5rem .75rem;margin-left: -10px;  line-height: 1.25;"><?php echo $key; ?></a>
                        <?php }
		                     echo '</ul>';?>

                        <form class="form-horizontal" action="" method="get">
                            {{ csrf_field() }}
                            <div class="flex relative justify-center items-center h-20 w-full mx-auto rounded">
                                <p>Price Range:</p>
                                &nbsp;
                                <div class="range-slider">
                                    <div class="progress"></div>
                                    <span class="range-min-wrapper">
                                        <input class="range-min" type="range" name="start" id="start"
                                            value="{{ $start }}" min="1" max="5000" onchange="form.submit()">
                                    </span>
                                    <span class="range-max-wrapper">
                                        <input class="range-max" type="range" name="end" id="end"
                                            value="{{ $end }}" min="1" max="5000" onchange="form.submit()">
                                    </span>
                                </div>

                                {{-- &nbsp;
                                <div class="max-value numberVal">
                                    <input type="number" class="col col-1" id="selectend" onchange="myChangeFunctions(this)">
                                </div> --}}

                                {{-- <div class="form-group col-lg-3 col-md-12 no-padding">
                                    <button class="btn btn-default pull-right btn-block-md" type="submit">
                                    </button>
                                </div> --}}
                            </div>
                        </form>
                        <br>
                        <form class="form-horizontal" action="" method="get">
                            {{ csrf_field() }}
                            <div style="float: left;">
                                <b><label>Search:</label></b> &nbsp;
                                <input type="text" name="search" id="search" value="{{ $search }}"
                                    onkeyup="myFunction()" placeholder="Search Item">
                            </div>

                            {{-- <div class="range">
                            <input type="range" class="form-range" id="customRange1" name="pricerange" value="{{$pricerange}}"/>
                        </div> --}}

                            <div style="float: right;">
                                Status: <select id="mylist" onchange="mystatus()">
                                    <option selected disabled>select status</option>
                                    <option value="Pendding">Pendding</option>
                                    <option value="Active">Active</option>
                                    <option value="Blocked">Blocked</option>
                                    <option value="Decline">Decline</option>
                                </select>

                                &nbsp;&nbsp;
                                Showing <select id="pagination">
                                    <option value="5" @if ($items == 5) selected @endif>5</option>
                                    <option value="10" @if ($items == 10) selected @endif>10</option>
                                    <option value="15" @if ($items == 15) selected @endif>15</option>
                                    <option value="20" @if ($items == 20) selected @endif>20</option>
                                </select>Records
                            </div>

                        </form>
                        <br><br>

                        <div class="section__content section__content--p30">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if (Session::has('message'))
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
                                        <div class="table-responsive m-b-40" id="updateDiv">
                                            <table class="table table-borderless table-data3" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th><strong>ItemId</strong></th>
                                                        <th><strong>Item Name</strong></th>
                                                        <th><strong>Price</strong></th>
                                                        <th><strong>Description</strong></th>
                                                        <th><strong>Image</strong></th>
                                                        <th><strong>Status</strong></th>
                                                        <th><strong>Action</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @forelse ($data as $user)
                                                        <tr class="tr-shadow">
                                                            <td>{{ $user->id }}</td>
                                                            <td>{{ $user->item_name }}</td>
                                                            <td>{{ $user->price }}</td>
                                                            <td>{{ $user->des }}</td>
                                                            <td>
                                                                @if ($user->item_img != '')
                                                                    @php $a = explode(",",$user->item_img); @endphp

                                                                    <!-- <a href="{{ url('public/item_img') }}/{{ $a[0] }}" target="_blank"> -->
                                                                    <!-- <a href="{{ url('showadminitemdetail') }}/{{ $user->id }}"> 	 -->
                                                                    <a
                                                                        href="{{ url('adminitemdetail') }}/{{ $user->id }}">
                                                                        <img class="thumbnail no-margin" data-toggle="modal"
                                                                            data-target="#myModal{!! $user->id !!}"
                                                                            src="{{ url('public/item_img') }}/{{ $a[0] }}"
                                                                            alt="img" height="40px" width="40px">

                                                                        <!-- <div id="myModal{!! $user->id !!}" class="modal">
                                <img class="modal-content" src="{{ url('public/item_img') }}/{{ $a[0] }}" height="30px" width="30px">

                                <span class="close" data-dismiss="modal">&times;</span> -->
                                                                        <!--  <center> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></center> -->
                                                                        <!-- <div id="caption"></div> -->


                                        </div>
                                    @else
                                        <p>Noimage</p>
                                        @endif
                                        </td>
                                        <td>
                                            @if ($user->status == 'Pendding')
                                                <p style="color:orange">Pendding</p>
                                            @endif

                                            @if ($user->status == 'Active')
                                                <p style="color:green">Active</p>
                                            @endif

                                            @if ($user->status == 'Decline')
                                                <p style="color:red">Decline</p>
                                            @endif

                                            @if ($user->status == 'Blocked')
                                                <p style="color:red">Blocked</p>
                                            @endif
                                        </td>
                                        <td colspan="2">
                                            @if ($user->status == 'Pendding')
                                                <a href='changestatusads/{{ $user->id }}'><button type="submit"
                                                        id="approve" name="approve" class="btn btn-outline-success btn-sm"
                                                        value="active">Approve</button></a>


                                                <a href='changestatusadsdec/{{ $user->id }}'><button type="submit"
                                                        id="decline" name="decline" class="btn btn-outline-danger btn-sm"
                                                        value="decline">Decline</button></a>
                                            @elseif($user->status == 'Decline')

                                            @elseif($user->status == 'Active')
                                                <a href='changestatusads/{{ $user->id }}'><button type="submit"
                                                        id="blocked" name="blocked" class="btn btn-outline-danger btn-sm"
                                                        value="blocked">Blocked</button></a>
                                            @elseif($user->status == 'Blocked')
                                                <a href='changestatusads/{{ $user->id }}'><button type="submit"
                                                        id="active" name="active" class="btn btn-outline-success btn-sm"
                                                        value="active">Active</button></a>
                                            @endif
                                        </td>
                                        </tr>
                                    @empty
                                        <td colspan="10" style="color: red;">
                                            <center><b style="font-size: 20px;">Result Not Found...</b></center>
                                        </td>
                                        @endforelse

                                        <!-- <tr id="noRecordTR" style="display: none;">
                                          <td colspan="10" style="color: red;"><center><b style="font-size: 20px;">No Record Found</b></center></td></tr> -->
                                        </tbody>
                                        <!--  @if (count($data) <= 0)
    <td colspan="10" style="color: red;"><center><b style="font-size: 20px;">Result Not Found</b></center></td>
    @endif -->


                                        </table>
                                    </div>
                                    <div class="pagination-bar text-center" style="float: right;">
                                        <nav aria-label="Page navigation " class="d-inline-b">
                                            <ul class="pagination">
                                                <li class="page-item">
                                                    {{ $data->appends(\Request::except('_token'))->render() }}
                                                    <!-- {{ $data->appends(compact('items'))->links() }} -->
                                                </li>
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

    <script type="text/javascript">
        function myChangeFunction(input1) {
            var input2, filter, table, tr, td, i;
            var input2 = document.getElementById('selectstart');
            input2.value = input1.value;

            var input3 = document.getElementById('start');
            input3.value = input2.value;
        }

        function myChangeFunctions(input4) {
            var input5, filter, table, tr, td, i;
            var input5 = document.getElementById('selectend');
            input5.value = input4.value;

            var input6 = document.getElementById('end');
            input6.value = input5.value;

        }
    </script>

    <script type="text/javascript">
        document.getElementById('pagination').onchange = function() {
            window.location = "{{ $data->url(1) }}&items=" + this.value;
        };

        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                tr[i].style.display = "none";

                for (j = 0; j < td.length; j++) {
                    if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    }
                }
            }
        }

        function mystatus() {

            var input, filter, table, tr, td, i;
            input = document.getElementById("mylist");
            filter = input.value.toUpperCase();

            console.log(filter);
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[5];
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        // document.getElementById('noRecordTR').style.display = "none";
                    } else {
                        tr[i].style.display = "none";
                        // document.getElementById('noRecordTR').style.display = "";
                    }
                }
                // if (document.getElementById("mylist").selected)     
                // {
                // 	document.getElementById('noRecordTR').style.display = "";
                // }
                // else
                // {
                // 	document.getElementById('noRecordTR').style.display = "none";
                // }
            }
        }

        //  		for(j=0;j<tr[i].getElementsByTagName("td").length;j++) // new loop
        //       	{
        //        	  td = tr[i].getElementsByTagName("td")[j];
        //             // console.log(td[j]);
        //             if (td) { 
        //               txtValue = td.textContent || td.innerText;
        //                console.log(txtValue);
        //               if (txtValue.toUpperCase().indexOf(filter) > -1) {
        //                  tr[i].style.display = "";
        //               } else {
        //                  tr[i].style.display = "none";
        //                 }
        //            }
        //       	}

        // var modal = document.getElementById("myModal");
        // var img = document.getElementById("myImg");
        // var modalImg = document.getElementById("img01");
        //  var captionText = document.getElementById("caption");

        // img.onclick = function(){
        //   modal.style.display = "block";
        //   modalImg.src = this.src;
        //   captionText.innerHTML = this.alt;
        // }
        // var span = document.getElementsByClassName("close")[0];
        // span.onclick = function() { 
        //   modal.style.display = "none";
        // }
    </script>
@endsection
