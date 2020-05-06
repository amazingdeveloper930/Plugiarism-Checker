@extends('frontend.layouts.default')

@section('title', 'Plagiarism checker. Check for plagiarism - best performance')
@section('description', "Plagiarism checker. For students and universities. Check paper for plagiarism. Scan your documents PLAGIARISM ANTIPLAGIARISM SOFTWARE - Best performance")

@section('content')
  <div class="site-blocks-cover overlay" style="background-image: url({{ asset('images/hero_bg_1.jpg')}})" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
            <h1 class="text-white font-weight-light mb-5 text-uppercase font-weight-bold">Plagiarism checker. Premium users Check for plagiarism here</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row no-gutters align-items-stretch align-items-center " style="margin-top: -150px;">
        <div class="col-md-4">
          <div class="feature-1 pricing h-100 text-center">
            <div class="icon">
              <i class="fa fa-user dashboard-icon"></i>
            </div>
             <h2 class="my-4 heading">For distributors</h2>
            <p>Become reseller of our plagiarism check licenses.
Sell it to buyers in your market. You can resell our licenses to universities, colleges, or any other business you reach. We offer great conditions for reselling.
Contact us and find what terms we can offer for you.</p>
    <a   class="btn btn-warning py-2 px-4 text-white" href="{{route('pages.partners')}}" style="position: absolute;
    right: 105px;
    bottom: 30px;
    width: 160px;">Apply</a>
          </div>
        </div>
        <div class="col-md-4 bg-dark">
          @include('frontend.home.fileupload')
        </div>
        <div class="col-md-4">
          <div class="feature-3 pricing h-100 text-center">
            <div class="icon">
              <i class="fa fa-university dashboard-icon"></i>
            </div>
            <h2 class="my-4 heading">For universities</h2>
            <p>You can purchase check for plagiarism in big amounts. That’s suitable for universities, business and other organisations who need to check many documents. You can create your custom order here choosing how many uploads you need and the average amount of the document. This means you can order plagiarism check right from your office and get invoice.</p>
            <a   class="btn btn-warning py-2 px-4 text-white" href="{{route('pages.calc_universities')}}" style="position: absolute;
    right: 105px;
    bottom: 30px;
    width: 160px;">Purchase</a>
          </div>
        </div>
      </div>
    </div>
    <div class="site-section">
      <div class="container">
         @if($visit_once== false)
        <div class="row align-items-stretch">
          <form method='POST' target="_blank" action="{{route('report.samplecheck')}}" style="width: 100%;" class="justify-content-center">
            {{ csrf_field()}}
            <textarea  cols="100" rows="10" class="form-control" placeholder="Write your sample text here..." onkeyup="textCounter(this,'counter',1000);" id = "sampletext" name="sampletext"></textarea>
            <span id = "counter"></span>
            <div class="row">
              <div class="col-md-5"></div>
            <input type="submit" value="Check" class="btn btn-primary py-2 px-4 text-white align-items-center col-md-2" id = "sample-check">
            <div class="col-md-5"></div>
            </div>
          </form>
        </div>
         @endif
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="mb-0 text-primary">How this plagiarism scanner works</h2>
            <p class="color-black-opacity-5">Know us in short</p>
          </div>
        </div>
        <div class="row align-items-stretch">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary fa fa-registered"></span></div>
              <div>
                <h3>No registration needed</h3>
                <p>We know you by your email. No passwords, no data entry. You are our guest and we do our best to remember you.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary fa fa-shield"></span></div>
              <div>
                <h3>Your uploaded papers  are safe</h3>
                <p>Every uploaded paper will be storaged for 24 hours and will be deleted automatically unless you choose to save it. When you upload, you may be sure no leak will happen and your apper will not be included into comparative databases. This means we solve your future possible problems.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary fa fa-money"></span></div>
              <div>
                <h3>Simple cost pricing</h3>
                <p>No matter how big your file is, the price is USD 9 per paper. It is standard price. However, bulk purchasing gives extra discount for that price.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="site-section block-13">
      <div class="owl-carousel nonloop-block-13">
        <div>
          <a href="#" class="unit-1 text-center">
            <img src="{{ asset('images/img_1.jpg') }}" alt="Image" class="img-fluid">
            <div class="unit-1-text">
              <h3 class="unit-1-heading">Plagiarism</h3>
              
            </div>
          </a>
        </div>
        <div>
          <a href="#" class="unit-1 text-center">
            <img src= "{{asset('images/img_2.jpg')}}" alt="Image" class="img-fluid">
            <div class="unit-1-text">
              <h3 class="unit-1-heading">Antiplagiarism software is necessity</h3>
              
            </div>
          </a>
        </div>
        <div>
          <a href="#" class="unit-1 text-center">
            <img src= "{{asset('images/img_3.jpg')}}" alt="Image" class="img-fluid">
            <div class="unit-1-text">
              <h3 class="unit-1-heading">Most modern tech catching plagiarism is here</h3>
              
            </div>
          </a>
        </div>
        <div>
          <a href="#" class="unit-1 text-center">
            <img src= "{{asset('images/img_4.jpg')}}" alt="Image" class="img-fluid">
            <div class="unit-1-text">
              <h3 class="unit-1-heading">Why you don’t need free plagiarism checker</h3>
              
            </div>
          </a>
        </div>
        <div>
          <a href="#" class="unit-1 text-center">
            <img src= "{{asset('images/img_5.jpg')}}" alt="Image" class="img-fluid">
            <div class="unit-1-text">
              <h3 class="unit-1-heading">Plagiarism and copyright infringment.</h3>
              
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Why this plagiarism check software is the best?</h2>
            
          </div>
        </div>
        @include('frontend.services.servicelist')
      </div>
    </div>
     <div class="site-blocks-cover overlay inner-page-cover" style="background-image:url({{"'" . asset('images/hero_bg_2.jpg') . "'"}}); background-attachment:fixed;background-size:100% 100%;">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-7">
            <h2 class="text-white font-weight-light mb-5 h1">European plagiarism check system for best performance</h2>
          </div>
        </div>
      </div>
    </div>  
    @include('frontend.layouts.testimonials')
    <div class="site-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Our Blog</h2>
            <p class="color-black-opacity-5">See Our Daily News &amp; Updates</p>
          </div>
        </div>
        <div class="row mb-3 align-items-stretch">
          <div class="col-md-6 col-lg-6 mb-4 mb-lg-4">
            <div class="h-entry">
              <img src="{{asset('images/blog_1.jpg')}}" alt="Image" class="img-fluid">
              <h2 class="font-size-regular"><a href="#">Which plagiarism checker you need?</a></h2>
              <div class="meta mb-4">by Theresa Winston <span class="mx-2">&bullet;</span> Jan 18, 2019 at 2:00 pm <span class="mx-2">&bullet;</span> <a href="#">News</a></div>
              <p>In order to make sure that your work is authentically cleansed of all possible plagiarism issues, it is important to know which plagiarism checker you can rely on. The online world is full of various free online plagiarism checkers for students that may provide you the required services, but may not be as trustworthy as you may think of. </p>
            </div> 
          </div>
          <div class="col-md-6 col-lg-6 mb-4 mb-lg-4">
            <div class="h-entry">
              <img src="{{asset('images/blog_2.jpg')}}" alt="Image" class="img-fluid">
              <h2 class="font-size-regular"><a href="#">How to know which plagiarism checker is the best for you?</a></h2>
              <div class="meta mb-4">by Theresa Winston <span class="mx-2">&bullet;</span> Jan 18, 2019 at 2:00 pm <span class="mx-2">&bullet;</span> <a href="#">News</a></div>
              <p>For any plagiarism checker to be the best for you, it is important that you know the key features that make it better than the others. Plagiarismchecker.eu offers these facilities that makes it not only different, but help you get a more credible plagiarism report. </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('frontend.layouts.expandtext')

@stop