@extends('frontend.layouts.default')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
            <h1 class="text-white font-weight-light text-uppercase font-weight-bold">Plagiarism</h1>
            <p class="breadcrumb-custom"><a href="{{ route('home')}}">The checker</a> 
            	<span class="mx-2">&gt;</span> <span>Plagiarism</span></p>
          </div>
        </div>
      </div>
    </div>  
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-4 mb-4">
            <a href="#" class="unit-1 text-center">
              <img src="images/img_1.jpg" alt="Image" class="img-fluid">
              <div class="unit-1-text">
                <h3 class="unit-1-heading">Plagiarism</h3>
                <p class="px-5">Plagiarism meaning. What is plagiarism and how we describe our object of work. All answers about plagiarism is here.</p>
              </div>
            </a>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <a href="#" class="unit-1 text-center">
              <img src="images/img_2.jpg" alt="Image" class="img-fluid">
              <div class="unit-1-text">
                <h3 class="unit-1-heading">Antiplagiarism software is necessity</h3>
                <p class="px-5">Not all universities use plagiarism checkers, however you must be one step further – student or educator, you must work better and smarter. Here we are to help you.</p>
              </div>
            </a>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <a href="#" class="unit-1 text-center">
              <img src="images/img_3.jpg" alt="Image" class="img-fluid">
              <div class="unit-1-text">
                <h3 class="unit-1-heading">Most modern tech catching plagiarism is here</h3>
                <p class="px-5">Technology is not stuck in 90’s. It is still developing and here we have newest and best technologies detecting plagiarism.</p>
              </div>
            </a>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <a href="#" class="unit-1 text-center">
              <img src="images/img_4.jpg" alt="Image" class="img-fluid">
              <div class="unit-1-text">
                <h3 class="unit-1-heading">Why you don’t need free plagiarism checker</h3>
                <p class="px-5">There are many free anti-plagiarism software. However, you risk using such services. Only professional tools like our guarantees best scan for plagiarism.</p>
              </div>
            </a>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <a href="#" class="unit-1 text-center">
              <img src="images/img_5.jpg" alt="Image" class="img-fluid">
              <div class="unit-1-text">
                <h3 class="unit-1-heading">Plagiarism and copyright infringment</h3>
                <p class="px-5">What are juridical consequences of violating copyrights? Short review of biggest countries legislations.</p>
              </div>
            </a>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <a href="#" class="unit-1 text-center">
              <img src="images/img_1.jpg" alt="Image" class="img-fluid">
              <div class="unit-1-text">
                <h3 class="unit-1-heading">Plagiarism</h3>
                <p class="px-5">Plagiarism meaning. What is plagiarism and how we describe our object of work. All answers about plagiarism is here.</p>
              </div>
            </a>
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