<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

class ConnDB      
{
	var $dbtype;
    var $host;
    var $user;
    var $pwd;
    var $dbname;
    var $conn;
    function ConnDB($dbtype, $host, $user, $pwd, $dbname)
    {
    	$this->dbtype = $dbtype;
        $this->host = $host;
        $this->usser = $user;
        $this->pwd = $pwd;
        $this->dbname = $dbname;
    }
    funtion GetConnId()      //连接数据库
    {
    	$this->conn = mysql_connect($this->host, $this->user, $this->pwd) or die("数据库服务器连		        接错误".mysql_error());
        mysql_select_db($this->dbname, $this->conn) or die("数据库选择错误".mysql_error());
        mysql_query("set names gb2312");      //设置数据库的编码方式
        return $this->conn;    //返回连接对象
    }
    funtion CloseConnId()     //关闭数据库
    {
    	$this->conn->Disconnect();
    }
}

class AdminDB
{
	funtion ExecSQL($sqlstr, $conn)
    {
    	$sqltype = strtolower(substr(trim($sqlstr), 0, 6));
        $rs = mysql_query($sqlstr);      //执行SQL语句
        if($sqltype == "select")  //判断SQL语句类型，执行成功则返回查询结果的数组
        {
        	$array = mysql_fetch_qrray($rs);
            if(count($array == 0) || $rs == false)
            	return false;
            else
            	return $array;
        }
        elseif($sqltype == "update" || $sqltype == "insert" || $sqltype == "delete")
        {
        	if($rs)
            	return true;
            else
            	return false;
        }
    }
}


<body>
</body>
</html>