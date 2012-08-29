<?php
    require_once "../models/UserService.class.php";
    $userModel = new UserService();
    $res = $userModel->getAllUsers();
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MyQQ</title>
    <script type="text/javascript">
        function change1(value,obj)
        {
            if (value == "over")
            {
                obj.style.color = "red";
                obj.style.cursor = "hand";
            }
            else if (value == "out")
            {
                obj.style.color = "black";
            }
        }

        function openChatRom(obj)
        {
            window.open("/views/chatRoom.php?username=" +encodeURI(obj.innerText),"_blank");
        }

    </script>
</head>
<body>
    <h2><font color="blue">好友列表</font></h2>
    <ul>
        <?php foreach ($res as $item) {?>
        <li onclick="openChatRom(this)" onmouseover="change1('over',this)" onmouseout="change1('out',this)">
        <?=$item['name']?>
        </li>
        <?php }?>
    </ul>
</body>
</html>
