@extends('frontend.layouts.default')

@section('title', 'Plagiarism check for universities')
@section('description', "Plagiarism check for universities")

@section('content')
<style type="text/css">
  .noUi-target,
.noUi-target * {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -ms-touch-action: none;
    touch-action: none;
    -ms-user-select: none;
    -moz-user-select: none;
    user-select: none;
    box-sizing: border-box
}

.noUi-target {
    position: relative;
    direction: ltr
}

.noUi-base {
    width: 100%;
    height: 100%;
    position: relative;
    z-index: 1
}

.noUi-connect {
    position: absolute;
    right: 0;
    top: 0;
    left: 0;
    bottom: 0
}

.noUi-origin {
    position: absolute;
    height: 0;
    width: 0;
    margin: 0;
    border-radius: 0;
    height: 2px;
    background: #c8c8c8
}

.noUi-origin[style^="left: 0"] .noUi-handle {
    background-color: #fff;
    border: 2px solid #c8c8c8
}

.noUi-origin[style^="left: 0"] .noUi-handle.noUi-active {
    border-width: 1px
}

.noUi-handle {
    position: relative;
    z-index: 1
}
.noUi-handle:focus { outline: none; }

.noUi-state-tap .noUi-connect,
.noUi-state-tap .noUi-origin {
    transition: top .3s, right .3s, bottom .3s, left .3s
}

.noUi-state-drag * {
    cursor: inherit!important
}

.noUi-base,
.noUi-handle {
    transform: translateZ(0)
}

.noUi-horizontal {
    height: 2px;
    margin: 15px 0
}

.noUi-vertical {
    width: 18px
}

.noUi-vertical .noUi-handle {
    width: 28px;
    height: 34px;
    left: -6px;
    top: -17px
}

.noUi-target {
    background: #c8c8c8;
    border-radius: 4px
}

.noUi-connect {
    background: #3fb8af;
    transition: background .45s
}

.noUi-draggable {
    cursor: w-resize
}

.noUi-vertical .noUi-draggable {
    cursor: n-resize
}

.noUi-handle {
    box-sizing: border-box;
    width: 14px;
    height: 14px;
    left: -10px;
    top: -6px;
    cursor: pointer;
    border-radius: 100%;
    transition: all .2s ease-out;
    border: 1px solid;
    background: #fff;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, .14), 0 3px 1px -2px rgba(0, 0, 0, .12), 0 1px 5px 0 rgba(0, 0, 0, .2)
}

.noUi-handle.noUi-active {
    transform: scale3d(1.5, 1.5, 1)
}

.noUi-vertical .noUi-handle:after,
.noUi-vertical .noUi-handle:before {
    width: 14px;
    height: 1px;
    left: 6px;
    top: 14px
}

.noUi-vertical .noUi-handle:after {
    top: 17px
}

[disabled] .noUi-connect {
    background: #b8b8b8
}

[disabled].noUi-handle,
[disabled] .noUi-handle,
[disabled].noUi-target {
    cursor: not-allowed
}

.slider {
    background: #c8c8c8
}

.slider .noUi-connect {
    background-color: #9c27b0;
    border-radius: 4px
}

.slider .noUi-handle {
    border-color: #9c27b0
}

.slider.slider-info .noUi-connect {
    background-color: #00bcd4
}

.slider.slider-info .noUi-handle {
    border-color: #00bcd4
}

.slider.slider-success .noUi-connect {
    background-color: #4caf50
}

.slider.slider-success .noUi-handle {
    border-color: #4caf50
}

.slider.slider-warning .noUi-connect {
    background-color: #ff9800
}

.slider.slider-warning .noUi-handle {
    border-color: #ff9800
}

.slider.slider-danger .noUi-connect {
    background-color: #f44336
}

.slider.slider-danger .noUi-handle {
    border-color: #f44336
}

.slider.slider-rose .noUi-connect {
    background-color: #e91e63
}

.slider.slider-rose .noUi-handle {
    border-color: #e91e63
}
</style>

