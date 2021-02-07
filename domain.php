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
                <th>Domain</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
			<?php
			session_start();
			$query = "SELECT * FROM `virtual_domains`";
			$result = mysqli_query($conn, $query);

			while ($array_result = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td>".$array_result['id']."</td>";
				echo "<td>".$array_result['name']."</td>";
				echo "<td><button type='button' data-id='".$array_result['id']."' data-domain='".$array_result['name']."'  class='btn btn-default editButton'>Edit</button><button type='button' class='btn btn-default deleteButton' data-id='".$array_result['id']."'>Delete</button></td>";
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
          	<label for="usr">Domain</label>
				<input type="text" class="form-control" id="new-domain">
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
          	<label for="usr">Domain</label>
			<input type="text" class="form-control" id="edit-domain">
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
			domain : $('#new-domain').val()
	    }
	    setTimeout(function(){ 
	    	$.ajax({
				url: "create_domain.php",
				type: "post",
				dataType: "json",
				data : post_data,
				success : function(data)
	              {
	                if (data.success == 1) {
	                	$.ajax({
		                    url: "domain.php",
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
		domain = $(this).data('domain');
		// password = $(this).data('password');
		id = $(this).data('id');


		$('#edit-domain').val(domain);
		$('#myModal').modal('show');
	});



	$('#mail-change-btn').click(function()  {

		
		var post_data = {
			domain : $('#edit-domain').val(),
			id : id
	    }
		$('#myModal').modal('hide');

		setTimeout(function(){ 
			$.ajax({
			url: "update_domain.php",
			type: "post",
			dataType: "json",
			data : post_data,
			success : function(data)
              {
                if (data.success == 1) {
                  	$.ajax({
	                    url: "domain.php",
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
				url: "delete_domain.php",
				type: "post",
				dataType: "json",
				data : post_data,
				success : function(data)
	              {
	                if (data.success == 1) {
	                    $.ajax({
							url: "domain.php",
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