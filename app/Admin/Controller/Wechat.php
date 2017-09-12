<?php
namespace App\Admin\Controller;
use App\Model\Menu;
use App\Model\WechatConfig;
use App\Model\WechatMenu;
use Cache;
use Itxiao6\Wechat\Wechat\AccessToken;
use Itxiao6\Wechat\Menu\Button;
use Itxiao6\Wechat\Menu\ButtonCollection;
use Itxiao6\Wechat\Menu\Create;

/**
 * 微信管理
 * Class Wechat
 * @package App\Admin\Controller
 */
class Wechat extends Base{
    # 菜单管理
    public function menu_list()
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
        # 获取菜单
        $data = WechatMenu::where(['pid'=>0]) -> get();
        # 判断是否存在按钮
        if(count($data) < 1){
            $this -> error('菜单不存在');
        }
        # 定义所有按钮
        $buttons = [];
        # 循环所有数据
        foreach ($data as $key => $value) {
            $button = [];
            if(count($value -> son) > 0){
                $button = new ButtonCollection($value -> name);
                # 循环二级菜单
                foreach ($value -> son as $k => $v) {
                    # 判断子菜单是否超过5个
                    if($key > 4){
                        $this -> error('子菜单不能超过5个');
                    }
                    # 添加二级按钮
                    $button -> addChild(new Button($v -> name,$v -> event,$v -> val));
                }
            }else{
                # 创建一级按钮
                $button = new Button($value -> name,$value -> event,$value -> val);
            }
            # 累加按钮
            $buttons[] = $button;
        }
        # 判断是否已经获取过accessToken
        $accessToken = new AccessToken(WechatConfig::get('appid'),WechatConfig::get('secret'));
        # 设置缓存
        $accessToken -> setCache(Cache::getDriver());
        # 获取accessToken
        $accessToken -> getTokenString();
        # 实例化自定义菜单接口
        $create = new Create($accessToken);
        # 循环添加按钮
        foreach ($buttons as $key => $value) {
            $create -> add($value);
        }
        # 执行创建
        try {
            $create -> doCreate();
        } catch (\Exception $e) {
            exit($e -> getMessage());
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
