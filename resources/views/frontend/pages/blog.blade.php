@extends('frontend.layouts.default')

@section('title', 'Our Blog')
@section('description', "Our Blog")

@section('content')

	  <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
            <h1 class="text-white font-weight-light text-uppercase font-weight-bold">Our Blog</h1>
            <p class="breadcrumb-custom"><a href="{{ route('home')}}">The checker</a> <span class="mx-2">&gt;</span> <span>Blog</span></p>
          </div>
        </div>
      </div>
    </div>  

    
  
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
            <div class="h-entry">
              <img src="images/blog_2.jpg" alt="Image" class="img-fluid">
              <h2 class="font-size-regular"><a href="#">EVERYTHING YOU NEED TO KNOW ABOUT PLAGIARISM CHECKER</a></h2>
              <div class="meta mb-4">Theresa Winston <span class="mx-2">&bullet;</span> Jan 18, 2019<span class="mx-2">&bullet;</span> <a href="#">News</a></div>
              <p>Academic writing is a real challenge that requires creativity and innovation. Words represent the originality of thoughts, ideas and messages.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
            <div class="h-entry">
              <img src="images/blog_1.jpg" alt="Image" class="img-fluid">
              <h2 class="font-size-regular"><a href="#">Which plagiarism checker you need?</a></h2>
              <div class="meta mb-4">Theresa Winston <span class="mx-2">&bullet;</span> Jan 18, 2019<span class="mx-2">&bullet;</span> <a href="#">News</a></div>
              <p>In order to make sure that your work is authentically cleansed of all possible plagiarism issues, it is important to know which plagiarism checker you can rely on. </p>
            </div> 
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
            <div class="h-entry">
              <img src="images/blog_2.jpg" alt="Image" class="img-fluid">
              <h2 class="font-size-regular"><a href="#">How to know which plagiarism checker is the best for you?</a></h2>
              <div class="meta mb-4">Theresa Winston <span class="mx-2">&bullet;</span> Jan 18, 2019<span class="mx-2">&bullet;</span> <a href="#">News</a></div>
              <p>For any plagiarism checker to be the best for you, it is important that you know the key features that make it better than the others. Plagiarismchecker.eu offers these facilities that makes it not only different, but help you get a more credible plagiarism report. </p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
            <div class="h-entry">
              <img src="images/blog_1.jpg" alt="Image" class="img-fluid">
              <h2 class="font-size-regular"><a href="#">Is free plagiarism checker a good choice?</a></h2>
              <div class="meta mb-4">Theresa Winston <span class="mx-2">&bullet;</span> Jan 18, 2019<span class="mx-2">&bullet;</span> <a href="#">News</a></div>
              <p>One of the major hurdles in checking plagiarism is that it is hardly ever entirely free. Most of the services do not offer a free plagiarism checker for students at all, and if they do, there is no comprehensive information of the text and the originality of it. </p>
            </div> 
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
            <div class="h-entry">
              <img src="images/blog_2.jpg" alt="Image" class="img-fluid">
              <h2 class="font-size-regular"><a href="#">Similarity checker or plagiarism checker - is there any difference?</a></h2>
              <div class="meta mb-4">Theresa Winston <span class="mx-2">&bullet;</span> Jan 18, 2019<span class="mx-2">&bullet;</span> <a href="#">News</a></div>
              <p>One thing that needs to be clarified is that the users must not confuse plagiarism and similarities to be any different. Copying or using the exact words of other writers is both similar and plagiarized. </p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
            <div class="h-entry">
              <img src="images/blog_1.jpg" alt="Image" class="img-fluid">
              <h2 class="font-size-regular"><a href="#">
Plagiarism check software - necessary tool for modern students</a></h2>
              <div class="meta mb-4">Theresa Winston <span class="mx-2">&bullet;</span> Jan 18, 2019<span class="mx-2">&bullet;</span> <a href="#">News</a></div>
              <p>Plagiarism check holds a great deal of importance for various reasons. It is not just important for an organization or an individual, but for the entire society. </p>
            </div> 
          </div>
          
        </div>
        <div >
          @foreach ( $pages as $key => $value)
            <a href = '{{ $value }}' style="display:block">{{ $key }}</a>
          @endforeach
        </div>
      </div>
    </div>


@stop