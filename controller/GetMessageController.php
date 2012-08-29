<?php
    require_once "../models/MessageService.class.php";

    header("Content-Type: text/xml;charset=utf-8");
    header("Cache-Control: no-cache");

    $getter = $_POST['getter'];
    $sender = $_POST['sender'];

    $messageService = new MessageService();
    $res = $messageService->getMessage($getter,$sender);

    echo $res;

?>
