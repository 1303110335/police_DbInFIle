<?php
	header("content-type:text/html;charset=utf-8");
	require_once 'class/inc.php';
	function __autoload($className){
		require_once 'class/'.$className.'.class.php';
	};
	
	$act = $_GET['act']?$_GET['act']:'select';

	$db = new FileDB($filePath,$recordsFile,$seperator,$SEPERATORS);
	if($act == 'add'){
		if($_GET['confirm']){
			$_POST['frequency'] = '每3天一次';
			$_POST['flag'] = 'true';
			$result = $db->add($_POST);
			if($result){
				header("location:indexs.php");exit;
			}
			else
				echo "添加失败!";
		}
		include 'html/add.php';
	}
	else if($act == 'delete'){
		$id = $_GET['id'];
		if(!is_numeric($id)){
			die('传入参数错误!');
		}
		$result = $db->delete($id);
		header('Location:indexs.php?act=select');
		//echo $message = $result?"删除成功!<a href='indexs.php?act=select'>返回</a>":"不存在该Id的记录!<a href='indexs.php?act=select'>返回</a>";
		clearstatcache();
	}
	else if($act == 'alter'){
		if($_GET['flag']==='true'){
			changeFlagField($_GET['id'],$db);
		}else{
			changeAllFields($_POST,$_GET,$db,$seperator);
		}
	}
	else if($act == 'select'){
		if(!file_exists($filePath))
		{
			echo "暂无新闻哦@_@";
		}
		else{
			include 'html/showHead.php';
			$currentPage = $_GET['page']?$_GET['page']:1;
			$page = new Page($filePath,$recordsFile,$seperator,$SEPERATORS,$pageNums,$currentPage);
			echo $page->listed();
			echo $page->pageLink();
			echo "<br /><br /><input type='button' value='添加记录' class='btn btn-primary btn-lg' 
			onclick=\"javascript:window.location.href='indexs.php?act=add'\" />";
			include 'html/showFooter.php';
		}
	}

	function changeFlagField($id,$db){
		if(!is_numeric($id)){die('参数类型错误!');}
		$result = $db->alters($id);
		if($result)header('Location:indexs.php');
		/*echo $message = $result?"修改成功!<a href='indexs.php'>返回</a>":
		"修改失败!<a href='$_SERVER[HTTP_REFERER]'>返回</a>";*/
	}

	function changeAllFields($post,$get,$db,$seperator){
		extract($post);
		$id = $get['id'];
		if(!is_numeric($id)){
			die('传入参数错误!');
		}
		if(!$get['confirm']){
			$newsArr = $db->source();
			foreach($newsArr as $key=>$line){
				if(trim($line)){
					$news = explode("$seperator",$line);
					if($news[0]==$id){
						include 'html/head.html';
						echo "<form class='mainForm' action='indexs.php?act=alter&id=$news[0]&confirm=true' method='post'>
								<div class='row'>
								    <div class='col-md-4'><label for='username'>姓名:</label></div>
								    <div class='col-md-8'><input type='text' class='form-control' id='username' name='username' value='$news[1]' placeholder='姓名'></div>
								</div>
								<div class='row'>
								    <div class='col-md-4'><label for='card'>身份证号:</label></div>
								    <div class='col-md-8'><input type='text' class='form-control' id='card' name='card' value='$news[2]' placeholder='身份证号'></div>
								</div>
								<div class='row'>
								    <div class='col-md-4'><label for='score'>评分:</label></div>
								    <div class='col-md-8'><input type='text' class='form-control' id='score' name='score' value='$news[3]' placeholder='评分'></div>
								</div>
								<div class='row'>
								    <div class='col-md-4'><label for='frequency'>频率:</label></div>
								    <div class='col-md-8'><input type='text' class='form-control' id='frequency' name='frequency' value='$news[4]' placeholder='频率'></div>
								</div>
								<div class='row'>
									<div class='col-md-4'><button type='submit' class='btn btn-default'>确认修改</button></div>
									<div class='col-md-8'><a href='$_SERVER[HTTP_REFERER]' class='btn btn-default'>返回</a></div>
								</div>
								<input type='hidden' name='refer' value='$_SERVER[HTTP_REFERER]' />
							</form>";
						include 'html/footer.html';
						break;
					}else{
						continue;
					}
				}
			}
		}else{
			$result = $db->alter($id,$post);
			header('Location:indexs.php');
			/*echo $message = $result?"修改成功!<a href='javascript:history.go(-2);'>返回</a>":
			"修改失败!<a href='$_SERVER[HTTP_REFERER]'>返回</a>";*/
		}

		clearstatcache();
	}
	?>