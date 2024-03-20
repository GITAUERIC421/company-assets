<?php 
require_once('../class/Item.php');

// Check if data is received via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = array();
    $data = json_decode($_POST['data'], true);
    $iN = ucwords($data[0]);
    $sN = $data[1];
    $mN = $data[2];
    $b = ucwords($data[3]);
    $a = $data[4];
    $pD = $data[5];
    $eID =44;
    $cID = $data[7];
    $coID = $data[8];
    $item = new Item();
    $response['valid'] = $item->insert_item($iN, $sN, $mN, $b, $a, $pD, $eID, $cID, $coID);

    if ($response['valid']) {
        $response['msg'] = "Item Added Successfully!";
        $response['action'] = "Add Data";
    } else {
        $response['msg'] = "Failed to add item";
    }
    echo json_encode($response);
    $item->Disconnect();
} else {

    http_response_code(405); 
    echo json_encode(array("error" => "Method Not Allowed"));
}
?>
