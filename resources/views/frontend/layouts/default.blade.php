<!doctype html>
<html class="no-js" lang="{{ config('app.locale') }}">
<head>
	<!-- <title>Plagiarism checker. Check for plagiarism - best performance</title> !-->
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!--<meta name="description" content="Plagiarism checker. For students and universities. Check paper for plagiarism. Scan your documents PLAGIARISM | ANTIPLAGIARISM SOFTWARE - Best performance"/>!-->
	<meta name="description" content="@yield('description')"/>
	<meta name="google-site-verification" content="EmmNFIW0I2HB_Eu_cARZVvOUHwUUM513JsvHB5xFGkQ" />
	<link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.png') }}" alt = "logo">

	<link rel="canonical" href="{{ route('pages.calc_universities') }}">
	<link rel="canonical" href="{{ route('home') }}">
	<link rel="canonical" href="{{ route('pages.plagiarism_detector') }}">
	<link rel="canonical" href="{{ route('pages.plagiarism_example') }}">
	<link rel="canonical" href="{{ route('pages.similarity_checker') }}">
	<link rel="canonical" href="{{ route('service') }}">
	<link rel="canonical" href="{{ route('pages.google_checker') }}">

	
	<script src="{{ asset('js/frontend/jquery-3.3.1.min.js') }}"></script>
 	<script  src="{{ asset('js/backend/plugins/combine_1.min.js') }}"></script>
</head> 
<body>
    
    
    
	@include('frontend.layouts.navigation')
    @yield('content')
    @include('frontend.layouts.footer')  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/frontend/fonts/icomoon/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/frontend/vendor/combined-v.css') }}">
	<link rel="stylesheet" href="{{ asset('css/frontend/fonts/flaticon/font/flaticon.css') }}">
	
	<link rel="stylesheet" href="{{ asset('css/frontend/combined.css') }}">
	<script defer src="{{ asset('js/frontend/combine_2.min.js') }}"></script>
</body>
<style type="text/css">
  .fa:before{font-style:normal;font-weight:400;font-variant:normal;text-transform:none;line-height:1;-webkit-font-smoothing:antialiased}.testimonial figure img{max-width:180px!important;margin:0 auto;border-radius:0!important;border-style:solid;border-width:10px;border-color:#eee}.dashboard-icon{font-size:30px;color:#fff}#sample-check{margin:30px 0}
</style>
<script type="text/javascript">
	function textCounter(e,t,n){var u=document.getElementById(t);if(e.value.length>n)return e.value=e.value.substring(0,n),!1;u.innerText=n-e.value.length+" characters left"}
</script>
<script type="application/ld+json">
{"@context":"http://schema.org/","@type":"Product","brand":{"@type":"Thing","name":""},"name":"","image":"","description":"","productId":"upc:","offers":{"@type":"AggregateOffer","priceCurrency":"","lowPrice":"0.00","itemCondition":"new"}}
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-107521779-4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-107521779-4');
</script>

</html>