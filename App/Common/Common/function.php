<?php

/**
 * 判断当前访问的用户是  PC端  还是 手机端  返回true 为手机端  false 为PC 端
 * @return boolean
 */
/**
　　* 是否移动端访问访问
　　*
　　* @return bool
　　*/
function isMobile()
{
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    return true;

    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
    {
    // 找不到为flase,否则为true
    return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile');
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            return true;
    }
        // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    {
    // 如果只支持wml并且不支持html那一定是移动设备
    // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        }
    }
            return false;
 }
/**
 * Created by PhpStorm.
 * User: "姜鹏"
 * Date: 16-3-8
 * Time: 下午4:57
 */
/**
 * 格式化信息类型
 * @param $type 参数(信息类型的参数）
 * @return string 返回值 把数字类型的参数 转换成汉字类型
 *
 */
function message_format_type($type){
    switch($type){
        case 1:$name="";break;
    }
    return $name;
}

/**
 * 去除最后的0
 */
function getFloatToNum($num){
	return floatval($num);
}

/**
 * 验证邮箱
 * @param $email
 * @return bool
 */
function checkEmail($email){
    $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
    if(preg_match($pattern, $email)){
        return true;
    }else{
        return false;
    }
}
/**
 * 验证手机号支持以下号段
 *      移动：134、135、136、137、138、139、150、151、152、157、158、159、182、183、184、187、188、178(4G)、147(上网卡)；
联通：130、131、132、155、156、185、186、176(4G)、145(上网卡)；
电信：133、153、180、181、189 、177(4G)；
卫星通信：1349
虚拟运营商：170
 * @param $mobile
 * @return bool
 */
function checkMobile($mobile) {
    if (!is_numeric($mobile)) {
        return false;
    }
    return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
}

/**
 * 截取字符串
 * @param $str
 * @param int $start
 * @param $length
 * @param string $charset
 * @param bool $suffix
 * @return string
 */

