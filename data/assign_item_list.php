<?php
// Include necessary files and initialize objects if needed
require_once('../class/Item.php');
$item = new Item();

// Fetch all items
$allItem = $item->get_all_items();
// Check if the serial number is provided in the POST request
if (isset($_POST['serno'])) {
    $serrno = $_POST['serno'];

    // Output the search results
    echo '<table id="myTable" class="table table-bordered table-hover" cellspacing="0" width="100%">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Item Serial</th>';
    echo '<th>Owner</th>';
    echo '<th>Office</th>';
    echo '<th>Category</th>';
    echo '<th><center>Action</center></th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($allItem as $i) {
        echo '<tr>';
        $fN = $i['emp_fname'];
        $mN = $i['emp_mname'];
        
        $lN = $i['emp_lname'];
        $fullName = "$fN $mN $lN";
        $fullName = ucwords($fullName);
		
        // Check if the current item matches the search serial number
        if ($i['item_serno'] == $serrno) {
			echo $i['item_serno'];
            echo '<td onclick="item_profile(\'' . $i['item_serno'] . '\');">' . $i['item_name'] . '</td>';
            echo '<td onclick="item_profile(\'' . $i['item_id'] . '\');">' . $fullName . '</td>';
            echo '<td onclick="item_profile(\'' . $i['item_id'] . '\');">' . ucwords($i['off_desc']) . '</td>';
            echo '<td onclick="item_profile(\'' . $i['item_id'] . '\');">' . ucwords($i['cat_desc']) . '</td>';
            echo '<td style="display:none" ';
            $cond = $i['con_id'];
            if ($cond == 1) {
                echo 'class="text-success"';
            }
            if ($cond == 2) {
                echo 'class="text-danger"';
            }
            echo ' onclick="item_profile(\'' . $i['item_id'] . '\');">';
            echo '<strong>' . ucfirst($i['con_desc']) . '</strong>';
            echo '</td>';
            echo '<td align="center">';
            echo '<button onclick="fill_assign_modal(\'' . $i['item_id'] . '\');" class="btn btn-warning btn-sm" id="btn-edit">';
            echo '<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>';
            echo 'Assign';
            echo '</button>';
            echo '</td>';
        }

        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    // If serial number is not provided, display the entire table
    echo '<br />';
    echo '<table id="myTable" class="table table-bordered table-hover" cellspacing="0" width="100%">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Item Serial</th>';
    echo '<th>Owner</th>';
    echo '<th>Office</th>';
    echo '<th>Category</th>';
    echo '<th><center>Action</center></th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($allItem as $i) {
        echo '<tr>';
        $fN = $i['emp_fname'];
        $mN = $i['emp_mname'];
        
        $lN = $i['emp_lname'];
        $fullName = "$fN $mN $lN";
        $fullName = ucwords($fullName);

        echo '<td onclick="item_profile(\'' . $i['item_serno'] . '\');">' . $i['item_serno'] . '</td>';
        echo '<td onclick="item_profile(\'' . $i['item_id'] . '\');">' . $fullName . '</td>';
        echo '<td onclick="item_profile(\'' . $i['item_id'] . '\');">' . ucwords($i['off_desc']) . '</td>';
        echo '<td onclick="item_profile(\'' . $i['item_id'] . '\');">' . ucwords($i['cat_desc']) . '</td>';
        echo '<td style="display:none" ';
        $cond = $i['con_id'];
        if ($cond == 1) {
            echo 'class="text-success"';
        }
        if ($cond == 2) {
            echo 'class="text-danger"';
        }
        echo ' onclick="item_profile(\'' . $i['item_id'] . '\');">';
        echo '<strong>' . ucfirst($i['con_desc']) . '</strong>';
        echo '</td>';
        echo '<td align="center">';
        echo '<button onclick="fill_assign_modal(\'' . $i['item_id'] . '\');" class="btn btn-warning btn-sm" id="btn-edit">';
        echo '<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>';
        echo 'Assign';
        echo '</button>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
}

// Disconnect or perform any necessary cleanup
$item->Disconnect();
?>

<!-- for the datatable of item -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
