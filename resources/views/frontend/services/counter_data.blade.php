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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
  
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
    #header {
        box-shadow: 0 4px 3px rgba(68,68,68,.25), 0 -5px 0 rgba(0,0,0,.1) inset;
        background-color: #1d72a6;
        color: #efefef;
    }
    #header #header-logo {
    color: #1d72a6;
    padding: .5em 0;
    background: #fefefe;
    background: -moz-linear-gradient(top,#fefefe 0%,#eeeeee 75%);
    background: -webkit-gradient(linear,left top,left bottom,color-stop(0%,#fefefe),color-stop(75%,#eeeeee));
    background: -webkit-linear-gradient(top,#fefefe 0%,#eeeeee 75%);
    background: -o-linear-gradient(top,#fefefe 0%,#eeeeee 75%);
    background: -ms-linear-gradient(top,#fefefe 0%,#eeeeee 75%);
    background: linear-gradient(to bottom,#fefefe 0%,#eeeeee 75%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fefefe',endColorstr='#eeeeee',GradientType=0);
    -webkit-box-shadow: 0 2px 4px 2px rgba(0,0,0,.5);
    box-shadow: 0 2px 4px 2px rgba(0,0,0,.5);
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
   <header id="header">

        <div id="header-logo">
        <div class="container">
        <div class="row">
        <div id="logo" class="span12">
        <a href="/">Plagiarismchecker.eu</a>

        
        </div>
        <div class="span12">
        <h1>Free Visitor Counter</h1>
        </div>
        </div>
        </div>
        </div>
        <div id="header-post" class="container">
        <h4><em>You can check your site visit status here.</em></h4>
        </div>
        </header>
        <div class="jumbotron">
            <div class="container text-center">
              <div class="row">
                  <div class="col-md-4">
                        <h2 class="text-danger">Visit Count per Country</h2>
                        @foreach ($country_data as $country)
                        <p style="text-align:left; padding-left: 75px;">
                            {{ $country -> country }} : {{ $country -> visit_per_country }}
                        </p>
                        @endforeach
                  </div>
                  <div class="col-md-4">
                        <h2 class="text-danger">Total Visitors : {{ $data -> visit_count }}</h2>
                  </div>
                  <div class="col-md-4">
                        <h2 class="text-danger">Today Visitors : {{ isset($today_data) ? $today_data -> visit_count : 0 }}</h2>
                  </div>

              
             
              </div>
              <br/>
              <table class="table table-bordered" id = "datatable">
                  <thead >
                    <th>Country</th>
                    <th>City</th>
                    <th>Visited Count</th>
                    <th>Last visit</th>
                  </thead>
                  <tbody>
                      @foreach ($users as $user)
                          <tr>
                              <td>{{ $user -> country }}</td>
                              <td>{{ $user -> city }}</td>
                              <td>{{ $user -> visit_count }}</td>
                              <td>{{ $user -> updated_at }}</td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
              <br/>

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
        $(document).ready(function() {
            $('#datatable').dataTable({
                    order: [[3, 'desc']]
                });
        } );
    </script>
</html>
