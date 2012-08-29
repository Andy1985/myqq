<?php
    require_once "../models/UserService.class.php";
    $loginUser = $_POST['username'];
    $pwd = $_POST['password'];

    $userModel = new UserService();
    $res = $userModel->getUser($loginUser,md5($pwd));

    if (count($res))
    {
        session_start();
        $_SESSION['loginuser'] = $loginUser;
        echo "ok";
    }
    else
    {
        echo "error";
    }
?>
