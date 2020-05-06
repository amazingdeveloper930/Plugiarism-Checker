@extends('frontend.layouts.default')

@section('title', 'Contact Us')
@section('description', "Contact Us")

@section('content')

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{ asset('images/hero_bg_1.jpg') }});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
            <h1 class="text-white font-weight-light text-uppercase font-weight-bold">Contact Us</h1>
            <p class="breadcrumb-custom"><a href="{{ route('home')}}">The checker</a> <span class="mx-2">&gt;</span> <span>Contact</span></p>
          </div>
        </div>
      </div>
    </div>  

    
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-7 mb-5">

            

            <form method='POST' action="{{route('send-email')}}" class="p-5 bg-white">
             {{ csrf_field()}}
             <input type="hidden" name="form_type" value="Contact Inquiry">
              <div class="row form-group">
                <div class="col-md-12 mb-md-0">
                  <label class="text-black" for="name">Your Name</label>
                  <input type="text" id="name" class="form-control">
                </div>
                
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Your Email</label> 
                  <input type="email" id="email" class="form-control" name="email">
                </div>
              </div>

              

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Your Message</label> 
                  <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Send Message" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>

  
            </form>
          </div>
          <div class="col-md-5">
            
            <div class="p-4 mb-3 bg-white">
                <p class="mb-0 font-weight-bold">Strat Bannstein Ltd</p>
              <p class="mb-4"><a href="#">co.no:11755061</a></p>
              
              <p class="mb-0 font-weight-bold">Address</p>
              <p class="mb-4">KEMP HOUSE 160 CITY ROAD LONDON EC1V 2NX</p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-4"><a href="#">{{env('APP_SUPPORT_EMAIL')}}</a></p>
              
              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4">: 37060413327</p>
              
             
            </div>

          </div>
        </div>
      </div>
    </div>
      <?php
      if(session()->has('data')){
        ?>
      
    <script type="text/javascript">

      $( document ).ready(function() {
        Swal.fire({
            type: 'success',
            title: 'Your message was send to support team successfully',
            showConfirmButton: true,
            timer: 2500
          });
      });
    </script>
    <?php
      }
    ?>

@stop