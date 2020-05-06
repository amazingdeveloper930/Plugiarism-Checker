@extends('backend.user.layouts.default')
@section('title', 'Plagiarismchecker | Sample Checker Page')
@section('description', "Plagiarismchecker | Sample Checker Page")
@section('content')
<style type="text/css">

	a {
  overflow-wrap: break-word;
  word-wrap: break-word;

  -ms-word-break: break-all;
  word-break: break-all;
  word-break: break-word;
  -ms-hyphens: auto;
  -moz-hyphens: auto;
  -webkit-hyphens: auto;
  hyphens: auto;

}
  .ball {
  height: 50px;
  width: 50px;
  position: absolute;
  left: 50%;
  top: 50%;
}
.ball:before{
  content: '';
  position: absolute;
  height: 100%;
  width: 100%;
  background: rgba( 0, 255, 0, .5);
  border-radius: 50%;
  margin-left: -50%;
  margin-top: -50%;
  left: -100%;
  
  animation: position 2s infinite cubic-bezier(.25,0,.75,1), size 2s infinite cubic-bezier(.25,0,.75,1);
}

.ball-1:before {
  animation-delay: 0s, -.5s;
}
.ball-2:before {
  animation-delay: -.5s, -1s;
}
.ball-3:before {
  animation-delay: -1s, -1.5s;
}
.ball-4:before {
  animation-delay: -1.5s, -2s;
}

.spinner {
  height: 100%;
  width: 100%;
  position: absolute;
  z-index: 3;
}

@keyframes position {
  50% { 
    left: 100%;
  }
}

@keyframes size {
  50% {
    transform: scale(.5,.5);
  }
}

.loader {
  height: 4px;
  width: 100%;
  position: relative;
  overflow: hidden;
  background-color: #ddd;
}
.loader:before{
  display: block;
  position: absolute;
  content: "";
  left: -200px;
  width: 200px;
  height: 4px;
  background-color: #09c0e4;
  animation: loading 2s linear infinite;
}

@keyframes loading {
    from {left: -200px; width: 30%;}
    50% {width: 30%;}
    70% {width: 70%;}
    80% { left: 50%;}
    95% {left: 120%;}
    to {left: 100%;}
}


	.card-header button{
		width:35px;
		height: 35px;
		margin: 5px 0px;
		padding: 0px;
	}

	#document-content{
		height: 500px;
		overflow-y: auto;
		padding: 30px;
		overflow-x: hidden;
		white-space: pre-wrap;
		font-size: 18px;
	}

	#document-content span {
		font-size: 18px;
		height: fit-content;

		  color: black; 
		  display: inline;
		  padding: 0.45rem;
		  line-height: 2em;
		  white-space: pre-wrap;
  box-decoration-break: clone;
  -webkit-box-decoration-break: clone;

	}
	.inexact-match {
    	border-bottom: 3px solid rgba(232,123,0,.42);

	}
	.match {
	    cursor: pointer;
	    padding: 2px 0;
	    transition: border-width .1s ease-in-out,background .2s ease;
	    border-radius: 2px 2px 0 0;
	}
	.exact-match {
	    background-color: rgba(232,152,148, 0.5);
	}
	.exact-match:hover, .exact-match.focus {
		background-color: rgba(232,152,148);
	}

	.inexact-match:hover, .inexact-match.focus{
		background-color: rgba(232,123,0,.1);
	}
	#info-box a{
		cursor: pointer;
	}
	i.matchtile{
		color: #e91e63;
		display: contents;
	}
	.refurl{
		color: #00bcd4;
	}
	#match-reference .card-body{
		font-size: 16px;
	}
	#match-reference-url .text-info{
		margin-bottom: 10px;
	}
	#report-download-link {
        width: 35px;
	    height: 35px;
	    margin: 5px 0px;
	    padding: 9px 2px;
	}
	.zoom-buttons{
	    background-color: transparent;
	    position: absolute;
	    right: 50px;
	}
	.btn-zoom {
		width: 40px !important;
		height: 40px !important;
		text-align: center !important;
		border-radius: 50% !important;
		border-style: solid;
		border-color: #999;
		background: #AAA;
		opacity: 0.6;
		padding: 8px;
		color: white;
		cursor: point;
		-webkit-transition: all 0.3s ease-in-out; 
	  -moz-transition: all 0.3s ease-in-out;
	  -o-transition: all 0.3s ease-in-out;
	  -ms-transition: all 0.3s ease-in-out;
	  transition: all 0.3s ease-in-out;
	}
	.btn-zoom:hover {
		opacity: 0.9;
	}
	.btn-zoom:focus {
    	outline: 0 !important;
	}
	.simiar-percent{
		font-size: 2em;
	}
