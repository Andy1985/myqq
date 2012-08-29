<?php
    require_once "../models/MessageService.class.php";
    $sender = $_POST["loginuser"];
    $getter = $_POST["getter"];
    $con = $_POST["con"];

    $messageService = new MessageService();
    $res = $messageService->addMessage($sender,$getter,$con);
    if ($res != 1)
    {
        echo "error";
    }
    else
    {
        echo "ok";
    }
?>
