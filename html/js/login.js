// JavaScript Document
//支持Enter键登录
		document.onkeydown = function(e){
			if($(".bac").length==0)
			{
				if(!e) e = window.event;
				if((e.keyCode || e.which) == 13){
					var obtnLogin=document.getElementById("submit_btn")
					obtnLogin.focus();
				}
			}
		}

    	$(function(){
			//提交表单
			$('#submit_btn').click(function(){
				show_loading();
				if($('#user_name').val() == ''){
					show_err_msg('用户名还没填呢！');	
					$('#user_name').focus();
				}
				else if($('#password').val() == ''){
					show_err_msg('密码还没填呢！');
					$('#password').focus();
				}
				else if($('#user_name').val() == 'admin' || $('#password').val() == 'admin'){
					//ajax提交表单，#login_form为表单的ID。 如：$('#login_form').ajaxSubmit(function(data) { ... });
					show_msg('登录成功咯！  正在为您跳转...','uploadfile.html');
				}
				else if($('#user_name').val() == 'root' || $('#password').val() == 'root'){
					show_msg('登录成功咯！  正在为您跳转...','uploadfile.html');
				}
				else if($('#user_name').val() == 'test' || $('#password').val() == 'test'){
					show_msg('登录成功咯！  正在为您跳转...','uploadfile.html');
				}
				else{
					show_err_msg('用户名或密码错误！');
					$('#user_name').focus();
				}
			});
		});