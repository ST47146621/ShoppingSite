<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!--bootstrap樣式-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Tools/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Tools/bootstrap/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>    
    <script src="Tools/bootstrap/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css" />
    <!--icon樣式-->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--驗證-->
    <link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
    <!--css樣式-->
    <script src="Tools/main/js/main.js"></script>
    <link rel="stylesheet" type="text/css" href="Tools/main/css/main.css">
    <!--主文件-->
    @yield('tool')
    
    
</head>
<body>
    <div class="wrap">

        <!-- Header -->
        @include('header')

        <!-- Sidebar-->
        @yield('sidebar')


        <!-- Content Wrapper. Contains page content -->
       
            <!-- Content Header (Page header) -->
           

            <!-- Main content -->
            <section class="container content">
                <!-- Your Page Content Here -->
                @yield('content')
            </section><!-- /.content -->
        
        <!-- Footer -->
    </div><!-- ./wrapper -->
     @include('footer')

     @yield('shopcart')

     <!-- 右側NAV(手機板) -->
    <nav id="sideNav"></nav>
</body>
</html>