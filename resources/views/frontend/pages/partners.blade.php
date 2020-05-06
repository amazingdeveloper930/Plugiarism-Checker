@extends('frontend.layouts.default')
@section('title', 'Be our plagiarism checker distributor')
@section('description', "Be our plagiarism checker distributor")
@section('content')

 <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">

      <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
        <h1 class="text-white font-weight-light text-uppercase font-weight-bold">for distributors</h1>
        <p class="breadcrumb-custom"><a href="{{ route('home')}}">The checker</a> <span class="mx-2">&gt;</span> <span>For Distributors</span></p>
      </div>
    </div>
  </div>
</div>  

    

  <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          
          <div class="col-md-6 ml-auto mb-5 order-md-2" data-aos="fade">
            <form method='POST' action="{{ route('partner-email') }}" class="p-5 bg-white">
             {{ csrf_field() }}
             <input type="hidden" name="form_type" value="Contact Inquiry">
              <div class="row form-group">
                <div class="col-md-12 mb-md-0">
                  <label class="text-black" for="company_name">Company Name</label>
                  <input type="text" id="company_name" class="form-control" name = "company_name" placeholder="Write your company name">
                </div>
                
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-md-0">
                  <label class="text-black" for="company_country">Country of residence</label>
                 {{Form::select('company_country', $country_list , null, ['class' => 'form-control ','placeholder' => 'Please select company country']) }}
                </div>
                
              </div>

              <div class="row form-group">
                <div class="col-md-12 mb-md-0">
                  <label class="text-black" for="market">Preferred market</label>
                 <textarea name="market" id="market" cols="30" rows="3" class="form-control" placeholder="Write your preferred market"></textarea>
                </div>                
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" class="form-control" name="email" placeholder="Write your email">
                </div>
              </div>

              

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Comment</label> 
                  <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Send Message" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>

  
            </form>
          </div>
          <div class="col-md-6 order-md-1" data-aos="fade">
            <div class="text-left pb-1 border-primary mb-4">
              <h2 class="text-primary">Be our partner.</h2>
            </div>
            <p style="font-size: 20px !important;">Become reseller of our plagiarism check licenses.<br/> Sell it to buyers in your market. You can resell our licenses to universities, colleges, or any other business you reach. We offer great conditions for reselling. <br/>Contact us and find what terms we can offer for you.
            <br/>
            <a   class="btn btn-primary py-2 px-4 text-white col-md-8 ml-5 mt-3" id = "viewDemo" href = "{{ route('user.demo') }}">Take a look at demo version</a>
          </p>
          </div>
          
        </div>
      </div>
    </div>
     <?php
      if(session()->has('data'))
      {
        ?>
      
    <script type="text/javascript">

      $( document ).ready(function() {
        Swal.fire({
            type: 'success',
            title: 'Your message was send to support team successfully',
            showConfirmButton: true
          });
      });
    </script>
    <?php
      }
    ?>
    
    @include('frontend.layouts.testimonials')

@stop