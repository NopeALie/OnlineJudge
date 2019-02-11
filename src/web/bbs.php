<?php 
	require_once("./include/db_info.inc.php");

	//启用考试状态下无法使用bbs并作出提示
	if(isset($OJ_EXAM_CONTEST_ID)&&$OJ_EXAM_CONTEST_ID>0){
		header("Content-type: text/html; charset=utf-8");
		echo $MSG_BBS_NOT_ALLOWED_FOR_EXAM;
		exit ();
	}

	$parm="";

	if(isset($_GET['pid'])){
		$pid=intval($_GET['pid']);
		$parm="pid=".$pid;
	}else{
		$pid=0;
	}
	if(isset($_GET['cid'])){
		$cid=intval($_GET['cid']);
		$parm.="&cid=".$cid;
	}else{
		$cid=0;
	}

	if($OJ_BBS=="discuss"){ //不存在这样的文件夹
		echo ("<script>location.href='discuss/discuss.php?".$parm."';</script>");
	}else if ($OJ_BBS=="discuss3"){
		echo ("<script>location.href='discuss3/discuss.php?".$parm."';</script>"); //重定向，传入竞赛id和竞赛中题目id都是0
	}else{//需要下载phpbb模板
		if(isset($_GET['pid'])){
			$url=("bbs/search.php?fid[]=2&keywords=".$pid); //change this to your own phpBB search link
		}else{
			$url=("bbs/");
		}
		echo ("<script>location.href='".$url."';</script>");
	}
?>