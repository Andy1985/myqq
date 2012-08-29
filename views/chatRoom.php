<?php
    $username = $_GET['username'];
    $username = trim($username);

    session_start();
    $loginuser = $_SESSION['loginuser'];
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>和<?=$username?>聊天中</title>
    <script type="text/javascript" src="/js/my.js"></script>
    <script type="text/javascript">
        window.resizeTo(500,400);
        window.setInterval("getMessage()",1500); 
        //获取聊天信息
        function getMessage()
        {
            var myXmlHttpRequest = getXmlHttpRequest();            
            if (myXmlHttpRequest)
            {
                var url = "/controller/GetMessageController.php"; 
                var data = "getter=<?=$loginuser?>&sender=<?=$username?>";

                myXmlHttpRequest.open("post",url,true);
                myXmlHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                myXmlHttpRequest.onreadystatechange=function(){
                    if (myXmlHttpRequest.readyState == 4)
                    {
                        if (myXmlHttpRequest.status == 200)
                        {
                            var mesRes = myXmlHttpRequest.responseXML;
                            var cons = mesRes.getElementsByTagName('con');
                            var sendTimes = mesRes.getElementsByTagName('sendTime');

                            if (cons.length != 0)
                            {
                                for (var i = 0; i < cons.length; i++)
                                {
                                    $('talk').value += '<?=$username?>对你';
                                    $('talk').value += '(' + sendTimes[i].childNodes[0].nodeValue;
                                    $('talk').value += ')说:\r\n';
                                    $('talk').value += cons[i].childNodes[0].nodeValue;
                                    $('talk').value += '\r\n';
                                    
                                }

                            }

                        }
                    }
                }

                myXmlHttpRequest.send(data);
            }
        }

        //发送聊天信息
        function sendMessage()
        {
            var myXmlHttpRequest = getXmlHttpRequest();            
            if (myXmlHttpRequest)
            {
                var url = "/controller/SendMessageController.php";
                var data = "con=" + $('con').value + '&getter=<?=$username?>';
                data += "&loginuser=<?=$loginuser?>";

                myXmlHttpRequest.open("post",url,true);

                myXmlHttpRequest.setRequestHeader("Content-Type",
                    "application/x-www-form-urlencoded");

                myXmlHttpRequest.onreadystatechange=function(){
                    if (myXmlHttpRequest.readyState == 4)
                    {
                        if (myXmlHttpRequest.status == 200)
                        {
                            var res = myXmlHttpRequest.responseText;
                            if (res == 'ok')
                            {
                                $('talk').value += '你对<?=$username?>(';
                                $('talk').value += new Date().toLocaleString();                        
                                $('talk').value += ')说:\r\n';
                                $('talk').value += $('con').value;
                                $('talk').value += '\r\n';
                                $('con').value = '';
                            }
                            else
                            {
                                window.alert('发送消息失败！');
                            }
                        }
                    }
                }

                if ($('con').value == '')
                {
                     window.alert('发送信息不允许为空！');
                }
                else
                {
                    myXmlHttpRequest.send(data);
                }
            }
        }

        function BindEnter(obj)
        {
            var button = $('btn1');
            if (obj.keyCode == 13)
            {
                button.click();
                obj.returnValue = false;
            }
        }
    </script>
</head>
<center>
<body onkeydown="BindEnter(event)">
    <h2>聊天室(正在和<font color="red"><?=$username?></font>聊天)</h2>
    <textarea id="talk" cols="50" rows="20"></textarea><br/>
    <input id="con" type="text" style="width:300px" />
    <input id="btn1" type="button" value="发送信息" onclick="sendMessage()" />
</body>
</center>
</html>
