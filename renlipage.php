<?php
session_start();
include("conn/conn.php");


$id = $_POST["id"];     //获取文本框内的值
$name = $_POST["name"];
$pwd = $_POST["pwd"];
$branch = $_POST["branch"];
$job = $_POST["job"];
$sex = $_POST["sex"];
$tel = $_POST["tel"];
$address = $_POST["address"];
$foundtime = $_POST["foundtime"];

if($_REQUEST['submit'] == "添加")
{
	$sql = mysqli_query($conne->init_conn(),"insert into tb_user
						values('$id', '$name', '$pwd', '$branch', '$job', '$sex', '$tel', '$address', '$foundtime')
						");
    echo "<script>alert('添加成功');window.location.href = 'renliziyuan.php';</script>";
}
else if($_REQUEST['submit'] == "查找")      //模糊查询
{
	$sql ="select *
		   from tb_user
		   where user_id LIKE '%".$_POST['id']."%' and user_name LIKE '%".$_POST['name']."%' and user_sex LIKE '%".$_POST['sex']."%' and 
				 user_password LIKE '%".$_POST['pwd']."%' and user_branch LIKE '%".$_POST['branch']."%' and user_job LIKE '%".$_POST['job']."%' and 
				 user_address LIKE '%".$_POST['address']."%' and user_foundtime LIKE '%".$_POST['foundtime']."%' and user_tel LIKE '%".$_POST['tel']."%'";
    if($conne->getRowsNum($sql) == 1){
        /*
        $_SESSION["userid"]=$conne->getFields($sql,'user_id');     //定义职工号的全局变量
        $_SESSION["username"]=$conne->getFields($sql,'user_name');  //定义姓名的全局变量
        $_SESSION["userpassword"]=$conne->getFields($sql,'user_password');  //定义密码的全局变量
        $_SESSION["userbranch"]=$conne->getFields($sql,'user_branch');  //定义部门的全局变量
        $_SESSION["userjob"]=$conne->getFields($sql,'user_job');  //定义工作的全局变量
        $_SESSION["usersex"]=$conne->getFields($sql,'user_sex');  //定义性别的全局变量
        $_SESSION["usertel"]=$conne->getFields($sql,'user_tel');  //定义电话的全局变量
        $_SESSION["useraddress"]=$conne->getFields($sql,'user_address');  //定义地址的全局变量
        $_SESSION["userfoundtime"]=$conne->getFields($sql,'user_foundtime');  //定义入职日期的全局变量
        echo "<script>window.location.href='backstage.php';</script>";
        */
        echo "<script>alert('成功找到');window.location.href='renliziyuan.php';</script>";     //检验输出
    }else{
        echo "<script>alert('未找到相关人员信息，请检查您的输入');window.location.href='renliziyuan.php';</script>";
    }
}
else if($_REQUEST['submit'] == "删除")
{
	$sql = mysqli_query($conne->init_conn(),"delete
					    from tb_user
						where user_id LIKE '%$id%' AND user_name LIKE '%$name%' AND user_sex LIKE '%$sex%' AND user_password LIKE '%$pwd%' AND user_branch LIKE '%$branch%' 
						    AND user_job LIKE '%$job%' AND user_address LIKE '%$address%' AND user_foundtime LIKE '%$foundtime%' AND user_tel LIKE '%$tel%'
						");
    echo "<script>alert('删除成功');window.location.href = 'renliziyuan.php';</script>";
}

else if($_REQUEST['submit'] == "修改")
{

}


