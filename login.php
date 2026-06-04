<?php
// login.php - Multi-Role Authorization Handler
session_start();
require_once "db_connect.php";

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $password = $_POST['password'];

    $query = "SELECT u.*, r.Role_Name FROM Users u 
              LEFT JOIN Roles r ON u.Role_ID = r.Role_ID 
              WHERE u.Phone_Number = '$phone'";
              
    $result = $conn->query($query);

    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['Password_Hash'])) {
            $_SESSION['user_id'] = $user['User_ID'];
            $_SESSION['user_name'] = $user['Full_Name'];
            $_SESSION['user_role'] = $user['Role_Name'];

            if ($user['Role_Name'] == 'Administrator') {
                header("Location: admin_crud.php"); 
                exit();
            } else {
                header("Location: index.html"); 
                exit();
            }
        } else { $error_message = "Invalid password."; }
    } else { $error_message = "No account matching that phone number."; }
}
?>