</style>
<input id = "savedreportdataurl" value="{{route('report.getsavedreportdata')}}" hidden>
<input id = "doAnalysis_texturl" value="{{route('report.doAnalysis_text')}}" hidden>
<div class="row">
	<div class="col-lg-8 col-md-12 col-sm-12">

		<div class="card">
		    <div class="card-header card-header-success card-header-icon">
              	<div class="row">
		      <h4 class="card-title col-lg-8 col-md-8 col-sm-12" style="padding-left: 50px;">Text Sample<span class="simiar-percent" style="margin-left: 20px"></span></h4>
				<div class="col-lg-4 col-md-4 col-sm-12 text-right" >
				</div>
			</div>
		    </div>
		    <div class="card-body" id="typography">
		    	<div class = "zoom-buttons">
		    		<button type="button" class="btn-zoom" onclick="zoom_in_text()"><i class="material-icons">zoom_in</i></button>
		    		<button type="button" class="btn-zoom" onclick="zoom_out_text()"><i class="material-icons">zoom_out</i></button>
		    	</div>
		        <div id = "document-content" >
		        	{{ $raw_data }}
		        </div>
		    </div>
		    <div class="spinner" id = "document-content-loading-spinner">
			  <div class="ball ball-1"></div>
			  <div class="ball ball-2"></div>
			  <div class="ball ball-3"></div>
			  <div class="ball ball-4"></div>
			</div>
		</div>

	</div>
	<div class="col-lg-4 col-md-12 col-sm-12 sticky" id = "info-box">
		<div id = "info-progressing-box">
			<span class="text-info"><h3>Progressing ...</h3></span>
			<div class="loader"></div>
			<div class="row">
				<div class="card">
	                <div class="card-body">
	                	<h4>
	                  We're searching billions of files for similar text to your input. This may take some time, depending on the size of your input and other factors.
						<br/>
						This job will continue even if you leave the page.
						You will receive the results of a job in your email box
						</h4>
	                </div>
	              </div>	
					
			</div>
		</div>
		<div id = "info-exist-box">
			<div class="row">
				<button  class="btn btn-white btn-round btn-just-icon" id = "prev-reference-button">
	                  <i class="material-icons">keyboard_arrow_left</i>
	                  <div class="ripple-container"></div>
	                </button>
	                <p class="h4" style="margin:auto 5px;" id = 'current-reference'>#</p>
	            <button  class="btn btn-white btn-round btn-just-icon" id = "next-reference-button">
	                  <i class="material-icons">keyboard_arrow_right</i>
	                  <div class="ripple-container"></div>
	                </button>
	            <p class="h4" style="margin: auto auto auto 0px;">
	            	<span class="text-rose" id = "match_count">0</span> matches from <span class="text-rose" id = "match_source_count">0</span> sources
	            </p>
			</div>
			<div class="row" id = "match-reference-url">
			</div>
			<div class="row" id = "match-reference">
			</div>
		</div>
	</div>
</div>
<style type="text/css">


</style>
<script type="text/javascript">

	function setToLoadingStatus()
	{
		$('#document-content').css('opacity', 0.1);
		$('#document-content-loading-spinner').show();
		$('#info-progressing-box').show();
		$('#info-exist-box').hide();
	}
	function setToOriginalStatus()
	{
		$('#document-content').css('opacity', 1.0);
		$('#document-content-loading-spinner').hide();
		$('#info-progressing-box').hide();
		$('#info-exist-box').show();
	}

	$( document ).ready(function() {
		setToLoadingStatus();
	      var raw_data = $('#document-content').html();
          $.ajax({
          	type:'post',
          	dataType: "json",
          	url: $("#doAnalysis_texturl").val(),
          	data:{_token: "{{ csrf_token() }}",
          	text_data: raw_data
          },
          	success: function(response1){
          		if(response1.status == 'success')
          		{
          			setToOriginalStatus();
          			$('#document-content').html('');
          			myfunction(response1);
          			
          		}
          		else
          		{
          			swal({ title:"Error!", text: response1.reason, type: "error", buttonsStyling: false, confirmButtonClass: "btn btn-success"}).then((result) => {
					      window.location.href = "{{ route('user.newsearch') }}";
					});
          		}
          	},
          	error: function(jqXhr1, textStatus1, errorThrown1) {

                swal({ title:"Error!", text: 'Error during processing', type: "error", buttonsStyling: false, confirmButtonClass: "btn btn-success"}).then((result) => {
					      window.location.href = "{{ route('user.newsearch') }}";
					});
            }
          });
	});


