<!doctype html>
<html>
    <head>
        @include('includes.head')
    </head>
    <body>
        @include('includes.nav')

        @if (Auth::check())
            <div id="sidebar" class="col-md-2">
                @include('includes.sidebar')
            </div>
        @endif
        
        <div class="container">

            <div id="main" class="row">
                <div id="content" class="col-md-12">
                    @yield('content')
                </div>
            </div>

        </div>
    </body>
</html>