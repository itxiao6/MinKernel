<?php
namespace App\Admin\Controller;
use App\Model\AdminNode;
use ReflectionClass;
use ReflectionMethod;
use Reflection;

/**
 * 后台权限管理
 * Class Jurisdiction
 * @package App\Admin\Controller
 */
class Jurisdiction extends Base{
    # 结点管理
    public function node()
    {
        if(isset($_GET['data'])) {
            $data = [];
            $data['list'] = AdminNode::get();
            $data['msg'] = '获取成功';
            $data['level'] = AdminNode::LEVEL;
            $data['rel'] = true;
            $data['count'] = count($data['list']);
            $this -> ajaxReturn($data);
        }else{
            #渲染模板
            $this -> display();
        }
    }
    # 获取控制器方法
    public function get_controller_fun()
    {
        $result = new ReflectionClass('\App\Admin\Controller\\'.$_GET['class_name']);

        $methods = $result -> getMethods();
        $sys_methods = ['__init',
            '__AuthCache',
            '__clear_cache',
            '__construct',
            'display',
            'getView',
            'assign',
            'ajaxReturn',
            'redirect',
            'message',
            '__call',
            '__destruct'];
        $data = [];
        foreach ($methods as $val){
            $obj = new ReflectionMethod($val->class,$val -> name);
            $obj = Reflection::getModifierNames($obj->getModifiers());

            if($obj[0] =='public' && (!in_array($val -> name,$sys_methods))){
                $data['funs'][] = $val -> name;
            }
        }
        if(count($data['funs']) < 1){
            $data['msg'] = '该控制器没有方法';
        }else{
            $data['msg'] = '获取成功';
        }
        $this -> ajaxReturn($data);
    }
    # 添加结点
    public function add_node()
    {
        if(IS_POST){
            dd($_POST);
        }else{
            $this -> display();
        }

    }
    # 类型管理
    public function type()
    {
        #渲染模板
        $this -> display();
    }
    # 用户管理
    public function user()
    {
        # 渲染模板
        $this -> display();
    }
}
