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
    <title>Simple Home Admin @yield('title') </title>

    <!-- Fontfaces CSS-->
    <link href="{{ URL::asset('css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ URL::asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ URL::asset('vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ URL::asset('vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">


    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <!-- Main CSS-->
    <link href="{{ URL::asset('css/theme.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('css/price-range.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('css/jquery-ui.css') }}" rel="stylesheet" media="all">

    <link href="{{ URL::asset('css/jquery-ui.css') }}" rel="stylesheet" media="all">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script src="{{ URL::asset('js/script.js') }}" type="text/javascript"></script>
   
    {{-- <script>
        $(function() {
            $('#slider-range').slider({
                range: true,
                min: 0,
                max: 100,
                values: [15, 65],
                slide: function(event, ui) {
                    $("#amount_start").val(ui.values[0]);
                    $("#amount_end").val(ui.values[1]);


                    var start = $('#amount_start').val();
                    var end = $('#amount_end').val();
                    $.ajax({
                        type: 'get',
                        dataType: 'html',
                        url: '',
                        data: "start=" + start + "& end=" + end,

                        success: function(response) {
                            console.log(response);
                            $('#updateDiv').html(response);
                        }
                    });


                }
            });
        });
    </script> --}}


</head>

<body>

    @include('Admin.adminheader')

    <!--section-->
    @yield('body')
    <!--footer-->
    @include('Admin.adminfooter')



    <script src="{{ URL::asset('vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ URL::asset('vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ URL::asset('vendor/slick/slick.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/wow/wow.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ URL::asset('vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/select2/select2.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ URL::asset('js/main.js') }}"></script>

</body>

</html>
