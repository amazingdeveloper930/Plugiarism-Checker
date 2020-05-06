@extends('frontend.layouts.default')
@section('title', 'Plagiarism Detection Services')
@section('description', "Plagiarism Detection Services")
@section('content')

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
            <h1 class="text-white font-weight-light text-uppercase font-weight-bold">Our Services</h1>
            <p class="breadcrumb-custom"><a href="{{ route('home')}}">The checker</a> <span class="mx-2">&gt;</span> <span>Services</span></p>
          </div>
        </div>
      </div>
    </div> 
     <div class="site-section bg-light">
      <div class="container">
        @include('frontend.services.servicelist')
      </div>
    </div>

    @include('frontend.layouts.testimonials')
    
@stop