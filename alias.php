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
                <th>Source</th>
                <th>Destination</th>
                <th>Domain_ID</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
			<?php
			session_start();
			$query = "SELECT * FROM `virtual_aliases`";
			$result = mysqli_query($conn, $query);

			while ($array_result = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td>".$array_result['id']."</td>";
				echo "<td>".$array_result['source']."</td>";
				echo "<td>".$array_result['destination']."</td>";
				echo "<td>".$array_result['domain_id']."</td>";
				echo "<td><button type='button' data-id='".$array_result['id']."' data-source='".$array_result['source']."' data-destination='".$array_result['destination']."' data-domainid='".$array_result['domain_id']."' data-id='".$array_result['id']."' class='btn btn-default editButton'>Edit</button><button type='button' class='btn btn-default deleteButton' data-id='".$array_result['id']."'>Delete</button></td>";
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
          	<label for="usr">Source:</label>
				<input type="text" class="form-control" id="new-source">
			<label for="pwd">Destination:</label>
				<input type="text" class="form-control" id="new-destination">
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
          	<label for="usr">Source:</label>
			<input type="text" class="form-control" id="edit-source">
			<label for="pwd">Destination:</label>
			<input type="text" class="form-control" id="edit-destination">
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
			source : $('#new-source').val(),
			destination : $('#new-destination').val(),
			domainid: $('#new-domainid').val()
	    }
	    setTimeout(function(){ 
	    	$.ajax({
				url: "create_alias.php",
				type: "post",
				dataType: "json",
				data : post_data,
				success : function(data)
	              {
	                if (data.success == 1) {
	                	$.ajax({
		                    url: "alias.php",
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
		source = $(this).data('source');
		destination = $(this).data('destination');
		id = $(this).data('id');
		domainid=$(this).data('domainid');


		$('#edit-source').val(source);
		$('#edit-destination').val(destination);
		$('#edit-domainid').val(domainid);
		$('#myModal').modal('show');
	});



	$('#mail-change-btn').click(function()  {

		
		var post_data = {
			source : $('#edit-source').val(),
			destination : $('#edit-destination').val(),
			domainid : $('#edit-domainid').val(),
			id : id
	    }
		$('#myModal').modal('hide');

		setTimeout(function(){ 
			$.ajax({
			url: "update_alias.php",
			type: "post",
			dataType: "json",
			data : post_data,
			success : function(data)
              {
                if (data.success == 1) {
                  	$.ajax({
	                    url: "alias.php",
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
				url: "delete_alias.php",
				type: "post",
				dataType: "json",
				data : post_data,
				success : function(data)
	              {
	                if (data.success == 1) {
	                    $.ajax({
							url: "alias.php",
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