<input type="text" id = "university-email" hidden value="{{route('university-email')}}">
 <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
            <h1 class="text-white font-weight-light text-uppercase font-weight-bold">Plagiarism Checker Price for Universities</h1>
            <p class="breadcrumb-custom"><a href="{{ route('home')}}">The checker</a> <span class="mx-2">&gt;</span> <span>Plagiarism Checker Price for Universities</span></p>
          </div>
        </div>
      </div>
    </div>  

    

    <div class="site-section">
      <form class="needs-validation"  id="payment-form" action="{{ route('cardinity_university') }}" method="POST">
            {{ csrf_field() }}
      <div class="container">
        <div class="row mb-9 ml-auto" data-aos="fade" >
         <p style="float:left">
           We offer you to purchase license of our software for the use in universities, colleges or any other institution when big amounts of check is needed. <br/>You can make your order here by choosing parameters you need. After choosing necessary parameters and amounts, you will be redirected to payment page. You will also get invoice for our service if needed. <br/>If any documentation needed for your institution, please contact us <a href="mailto:{{env('APP_SUPPORT_EMAIL')}}">{{env('APP_SUPPORT_EMAIL')}}</a>
           <a   class="btn btn-primary py-2 px-4 text-white col-md-4 ml-5" id = "viewDemo" href = "{{ route('user.demo') }}">Take a look at demo version</a>
          </p>
         
        </div>
        <div class="row mb-9 ml-auto" data-aos="fade" >
          <div class="col-md-6 col-sm-12">
            <p>Number of documents</p>
          </div>
          <div class="col-md-6 col-sm-12 row">
          
            <div class="col-md-6">
              <input type="input" id = "count-of-page" class="form-control" value="1" name="page_count">
            </div>
          </div>
        </div>
      
        <div class="row mb-9 ml-auto" data-aos="fade" >
          <div class="col-md-6 col-sm-12">
            <p>Term of using the service (months)</p>
          </div>
          <div class="col-md-6 col-sm-12 row">
            <div id="slider_B" class="slider col-md-6" style="padding: 0px;"></div>
            <div class="col-md-6">
              <span id = "slider_B_Val">0</span>
            </div>
          </div>
        </div>

        <div class="row mb-9 ml-auto" data-aos="fade" >
          <div class="col-md-6 col-sm-12">
            <p>Your Country</p>
          </div>
          <div class="col-md-3 col-sm-6">
            <select class="form-control" name="user_country" id = "user_country">
              <option>Please select your country</option>
              @foreach($country_list as $index => $country)
              <option value="{{$country_gdp[$index]}}">
                {{$country}}
            </option>
              @endforeach
            </select>

          </div>

        </div>

        <div class="row mb-9 ml-auto" data-aos="fade" style="margin-top: 10px;">
          <div class="col-md-6 col-sm-12">
            <p>number of students</p>
          </div>
          <div class="col-md-6 col-sm-12 row">
            <div class="col-md-6">
              <input type="input" id = "count-of-student" class="form-control" value="10" required="true">
            </div>
          </div>
          <div class="col-md-10 col-sm-12 border-bottom" style="margin-top: 10px;"></div>
        </div>

          <div class="row mb-9 ml-auto row text-primary" data-aos="fade" style="margin-top: 30px;">
            <div class="col-md-6 col-sm-6">
              <h3>Price<small>(USD)</small></h3>
            </div>
            <div class="col-md-3 col-sm-6" style="text-align: center;">
              <h3><span id = "Price">0</span></h3>
            </div>
        </div>

        <div class= "mb-9 ml-auto   row"  style="margin-top: 50px;">
          <div class="col-md-5 col-sm-12">
            <p>Name of institution</p>
          </div>
          <div class="col-md-4 col-sm-6">
            <input type="input" id = "name-of-institution" class="form-control" name="institution_name" required="true">
          </div>
        </div>
        <div class=" mb-9 ml-auto   row"  style="margin-top: 30px;">
          <div class="col-md-5 col-sm-12">
            <p>Website of institution</p>
          </div>
          <div class="col-md-4 col-sm-6">
            <input type="input" id = "website-of-institution" class="form-control" name="institution_website" required="true">
          </div>
        </div>

        <div class=" mb-9 ml-auto  row"  style="margin-top: 30px;">
          <div class="col-md-5 col-sm-12">
            <p>Email of responsible person </p>
          </div>
          <div class="col-md-4 col-sm-6">
            <input type="email" id = "email-of-institution" class="form-control" name="institution_email" required="true">
          </div>
        </div>

        <div class=" mb-9 ml-auto row"  style="margin-top: 30px;">
          <div class="col-md-5 col-sm-12">
            <p>Additional comments </p>
          </div>
          <div class="col-md-4 col-sm-6">
            <textarea id = "additional-comments" class="form-control" cols="30" rows="7" name="additional_comments" required="true"></textarea>
          </div>
        </div>

        
        <div class="row">
            <div class="col-md-6 mb-3">
            <input type="hidden" name="amount" id="amount">
            <input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="mode" value="2">
            <input type="hidden" name="terms" id="terms">
            <input type="hidden" name="country" id="country">
            </div>
        </div>
        <div class="mb-9 row">
            <div class="col-md-6 mb-3">
            <label for="cc-name">Name on card</label>
            <input type="text" class="form-control" id="cc-name" name="cc-name" placeholder="Full name as displayed on card" required="true">
            </div>
            <div class="col-md-6 mb-3">
            <label for="cc-number">Credit card number</label>
            <input type="text" class="form-control" id="cc-number" name="cc-number" placeholder="xxxx-xxxx-xxxx-xxxx" required="true">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
            <label for="cc-expiration">Expiration Month</label>
            <input type="number" class="form-control" id="cc-expiration-month" name="cc-expiration-month" placeholder="xx" required="true">
            </div>
            <div class="col-md-3 mb-3">
            <label for="cc-expiration">Expiration Year</label>
            <input type="number" class="form-control" id="cc-expiration-year" name="cc-expiration-year" placeholder="xxxx" required="true">
            </div>
            <div class="col-md-3 mb-3">
            <label for="cc-expiration">CVV</label>
            <input type="text" class="form-control" id="cc-cvv" name="cc-cvv" placeholder="CVV" required="true">
            </div>
        </div>
        <div class=" mb-9 ml-auto row"  style="margin-top: 50px;">
            <div class="col-md-9 row">
              <div class="col-md-4">
              </div>
              <button   class="btn btn-primary py-2 px-4 text-white col-md-4" id = "order">Order</button>
              <div class="col-md-4">
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
<script type="text/javascript">

