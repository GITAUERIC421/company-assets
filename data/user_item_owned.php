<?php 
require_once('../class/Item.php'); 
require_once('../class/Employee.php');

$item_owned = $employee->item_owned();

// echo '<pre>';
// 	print_r($item_owned);
// echo '</pre>';

/*
*ang e display ra niya is ang row sa item nga ang emp na belong sa naka login nga user
*og ang status_id niya is 4, see DB value equivalent sa 4 
*/

?>

<table id="myTable-item-owned" class="table table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
	    <tr>
	        <th>Item Name</th>
	        <th>Brand</th>
	        <th>Category</th>
	        <th><center>Request</center></th>
	    </tr>
	</thead>
    <tbody>
		<?php 
		$employees = $employee->get_employees();
$categories = $item->item_categories();
$conditions = $item->item_conditions();
			foreach ($item_owned as $owned) {
				$iID = $owned['item_id'];
				$name = $owned['item_name'];
				$brand = $owned['item_brand'];
				$cat = $owned['cat_desc'];
				$status = $owned['status_desc'];
				$stat_id = $owned['status_id'];
		?>
			<tr>
				<td><?php echo $name; ?></td>
				<td><?php echo $brand; ?></td>
				<td><?php echo $cat; ?></td>
				<td align="center">
					
					<button type="button" class="btn btn-info btn-sm" onclick="request('<?php echo $iID; ?>', '1');">
					<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
					Repair</button>

					<button type="button" class="btn btn-warning btn-sm" onclick="request('<?php echo $iID; ?>', '2');">
					<span class="glyphicon glyphicon-retweet" aria-hidden="true"></span>
					Return</button>
					<button type="button" class="btn btn-warning btn-sm" onclick="fill_transfer_modal('<?php echo $iID; ?>');">
					<span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>
					Transfer</button>
					<button type="button" class="btn btn-danger btn-sm" onclick="request('<?php echo $iID; ?>', '3');">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					Default</button>
					
				</td>
			</tr>
		<?php
			}//end foreach
		 ?>
    </tbody>
</table>


<?php 
$employee->Disconnect();
 ?>
<div class="modal fade" id="modals-transfer">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				
			</div>
			<div class="modal-body">
				<!-- main form -->
					<form class="form-horizontal" role="form" id="transfer-item-form">
						<input type="hidden" id="iID-transfer">
					<div class="form-group" style="display:none">
					    <label class="control-label col-sm-3" for="catID">Category:</label>
					    <div class="col-sm-3"> 
					    	<select name="" class="btn btn-default" id="catID-transfer" style="display:none">
					    		<?php 
					    			foreach ($categories as $category) {
					    				# code...
					    			$catID = $category['cat_id'];
					    			$catDesc = ucwords($category['cat_desc']);
					    		?>
					    			<option value="<?php echo $catID; ?>"><?php echo $catDesc; ?></option>}
					    		<?php
					    			}//end foreach of category
					    		 ?>
					    	</select>
					    </div>
					  </div>

					  <div class="form-group" >
					    <label class="control-label col-sm-3" for="itemname">Item Name:</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="itemname-transfer" placeholder="Enter Item Name" autofocus>
					    </div>
					  </div>

					  <div class="form-group" id="sr" style="display:none">
					    <label class="control-label col-sm-3" for="serialNumber-transfer">Serial No.:</label>
					    <div class="col-sm-9"> 
					      <input type="text" class="form-control" id="serialNumber-transfer" placeholder="Enter Serial No">
					    </div>
					  </div>

					   <div class="form-group" id="mn" style="display:none">
					    <label class="control-label col-sm-3" for="modelNumber-transfer">Model No.:</label>
					    <div class="col-sm-9"> 
					      <input type="text" class="form-control" id="modelNumber-transfer" placeholder="Enter Model No">
					    </div>
					  </div>
					
					  <div class="form-group" id="brand-transfer" style="display: none;">
					    <label class="control-label col-sm-3" for="brand-transfer">Brand:</label>
					    <div class="col-sm-9"> 
					      <input type="text" class="form-control" id="brand-transfer" placeholder="Enter Brand">
					    </div>
					  </div>

					 <!-- <div class="form-group" style="display:none">
					    <label class="control-label col-sm-3" for="amount">Amount:</label>
					    <div class="col-sm-9"> 
					      <input type="number" step="any"  class="form-control" id="amount-transfer" placeholder="Enter Amount">
					    </div>
					  </div>		
					  
					   <div class="form-group" style="display:none">
					    <label class="control-label col-sm-3" for="purDate-transfer">Purchase Date:</label>
					    <div class="col-sm-9"> 
					      <input type="date" class="form-control" id="purDate-transfer" >
					    </div>
								</div> -->

					
				   <div class="form-group" >
					    <label class="control-label col-sm-3" for="empID-transfer">Employee:</label>
					    <div class="col-sm-9"> 
					   <select class="btn btn-default" id="empID-transfer">
					    		
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

					  <div class="form-group" style="display:none">
					    <label class="control-label col-sm-3" for="conID-transfer">Condition:</label>
					    <div class="col-sm-3"> 
						<select name="" class="btn btn-default" id="conID-transfer" disabled>
					    		<?php 
					    			foreach ($conditions as $condition) {
					    				# code...
					    				$conID = $condition['con_id'];
					    				$conDesc = ucwords($condition['con_desc']);
					    		?>
					    			<option value="<?php echo $conID; ?>"
					    			<?php echo $conDesc == 'Working' ? 'selected':''?>
					    			><?php echo $conDesc; ?></option>}
					    		<?php
					    			}//end foreach cond
					    		 ?>
					    	</select>
					    </div>
					  </div>

					  <div class="form-group"> 
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" id="btn-submit" value="add" class="btn btn-primary">Transfer
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

