<!DOCTYPE html>
<html lang="en">
<head>
  <title>Visitor Counter - plagiarismchecker.eu</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Visitor Counter"/>
  <meta name="google-site-verification" content="EmmNFIW0I2HB_Eu_cARZVvOUHwUUM513JsvHB5xFGkQ" />
  <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.png') }}" alt = "logo">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    nav {
      margin-bottom: 50px;
      border-radius: 0;
      color: #fff;
        background-color: #337ab7;
        border-color: #337ab7;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }

    #header-post span.step-digit {
        font-size: 78px;
        padding: 0 10px;
    }

    #header-post span {
        vertical-align: middle;
    }
    #header-post .well {
        background-color: rgba(255,255,255,.5);
        border: none;
        font-size: 18px;
        font-weight: 700;
        color: #168fda;
        padding: 0;
        line-height: 54px;
    }
    #header-post .well .step-digit{
        -webkit-text-stroke: 1px #1c7ed2;
    }
    .panel-footer {
        text-align: center;
    }
    .panel-body {
        height: 135px;
    }
  </style>
</head>
<body>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Visitor Counter</h1>      
    <p>Free Visitor Counters</p>
  </div>
</div>

<nav>
  <div class="container-fluid">
    <div id="header-post" class="container">
        <h4><em>Get your very own for your site. Choose from six different styles in three easy steps.</em></h4>
        <div class="row-fluid row">
        <div class="span4 col-md-4">
        <div class="well">
        <span class="step-digit">1</span><span>Click on a style</span>
        </div>
        </div>
        <div class="span4  col-md-4">
        <div class="well">
        <span class="step-digit">2</span><span>Copy the generated code</span>
        </div>
        </div>
        <div class="span4 col-md-4">
        <div class="well steps">
        <span class="step-digit">3</span><span>Embed in your homepage</span>
        </div>
        </div>
        </div>
        </div>
  </div>
</nav>
<?php 
$index = 0;
?>
@foreach(App\CounterModel::all() as $entry)
    @if($index % 3 == 0)
    <div class="container">    
    <div class="row">
    @endif
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">{{ $entry -> name }}</div>
        <div class="panel-body"><img src="{{ asset('number/' . $entry -> folder_path . '/model.' . $entry -> format) }}" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer"><button class="btn btn-danger" onclick="getCode({{ $entry -> id }})">Get Code</button></div>
      </div>
    </div>
    <?php $index ++; ?>
    @if($index % 3 == 0) 
    </div>
    </div><br>
    
   @endif

@endforeach

@if($index % 3 != 0) 
    </div>
    </div><br>
    
   @endif


<br>

<br>

<div class="container-fluid">
  <div class="container text-center">
    <h3>This is how your report will look like when visited</h3>
    <br/>
    <img class = "img-responsive" src="{{ asset('images/screenshot.png') }}">
    <br/>
    <br/>
  </div>
</div>
<div id="codeModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
      
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title">Get Your Code!</h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="code">Embed Code</label>
                    <textarea class="form-control" rows="5" id="code" readonly></textarea>
                </div>
                <button type="button" class="btn btn-primary" onclick="copyCode()">Copy Code</button>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
      
        </div>
      </div>
      
</body>

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

<script>
        function getCode(index) {
            $.ajax({
                type: "post",
                dataType: "json",
                url: "{{ route('service.get_code') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: index
                },
                success: function(response) {
                    var str = "<div id = '" + response.index + "'><a href='" + response.link + "' title = 'page view counter' target='_blank' id = 'main_" + response.index + "'></a></div>";
                    str += "<script src = '{{ route('home') }}" + "/counter_script/" + response.index  + "'" + "><" + '/script>';
                    $("#code").val(str);
                    $("#codeModal").modal();
                }
            });
        
            // $("#codeModal").modal()
        }
        
        function copyCode() {
            $("#code").focus();
            $("#code").select();
            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                console.log('Fallback: Copying text command was ' + msg);
            } catch (err) {
                console.error('Fallback: Oops, unable to copy', err);
            }
        }
    </script>
</html>
