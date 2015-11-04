<?php include 'head.html';?>
<form class="mainForm" action="indexs.php?act=add&confirm=true" method="post">
	<div class="center"><label>添加记录</label></div>
	<div class="row">
	  <div class="col-md-4"><label for="username">姓名:</label></div>
	  <div class="col-md-8"><input type="text" class="form-control" id="username" name="username" placeholder="姓名"></div>
	</div>

	<div class="row">
	    <div class="col-md-4"><label for="card">身份证号:</label></div>
	    <div class="col-md-8"><input type="text" class="form-control" id="card" name="card" placeholder="身份证号"></div>
	</div>

	<div class="row">
	    <div class="col-md-4"><label for="score">分值:</label></div>
	    <div class="col-md-8"><input type="text" class="form-control" id="score" name="score" placeholder="分值"></div>
	</div>

	<div class="row">
		<div class="col-md-4"><button type="submit" class="btn btn-default">添加记录</button></div>
		<div class="col-md-8"><a href="indexs.php?act=select" class="btn btn-default">返回</a></div>
	</div>
</form>
<?php include 'footer.html';?>
