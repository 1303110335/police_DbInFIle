<?php
class FileDB{
	public $db;
	public $filePath;
	public $recordsFile;
	public $seperator;
	public $SEPERATORS;
	public function __construct($filePath,$recordsFile,$seperator="<{}>",$SEPERATORS="<br>"){
		$this->filePath = $filePath;
		$this->recordsFile = $recordsFile;
		$this->seperator = $seperator;
		$this->SEPERATORS = $SEPERATORS;
		$this->db = file_get_contents($this->filePath);
	}
	public function select_table($filePath){
		
	}
	public function add($post){
		extract($post);
		if(!file_exists($this->filePath))
		{
			$future = mktime ( 0 ,  0 ,  0 ,  date ( "m" )  ,  date ( "d" )+ 3 ,  date ( "Y" ));
			$file = file_get_contents($this->filePath);
			$handle = fopen($this->filePath,'w');
			fwrite($handle,"0".$this->seperator.
				"天下第一".$this->seperator.
				"330382199603107558".$this->seperator.
				"5".$this->seperator
				."每3天一次".$this->seperator.
				$future."$this->SEPERATORS\n".$file);
			fclose($handle);
			$handle1 = fopen($this->recordsFile,'a');
			fwrite($handle1,0);
			fclose($handle1);
			return true;
		}
		else{
			$lastId = file_get_contents($this->recordsFile);
			$old = file_get_contents($this->filePath);
			$new = ++$lastId."$this->seperator".htmlspecialchars($username).
					"$this->seperator".htmlspecialchars($card).
					"$this->seperator".htmlspecialchars($score).
					"$this->seperator".htmlspecialchars($frequency).
					"$this->seperator".time().
					"$this->SEPERATORS\n";
			if(file_put_contents($this->filePath,$new.$old)){
				file_put_contents($this->recordsFile,$lastId);
				return true;
			}
		}
		clearstatcache();
		
	}
	public function delete($id){

		$newsArr = $this->source();
		foreach($newsArr as $key=>$line){
			if(trim($line)){
				$news = explode("$this->seperator",$line);
				if($news[0]==$id){
					array_splice($newsArr,$key,1);
					if(count($newsArr)!=0)
						file_put_contents($this->filePath,implode("$this->SEPERATORS",$newsArr));
					$isDeleted = 1;
					break;
				}else{
					$isDeleted = 0;
					continue;
				}

			}
		}
		return $isDeleted;
	}
	public function alter($id,$post){
		extract($post);
		$newsArr = $this->source();
		foreach($newsArr as $key=>$line){
			if(trim($line)){
				$news = explode("$this->seperator",$line);
				if($news[0]==$id){
					$newsArr[$key] = "\n".$id."$this->seperator".htmlspecialchars($username)."$this->seperator".htmlspecialchars($card).
					"$this->seperator".htmlspecialchars($score)."$this->seperator".htmlspecialchars($frequency).
					"$this->seperator".$news[5];
					file_put_contents($this->filePath,implode("$this->SEPERATORS",$newsArr));
					$isAltered = 1;
					break;
				}else{
					$isAltered = 0;
					continue;
				}
			}
		}
		return $isAltered;
	}

	public function alters($id){
		$newsArr = $this->source();
		foreach($newsArr as $key=>$line){
			if(trim($line)){
				$news = explode("$this->seperator",$line);
				if($news[0]==$id){
					$future = mktime ( 0 ,  0 ,  0 ,  date ( "m" )  ,  date ( "d" )+ 3 ,  date ( "Y" ));
					$newsArr[$key] = "\n".$news[0]."$this->seperator".$news[1]."$this->seperator".$news[2].
					"$this->seperator".$news[3]."$this->seperator".$news[4]."$this->seperator".$future;
					file_put_contents($this->filePath,implode("$this->SEPERATORS",$newsArr));
					$isAltered = 1;
					break;
				}else{
					$isAltered = 0;
					continue;
				}
			}
		}
		return $isAltered;
	}

	public function source($id=''){
		if(!$id){
			$newsStr = @trim(file_get_contents($this->filePath));
			$newsArr = explode("$this->SEPERATORS",$newsStr);
			return $newsArr;
		}else{
		
		}
	}
	public function query_nums(){
		$newsArr = $this->source();
		return count($newsArr)-1;
	}
	public function select(){
		$newsStr = @trim(file_get_contents($this->filePath));
		$newsArr = explode("$this->SEPERATORS",$newsStr);
		return count($newsArr)-1;
	}
	public function __destruct(){
		unset($this->db);
	}
}