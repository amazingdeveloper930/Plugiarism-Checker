@extends('frontend.layouts.default')

@section('title', 'Copyright Checker')
@section('description', "Copyright Checker")
@section('content')

 <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
            <h1 class="text-white font-weight-light text-uppercase font-weight-bold">Copyright Checker</h1>
            <p class="breadcrumb-custom"><a href="{{ route('home')}}">The checker</a> <span class="mx-2">&gt;</span> <span>Copyright Checker</span></p>
          </div>
        </div>
      </div>
    </div>  

    

    <div class="site-section">
      <div class="container">
          <div class="row mb-9">
              @include('frontend.home.fileuploadtemplate')
          </div>
        <div class="row mb-9 ml-auto" data-aos="fade" >

          <p>
            With time it is becoming a significant requirement for companies to protect copyright infringement <a href = "{{ $pages[array_keys($pages)[0]] }}">{{ array_keys($pages)[0] }}</a> and also stop it from happening. Not only is it a global standard but it is also unfair to end up copying of ideas from other companies around the world. Especially, when all organizations are trying to earn revenues and compete. 
Teachers also become a subject of plagiarism in the sense that they are the ones who have to deal with plagiarized papers and to ensure that a ton of work is authentic and plagiarism free. We help all individuals around the world to produce and ensure qualitative standards of writing and academic production with our best free plagiarism checker. Enjoy!
          </p>
         
      </div>
    </div>
  </div>

@stop