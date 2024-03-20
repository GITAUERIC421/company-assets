<?php 
require_once('../class/Login.php');

// Check if form data is submitted
if(isset($_POST['data'])){
    $data = json_decode($_POST['data'], true);
    $un = isset($data[0]) ? $data[0] : null;
    $pwd = isset($data[1]) ? md5($data[1]) : null;

    if($un && $pwd) {
        $login->set_un_pwd($un, $pwd); // Setter
        $user_exist = $login->check_user();
        $result['valid'] = false;

        if($user_exist && isset($user_exist['type_id'])) {
            $result['valid'] = true;
            if($user_exist['type_id'] == 1){
                // 1 means normal employee or user
                $_SESSION['user_logged_in'] = $user_exist['emp_id'];
                $result['url'] = 'user/item-owned.php';
            } else {
                // 2 means admin 
                $_SESSION['admin_logged_in'] = $user_exist['emp_id'];
                $result['url'] = 'admin/item.php';
            }
        } else {
            $result['msg'] = "Invalid username or password";
        }
    } else {
        $result['msg'] = "Username or password missing";
    }

    // Output JSON response
    echo json_encode($result);
}

// Disconnect from database
$login->Disconnect();
?>
