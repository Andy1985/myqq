<?php
class SqlHelper
{
    public $conn;
    public $dbname = "chat";
    public $username = "root";
    public $password = "netpower";
    public $host = "localhost";

    public function __construct()
    {
        $this->conn = mysql_connect($this->host,$this->username,$this->password);
        if (!$this->conn)
        {
            die("连接失败" . mysql_error());
        }

        mysql_select_db($this->dbname,$this->conn);
        mysql_query("set names utf8");
    }

    public function __destruct()
    {
        if (!empty($this->conn))
        {
            mysql_close($this->conn);
        }
    }

    public function execute_dql($sql)
    {
        $res = mysql_query($sql,$this->conn) or die($sql);
        return $res;
    }

    public function execute_dql2($sql)
    {
        $arr = array();
        $res = mysql_query($sql,$this->conn) or die(mysql_error());

        while ($row = mysql_fetch_assoc($res))
        {
            $arr[] = $row;
        }

        mysql_free_result($res);
        return $arr;
    }

    public function execute_dql_fenye($sql1,$sql2,$fenyePage)
    {
        $res = mysql_query($sql1,$this->conn) or die(mysql_error());
        $arr = array();

        while ($row = mysql_fetch_assoc($res))
        {
            $arr[] = $row; 
        }
        mysql_free_result($res);

        $res2 = mysql_query($sql2,$this->conn) or die(mysql_error());

        if ($row = mysql_fetch_row($res2))
        {
            $fenyePage->pageCount = ceil($row[0]/$fenyePage->pageSize);
            $fenyePage->rowCount = $row[0];
        }

        mysql_free_result($res2);

        $navigate = " ";

        if ($fenyePage->pageNow > 1)
        {
            $prePage = $fenyePage->pageNow - 1;
            $navigate = "<a href='{$fenyePage->gotoUrl}pageNow={$prePage}'>上一页</a>&nbsp;";
        }
        if ($fenyePage->pageNow < $fenyePage->pageCount)
        {
            $nextPage = $fenyePage->pageNow + 1;
            $navigate .= "<a href='{$fenyePage->gotoUrl}pageNow={$nextPage}'>下一页</a>&nbsp;";
        }

        $page_whole = 3;
        $start = floor(($fenyePage->pageNow - 1)/$page_whole) * $page_whole + 1;
        $index = $start;
        if ($fenyePage->pageNow > $page_whole)
        {
            $navigate .= "&nbsp;&nbsp;<a href='{$fenyePage->gotoUrl}pageNow=";
            $navigate .= ($start - 1) . "'>&nbsp;&nbsp;<<&nbsp;&nbsp;</a>";
        }

        for (;$start < $index + $page_whole; $start++)
        {
            $navigate .= "<a href='{$fenyePage->gotoUrl}pageNow={$start}'>[{$start}]</a>";
        }

        $navigate .= "&nbsp;&nbsp;<a href='{$fenyePage->gotoUrl}?pageNow=$start'>&nbsp;&nbsp;</a>";
        $navigate .= "&nbsp;&nbsp;当前页{$fenyePage->pageNow}/共{$fenyePage->pageCount}页";
        $navigate .= "&nbsp;&nbsp;共{$fenyePage->rowCount}条&nbsp;&nbsp;每页显示{$fenyePage->pageSize}";

        $fenyePage->res_array = $arr;
        $fenyePage->navigate = $navigate;

    }

    public function execute_dml($sql)
    {
        $b = mysql_query($sql,$this->conn) or die(mysql_error());
        if (!$b)
        {
            return 0;
        }
        else
        {
            if (mysql_affected_rows($this->conn) > 0)
            {
                return 1;
            }
            else
            {
                return 2;
            }
        }
    }

    public function close_connect()
    {
        if (!empty($this->conn))
        {
            mysql_close($this->conn);
        }
    }

}
?>
