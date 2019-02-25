<?php @session_start();
	ini_set("display_errors","off");  //set this to "On" for debugging  ,especially when no reason blank shows up.
	ini_set("session.cookie_httponly", 1);  //防止cookie在浏览其他网页时被盗取
	header('X-Frame-Options:SAMEORIGIN'); //确保自己网站的内容没有被嵌到别人的网站中去，也从而避免了点击劫持 (clickjacking) 的攻击。

//for people using hustoj out of China , be careful of the last two line of this file !

// connect db 
static 	$DB_HOST="localhost";
static 	$DB_NAME="jol";
static 	$DB_USER="debian-sys-maint";
static 	$DB_PASS="NuzGbw0a68BtCpoM";

static 	$OJ_NAME="OnlineJudge";
static 	$OJ_HOME="./";
static 	$OJ_ADMIN="root@localhost";
static 	$OJ_DATA="/home/judge/data";//D:\wamp64\www\oj\Data
//static 	$OJ_DATA="D:\wamp64\www\oj\Data";//
static 	$OJ_BBS="discuss3";//"bbs" for phpBB3 bridge or "discuss" for mini-forum
static  $OJ_ONLINE=false; //是否使用在线监控，需要消耗一定的内存和计算，因此如果并发大建议关闭(这个建议后面再深究，监控哟公户在线数量)
static  $OJ_LANG="cn"; //网站显示语言
static  $OJ_SIM=true; 
static  $OJ_DICT=false;
static  $OJ_LANGMASK=261940; //1mC 2mCPP 4mPascal 8mJava 16mRuby 32mBash 哪些语言不现实，将不现实语言的好吗加起来，填总和
static  $OJ_EDITE_AREA=true; //true: syntax highlighting is active高亮显示
static  $OJ_ACE_EDITOR=true; //显示行号
static  $OJ_AUTO_SHARE=false; //true: One can view all AC submit if he/she has ACed it onece.提交成功后能看到替他人的代码
static  $OJ_CSS="white.css";
static  $OJ_SAE=false; //using sina application engine,是否是在新浪的云平台运行 web 部分
static  $OJ_VCODE=false; //提交代码时和登陆时是否启用验证码
static  $OJ_APPENDCODE=false;
static  $OJ_CE_PENALTY=false;
static  $OJ_PRINTER=false;
static  $OJ_MAIL=false;
static  $OJ_MEMCACHE=false; //是否使用 memcache 作为页面缓存，如果不启用则用/cache 目录
static  $OJ_MEMSERVER="127.0.0.1"; //缓存服务器
static  $OJ_MEMPORT=11211; //缓存使用端口
//static  $OJ_REDIS=false;
//static  $OJ_REDISSERVER="127.0.0.1";
//static  $OJ_REDISPORT=6379;
//static  $OJ_REDISQNAME="hustoj";
//static  $SAE_STORAGE_ROOT="http://hustoj-web.stor.sinaapp.com/";
static  $OJ_CDN_URL="";  //  http://cdn.hustoj.com/  https://raw.githubusercontent.com/zhblue/hustoj/master/trunk/web/ 
static  $OJ_TEMPLATE="bs3"; //使用的默认模板, [bs3 ie ace sweet sae] work with discuss3, [classic bs] work with discuss
if(isset($_GET['tp'])) $OJ_TEMPLATE=$_GET['tp']; //前端模板
static  $OJ_LOGIN_MOD="hustoj";
static  $OJ_REGISTER=true; //允许注册新用户
static  $OJ_REG_NEED_CONFIRM=false; //新注册用户需要审核
static  $OJ_NEED_LOGIN=false; //需要登录才能访问
static  $OJ_RANK_LOCK_PERCENT=0; //比赛封榜时间比例
static  $OJ_SHOW_DIFF=true; //是否显示WA的对比说明
static  $OJ_TEST_RUN=false; //提交界面是否允许测试运行
static  $OJ_BLOCKLY=false; //是否启用Blockly界面
static  $OJ_ENCODE_SUBMIT=true; //是否启用base64编码提交的功能，用来回避WAF防火墙误拦截。
static  $OJ_OI_1_SOLUTION_ONLY=false; //比赛是否采用noip中的仅保留最后一次提交的规则。true则在新提交发生时，将本场比赛该题老的提交计入练习。

//static  $OJ_EXAM_CONTEST_ID=1000; // 启用考试状态，填写考试比赛ID
//static  $OJ_ON_SITE_CONTEST_ID=1000; //启用现场赛状态，填写现场赛比赛ID

/* share code */
static  $OJ_SHARE_CODE = true; // 代码分享功能

//$OJ_ON_SITE_TEAM_TOTAL用于根据比例的计算奖牌的队伍总数
//CCPC比赛的一种做法是比赛结束后导出终榜看AC至少1题的不打星的队伍数，现场修改此值即可正确计算奖牌
//0表示根据榜单上的出现的队伍总数计算(包含了AC0题的队伍和打星队伍)
static $OJ_ON_SITE_TEAM_TOTAL=0;

static $OJ_OPENID_PWD = '8a367fe87b1e406ea8e94d7d508dcf01';

/* weibo config here */
static  $OJ_WEIBO_AUTH=false;
static  $OJ_WEIBO_AKEY='1124518951';
static  $OJ_WEIBO_ASEC='df709a1253ef8878548920718085e84b';
static  $OJ_WEIBO_CBURL='http://192.168.0.108/JudgeOnline/login_weibo.php';

/* renren config here */
static  $OJ_RR_AUTH=false;
static  $OJ_RR_AKEY='d066ad780742404d85d0955ac05654df';
static  $OJ_RR_ASEC='c4d2988cf5c149fabf8098f32f9b49ed';
static  $OJ_RR_CBURL='http://192.168.0.108/JudgeOnline/login_renren.php';
/* qq config here */
static  $OJ_QQ_AUTH=false;
static  $OJ_QQ_AKEY='1124518951';
static  $OJ_QQ_ASEC='df709a1253ef8878548920718085e84b';
static  $OJ_QQ_CBURL='192.168.0.108';


//if(date('H')<5||date('H')>21||isset($_GET['dark'])) $OJ_CSS="dark.css";
//$_SERVER 是一个包含了诸如头信息(header)、路径(path)、以及脚本位置(script locations)等等信息的数组。
if( isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) && strstr($_SERVER['HTTP_ACCEPT_LANGUAGE'],"zh-CN")) { //strstr查找字符串的首次出现
        $OJ_LANG="cn";
}
if (isset($_SESSION[$OJ_NAME.'_'.'OJ_LANG'])) $OJ_LANG=$_SESSION[$OJ_NAME.'_'.'OJ_LANG'];

require_once(dirname(__FILE__)."/pdo.php"); //返回路径中的目录部分

		// use db
	//pdo_query("set names utf8");	
	//basename返回路径中的文件名部分
	if(isset($OJ_CSRF)&&$OJ_CSRF&&$OJ_TEMPLATE=="bs3"&&basename($_SERVER['PHP_SELF'])!="problem_judge")
		 require_once('csrf_check.php');

	//sychronize php and mysql server with timezone settings, dafault setting for China
	//if you are not from China, comment out these two lines or modify them.
	//date_default_timezone_set("PRC");
	//pdo_query("SET time_zone ='+8:00'");

?>
