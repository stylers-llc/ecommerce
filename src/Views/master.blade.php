<html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" type="text/css" href="/plugins/ecommerce/node_modules/bootstrap/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/plugins/ecommerce/node_modules/bootstrap/dist/css/bootstrap-theme.min.css" />
        <script type="text/javascript" src="/plugins/ecommerce/node_modules/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="/plugins/ecommerce/jquery.redirect.js"></script>
        <script type="text/javascript" src="/plugins/ecommerce/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div id="alert-container"></div>
            @yield('content')
        </div>
        @yield('script')
    </body>
</html>