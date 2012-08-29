<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MyQQ</title>
    <script type="text/javascript" src="/js/my.js"></script>
    <script type="text/javascript">
    function login()
    {
        if ($('username').value == '' || $('password').value == '')
        {
            window.alert('用户名和密码不能为空！');
            return;
        }

        var myXmlHttpRequest = getXmlHttpRequest();            
        if (myXmlHttpRequest)
        {
            var url = "/controller/loginController.php"; 
            var data = "username=" + $('username').value;
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
                            window.location.href = "/views/friendList.php";
                        }
                        else
                        {
                            window.alert("用户名或密码错误!");
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
    <h2><font color="blue">欢迎登陆聊天室</font></h2>
        用户名：<input type="text" id="username" name="username" />
        密码：  <input type="password" id="password" name="password" />
        <input type="submit" value="登陆" onclick="login();"/>
</body>
</center>
</html>
