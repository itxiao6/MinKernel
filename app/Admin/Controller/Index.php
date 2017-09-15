<?php
namespace App\Admin\Controller;
use App\Model\Menu;

/**
 * 后台首页控制器
 * Class Index
 * @package App\Admin\Controller
 */
class Index extends Base{
    # 后台首页
    protected function index()
    {
        #渲染模板
        $this -> display();
    }
    # 欢迎页
    public function main()
    {
        $this -> display();
    }
    # 获取导航
    public function get_nav()
    {
        # 获取一级导航
        ($nav = Menu::where(['pid'=>0]) -> select('id','title','icon','controller') -> get()) && $nav = $nav -> toArray();
        # 判断是否有一级导航
        if(count($nav) < 1){
            return false;
        }
        # 处理是否展开
        foreach ($nav as $key=>$item){
            # 默认为不展开
            $nav[$key]['spread'] = false;
            # 找到当前控制器
            if($item['controller']==CONTROLLER_NAME){
                # 设置展开
                $nav[$key]['spread'] = true;
            }
        }
        # 获取二级导航
        foreach ($nav as $key=>$item){
            ($children = Menu::where(['pid'=>$item['id']]) -> select('title','icon','href') -> get()) && $children = $children -> toArray();
            $nav[$key]['children'] = $children;
        }
        $data = 'var navs = '.json_encode($nav).';';
        $this -> ajaxReturn($data,'EVAL');
    }
    public function table(){
        $this -> display();
    }
}
