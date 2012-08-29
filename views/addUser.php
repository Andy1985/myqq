<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MyQQ</title>
    <script type="text/javascript" src="/js/my.js"></script>
    <script type="text/javascript">
    function addUser()
    {
        if ($('name').value == '')
        {
            window.alert('用户名不能为空!');
            return false;
        }

        if ($('password').value == '' || $('confirm_pass').value == '')
        {
            window.alert('密码不能为空!');
            return false;
        }

        if ($('password').value != $('confirm_pass').value)
        {
            window.alert('密码不一致');
            return false;
        }

        var myXmlHttpRequest = getXmlHttpRequest();            
        if (myXmlHttpRequest)
        {
            var url = "/controller/adminController.php?type=add"; 
            var data = "username=" + $('name').value;
            data += "&password=" + $('password').value;

            myXmlHttpRequest.open("post",url,true);
            myXmlHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            myXmlHttpRequest.onreadystatechange=function(){
                if (myXmlHttpRequest.readyState == 4)
                {
                    if (myXmlHttpRequest.status == 200)
                    {
                        var res = myXmlHttpRequest.responseText;
                        if (res == "ok")
                        {
                            window.alert("添加成功！");
                            $('form').reset();
                        }
                        else
                        {
                            window.alert("添加失败！");
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
    <h2><font color="blue">添加用户</font></h2>
    <form id="form">
    <table>
    <tr>
        <td>姓名</td>
        <td><input type="text" id="name" name="name" /></td>
    </tr>
    <tr>
        <td>密码</td>
        <td><input type="password" id="password" name="password" /></td>
    </tr>
    <tr>
        <td>确认密码</td>
        <td><input type="password" id="confirm_pass" name="confirm_pass" /></td>
    </tr>
    <tr>
        <td><input type="button" value="添加" onclick="addUser();"/></td>
        <td><input type="reset" value="重置"/></td>
    </tr>
    </table>
    </form>
</body>
</center>
</html>
