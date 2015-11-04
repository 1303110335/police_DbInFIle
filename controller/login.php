<?php
	header('Content-type:text/html;charset=utf-8');
	if($_POST['username']!='admin'||$_POST['password']!='admin'){
		echo '用户名和密码错误!';
		echo '<a href="../index.html">重新登录</a>';
		exit;
	}else{
		header("location:../indexs.php");
	}