function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true){
    if(function_exists("mb_substr")){
        $slice= mb_substr($str, $start, $length, $charset);
    }elseif(function_exists('iconv_substr')) {
        $slice= iconv_substr($str,$start,$length,$charset);
    }else{
        $re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
        $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
        $re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
        $re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    $fix='';
    if(strlen($slice) < strlen($str)){
        $fix='';
    }
    return $suffix ? $slice.$fix : $slice;
}
//委托状态格式化
function enstrustStatus($num){
    switch ($num){
        case 0:$data="未成交";break;
        case 1:$data="部分成交";break;
        case 2:$data="已成交";break;
        case 3:$data="已撤销";break;
        case 4:$data="全部";break;
        default:$data="暂无";
    }
    return $data;
}
//充值状态格式化
function payStatus($num){
    switch ($num){
        case 0:$data="请付款";break;
        case 1:$data="充值成功";break;
        case 2:$data="充值失败";break;
        case 3:$data="已失效";break;
        default:$data="暂无";
    }
    return $data;
}
//充值状态格式化
function zhongchouStatus($num){
    switch ($num){
        case 0:$data="新众筹";break;
        case 1:$data="众筹开始";break;
        case 2:$data="众筹结束";break;
        case 3:$data="众筹结束";break;
        default:$data="暂无";
    }
    return $data;
}

/**委托记录状态
 * @param $status  状态
 * @return string
 */
function getOrdersStatus($status){
    switch($status){
        case 0 : $data =  "挂单";
            break;
        case 1 : $data =  "部分成交";
            break;
        case 2 : $data =  "成交";
            break;
        case -1 : $data =  "已撤销";
            break;
        default: $data="未知状态";
    }
    return $data;
}

/**委托记录type
 * @param $type
 * @return string
 */
function getOrdersType($type){
    switch($type){
        case "buy": $data="买入";
            break;
        case "sell" : $data="卖出";
            break;
        case "change" : $data="兑换币";
            break;
        default: $data="未知状态";
    }
    return $data;
}

/**
 * 验证密码长度在6-20个字符之间
 * @param $pwd
 * @return bool
 */
function checkPwd($pwd){
    $pattern="/^[\\w-\\.]{6,20}$/";
    $pattern2="/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/";
    if(preg_match($pattern, $pwd)||preg_match($pattern2, $pwd)){
        return true;
    }else{
        return false;
    }
}


/**
 *  发送邮箱
 * @param String $emailHost 您的企业邮局域名
 * @param String $emailUserName 邮局用户名(请填写完整的email地址)
 * @param String $emailPassWord 邮局密码
 * @param String $formName 邮件发送者名称
 * @param String $email  收件人邮箱，收件人姓名
 * @param String $title	发送标题
 * @param String $body	发送内容
 * @return boolean
 */
function setPostEmail($emailHost,$emailUserName,$emailPassWord,$formName,$email,$title,$body) {
    // 以下内容为发送邮件
    require_once('class.phpmailer.php');//下载的文件必须放在该文件所在目录
    $mail=new PHPMailer();//建立邮件发送类
    $mail->IsSMTP();//使用SMTP方式发送 设置设置邮件的字符编码，若不指定，则为'UTF-8
    $mail->Host=$emailHost;//'smtp.qq.com';//您的企业邮局域名
    $mail->SMTPAuth=true;//启用SMTP验证功能   设置用户名和密码。
    $mail->Username=$emailUserName;//'mail@koumang.com'//邮局用户名(请填写完整的email地址)
//    $mail->Username='admin@shikeh.com';//邮局用户名(请填写完整的email地址)
//    $mail->Password='WWW15988999998com';//邮局密码
    $mail->Password=$emailPassWord;//'xiaowei7758258'//邮局密码
    $mail->From=$emailUserName;//'mail@koumang.com'//邮件发送者email地址
    $mail->FromName=$formName;//邮件发送者名称
    $mail->AddAddress($email);// 收件人邮箱，收件人姓名
    //$mail->AddBCC('chnsos@126.com',$_SESSION['clean']['name']);//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
    $mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
    $mail->Subject="=?UTF-8?B?".base64_encode($title)."?=";
    $mail->Body=$body; //邮件内容
    $mail->AltBody = "这是一封HTML格式的电子邮件。"; //附加信息，可以省略
    $mail->Send();
    return $mail->ErrorInfo;
}

/**
 * 人民币格式化
 * @param $num
 * @return array|bool|string
 */
function num_format($num){
    if(!is_numeric($num)){
        return false;
    }
    $rvalue='';
    $num = explode('.',$num);//把整数和小数分开
    $rl = !isset($num['1']) ? '' : $num['1'];//小数部分的值
    $j = strlen($num[0]) % 3;//整数有多少位
    $sl = substr($num[0], 0, $j);//前面不满三位的数取出来
    $sr = substr($num[0], $j);//后面的满三位的数取出来
    $i = 0;
    while($i <= strlen($sr)){
        $rvalue = $rvalue.','.substr($sr, $i, 3);//三位三位取出再合并，按逗号隔开
        $i = $i + 3;
    }
    $rvalue = $sl.$rvalue;
    $rvalue = substr($rvalue,0,strlen($rvalue)-1);//去掉最后一个逗号
    $rvalue = explode(',',$rvalue);//分解成数组
    if($rvalue[0]==0){
        array_shift($rvalue);//如果第一个元素为0，删除第一个元素
    }
    $rv = $rvalue[0];//前面不满三位的数
    for($i = 1; $i < count($rvalue); $i++){
        $rv = $rv.','.$rvalue[$i];
    }
    if(!empty($rl)){
        $rvalue = $rv.'.'.$rl;//小数不为空，整数和小数合并
    }else{
        $rvalue = $rv;//小数为空，只有整数
    }
    return $rvalue;
}

/** 短信认证
 * @param $phone 电话号码
 * @param $name  发送标题
 * @param $user  短息接口用户名
 * @param $pass  短信接口密码
 * @return mixed 错误信息
 */
function sandPhone($phone,$name='',$user='',$pass=''){
    $statusStr = array(
        "0" => "短信发送成功",
        "-1" => "参数不全",
        "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
        "30" => "密码错误",
        "40" => "账号不存在",
        "41" => "余额不足",
        "42" => "帐户已过期",
        "43" => "IP地址限制",
        "50" => "内容含有敏感词",
        "100"=>'您操作太频繁，请稍后再试'
    );
/*
    $smsapi = "http://hprpt2.eucp.b2m.cn:8080/sdkproxy/sendsms.action";
    $user = $user; //短信平台帐号
    $pass = $pass; //短信平台密码
*/
    $list = M("Config")->select();
	foreach ($list as $k=>$v){
       $conf[$v['key']]=$v['value'];
    }
    $smsAPI = $conf['CODE_GATE'];//短信网关
	$name = $conf['CODE_NAME']; //短信签名
    $user = $conf['CODE_USER_NAME']; //短信平台帐号
    $pass = $conf['CODE_USER_PASS']; //短信平台密码
	$mobile = $phone;

    $time = session('time');
    if (time()-$time<60&&!empty($time)){
        return $statusStr['100'];
    }
    $code=rand(100000, 999999);

    session(array('name'=>'code','expire'=>600));
    session('code',$code);  //设置session
    session('time',time());

    $content ="【侗红实业】您正在进行手机操作，您的验证码是：".$code;//要发送的短信内容

/*
	$find = array('{account}','{pswd}','{msg}','{mobile}','{needstatus}','{extno}');
	$replace = array($user,$pass,$mobile,$content);
	$url = str_replace($find,$replace,$smsapi,'false','');
*/

	$postArr = array(
		'appid' => $user,
		'signature' => $pass,
		'content' => $content,
		'to' => $mobile
     );
/*
print_r($smsAPI);
print_r($postArr);
exit;
*/
    $result = curlPost($smsAPI,$postArr);
    $res = json_decode($result, true);
    if ($res['status'] == 'success') {
        return "短信发送成功";
    } else {
        return "短信发送失败";
    }
//    $xml = simplexml_load_string($result);
//     foreach ($xml as $key => $value) {
//     	// 获取属性
//     	$attr = $value->error->attributes();
//     	return  $attr;
//     }
    //return $statusStr[$xml[0]->error];
//     $book1 = $doc->getElementsByTagName('response')->item(0);
//     $title = $book1->getElementsByTagName('error');
//     $title_1 = $title->item(0);
//     return $title_1;
//     return $result;

//     dump($user);dump($pass);dump($phone);dump($content);die;
}
/**
 * 验证手机
 * @param $code
 * @return bool
 */
function checkPhoneCode($code){
    if (session('code')!=$code){
        return  false;
    }else {
        return true;
    }
}

function sendMail($email, $subject, $content){

    $list = M("Config")->select();
    foreach ($list as $k=>$v){
       $conf[$v['key']]=$v['value'];
    }

    $smsAPI = $conf['EMAIL_HOST'];
    $appid = $conf['EMAIL_PASSWORD'];
    $from = $conf['EMAIL_USERNAME'];

    $postArr = array(
        'appid' => $appid,
        'to' => $email,
        'from' => $from,
        'html' => $content,
        'from_name' => '侗红实业',
        'signature' => '589d85f5c9c56d2763071c8808345614',
        'subject' => $subject
     );
    $result = curlPost($smsAPI,$postArr);
    $res = json_decode($result, true);
    if ($res['status'] != 'success') {
        return 1;
    }
}

/**
 * 随机数字英文字符
 * @param $param 长度
 * @return string 随机数
 */
function getRandom($param){
    $str="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $key = "";
    for($i=0;$i<$param;$i++)
    {
        $key .= $str{mt_rand(0,32)};    //生成php随机数
    }
    return $key;
}
/**
 * 财务日志添加
 * @param unknown $member_id 用户id
 * @param unknown $type	   类型
 * @param unknown $content 说明
 * @param unknown $money	变动资金
 * @param unknown $money_type	支出=2/收入=1
 * @param unknown $currency_id	币种 默认为0 为人民币
 * @return boolean
 */
function  addFinanceLog($member_id,$type,$content,$money,$money_type,$currency_id=0){
	$finance=M('Finance');
	$data['money_type']=$money_type;//收入或者支出
	$data['member_id']=$member_id;//用户id
	$data['type']=$type;//类型
	$data['content']=$content;//变动说明
	$data['money']=$money;//变动资金数量
	$data['add_time']=time();//添加时间
	$data['currency_id']=$currency_id;//币种
	$data['ip']=get_client_ip();//ip
	$data['status']=0;
	$r=$finance->data($data)->add();
	if($r){
		return true;
	}else {
		return false;
	}
}
/**
 * 格式化挂单记录status状态
 * @param unknown $status   状态
 * @return unknown
 */
 function formatOrdersStatus($status){
	switch($status){
		case 0: $status = '未成交' ;break;
		case 1: $status = '部分成交' ;break;
		case 2: $status = '已成交' ;break;
		case -1: $status = '已撤销' ;break;
		default: $status = '未成交' ;break;
	}
	return  $status;
}
/**
 * 格式化用户名
 * @param unknown $currency_id   币种id
 * @return unknown
 */
 function getCurrencynameByCurrency($currency_id){
     if(isset($currency_id)){
     	if($currency_id==0){
             return "人民币";
         }
     	return  M('Currency')->field('currency_name')->where("currency_id='{$currency_id}'")->find()['currency_name'];
	}else{
         return "未知钱币";
     }
}

/**
 * 格式化用户名
 * @param unknown $member_id
 */
 function getMemberNameByMemberid($member_id){
 	$where['member_id']= $member_id;
 	$list = M('Member')->field('name')->where($where)->find();
 	return !empty($list)?$list['name']:'无';
 }

function getMemberEmailByMember_id($member_id){
    $where['member_id']= $member_id;
    $list = M('Member')->field('email')->where($where)->find();
    return !empty($list)?$list['email']:'无';
}
function getMemberUsernameByMemberid($member_id){
	$where['member_id']= $member_id;
	$list = M('Member')->field('username')->where($where)->find();
	return !empty($list)?$list['username']:'无';
}
//格式化挂单买单还是卖单
function fomatOrdersType($type){
    switch ($type){
        case 'buy':$type='买';break;
        case 'sell':$type='卖';break;
        default:$type='无';
    }
    return $type;
}

//计算卖出比例
function setOrdersTradeNum($num,$trade_num){
   return 100-($trade_num/$num*100);
}

/**委托记录状态
 * @param $status  状态
 * @return string
 */
function formatMemberStatus($status){
    switch($status){
        case 0 : $status =  "挂单";
            break;
        case 1 : $status =  "部分成交";
            break;
        case 2 : $status =  "成交";
            break;
        default: $status="未知状态";
    }
    return $status;
}

/**
 * 根据众筹id号查找一共众筹次数
 * @param $id 用户ID
 * @return mixed 次数
 */
function getIssueMemberCountByIssueId($id){
    $re = M('Issue_log')->where("iid = '{$id}'")->count("DISTINCT uid");
    if($re){
        return $re;
    }else{
        return 0;
    }
}

/**
 * 根据众筹id号查找一共众筹次数
 * @param $id 用户ID
 * @return mixed 次数
 */
function getIssueNumCountByIssueId($id){
	$re = M('Issue_log')->where("iid = '{$id}'")->count();
	if($re){
		return $re;
	}else{
		return 0;
	}
}

/**
 *  给分页传参数
 * @param  mixed $Page 分页对象
 * @param array $parameter 传参数组
 */
function setPageParameter($Page,$parameter){
    foreach ($parameter as $k=> $v){
        if (isset($v)){
            $Page->parameter[$k]=$v;
        }
    }
}
/**
 * 获取用户状态
 * @param string $status 状态
 * @return boolean|string 状态
 */
function getMemberStatus($status){
	if(empty($status)){
		return false;
	}
	switch($status){
		case 0 : $status =  "未填写个人信息";
		break;
		case 1 : $status =  "正常";
		break;
		case 2 : $status =  "禁用";
		break;
		default: $status="未知状态";
	}
	return $status;
}
     /**
      * 获取文章分类名
      * @param int $id   分类id
      * @return 文章分类名
      */
     function getUsernameByid($id){
     		$member=M("Member")->field('username')->where('member_id='.$id)->find();
	        return $member['username'];
     }
/**
 * 检测sql
 * @param unknown $sql_str 语句
 * @return unknown
 */
function inject_check($sql_str) {
	$check= preg_match('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str);
	if($check){
		return true;
	}else{
		return false;
	}
}

function bank_check($mobile, $bankcard, $cardNo, $realName)
{    
    $host = "https://aliyun-bankcard-verify.apistore.cn";
    $path = "/bank";
    $method = "GET";
    $appcode = "300038472d23467d96252bc0385bb4e4";
    $headers = array();
    array_push($headers, "Authorization:APPCODE " . $appcode);
    $querys = "Mobile={$mobile}&bankcard={$bankcard}&cardNo={$cardNo}&realName={$realName}";
    $bodys = "";
    $url = $host . $path . "?" . $querys;
    $res = curlGet($url, $headers);
    $res = json_decode($res, true);
    return $res;
}

function curlGet($url, $headers = '')
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_URL, $url);
    if ($headers) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    if (1 == strpos("$".$url, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    $html = curl_exec($curl);
    curl_close($curl);
    return $html;
}

/**
 * 通过CURL发送HTTP请求
 * @param string $url  //请求URL
 * @param array $postFields //请求参数
 * @return mixed
 */
function curlPost($url,$postFields){
	$postFields = http_build_query($postFields);
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_HEADER, 0 );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $postFields );
    if (1 == strpos("$".$url, "https://"))
    {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }
	$result = curl_exec ( $ch );
	curl_close ( $ch );
	return $result;
}



/**
 * 获取会员等级名称
 */
function getMemberGradeTitle($grade_id){
    $result=M('member_grade')->where(['id'=>$grade_id])->getField('title')?:'';
    return $result;
}
function array_value_sum()
{
    $res = array();
    foreach (func_get_args() as $arr) {
        foreach ($arr as $k => $v){
            if (!isset($res[$k])){
                $res[$k] = $v;
            }else{
                $res[$k] += $v;
            }
        }
    }
    return $res;
}
function array_value_minus()
{
    $res = array();
    foreach (func_get_args() as $arr) {
        foreach ($arr as $k => $v){
            if (!isset($res[$k])){
                $res[$k] = $v;
            }else{
                $res[$k] -= $v;
            }
        }
    }
    return $res;
}