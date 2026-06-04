<?php
require_once "db_connect.php";

function adminCreateUser($conn, $name, $phone, $password, $township, $role_id) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO Users (Full_Name, Phone_Number, Password_Hash, Township_Name, Role_ID) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $name, $phone, $hash, $township, $role_id);
    return $stmt->execute();
}

function adminDisplayUsers($conn) {
    $query = "SELECT u.User_ID, u.Full_Name, u.Phone_Number, u.Township_Name, u.Identity_Verified, r.Role_Name 
              FROM Users u 
              JOIN Roles r ON u.Role_ID = r.Role_ID";
    return $conn->query($query);
}


function adminUpdateUserRole($conn, $user_id, $new_role_id) {
    $stmt = $conn->prepare("UPDATE Users SET Role_ID = ? WHERE User_ID = ?");
    $stmt->bind_param("ii", $new_role_id, $user_id);
    return $stmt->execute();
}

function adminDeleteUser($conn, $user_id) {
    $stmt = $conn->prepare("DELETE FROM Users WHERE User_ID = ?");
    $stmt->bind_param("i", $user_id);
    return $stmt->execute();
}
?>
