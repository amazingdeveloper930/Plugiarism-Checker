<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{ asset('images/logo.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>@yield('title')</title>
  <meta name="description" content="@yield('description')"/>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <meta name="google-site-verification" content="EmmNFIW0I2HB_Eu_cARZVvOUHwUUM513JsvHB5xFGkQ" />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="{{ asset('css/backend/material-dashboard.css?v=2.1.1') }}" rel="stylesheet" />
  <link href="{{ asset('css/backend/demo/demo.css') }}" rel="stylesheet" />


</head>
<script src="{{ asset('js/backend/core/jquery.min.js') }}"></script>
<script src="{{ asset('js/backend/plugins/combine_1.min.js') }}"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-107521779-4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-107521779-4');
</script>
<style>
  h1{
    font-size: 1.125rem;
    font-weight: 300;
  }
</style>

<body class="sidebar-mini">
  <div class="wrapper ">
    @include('backend.user.layouts.sidebar')
    <div class="main-panel">
      @include('backend.user.layouts.navbar')
      <div class="content">
        <div class="container-fluid">
          @yield('content')
        </div>
      </div>
      @include('backend.user.layouts.footer')
    </div>
  </div>
  @include('backend.user.layouts.fixed_plugin')
  @include('backend.script')
</body>

</html>
