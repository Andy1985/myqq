<?php
require_once "../models/UserService.class.php";

$userModel = new UserService();

if ($_GET['type'] == "add")
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($userModel->addUser($username,md5($password)) == 0)
    {
        echo "ok"; 
    }
    else
    {
        echo "error";
    }
}
else if ($_GET['type'] == "del")
{
    $userid = trim($_POST['userid']);
    
    if ($userModel->deleteUser($userid) == 0)
    {
        echo "ok";
    }
    else
    {
        echo "error";
    }
}

?>