var slider_B = document.getElementById('slider_B');
var slider_B_Val = document.getElementById('slider_B_Val');



noUiSlider.create(slider_B, {
  start: 1,
  connect: [true,false],
  range: {
    min: 0,
    max: 36
  }
});

function getPriceValue()
{
  var A = $('#count-of-page').val();
  if(!($.isNumeric(A)))
  {
    A = 0;
    $('#count-of-page').val(0);
  }
  var b = Math.round(slider_B.noUiSlider.get());
  var B = 0;
  if(b <= 12)
    B = 1;
  if(12 < b && b <= 24)
    B = 2;
  if(b > 24)
    B = 2.5;
  var c = $('#user_country').val();
  var C = 0;
  if($.isNumeric(c))
  C = c;
  else
    C = 1;
  var price = Math.round(A * 0.95 * B * C * 1000)/1000.0;

  $("#Price").text(price);
  return price;
}

 $('#count-of-page').on('change', function (e) {
    getPriceValue();
});
 slider_B.noUiSlider.on('update', function( values, handle ) {
      slider_B_Val.innerText = Math.round(slider_B.noUiSlider.get());
      getPriceValue();
    });

 $('#user_country').on('change', function (e) {
    getPriceValue();
});

function my_alert(type, message)
{
  Swal.fire({
      type: type,
      title: message,
      showConfirmButton: true,
    });
}

$('#order').click(function(){

  var page_count = $('#count-of-page').val();
  if(!($.isNumeric(page_count)))
  {
    page_count = 0;
    $('#count-of-page').val(0);
  }
  var terms = Math.round(slider_B.noUiSlider.get());
  $("#terms").val(terms);
  var country = $("#user_country option:selected").text();
  if(country == "Please select your country")
  {
      country = "Other";
  }
  $("#country").val(country);
  var institution_name = $("#name-of-institution").val();
  if(institution_name == '')
  {
     my_alert("error", "Please fill institution name");
    return;
  }
  var institution_website = $("#website-of-institution").val();
  if(institution_website == '')
  {
    my_alert("error", "Please fill institution website");
    return;
  }
  var institution_email = $("#email-of-institution").val();
  if(institution_email == '')
  {
    my_alert("error", "Please fill institution email");
    return;
  }
  var additional_comments = $("#additional-comments").val();
  if(additional_comments == '')
  {
    my_alert("error", "Please fill additional comments");
    return;
  }
  var price = $("#Price").text();
  var form = $("#payment-form");
  $("#amount").val(getPriceValue());
  if (form.valid()) {
    form.submit();
  }

});

</script>
@if(session('errors'))
  <script>
     my_alert('error', '{{ session('errors') }}');
  </script>
@endif
@if(session('success'))
  <script>
     my_alert('success', '{{ session('success') }}');
  </script>
@endif

@stop