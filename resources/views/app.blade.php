<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Tomita Market</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,800" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('tomita/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('tomita/fonts/elegantIcon/elegantIcon.css') }}">
        <link rel="stylesheet" href="{{ asset('tomita/fonts/Linearicons-Free/Linearicons-Free.css') }}">
        <link rel="stylesheet" href="{{ asset('tomita/css/fancybox.css') }}">
        <link rel="stylesheet" href="{{ asset('tomita/css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('tomita/css/main.css') }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app"></div>
        <script>
            const BASE_URL = '{{ URL::to('/') }}'
        </script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('tomita/js/jquery.js') }}" defer></script>
        <script src="{{ asset('tomita/js/fancybox.js') }}" defer></script>
        <script src="{{ asset('tomita/js/bootstrap.min.js') }}" defer></script>
        <!-- Subiz --> <script> (function(s, u, b, i, z){ u[i]=u[i]||function(){ u[i].t=+new Date(); (u[i].q=u[i].q||[]).push(arguments); }; z=s.createElement('script'); var zz=s.getElementsByTagName('script')[0]; z.async=1; z.src=b; z.id='subiz-script'; zz.parentNode.insertBefore(z,zz); })(document, window, 'https://widgetv4.subiz.com/static/js/app.js', 'subiz'); subiz('setAccount', 'acqrawjmjysrltqjdorx'); </script> <!-- End Subiz -->
    </body>
</html>
