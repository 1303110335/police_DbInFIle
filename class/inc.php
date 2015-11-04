<?php
$filePath = 'class/news.txt';  #文件数据库
$recordsFile = 'class/newsInfo';  #最后一条记录ID存放的文件
$seperator = "<{}>";  #每条新闻的连接、标题、来源等元素的分割符号,同一个文件数据库只能定义一个分隔符
$SEPERATORS = "<br>";  #每条新闻的分隔符,同一个文件数据库只能定义一个分隔符
$pageNums = 50;  #每页个数