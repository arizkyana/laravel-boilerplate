<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? config('app.name', 'Laravel') . " | " . $title : config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{--<script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>--}}
</head>

{{--<body class="mini-navbar">--}}
<body class="top-navigation skin-1">

<div id="wrapper">

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom white-bg">
            <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse"
                            class="navbar-toggle collapsed" type="button">
                        <i class="fa fa-reorder"></i>
                    </button>


                </div>
                <ul class="nav navbar-top-links navbar-right" style="">
                    @guest

                        <li>
                            <a href="{{ route('login') }}" class="active">
                                Login
                            </a>
                        </li>
                        @else
                            <li>
                                <a href="{{ route('dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li>

                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            @endguest

                </ul>

            </nav>
        </div>


        <div class="wrapper wrapper-content">

            @yield('content')

        </div>
        <div class="footer">

            <div>
                <strong>Copyright</strong> {{ config('app.name', 'Laravel') }} &copy; {{ date('Y') }}
            </div>
        </div>

    </div>
</div>


{{--plugins--}}
<script src="{{ mix('js/themes/plugins/switchery/switchery.js') }}"></script>
{{--/plugins--}}

<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/bundle.js')  }}"></script>

{{--gmaps required--}}
@if (isset($gmaps) && $gmaps)
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACK1BU_M2kIo8xohz0dx5RjNOqDwwUKSE&callback=init"
            async
            defer></script>
    <script>

        function init() {
            const latitude = Number(-6.2383);
            const longitude = Number(106.9756);

            var _map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: latitude, lng: longitude},
                zoom: 12
            });


            window.dashboard.loadmap(_map);
            window.gmap = _map;


        }
    </script>
@endif

<script type="text/javascript">

    var base_url =
            {!! json_encode(url('/')) !!}
            {{--var asset_url = {{!! json_encode(asset('')) !!}};--}}

    var logError = (e) => {
            console.log(e);
            swal({
                type: 'error',
                title: e.status,
                text: e.statusText
            })
        };


</script>

@if (isset($js))
    <script src="{{ asset('js/' . $js) }}"></script>
@endif
</body>
</html>
