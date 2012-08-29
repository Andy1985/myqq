<?php
require_once "sqlHelper.class.php";
class UserService
{
    protected $error;

    public function getError()
    {
        return $this->error;
    }

    public function getAllUsers()
    {
        $sql = "select * from users order by userId";
        $sqlHelper = new SqlHelper();
        return $sqlHelper->execute_dql2($sql);
    }

    public function getUser($username,$password)
    {
        $sql = "select * from users where name = '$username' and password = '$password'";
        $sqlHelper = new SqlHelper();
        return $sqlHelper->execute_dql2($sql);
    }

    public function deleteUser($userId)
    {
        $sql = "delete from users where userId = $userId";
        
        $sqlHelper = new SqlHelper();
        $res = $sqlHelper->execute_dml($sql);

        if ($res == 0)
        {
            $this->error = "删除数据库失败";
            return 1;
        }
        else if ($res == 2)
        {
            $this->error = "删除条数为零";
            return 1;
        }
        else if ($res == 1)
        {
            $this->error = "";
            return 0;
        }
        else
        {
            $this->error = "未知错误";
            return 1;
        }
    }

    public function addUser($username,$password)
    {
        $sqlHelper = new SqlHelper();

        $sql = "select userId from users where name = '$username'";
        $res = $sqlHelper->execute_dql2($sql);
        if (count($res) > 0)
        {
            $this->error = "用户名($username)已经存在";
            return 1;
        }
    
        $sql = "select max(userId) as maxUserId from users";
        $res = $sqlHelper->execute_dql2($sql);
        $userId = 0;

        if (count($res) > 0)
        {
            $userId = $res[0]['maxUserId'] + 1;
        }
        else
        {
            $userId = 100;
        }

        $sql = "insert into users(userId,name,password,isLogin) ";
        $sql .= "values($userId,'$username','$password',0)";

        $res = $sqlHelper->execute_dml($sql);

        if ($res == 0)
        {
            $this->error = "插入数据库失败";
            return 1;
        }
        else if ($res == 2)
        {
            $this->error = "插入条数为零";
            return 1;
        }
        else if ($res == 1)
        {
            $this->error = "";
            return 0;
        }
        else
        {
            $this->error = "未知错误";
            return 1;
        }
    }

    public function updateUserState($userName,$state)
    {
        $sql = "update users set isLogin = $state where name = '$userName'";

        $res = $sqlHelper->execute_dml($sql);

        if ($res == 0)
        {
            $this->error = "更新数据库失败";
            return 1;
        }
        else if ($res == 2)
        {
            $this->error = "更新条数为零";
            return 1;
        }
        else if ($res == 1)
        {
            $this->error = "";
            return 0;
        }
        else
        {
            $this->error = "未知错误";
            return 1;
        }
    }
}

?>
