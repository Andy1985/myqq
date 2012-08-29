<?php
require_once "sqlHelper.class.php";

class MessageService
{
    public function addMessage($sender,$getter,$con)
    {
        $sql = "insert into messages(sender,getter,content,sendTime) value(";
        $sql .= "'$sender','$getter','$con',now())";

        $sqlHelper = new SqlHelper();
        return $sqlHelper->execute_dml($sql);
    }

    public function getMessage($getter,$sender)
    {
        $sql = "select * from messages";
        $sql .= " where sender = '$sender' and getter = '$getter'";
        $sql .= " and isGet = 0";

        $sqlHelper = new SqlHelper();
        $res = $sqlHelper->execute_dql2($sql);

        $messageInfo = "<meses>";
        for ($i = 0; $i < count($res); $i++)
        {
            $row = $res[$i];    
            $messageInfo .= "<mesid>{$row['id']}</mesid>";
            $messageInfo .= "<sender>{$row['sender']}</sender>";
            $messageInfo .= "<getter>{$row['getter']}</getter>";
            $messageInfo .= "<con>{$row['content']}</con>";
            $messageInfo .= "<sendTime>{$row['sendTime']}</sendTime>";
        }

        $messageInfo .= "</meses>";

        $sql = "update messages set isGet = 1 where";
        $sql .= " getter = '$getter' and sender = '$sender'";
        $sqlHelper->execute_dml($sql);

        return $messageInfo;
    }

}

?>
