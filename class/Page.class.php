<?php
class Page extends FileDB{
	private $pageNum;
	private $totalPage;
	private $currentPage;
	private $source;
	private $totalNum;
	public function __construct($filePath,$recordsFile,$seperator,$SEPERATORS,$pageNum,$currentPage)
	{
		parent::__construct($filePath,$recordsFile,$seperator,$SEPERATORS);
		$this->source = $this->source();
		$this->totalNum = count($this->source)-1;
		$this->pageNum = $pageNum;
		$this->currentPage = $currentPage;
		$this->totalPage = ceil($this->totalNum/$this->pageNum);
	}
	public function listed()
	{
		$start = ($this->currentPage-1)*$this->pageNum;
		$end = $this->currentPage*$this->pageNum-1;

		

		foreach($this->source as $key=>$line){
			if(trim($line)){
				$haveNews = 1;
				if($key<$start||$key>$end)continue;
				else{
					$news = explode("$this->seperator",$line);
					//add the red background if time is Up
					if($news[5]<=time()){
						echo "<tr class='bgRed'><td>$news[1]</td><td>$news[2]</td><td>$news[3]</td><td>$news[4]</td><td>
						<a class='btn btn-primary' href='indexs.php?act=alter&id=$news[0]&flag=true'>处理</a>&nbsp;&nbsp;
						<a class='btn btn-primary' href='indexs.php?act=alter&id=$news[0]'>修改</a>&nbsp;&nbsp;
						<a class='btn btn-primary' href='indexs.php?act=delete&id=$news[0]'>删除</a></td></tr>";
					}
				}
			}
		}

		foreach($this->source as $key=>$line){
			if(trim($line)){
				$haveNews = 1;
				if($key<$start||$key>$end)continue;
				else{
					$news = explode("$this->seperator",$line);
					//add the red background if time is Up
					if($news[5]>time()){
						echo "<tr><td>$news[1]</td><td>$news[2]</td><td>$news[3]</td><td>$news[4]</td><td>
						<a class='btn btn-primary' href='indexs.php?act=alter&id=$news[0]&flag=true'>处理</a>&nbsp;&nbsp;
						<a class='btn btn-primary' href='indexs.php?act=alter&id=$news[0]'>修改</a>&nbsp;&nbsp;
						<a class='btn btn-primary' href='indexs.php?act=delete&id=$news[0]'>删除</a></td></tr>";
					}
				}
			}
		}
		if(!$haveNews)echo "<tr><td colspan=5>暂无记录哦.</td></tr>";
		
	}


	public function pageLink()
	{
		if($this->totalPage>1){
			if($this->currentPage==1){
				$link = "<br />共  $this->totalNum 条记录&nbsp;&nbsp;当前第 $this->currentPage/$this->totalPage 页&nbsp;&nbsp;上一页&nbsp;&nbsp;<a href='indexs.php?act=select&page=2'>下一页</a>";
			}
			else if($this->currentPage>1&&$this->totalPage>$this->currentPage)
			{
				$ppage = $this->currentPage-1;
				$npage = $this->currentPage+1;
				$link =  "<br />共  $this->totalNum 条记录&nbsp;&nbsp;当前第 $this->currentPage/$this->totalPage 页&nbsp;&nbsp;<a href='indexs.php?act=select&page=$ppage'>上一页</a>&nbsp;&nbsp;<a href='indexs.php?act=select&page=$npage'>下一页</a>";
			}
			else{
				$ppage = $this->currentPage-1;
				$link =  "<br />共  $this->totalNum 条记录&nbsp;&nbsp;当前第 $this->currentPage/$this->totalPage 页&nbsp;&nbsp;<a href='indexs.php?act=select&page=$ppage'>上一页</a>&nbsp;&nbsp;下一页";
			}
		}
		return $link;
	}
	public function __destruct(){
	
	}
}