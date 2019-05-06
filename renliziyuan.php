<?php
session_start();
include("conn/conn.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
    <script src="http://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>

<body>

<?php
if(@!is_null($_GET['trans_data'])) {
    $_SESSION["modify_id"] = $_GET['trans_data'];
   // echo $_SESSION["modify_id"];
}
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="information" enctype="multipart/form-data">
	<table width="405">
    	<tr>
        	<td width="103" align="right">职工号：</td>
            <td width="144" height="25"><input name="id" type="text" id="id" size="20" maxlength="20" > </td>
        </tr>
        <tr>
        	<td width="103" align="right">姓名：</td>
            <td width="144" height="25"><input name="name" type="text" id="name" size="20" maxlength="100"></td>
        </tr>
        <tr>
            <td width="103" align="right">密码：</td>
            <td width="144" height="25"><input name="pwd" type="password" id="pwd" size="20" maxlength="20"></td>
        </tr>
        <tr>
            <td width="103" align="right">部门：</td>
            <td width="144" height="25"><input name="branch" type="text" id="branch" size="20" maxlength="100"></td>
        </tr>
        <tr>
            <td width="103" align="right">职位：</td>
            <td width="144" height="25"><input name="job" type="text" id="job" size="20" maxlength="100"></td>
        </tr>
        <tr>
        	<td width="103" align="right">性别：</td>
            <td width="144" height="25"><input name="sex" type="text" id="sex" size="20" maxlength="10"></td>
        </tr>
       <tr>
        	<td width="103" align="right">电话：</td>
            <td width="144" height="25"><input name="tel" type="text" id="tel" size="20" maxlength="20"></td>
        </tr>
        <tr>
        	<td width="103" align="right">地址：</td>
            <td width="144" height="25"><input name="address" type="text" id="address" size="20" maxlength="100"></td>
        </tr>
        <tr>
        	<td width="103" align="right">入职时间：</td>
            <td width="144" height="25"><input name="foundtime" type="text" id="foundtime" size="20" maxlength="20"></td>
        </tr>
	</table>
    <br>

    <input type="submit" name="submit" id = "add" value="添加">
    <input type="submit" name="submit" id = "delete" value="删除">
    <input type="submit" name="submit" id = "find" value="查找">
    <input type="submit" name="submit" id = "modify" value="修改">
    <br><br>
</form>


<table id = "infor" width = "800" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#990000">
    <tr>
        <td width="100" align="center" bgcolor="#FFFFFF" class="STYLE4">职工号</td>
        <td width="102" align="center" bgcolor="#FFFFFF" class="STYLE4">姓名</td>
        <td width="119" align="center" bgcolor="#FFFFFF" class="STYLE4">密码</td>
        <td width="169" align="center" bgcolor="#FFFFFF" class="STYLE4">部门</td>
        <td width="119" align="center" bgcolor="#FFFFFF" class="STYLE4">职位</td>
        <td width="119" align="center" bgcolor="#FFFFFF" class="STYLE4">性别</td>
        <td width="119" align="center" bgcolor="#FFFFFF" class="STYLE4">电话</td>
        <td width="282" height="25" align="center" bgcolor="#FFFFFF" class="STYLE4">地址</td>
        <td width="150" align="center" bgcolor="#FFFFFF" class="STYLE4">入职时间</td>
        <!-- <td height="23" align="center" bgcolor="#FFFFFF" class="STYLE4"><input width = "20" type="button" value="确定" /></td> -->
    </tr>
    <?php
    //$val = $_POST['val'];
    //echo $val;
    if(isset($_POST['submit'])) {
       if($_REQUEST['submit'] == "添加") {
           if($_POST["id"] == "" && $_POST["name"] == "" && $_POST["sex"] == "" && $_POST["pwd"] == "" && $_POST["branch"] == "" && $_POST["job"] == "" &&
               $_POST["address"] == "" && $_POST["foundtime"] == "" && $_POST["tel"] == "" ){
               echo "<script>alert('输入为空，请输入您想要添加的信息');</script>";
           }else {
               $sql = mysqli_query($conne->init_conn(), "insert into tb_user
                            values('" . $_POST["id"] . "', '" . $_POST["name"] . "', '" . $_POST["pwd"] . "', '" . $_POST["branch"] . "', '" . $_POST["job"] . "', '" . $_POST["sex"] . "', 
                            '" . $_POST["tel"] . "', '" . $_POST["address"] . "', '" . $_POST["foundtime"] . "')
                            ");
               echo "<script>alert('添加成功');</script>";
           }
       }
       if($_REQUEST['submit'] == "删除") {
           if($_POST["id"] == "" && $_POST["name"] == "" && $_POST["sex"] == "" && $_POST["pwd"] == "" && $_POST["branch"] == "" && $_POST["job"] == "" &&
               $_POST["address"] == "" && $_POST["foundtime"] == "" && $_POST["tel"] == "" ){
               echo "<script>alert('输入为空，请输入您想要删除的信息索引');</script>";
           }else {
               $sql = mysqli_query($conne->init_conn(), "delete
                            from tb_user
                            where user_id LIKE '%" . $_POST["id"] . "%' AND user_name LIKE '%" . $_POST["name"] . "%' AND user_sex LIKE '%" . $_POST["sex"] . "%' AND
                                user_password LIKE '%" . $_POST["pwd"] . "%' AND user_branch LIKE '%" . $_POST["branch"] . "%'  AND user_job LIKE '%" . $_POST["job"] . "%' AND 
                                user_address LIKE '%" . $_POST["address"] . "%' AND user_foundtime LIKE '%" . $_POST["foundtime"] . "%' AND user_tel LIKE '%" . $_POST["tel"] . "%'
                            ");
               echo "<script>alert('删除成功');</script>";
           }
       }
       if($_REQUEST['submit'] == "查找") {
           $sql = mysqli_query($conne->init_conn(),"select *
               from tb_user
               where user_id LIKE '%" . $_POST['id'] . "%' and user_name LIKE '%" . $_POST['name'] . "%' and user_sex LIKE '%" . $_POST['sex'] . "%' and 
                     user_password LIKE '%" . $_POST['pwd'] . "%' and user_branch LIKE '%" . $_POST['branch'] . "%' and user_job LIKE '%" . $_POST['job'] . "%' and 
                     user_address LIKE '%" . $_POST['address'] . "%' and user_foundtime LIKE '%" . $_POST['foundtime'] . "%' and user_tel LIKE '%" . $_POST['tel'] . "%'");

           if ($sql) {
               while ($myrow = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
                   ?>
                   <tr>
                       <td align="center" bgcolor="#FFFFFF" class="STYLE4"><span
                                   class="STYLE2"><?php echo $myrow['user_id']; ?></span></td>
                       <td align="center" bgcolor="#FFFFFF" class="STYLE4"><span
                                   class="STYLE2"><?php echo $myrow['user_name']; ?></span></td>
                       <td height="23" align="center" bgcolor="#FFFFFF" class="STYLE4"><span
                                   class="STYLE2"><?php echo $myrow['user_password']; ?></span></td>
                       <td height="23" align="center" bgcolor="#FFFFFF" class="STYLE4"><span
                                   class="STYLE2"><?php echo $myrow['user_branch']; ?></span></td>
                       <td height="23" align="center" bgcolor="#FFFFFF" class="STYLE4"><span
                                   class="STYLE2"><?php echo $myrow['user_job']; ?></span></td>
                       <td height="23" align="center" bgcolor="#FFFFFF" class="STYLE4"><span
                                   class="STYLE2"><?php echo $myrow['user_sex']; ?></span></td>
                       <td height="23" align="center" bgcolor="#FFFFFF" class="STYLE4"><span
                                   class="STYLE2"><?php echo $myrow['user_tel']; ?></span></td>
                       <td height="23" align="center" bgcolor="#FFFFFF" class="STYLE4"><span
                                   class="STYLE2"><?php echo $myrow['user_address']; ?></span></td>
                       <td height="23" align="center" bgcolor="#FFFFFF" class="STYLE4"><span
                                   class="STYLE2"><?php echo $myrow['user_foundtime']; ?></span></td>
                       <td height="23" align="center" bgcolor="#FFFFFF" class="STYLE4"><input type="button" value="确定" /></td>
                   </tr>
                   <?php
               }
           }
       }
        if($_REQUEST['submit'] == "修改") {

            if($_POST["id"] == "" && $_POST["name"] == "" && $_POST["sex"] == "" && $_POST["pwd"] == "" && $_POST["branch"] == "" && $_POST["job"] == "" &&
                $_POST["address"] == "" && $_POST["foundtime"] == "" && $_POST["tel"] == "" ){
                echo "<script>alert('输入为空，请输入您想要修改的信息');</script>";
            }else {
               // echo $_SESSION["modify_id"];echo $_SESSION["modify_id"];     //检验输出
                $sql = mysqli_query($conne->init_conn(), "update tb_user
                        set user_id = '".$_SESSION["modify_id"]."' , user_name = '".$_POST['name']."' , user_sex = '".$_POST['sex']."' , user_password = '".$_POST['pwd']."'
                            ,  user_branch = '".$_POST['branch']."' , user_job = '".$_POST['job']."' , user_address = '".$_POST['address']."' , 
                            user_tel = '".$_POST['tel']."', user_foundtime = '".$_POST['foundtime']."'
                        where user_id = '".$_SESSION["modify_id"]."'
                            ");

                echo "<script>alert('修改成功');</script>";
            }
        }

    }
    ?>
</table>
</body>
</html>

<script type="text/javascript">
        $(function(){
            $("#infor").on("click", ":button", function(event){
                $("#id").val($(this).closest("tr").find("td").eq(0).text());
                $("#name").val($(this).closest("tr").find("td").eq(1).text());
                $("#pwd").val($(this).closest("tr").find("td").eq(2).text());
                $("#branch").val($(this).closest("tr").find("td").eq(3).text());
                $("#job").val($(this).closest("tr").find("td").eq(4).text());
                $("#sex").val($(this).closest("tr").find("td").eq(5).text());
                $("#tel").val($(this).closest("tr").find("td").eq(6).text());
                $("#address").val($(this).closest("tr").find("td").eq(7).text());
                $("#foundtime").val($(this).closest("tr").find("td").eq(8).text());

                var my_data=$(this).closest("tr").find("td").eq(0).text();   //把职工号传给php，作为修改时对象的依据
                $.ajax({
                    url:   "renliziyuan.php",
                    type: "POST",
                    data:{trans_data:my_data},
                    error: function(){
                        alert('Error loading XML document');
                    },
                    /*complete:function()
                    {
                        location.href = "renliziyuan.php?trans_data=" + my_data;
                    }*/
                    success:function(){
                        $("#modify").html();     //只刷新“修改”按键
                    }
                });
            });
        });
        /*
        function test(){
            var x="abc";
            $.ajax("renliziyuan.php?x="+x),null,function(data){alert(data)});
        }*/
       /* $.ajax({
            url : 'renliziyuan.php',

            data: { 'name': $("#name").val()},

            success: function(data) {
//123.php返回的数据.一般采用json格式

            }

        })*/


</script>
