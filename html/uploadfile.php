<?php

$domain = "enter_your_doamin_name";
$file_name = $_FILES["fileToUpload"]["name"];
$allow_ext = array(
	'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'pdf', 'txt'),
);
$file_ext = strtolower(trim(array_pop(explode(".", $file_name))));
$dir_name = empty($_GET['dir']) ? 'file' : trim($_GET['dir']);
if(in_array($file_ext, $allow_ext[$dir_name]) === false){
	alert("不支持的扩展名，目前我们仅支持以下扩展名：".implode(',',$allow_ext[$dir_name]));
	exit;
}
//$new_file_name = 'printer/' . time() . '.' . $file_ext;
$print_code = generate_password();
$new_file_name = 'printer/' . $print_code . '.' . $file_ext;
$s = new SaeStorage();
$result = $s->upload($domain, $new_file_name, $_FILES["fileToUpload"]["tmp_name"]);
send_mail($print_code, $file_name);
successUpload($result, $print_code);

function alert($msg){
	header('Content-type: text/html; charset=UTF-8');
	var_dump(array('error' => 1, 'message' => $msg));
	exit;
}

function successUpload($msg, $code){
	//header('Location: http://mywsine.sinaapp.com/SAE_Printer/uploadfile.html');
	header('Content-type: text/html; charset=UTF-8');
	echo "<script>alert('上传成功！你的打印密钥是：" . $code ."');window.location.href='uploadfile.html'</script>";
	exit;
}

function generate_password( $length = 8 ) {
    // 密码字符集，可任意添加你需要的字符
    //$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ []{}<>~`+=,.;:/?|';
    $chars = '0123456789';
    $maxn = strlen($chars) - 1;
    $password = '';
    for ( $i = 0; $i < $length; $i++ ) {
        // 这里提供两种字符获取方式
        // 第一种是使用 substr 截取$chars中的任意一位字符；
        // 第二种是取字符数组 $chars 的任意元素
        // $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        $password .= $chars[ rand(0, $maxn) ];
    }
    return $password;
}

function send_mail($code, $file_name){
    /*
     * 注：本邮件类都是经过我测试成功了的，如果大家发送邮件的时候遇到了失败的问题，请从以下几点排查：
     * 1. 用户名和密码是否正确；
     * 2. 检查邮箱设置是否启用了smtp服务；
     * 3. 是否是php环境的问题导致；
     * 4. 将76行的$smtp->debug = false改为true，可以显示错误信息，然后可以复制报错信息到网上搜一下错误的原因；
     */

    require_once "email.class.php";
    //******************** 配置信息 ********************************
    $smtpserver = "your_SMTP_server";//SMTP服务器
    $smtpserverport =25;//SMTP服务器端口
    $smtpusermail = "your_send_Email_address";//SMTP服务器的用户邮箱
    $smtpemailto = 'user_receive_Email_address';//发送给谁
    $smtpuser = "SMTP_user_account";//SMTP服务器的用户帐号
    $smtppass = "SMTP_user_password";//SMTP服务器的用户密码
    //$mailtitle = $_POST['自助云打印机打印密钥'];//邮件主题
    $mailtitle = '自助云打印机打印密钥';//邮件主题
    $content = "您的 ".$file_name." 打印密钥是：".$code;
    //$mailcontent = "<h1>".$_POST[$content]."</h1>";//邮件内容
    $mailcontent = "<h1>".$content."</h1>";//邮件内容
    $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
    //************************ 配置信息 ****************************
    $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
    $smtp->debug = false;//是否显示发送的调试信息
    $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
    return;
}

?>