<?php 
require_once('../class/Item.php'); 
require_once('../class/Employee.php'); 
include("../include/footer.php");

$employees = $employee->get_employees();
$categories = $item->item_categories();
$conditions = $item->item_conditions();

?>
<div class="modal fade" id="modal-add-item">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				
			</div>
			<div class="modal-body">
				<!-- main form -->
					<form class="form-horizontal" role="form" id="add-item-form">
					<div class="form-group">
					    <label class="control-label col-sm-3" for="catID">Category:</label>
					    <div class="col-sm-3"> 
					    	<select name="" class="btn btn-default" id="catID">
					    		<?php 
					    			foreach ($categories as $category) {
					    				# code...
					    			$catID = $category['cat_id'];
					    			$catDesc = ucwords($category['cat_desc']);
					    		?>
					    			<option value="<?php echo $catID; ?>"><?php echo $catDesc; ?></option>
					    		<?php
					    			}//end foreach of category
					    		 ?>
					    	</select>
					    </div>
					  </div>

					  <div class="form-group">
					    <label class="control-label col-sm-3" for="itemname">Item Name:</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="itemname" placeholder="Enter Item Name" autofocus>
					    </div>
					  </div>

					  <div class="form-group" id="sr">
					    <label class="control-label col-sm-3" for="serialNumber">Serial No.:</label>
					    <div class="col-sm-9"> 
					      <input type="text" class="form-control" id="serialNumber" placeholder="Enter Serial No">
					    </div>
					  </div>

					   <div class="form-group" id="mn">
					    <label class="control-label col-sm-3" for="modelNumber">Model No.:</label>
					    <div class="col-sm-9"> 
					      <input type="text" class="form-control" id="modelNumber" placeholder="Enter Model No">
					    </div>
					  </div>
					
					  <div class="form-group" id="b">
					    <label class="control-label col-sm-3" for="brand">Brand:</label>
					    <div class="col-sm-9"> 
					      <input type="text" class="form-control" id="brand" placeholder="Enter Brand">
					    </div>
					  </div>

					  <div class="form-group" style="display:none">
					    <label class="control-label col-sm-3" for="amount">Amount:</label>
					    <div class="col-sm-9"> 
					      <input type="number" step="any" value="300" class="form-control" id="amount" placeholder="Enter Amount">
					    </div>
					  </div>		
					 
					   <div class="form-group">
					    <label class="control-label col-sm-3" for="purDate">Purchase Date:</label>
					    <div class="col-sm-9"> 
					      <input type="date" class="form-control" id="purDate" >
					    </div>
					  </div>	

					
				   <div class="form-group" style="display:none">
					    <label class="control-label col-sm-3" for="empID">Employee:</label>
					    <div class="col-sm-9"> 
					    	<select class="btn btn-default" id="empID">
								<option value='44'>0</option>
								<?php 
									foreach ($employees as $empployee) {
										# code..
									$fN = $empployee['emp_fname'];
									$mN = $empployee['emp_mname'];
									$lN = $empployee['emp_lname'];
									$fullName = "$fN $mN $lN";
									$fullName = ucwords($fullName);
									$emp_id = $empployee['emp_id'];
								?>	
									<option value="<?php echo $emp_id; ?>"><?php echo $fullName; ?></option>}
								<?php
									}//end foreach
								 ?>					    		
					    	</select>
					    </div>
					  </div>	

					 <!-- old cat pos -->

					  <div class="form-group">
					    <label class="control-label col-sm-3" for="conID">Condition:</label>
					    <div class="col-sm-3"> 
					    	<select name="" class="btn btn-default" id="conID">
					    		<option value="4">Working</option>
					    	</select>
					    </div>
					  </div>

					  <div class="form-group"> 
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" id="btn-submit" value="add" class="btn btn-primary">Save
					      <span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
					      </button>
					    </div>
					  </div>
					</form>
				<!-- /main form -->
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-asign-item">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <!-- Search Input -->
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search by Serial Number" id="searchInput">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" id="searchBtn">Search</button>
                    </span>
                </div>
            </div>

            <div class="modal-body" id="items">
                <!-- All Items List -->
                <div id="allItemList"></div>

                <!-- Search Results -->
                <div id="searchResults"></div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
	// Event listener for the search button
	$("#searchBtn").click(function () {
		// Get the serial number from the search input
		var serialNumber = $("#searchInput").val();
		$.ajax({
			type: "POST", 
			url: "../data/assign_item_list.php",  
			data: { serno: serialNumber },
			success: function (data) {
				$("#items").html(data);
			}
		});
	})
});
</script>
