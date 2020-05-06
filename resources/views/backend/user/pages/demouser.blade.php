@extends('backend.user.layouts.default')
@section('title', 'Plagiarismchecker | Demoview of Plagiarism Tool')
@section('description', "Plagiarismchecker | Demoview of Plagiarism Tool")
@section('content')
<style type="text/css">
	.col-repo{
		padding: 1em 3em;

	}
	.col-repo span{
		font-size: 1.3em;
	}
	#purchase-price-modal {
		font-size: 3em !important;
	}	

	.self-chance-panel {
		color: #00bcd4;
		font-size:1.3em;
	}
</style>
<div  id="purchase_modal" class="modal fade">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Purchase membership</h4>
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
			<form class="needs-validation"  id="payment-form" action="{{ route('cardinity_user') }}" method="POST">
				{{ csrf_field() }}
				<div class="form-group col-md-6 col-sm-12">
					<label for= "purchase-document-count-modal">Number of documents : </label>
					<input id = "purchase-document-count-modal" type="number" class="form-control" value="0" name="purchase_document_count"/>
				</div>
				<div class="form-group col-md-6 col-sm-12">
					<label for= "purchase-terms-count-modal">Term of using the service (months): </label>
					<input id = "purchase-terms-count-modal" type="number" class="form-control" value="0" name="purchase_terms_count"/>
				</div>
				<div class="form-group col-md-12 col-sm-12">
					<p id = "purchase-price-modal">Price: <span id = "purchase-price-value-modal">0</span></p>
					<input type="hidden" name="amount" value="0" id = "purchase-price-amount-modal">
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
			</form>
	   
		</div>
		<div id="user-modal-loader" style="display: none;"></div>
		<div class="modal-footer form-group">
			 <button type="button" class="btn btn-info form-control" data-dismiss="modal" id = "save-university">Save</button>
		  <button type="button" class="btn btn-danger form-control" data-dismiss="modal" id = "close-modal-btn-3">Close</button>
		</div>
	</div>
