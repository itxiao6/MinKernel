<?php
namespace App\Home\Controller;
use Thenbsp\Wechat\Wechat\AccessToken;
use Doctrine\Common\Cache\FilesystemCache;
/**
* 初始欢迎页
*/

class Index extends Base{
  public function index(){
    $this -> success('Hwllo World','恭喜您框架搭建成功');
  }
}
