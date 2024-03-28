<!DOCTYPE html>
<html lang="en">
@include('layout.header')

<body class="bg-theme bg-theme1">

    
    <div id="wrapper">
        @include('layout.aside')
        @include('layout.navbar')
        <div class="clearfix"></div>

        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('layout.footer')
</body>

</html>
