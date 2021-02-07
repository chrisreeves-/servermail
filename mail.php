<?php
include "config.php";
session_start();

$conn = mysqli_connect($servername, $username, $password, $dbname);
?>
<button type="button" class="btn btn-default" data-dismiss="modal" id="create-btn">Create</button>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Password</th>
                <th>Email</th>
                <th>Domain_ID</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
			<?php
			session_start();
			$query = "SELECT * FROM `virtual_users`";
			$result = mysqli_query($conn, $query);

			while ($array_result = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td>".$array_result['id']."</td>";
				echo "<td>encrypted</td>";
				echo "<td>".$array_result['email']."</td>";
				echo "<td>".$array_result['domain_id']."</td>";
				echo "<td><button type='button' data-id='".$array_result['id']."' data-password='".$array_result['password']."' data-email='".$array_result['email']."' data-domainid='".$array_result['domain_id']."' data-id='".$array_result['id']."' class='btn btn-default editButton'>Edit</button><button type='button' class='btn btn-default deleteButton' data-id='".$array_result['id']."'>Delete</button></td>";
				echo "</tr>";
			}

			// $conn->close();
			?>

        </tbody>
    </table>
</div>

<div class="modal fade" id="createNew" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create</h4>
        </div>
        <div class="modal-body">
          	<label for="usr">Email:</label>
				<input type="text" class="form-control" id="new-email">
			<label for="pwd">Password:</label>
				<input type="text" class="form-control" id="new-password">
			<label for="pwd">Domain ID:</label>
				<input type="text" class="form-control" id="new-domainid" value="1">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="create-submit-btn">Submit</button>
        </div>
      </div>
      
    </div>
</div>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit</h4>
        </div>
        <div class="modal-body">
          	<label for="usr">Email:</label>
			<input type="text" class="form-control" id="edit-email">
			<label for="pwd">Password:</label>
			<input type="text" class="form-control" id="edit-password">
			<label for="pwd">Domain ID:</label>
			<input type="text" class="form-control" id="edit-domainid">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="mail-change-btn">Submit</button>
        </div>
      </div>
      
    </div>
</div>

<script>
	$(document).ready(function() {
		
	});

	var id;
	$('#create-btn').click(function() {
		$('#createNew').modal('show');
	});

	$('#create-submit-btn').click(function() {
		var post_data = {
			email : $('#new-email').val(),
			password : $('#new-password').val(),
			domainid: $('#new-domainid').val()
	    }
	    setTimeout(function(){ 
	    	$.ajax({
				url: "create_email_password.php",
				type: "post",
				dataType: "json",
				data : post_data,
				success : function(data)
	              {
	                if (data.success == 1) {
	                	$.ajax({
		                    url: "mail.php",
		                    type: "get",
		                    success: function(result){
		                      right_area.html(result);
		                      // $('#myModal').modal('hide');
		                    }
	               		});
	                }
	                if (data.success == 0) {

	                }        
	              },
	              fail: function(err)
	              {

	              }
	        });
	    }, 300);
	});

	$('.editButton').click(function() {
		email = $(this).data('email');
		// password = $(this).data('password');
		id = $(this).data('id');
		domainid=$(this).data('domainid');


		$('#edit-email').val(email);
		// $('#edit-password').val("Input new password");
		$('#edit-domainid').val(domainid);
		$('#myModal').modal('show');
	});



	$('#mail-change-btn').click(function()  {

		
		var post_data = {
			email : $('#edit-email').val(),
			password : $('#edit-password').val(),
			domainid : $('#edit-domainid').val(),
			id : id
	    }
		$('#myModal').modal('hide');

		setTimeout(function(){ 
			$.ajax({
			url: "update_email_password.php",
			type: "post",
			dataType: "json",
			data : post_data,
			success : function(data)
              {
                if (data.success == 1) {
                  	$.ajax({
	                    url: "mail.php",
	                    type: "get",
	                    success: function(result){
	                      right_area.html(result);
	                      // $('#myModal').modal('hide');
	                    }
               		});

                }
                if (data.success == 0) {
					// $('#myModal').modal('hide');
                }        
              },
              fail: function(err)
              {

              }
            });
		}, 300);

		
	});




	$('.deleteButton').click(function() {
		var post_data = {
			id : $(this).data('id')
	    }
	    if (confirm('Really delete?')) {
		    $.ajax({
				url: "delete_email_password.php",
				type: "post",
				dataType: "json",
				data : post_data,
				success : function(data)
	              {
	                if (data.success == 1) {
	                    $.ajax({
							url: "mail.php",
							type: "get",
							success: function(result){
							  right_area.html(result);
							  // $('#myModal').modal('hide');
							}
						});

	                }
	                if (data.success == 0) {

	                }        
	              },
	              fail: function(err)
	              {

	              }
	        });
		}
	});



</script>