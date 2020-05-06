<style type="text/css">
    #file-list-container {
        width: 100%;
        padding: 10px;
    }

    .filetype-icon {
        width: 50px;
        height: auto;
        margin-right: 10px;
    }
    #modal-loader {
      position: absolute;
      left: 50%;
      top: 50%;
      z-index: 9999;
      width: 150px;
      height: 150px;
      margin: -75px 0 0 -75px;
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #3498db;
      width: 120px;
      height: 120px;
      -webkit-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    .animate-bottom {
      position: relative;
      -webkit-animation-name: animatebottom;
      -webkit-animation-duration: 1s;
      animation-name: animatebottom;
      animation-duration: 1s
    }

    @-webkit-keyframes animatebottom {
      from { bottom:-100px; opacity:0 } 
      to { bottom:0px; opacity:1 }
    }

    @keyframes animatebottom { 
      from{ bottom:-100px; opacity:0 } 
      to{ bottom:0; opacity:1 }
    }
    .modal-body {
        height: 300px;
    }
    #upload-content {
      color: black;
    }
    #file-input{
      color: white;
    }
    #file-input::placeholder {
      color: rgba(255, 255, 255, 0.6);
    }
    #upload-button {
      background-image: url({{asset('images/document-arrow-upload-icon.png')}});     
      height: -webkit-fill-available;
      width: -webkit-fill-available; 
      width: 100px; 
      height: 100px; 
      background-size:100% 100%; 
      background-color: transparent;
      border: none;
    }
    #upload-button:focus{
      outline: none;
    }
    #upload-button:active{
      opacity: 0.9;
      width: 90;
      height: 90;
    }

    .loader {
      height: 4px;
      width: 120%;
      margin-left: -10%;
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

</style>

    <input id = "asset_image_url" value="{{asset('images')}}" hidden>
    <input id = "process_window_url" value="{{route('process.index')}}" hidden>
    <input id = "current_file" hidden>

    <div class="row justify-content-center ml-auto" id = "upload-content">
      <div  style="display: block; width: 100%; margin: 0px auto; text-align: center; padding: 20px;"><h3>Press the upload button to process file.</h3></div>
        <br/>
        <form action="{{route('upload')}}" id = "upload-form" enctype="multipart/form-data" class="align-items-center" method="POST">
                {{ csrf_field() }}
                <input type = "file" id = "file-input" name = "file[]"
                class = "form-control-file border" accept=".docx" style="display: none">
                <button  id = "upload-button" type="button"></button>
                <div class="loader" id = "uploading-button" style="display: none"></div> 
               
        </form>

        <div  style="display: block; width: 100%; margin: 0px auto; text-align: center; padding: 10px;">
    <p>Upload your paper and start check for plagiarism.</p></div>

    </div>

    <div class="row justify-content-center" id = "file-process-container" style="display: none;">
        <div class="row" id = "file-list-container">
            <h3>Uploaded File</h3>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Type</th>
                        <th>File Size (KB)</th>
                        <th>Text Size</th>
                        <th>Price(USD)</th>
                        <th>Uploaded Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id = "file-list">
                    @if( isset($uploaded_files))
                    @foreach($uploaded_files as $uploaded_file)
                    <tr id = "{{'file-'.$uploaded_file['id']}}">
                        <td>
                            @if ($uploaded_file['file_format'] == 'pdf')
                            <img class = "img-fluid float-left filetype-icon" src = "{{asset('images/pdf.png')}}">
                            @else
                             <img class = "img-fluid float-left filetype-icon" src = "{{asset('images/word.png')}}">
                             @endif
                            <span class="">{{$uploaded_file['file_name']}}</span>
                        </td>
                        <td>{{$uploaded_file['file_format']}}</td>
                        <td>{{number_format($uploaded_file['file_size'] / 1024, 2)}}</td>
                        <td>{{$uploaded_file['text_size']}}</td>
                        <td>{{$uploaded_file['price']}}</td>
                        <td>{{$uploaded_file['created_at']}}</td>
                        <td>
                            @if ($uploaded_file['status'] == 0)
                                <span>Uploaded</span>
                            @elseif ($uploaded_file['status'] == 1)
                                <span>Processing...</span>
                            @elseif ($uploaded_file['status'] == 2)
                                <span>Processed</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group float-left">
                                @if ($uploaded_file['status'] == 0)
                                    <button  class="btn btn-success" onclick="processFile({{$uploaded_file['id']}})">Process</button>
                                    <button  class="btn btn-danger" onclick="deleteFile({{$uploaded_file['id']}})">Delete</button>
                                @elseif ($uploaded_file['status'] == 1)
                                    <button  class="btn btn-success" disabled>Process</button>
                                    <button  class="btn btn-danger" disabled>Delete</button>
                                @elseif ($uploaded_file['status'] == 2)
                                    <button  class="btn btn-success">View Report</button>
                                    <button  onclick="deleteFile({{$uploaded_file['id']}})" class="btn btn-danger">Delete</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        
    </div>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Plagiarism Checker</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

              <div class="input-group form-group">
                <div class="input-group-prepend">
                 <span class="input-group-text">Email:</span>
                </div>
                <input type="email" class="form-control" id="user-email">
                
              </div>
              <div class="input-group form-group">
                  <button class="btn btn-success" id = "process-file" onClick = "do_process()">Process File</button>
              </div>
            </div>
            <div id="modal-loader" style="display: none;"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" id = "close-modal-btn">Close</button>
            </div>
            
          </div>
        </div>

    
        <?php
          $no_assigned_chance = false;
          if(Auth::check() && auth() -> user()->membership->current_count <= 0)
          {
            $no_assigned_chance = true;
          }
        ?>

    <script>
        var no_assigned_chance = {!! json_encode($no_assigned_chance) !!};

        function my_alert(type, message)
          {
            Swal.fire({
                type: type,
                title: message,
                showConfirmButton: true,
              });
          }
        if(no_assigned_chance)
        {
          my_alert('error', 'There is no chance' + '\n' + 'Please purchase new chances');
        }
        var asset_image_url = $('#asset_image_url').val();
        var form = document.getElementById('upload-form');
        var request = new XMLHttpRequest();
        var selected_file_name = '';

        $("#upload-button").click(function(){
          if(no_assigned_chance)
          {
            my_alert('error', 'There is no chance' + '\n' + 'Please purchase new chances');
            return;
          }
          $("#file-input").trigger('click');
        });
        $("#upload-form").on('change','#file-input' , function(){
            selected_file_name = $('#file-input').val();
            if(selected_file_name != "")
            {
                $("#uploading-button").show();
                $("#upload-button").prop('disabled', true);
                var formdata = new FormData(form);

                request.open('post', '/upload');
                request.addEventListener("load", transferComplete);
                request.send(formdata);
            }
        });

       

        function transferComplete(data){

             console.log(data.currentTarget.response);
             var responsedata = $.parseJSON(data.currentTarget.response);
             if(responsedata.success == 'done')
             {
                var file_data = responsedata.data;
                $("#upload-button").prop('disabled', false);
                $("#uploading-button").hide();
                $('#current_file').val(file_data['id']);
                $('#myModal').modal('show');
                $('#close-modal-btn').on("click", function(){ 
                    deleteFile(file_data['id']);
                });
             }
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function deleteFile(file_id){
            $.ajax({
                type: "delete",
                dataType: "json",
                url: 'deletefile/'+file_id,
                data:{_token: "{{ csrf_token() }}"
                },
                success: function(response){
                    if(response.success == 'done')
                    {
                        $("#file-" + file_id).remove();
                        if ( $('#file-list').children().length == 0 ) {
                            $('#file-process-container').hide();
                            $('#upload-content').show();
                            $("#upload-button").prop('disabled', false);
                        }
                    }
                    else
                    {

                    }
                }
            })
        }

        function processFile(file_id){
            $('#current_file').val(file_id);
            $('#myModal').modal('show');
        }

function do_process(){
    $('#modal-loader').show();
    $('.modal-body *').prop('disabled',true);
    $('.modal-body *').css('opacity', '0.1');
    var current_file = $('#current_file').val();
    var email = $('#user-email').val();
     $.ajax({
            type: "get",
            dataType: "json",
            url: 'setemail/'+current_file,
            data:{_token: "{{ csrf_token() }}",
            email: email
            },
            success: function(response){
                if(response.success == 'done')
                {
                    $('.modal-body *').css('opacity', '1.0');
                    $('#modal-loader').hide();
                    $('.modal-body *').prop('disabled',false);
                    $('#myModal').modal('hide');

                     window.location.href = $('#process_window_url').val();
                }
                else
                {

                }
            }
        })
}

        </script>
</div>