function myfunction(response1)
{
			var text_datas = response1.data;
  			$('.simiar-percent').html(response1.score + "%");
  			$.each(text_datas, function(index, item){
  				var str = '';
  				if(item.clusterid == -1)
  				{
  					str = "<span>";
  				}
  				else
  					str = "<span class='match exact-match' data-source-id = '" + item.clusterid + "'>";
  				str += item.text;
  				str += "</span>";
  				$('#document-content').append(str);
  			});
  			$('#match_count').html($('span.match').length);
			$('#match_source_count').html(response1.references.length);
			$('#match-reference').html('');
			$.each(response1.references, function(index, item){
				var str = "<div class='card' id = 'reference-pad-" + index + "'><div class='card-body'>";
				str += item;
				str += "</div></div>";
				$('#match-reference').append(str);
			});
			$('#match-reference .card .refurl').hide();
			$('#match-reference-url').html('');
			$.each($('#match-reference .refurl'), function(){
				var temp_url = $(this).html();
				$('#match-reference-url').append('<a class="text-info" href = "' 
					+ temp_url 
					+ '" target="_blank">' + temp_url + '</a>');
			});

			$('#match-reference').hide();

			$('#current-reference').attr('reference-index', -1);

			$('span.match').click(function(){
				var index = $(this).attr('data-source-id');
				$('#match-reference .card').hide();
				$('#match-reference').show();
				$('#match-reference #reference-pad-' + index).show();
				$(this).siblings().removeClass('focus');
				$(this).addClass('focus');
				$('#match-reference-url .text-info').hide();
				$('#match-reference-url .text-info').eq(index).show();
				$('#current-reference').attr('reference-index', ($('span.match').index($(this)) + 1));
				$('#current-reference').html("#" + ($('span.match').index($(this)) + 1));
			});
			
			$('#prev-reference-button').click( function(){
				var index = parseInt($('#current-reference').attr('reference-index')) - 1;
				if(index < 0 || index >= $('span.match').length)
				{
					return;
				}
				$('span.match').removeClass('focus');
				$('span.match').eq(index).addClass('focus');
				$('#current-reference').attr('reference-index', index);
				$('#current-reference').html("#" + (index + 1));
				$('#match-reference .card').hide();
				$('#match-reference').show();
				$('#match-reference #reference-pad-' + parseInt($('span.match').eq(index).attr('data-source-id'))).show();
				$('#match-reference-url .text-info').eq(index).show();
				$('span.match').removeClass('focus');
				$('span.match').eq(index).addClass('focus');
			 	$('#document-content').scrollTop($('#document-content').scrollTop() + $('span.match').eq(index).position().top - $('#document-content').height()/2 + $('span.match').eq(index).height()/2, 2000);
				$('#match-reference-url .text-info').hide();
				$('#match-reference-url .text-info').eq(parseInt($('span.match').eq(index).attr('data-source-id'))).show();

				$('#current-reference').attr('reference-index', index);
			});
			$('#next-reference-button').click( function(){
				var index = parseInt($('#current-reference').attr('reference-index')) + 1;
				if(index < 0 || index >= $('span.match').length)
				{
					return;
				}
				$('#current-reference').attr('reference-index', index);
				$('#current-reference').html("#" + (index + 1));
				$('#match-reference .card').hide();
				$('#match-reference').show();
				$('#match-reference #reference-pad-' + parseInt($('span.match').eq(index).attr('data-source-id'))).show();
				$('#match-reference-url .text-info').eq(index).show();
				$('span.match').removeClass('focus');
				$('span.match').eq(index).addClass('focus');
			 	$('#document-content').scrollTop($('#document-content').scrollTop() + $('span.match').eq(index).position().top - $('#document-content').height()/2 + $('span.match').eq(index).height()/2 , 2000);
				$('#match-reference-url .text-info').hide();
				$('#match-reference-url .text-info').eq(parseInt($('span.match').eq(index).attr('data-source-id'))).show();

				$('#current-reference').attr('reference-index', index);
			});

			swal({ title:"Plagiarism rate is " + response1.score + "%", text: "", type: "success", buttonsStyling: false, confirmButtonClass: "btn btn-success"});

}

 
  function zoom_in_text()
  {
  	var current_font_size = parseInt($('#document-content span').css("font-size"));
  	current_font_size = Math.ceil(current_font_size * 1.2);
  	$('#document-content span').css("font-size", current_font_size);
  }

  function zoom_out_text()
  {
  	var current_font_size = parseInt($('#document-content span').css("font-size"));
  	current_font_size = Math.ceil(current_font_size / 1.2);
  	$('#document-content span').css("font-size", current_font_size);
  }
</script>
@stop