<?php
namespace App\Home\Controller;
use Illuminate\Database\Capsule\Manager as DB;
/**
* 初始欢迎页
*/

class Index extends Base{
  public function index(){
	$data = [
		['name'=>'进入商城','event'=>'view','val'=>'http://www.baidu.com'],
		['pname'=>'个人中心',
			['name'=>'我的订单','event'=>'view','val'=>'http://www.taobao.com']
			['name'=>'我的钱包','event'=>'view','val'=>'http://www.tianmao.com']
		],
		['name'=>'积分商城','event'=>'view','val'=>'http://www.jd.com']
	];
	// 按钮类型
	// view
	// click
	// scancode_push
	// scancode_waitmsg
	// pic_sysphoto
	// pic_photo_or_album
	// pic_weixin
	// location_select
	// media_id
	// view_limited
    $this -> success('Hwllo World','恭喜您框架搭建成功');
  }

}
