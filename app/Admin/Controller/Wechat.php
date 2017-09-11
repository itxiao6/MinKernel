<?php
namespace App\Admin\Controller;
use Itxiao6\Wechat\Wechat\AccessToken;
use Itxiao6\Wechat\Menu\Button;
use Itxiao6\Wechat\Menu\ButtonCollection;
use Itxiao6\Wechat\Menu\Create;
/**
 * 微信管理
 */

class Wechat extends Base{
    # 菜单管理
    public function menu()
    {
        #渲染模板
        $this -> display();
    }
    # 添加微信菜单
    public function add_menu()
    {

    }
    # 更新微信菜单
    public function update_menu()
    {
        # 微信菜单
        $data = [
            ['name'=>'个人中心','two'=>
                [['name'=>'我的订单','event'=>'view','val'=>'http://www.taobao.com'],
                    ['name'=>'我的钱包','event'=>'view','val'=>'http://www.tianmao.com']]
            ],
            ['name'=>'进入商城','event'=>'view','val'=>'http://www.tianmao.com'],
            ['name'=>'进入商城','event'=>'view','val'=>'http://www.tianmao.com']
        ];
        # 判断是否存在按钮
        if(count($data) < 1){
            $this -> error('菜单不存在');
        }
        # 判断是否已经获取过accessToken
        $accessToken = new AccessToken(C('appid','wechat'), C('secret','wechat'));
        # 设置缓存
        $accessToken->setCache(Cache::getDriver());
        # 获取accessToken
        $accessToken = $accessToken->getTokenString();
        # 定义所有按钮
        $buttons = [];
        # 循环所有数据
        foreach ($data as $key => $value) {
            if(isset($value['two'])){
                $button = new ButtonCollection($value['name']);
                # 循环二级菜单
                foreach ($value['two'] as $k => $v) {
                    # 添加二级按钮
                    $button->addChild(new Button($v['name'],$v['event'],$v['val']));
                }
            }else{
                # 创建一级按钮
                $button= new Button($value['name'],$value['event'],$value['val']);
            }
            # 累加按钮
            $buttons[] = $button;
        }
        # 发布菜单
        $create = new Create($accessToken);
        # 循环添加按钮
        foreach ($buttons as $key => $value) {
            $create->add($value);
        }
        # 执行创建
        try {
            $create->doCreate();
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
        # 返回结果
        $this -> success('更新成功');
    }
    # 配置管理
    public function config()
    {
        #渲染模板
        $this -> display();
    }
}
