#SAE_Printer

这个是工程嘉年华的时候做的一个参赛项目，只做了一周，比较赶，但是功能还算齐全。

###html
这个文件夹内容放置在SAE平台上运行，使用了SAE_Storage服务

- js
	- login.js
		- 这里是密码设置
- uploadfile.php
	- 这里需要设置SAE_Storage参数
	- 这里如果需要使用SMTP邮箱服务，参考里面的注释

###pi
这个文件夹内容放置在树莓派2代平台上运行，使用了Curl库和SAE_Storage_Php_SDK。树莓派需要内置libreoffice和php5，phthon(自带)环境。
硬件设备还需要一个LCD显示屏。

- getFile2.php
	- 这里需要设置SAE_Storage参数