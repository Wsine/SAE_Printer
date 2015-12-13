<?php
require_once('saestorage.class.php');
#your app accesskey
$accesskey = 'enter_your_app_accesskey';
#your app secretkey
$secretkey = 'enter_your_app_secretkey';
#your doamin name
$domain = 'enter_your_doamin_name';
$storage = new SaeStorage($accesskey, $secretkey);
$filesNum = $storage->getFilesNum($domain);
$fileList = $storage->getList($domain);
//print_r($fileList);
foreach ($fileList as $oneFile) {
	$fileName = $oneFile['fileName'];
	//var_dump($fileName);
	echo $fileName;
	$fileNameNoDir = explode("/",$fileName)[1];
	if(!file_exists($fileNameNoDir)){
		$fileUrl = $storage ->getUrl($domain, $fileName);
		$cmd = 'wget ' . $fileUrl;
		shell_exec($cmd);
	}
}

?>
