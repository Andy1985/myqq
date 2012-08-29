<?php
    require_once "../models/UserService.class.php";
    $userModel = new UserService();
    $res = $userModel->getAllUsers();
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MyQQ</title>
    <script type="text/javascript" src="/js/my.js"></script>
    <script type="text/javascript">
    function delUser(userId)
    {
        var res = window.confirm("确定删除此用户吗？");
        if (!res)
        {
            return;
        }

        var myXmlHttpRequest = getXmlHttpRequest();            
        if (myXmlHttpRequest)
        {
            var url = "/controller/adminController.php?type=del"; 
            var data = "userid=" + userId;

            myXmlHttpRequest.open("post",url,true);
            myXmlHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            myXmlHttpRequest.onreadystatechange = function()
            {
                if (myXmlHttpRequest.readyState == 4)
                {
                    if (myXmlHttpRequest.status == 200)
                    {
                        var res = myXmlHttpRequest.responseText;
                        if (res == "ok")
                        {
                            window.alert("删除成功！");
                            window.location.href = "/views/delUser.php";
                        }
                        else
                        {
                            window.alert("删除失败！");
                        }
                    }
                }
            }

            myXmlHttpRequest.send(data);
        }

    }
    </script>
</head>
<center>
<body>
    <h2><font color="blue">删除用户</font></h2>
    <table width="300px">
        <tr>
            <td>id</td>
            <td>姓名</td>
            <td>删除</td>
        </tr>
        <?php foreach ($res as $item){?>
            <tr>
                <td><?=$item['userId']?></td>
                <td><?=$item['name']?></td>
                <td><a href="#" onclick="delUser(<?=$item['userId']?>);">删除</a></td>
            </tr>
        <?php }?>
    </table>
</body>
</center>
</html>
