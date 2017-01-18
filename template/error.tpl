<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<title>{{$title}}</title>
	<link rel="stylesheet" href="https://weui.io/weui.css">
	<link rel="stylesheet" href="https://weui.io/example.css">
</head>
<body>
	<div class="container" id="container">
		<div class="page msg_success js_show">
		    <div class="weui-msg">
		        <div class="weui-msg__icon-area"><i class="weui-icon-warn weui-icon_msg"></i></div>
		        <div class="weui-msg__text-area">
		            <h2 class="weui-msg__title">{{$title}}</h2>
		            <p class="weui-msg__desc">{{$message}}</p>
		        </div>
		        <div class="weui-msg__opr-area">
		            <p class="weui-btn-area">
		                <a href="javascript:@if($url=='') history.go(-1); @else window.location='{{$url}}'; @endif" class="weui-btn weui-btn_warn">确定</a>
		            </p>
		        </div>
		        <div class="weui-msg__extra-area">
		            <div class="weui-footer">
		                <p class="weui-footer__links">
		                    <a href="javascript:void(0);" class="weui-footer__link">KernelMin</a>
		                </p>
		                <p class="weui-footer__text">KernelMin版权所有</p>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</body>
</html>