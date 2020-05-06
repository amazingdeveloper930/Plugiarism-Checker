@extends('frontend.layouts.default')

@section('title', 'Plagiarism Scanner')
@section('description', "Plagiarism Scanner")

@section('content')

 <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
            <h1 class="text-white font-weight-light text-uppercase font-weight-bold">Plagiarism Scanner</h1>
            <p class="breadcrumb-custom"><a href="{{ route('home')}}">The checker</a> <span class="mx-2">&gt;</span> <span>Plagiarism Scanner</span></p>
          </div>
        </div>
      </div>
    </div>  

    

    <div class="site-section">
      <div class="container">
        <div class="row mb-9 ml-auto" data-aos="fade" >

          <div class="text-center pb-1 mb-5">
              <h3 class="text-primary">Plagiarism Scanner</h3>
          </div>
          <p>
           One of the major hurdles in checking plagiarism is that it is hardly ever entirely free. Most of the services do not offer a free plagiarism checker <a href = "{{ $pages[array_keys($pages)[0]] }}">{{ array_keys($pages)[0] }}</a> for students at all, and if they do, there is no comprehensive information of the text and the originality of it. 
Plagiarismchecker.eu, on the other hand, offers free trials, free services, and that too for unlimited number of words that need to be checked. We offer some really impressive features that will help you along the process to determine the authenticity of our results. This service is availed, not just by students, but even the universities, private firms and web organizations use our special features. We ensure our credibility with a certificate of authenticity for you, in order to validate the accuracy of the system..
          </p>
         
      </div>
    </div>
  </div>

@stop