<!-- for the datatable of employee -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#myTable-item-owned').DataTable();
	});
	function fill_transfer_modal(iID){
	$.ajax({
			url: '../data/item_profile.php',
			type: 'post',
			dataType: 'json',
			data: { iID: iID},
			success: function (data) {
				$('#itemname-transfer').val(data.item_name);
				$('#serialNumber-transfer').val(data.item_serno);
				$('#modelNumber-transfer').val(data.item_modno);
				$('#brand-transfer').val(data.item_brand);
				$('#amount-transfer').val(data.item_amount);
				$('#purDate-transfer').val(data.item_purdate);
				$('#empID-transfer').val(data.emp_id);
				$('#catID-transfer').val(data.cat_id);
				$('#conID-transfer').val(data.con_id);
				$('#iID-transfer').val(data.item_id)//iID
				$('#modals-transfer').modal('show');
			},
			error: function (){
				alert('Error: fill_update_modal L172+');
			}
		});
		$(document).on('submit', '#transfer-item-form', function (event) {
    event.preventDefault();

    var validate = '';
	alert($('input[id=brand-transfer]').val());
    var form_data = [
        $('input[id=itemname-transfer]'), 
        $('input[id=serialNumber-transfer]'), 
        $('input[id=modelNumber-transfer]'), 
        $('input[id=brand-transfer]'), 
        $('input[id=amount-transfer]'), 
        $('input[id=purDate-transfer]')
    ];

    // Adding only input elements to the data array
    var data = {};

    for (var i = 0; i < form_data.length; i++) {
        if (form_data[i].val() && form_data[i].val().length > 0) {
            form_data[i].closest('.form-group').removeClass('has-error');
            data[i] = form_data[i].val();
            validate += i;
        } else {
            form_data[i].closest('.form-group').addClass('has-error');
        }
    }

    // Manually adding non-input elements to the data array
    data[6] = $('#empID-transfer').val();
    data[7] = $('#catID-transfer').val();
    data[8] = $('#conID-transfer').val();
    data[9] = $('#iID-transfer').val();
    if (validate === '01245') {
        $.ajax({
            url: '../data/update_item.php',
            type: 'post',
            data: {
                data: JSON.stringify(data)
            },
            success: function (resp) {
                if (resp) {
                    $('#modals-transfer').modal('hide');
                    $('#modal-message-box').find('.modal-body').text("Successfully transfered");
                    $('#modal-message-box').modal('show');
                    show_all_item();
                } else {
                    alert('Server response: ' + resp);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                alert('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    } else {
        alert('Validation failed. Please check the form.');
    }
});


}

</script>