</div>
</div>
	@if(session('errors'))
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<i class="material-icons">close</i>
			</button>
			<span>
				<b> Error - </b> {{ session('errors') }}</span>
		</div>
	@endif
	@if(session('done'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<i class="material-icons">close</i>
			</button>
			<span>
				<b> Success - </b> {{ session('done') }}</span>
		</div>
	@endif
	<div class="col-md-12">
		<div class="row">
		 <p class="col-md-4 col-sm-12 self-chance-panel"><strong>Terms(month) : <span id = "self-terms"> 12 </span></strong></p>
		 <button type = "button" class = "col-md-3 col-sm-12 btn btn-primary" onclick="upload_file()">Upload file and check for plagiarism</button>
		 <p class="col-md-4 col-sm-12  text-right self-chance-panel"><strong>Submissions :  <span id = "self-chance">  </span></strong></p>
		 <button type = "button" onclick="purchase()" class="btn btn-info">Purchase</button>
		</div>
      <div class="card">
		    <div class="card-header card-header-danger card-header-icon">
		      <div class="card-icon">
		        <i class="material-icons">assignment_ind</i>
		      </div>
		      <h4 class="card-title">World University</h4>
		    </div>

          <div class="card-body">
          		<div class="row col-repo">
                  <p class="col-md-6 col-sm-12">Name : <span id = "self-name">Demo User</span></p>
              </div>

              <div class="row col-repo">
              	<span class="col-md-12">Users</span>
              	  <table class="table table-striped table-hover">
              	  	<thead>
	                    <tr>
	                        <th>Name</th>
	                        <th>Email</th>
	                        <th>Terms(month)</th>
	                        <th>Submissions</th>
	                        <th class="text-right">Action</th>
	                    </tr>
	                </thead>
	                <tbody id = "child-data">
	                	
	                </tbody>
              	  </table>

                   <div class="row col-repo">
                   	 <div class="row col-repo">
                   	 	 <button  class="btn btn-info" onclick="add_user()">Add User</button>
                   </div>
              </div>

          </div>
      </div>
  </div>
   <div  id="self_edit_modal" class="modal fade">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">University</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
            	<div class="form-group col-md-6 col-sm-12">
            		<label for= "self-name-modal">Name : </label>
            		<input id = "self-name-modal" type="text" class="form-control" />
            	</div>
            	<div class="form-group col-md-6 col-sm-12">
            		<label for= "self-email-modal">Email : </label>
            		<input id = "self-email-modal" type="email" class="form-control" />
            	</div>
            	<div class="form-group col-md-6 col-sm-12">
            		<label for= "self-password-modal">password : </label>
            		<input id = "self-password-modal" type="password" class="form-control" />
            	</div>

            </div>
            <div id="self-modal-loader" style="display: none;"></div>
            <div class="modal-footer form-group">
        	 	<button type="button" class="btn btn-info form-control" data-dismiss="modal" id = "save-self" onclick="save_self()">Save</button>
              <button type="button" class="btn btn-danger form-control" data-dismiss="modal" id = "close-modal-btn-1">Close</button>
            </div>
        </div>
    </div>
</div>

   <div  id="user_edit_modal" class="modal fade">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Teacher</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            	<div class="form-group col-md-6 col-sm-12">
            		<label for= "user-name-modal">Name : </label>
            		<input id = "user-name-modal" type="text" class="form-control" />
            	</div>
            	<div class="form-group col-md-6 col-sm-12">
            		<label for= "user-email-modal">Email : </label>
            		<input id = "user-email-modal" type="email" class="form-control" />
            	</div>
            	<div class="form-group col-md-12 col-sm-12">
            		<label for= "user-password-modal">Password : </label>
            		<input id = "user-password-modal" type="password" class="form-control" />
            	</div>
            	<div class="form-group col-md-6 col-sm-12">
            		<label>Submissions : <span id = user-chance-current-count-modal>80</span> + <span id = user-chance-add-count-modal>80</span></label>
            		<div class="slider slider-rose" id = "user-chance-modal"></div>
            	</div>
            </div>
            <input id = "user-id" hidden />
            <div id="user-modal-loader" style="display: none;"></div>
            <div class="modal-footer form-group">
        	 	<button type="button" class="btn btn-info form-control" data-dismiss="modal" id = "save-user" onclick="save_user()">Save</button>
              <button type="button" class="btn btn-danger form-control" data-dismiss="modal" id = "close-modal-btn-2">Close</button>
            </div>
        </div>
    </div>
</div>

  <input hidden id = "current_count" value="{{ session('demo_amount') }}">
  <input hidden id = "terms" value="12">
  <input hidden id = "user_save_url" value="{{route('user.demosave')}}">
  <input hidden id = "user_delete_url" value="{{route('user.demodelete')}}">
  <input hidden id = "self_save_url" value="{{route('user.demosave_self')}}">
  <input hidden id = "self_demo_data_url" value="{{route('user.demoself')}}">
<script type="text/javascript">

	var user_chance = document.getElementById('user-chance-modal');
	var mode = 0;
	var my_data = null;
	var my_children = null;

	noUiSlider.create(user_chance, {
		start: 0,
		connect: [true,false],
		range: {
			min: 0,
			max: 100
		}
	});

	 user_chance.noUiSlider.on('update', function( values, handle ) {
      $("#user-chance-add-count-modal").text(Math.round(user_chance.noUiSlider.get()));

    });

	function refresh()
	{
		$.ajax({
	        type: "get",
	        dataType: "json",
	        url: $('#self_demo_data_url').val(),
	        data:{ _token: "{{ csrf_token() }}"
	        },
	        success: function(response){
	        	var self = response.data;
	        	$("#self-terms").text('12');
	        	$("#self-chance").text(self.submission_amount);
	        	$("#current_count").val(self.submission_amount);
	        	$("#child-data").empty();
	        	my_children = self.demo_child;
	        	$.each(self.demo_child, function(index, item){
	        		
	        		var child_data = "<tr><td hidden class = 'child-id'>" + item.id + "</td>" +
	        						"<td>" + item.name + "</td>" +
	        						"<td>" + item.email + "</td>" + 
	        						"<td>" + item.terms + "</td>" +
	        						"<td>" + item.chance + "</td>" +
	        						"<td class='text-right'>" + "<button type='button' rel='tooltip' class='btn btn-success btn-simple btn-sm' rel='tooltip'  data-original-title='Edit User' title='Edit User' onclick='edit_child_user(" + index + ")'><i class='material-icons'>edit</i></button>" + 
	        						"<button type='button' rel='tooltip' class='btn btn-danger btn-simple btn-sm' rel='tooltip'  data-original-title='Delete User' title='Delete User' onclick='delete_child_user(" + index + ")'><i class='material-icons'>close</i></button></td></tr>";
	        		$("#child-data").append(child_data);
	        	});
	        	if(self.demo_child.length == 0)
	        	{
	        		var child_data = "<td class='text-center' colspan = 5 >No records yet</td>";
	        		$("#child-data").append(child_data);
	        	}

	        }
    	})
	}

	refresh();
	function my_alert(type, message)
	{
	  Swal.fire({
	      type: type,
	      title: message,
	      showConfirmButton: true,
	    });
	}

	function upload_file()
	{
		my_alert('warning', 'This is demo version, no checking for plagiarism available in demo');
	}
	function edit_self()
	{
		$('#self_edit_modal').modal('show');
		$('#self-name-modal').val(my_data.name);
		$('#self-email-modal').val(my_data.email);
		$('#self-password-modal').val('');

	}
	function save_self()
	{
		var self_name = $("#self-name-modal").val();
		var self_email = $("#self-email-modal").val();
		var self_password = $("#self-password-modal").val();
		if(self_name == '')
		{
			my_alert('error', "Please fill the name box");
			return;
		}
		if(self_email == '')
		{
			my_alert('error', "Please fill the email box");
			return;
		}


		$.ajax({
	        type: "post",
	        dataType: "json",
	        url: $('#self_save_url').val(),
	        data:{ _token: "{{ csrf_token() }}",
	               self_name: self_name,
	               self_email: self_email,
	               self_password: self_password,
	        },
	        success: function(response){
	            if(response.status == 'done')
	            {	            	
              		my_alert('success', "Successfully updated");
	              	refresh();
	            }
	            else
	            {
	               	my_alert('error', "Error");
	            }
	        },
	        error: function(){
	        	my_alert('error', "Network Error");
	        }
    	})
	}
	function add_user()
	{
		var current_count = parseInt($("#current_count").val());
		if(current_count <= 0)
		{
			my_alert('error', "Please purchase new chance");
			return;
		}
		user_chance.noUiSlider.updateOptions({
			start:0,
			range: {
		        'min': 0,
		        'max': current_count
		    }
		});
		
		$('#user_edit_modal').modal('show');
		$('#user_edit_modal input').val('');
		$("#user-chance-current-count-modal").text('0');
		$("#user-chance-add-count-modal").text('0');
		mode = 1;
		

	}
	function edit_child_user(id)
	{
		mode = 2;
		var current_count = parseInt($("#current_count").val());

		
		
		$("#user-name-modal").val(my_children[id].name);
		$("#user-email-modal").val(my_children[id].email);
		$("#user-password-modal").val(my_children[id].password);
		$("#user-chance-current-count-modal").text(my_children[id].chance);
		$("#user-chance-add-count-modal").text("0");
		if(current_count <= 0)
		{
			user_chance.parentElement.hidden = true;
		}
		else{
			user_chance.parentElement.hidden = false;
			user_chance.noUiSlider.updateOptions({
			start:0,
			range: {
		        'min': 0,
		        'max': current_count
		    }
			});
		}

		$('#user_edit_modal').modal('show');

	}
	function save_user()
	{
		var user_name = $("#user-name-modal").val();
		var user_email = $("#user-email-modal").val();
		var user_password = $("#user-password-modal").val();
		var user_chance_count = Math.round(user_chance.noUiSlider.get());
		var terms = $("#terms").val();
		var id = $("#user-id").val();
		if(user_name == '')
		{
			my_alert('error', "Please fill the name box");
			return;
		}
		if(user_email == '')
		{
			my_alert('error', "Please fill the email box");
			return;
		}
		if(user_password == '' && mode == 1)
		{
			my_alert('error', "Please fill the password box");
			return;
		}
		$.ajax({
	        type: "get",
	        dataType: "json",
	        url: $('#user_save_url').val(),
	        data:{ _token: "{{ csrf_token() }}",
	               user_name: user_name,
	               user_email: user_email,
	               user_password: user_password,
	               terms:terms,
	               user_chance:user_chance_count,
	               mode:mode,
	               id:id,
	        },
	        success: function(response){
	        	debugger;
	            if(response.status == 'done')
	            {
	            	if(mode == 1)
	              		my_alert('success', "New user was added successfully");
	              	if(mode == 2)
	              		my_alert('success', "User successfully updated");
	              	refresh();
	            }
	            else
	            {
	               	my_alert('error', "Error");
	            }
	        }
    	})

	}

	function delete_child_user(index)
	{
		Swal.fire({
		  title: 'Are you sure about deleting this user?',
		  text: "You won't be able to revert this!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
		  if (result.value) {

		  	$.ajax({
	        type: "get",
	        dataType: "json",
	        url: $('#user_delete_url').val(),
	        data:{ 
	        	_token: "{{ csrf_token() }}",
	        	email: my_children[index].email,
	        },
	        success: function(response){
	        	 Swal.fire(
			      'Deleted!',
			      'User has been deleted.',
			      'success'
		    	)
	        	 refresh();
	        
	        }
    	})


		   
		  }
		})
	}

	function purchase()
	{
		$("#purchase_modal").modal('show');
	}

</script>





 


  <script>
	  function getPrice()
	  {
		var role = $("#role").val();
		var doc_count = $("#purchase-document-count-modal").val();
		var term_count = $("#purchase-terms-count-modal").val();
		var price = 0;
		if(role == "1")
		{
			price = parseInt(doc_count) * parseInt(term_count) * 2; 
		}
		if(role == "2")
		{
			price = parseInt(doc_count) * parseInt(term_count) * 2; 
		}
		if(role == "3")
		{
			price = parseInt(doc_count) * parseInt(term_count) * 2; 
		}
		if(role == "4")
		{
			price = parseInt(doc_count) * parseInt(term_count) * 2; 
		}
		$("#purchase-price-value-modal") . text(price);
		$("#purchase-price-amount-modal") . val(price);
	  }
	  
	  $("#purchase-document-count-modal").change(function(){
		  getPrice();
	  });

	  $("#purchase-terms-count-modal").change(function(){
		  getPrice();
	  });

	  $("#save-university").click(function(){
		 my_alert("warning", "This is demo, no function of purchase here. Only demonstrational purposes");
	  });
  </script>
@stop