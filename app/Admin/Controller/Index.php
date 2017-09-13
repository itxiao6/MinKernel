<?php
namespace App\Admin\Controller;

/**
 * 后台首页控制器
 * Class Index
 * @package App\Admin\Controller
 */
class Index extends Base{
    # 后台首页
    public function index()
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
        $data = 'var navs = [{
            "title": "基本元素",
            "icon": "fa-cubes",
            "spread": true,
            "children": [{
                "title": "按钮",
                "icon": "&#xe641;",
                "href": "/Element/button.html"
            }, {
                "title": "表单",
                "icon": "&#xe63c;",
                "href": "/Element/form.html"
            }, {
                "title": "表格",
                "icon": "&#xe63c;",
                "href": "/Element/table.html"
            }, {
                "title": "导航",
                "icon": "&#xe609;",
                "href": "/Element/nav.html"
            }, {
                "title": "辅助性元素",
                "icon": "&#xe60c;",
                "href": "/Element/auxiliar.html"
            }]
        }, {
            "title": "组件",
            "icon": "fa-cogs",
            "spread": false,
            "children": [{
                "title": "BTable",
                "icon": "fa-table",
                "href": "/Element/btable.html"
            }, {
                "title": "Navbar组件",
                "icon": "fa-navicon",
                "href": "/Element/navbar.html"
            }, {
                "title": "Tab组件",
                "icon": "&#xe62a;",
                "href": "/Element/tab.html"
            }, {
                "title": "Laytpl+Laypage",
                "icon": "&#xe628;",
                "href": "/Element/paging.html"
            }]
        }, {
            "title": "第三方组件",
            "icon": "&#x1002;",
            "spread": false,
            "children": [{
                "title": "iCheck组件",
                "icon": "fa-check-square-o",
                "href": "/Element/icheck.html"
            }]
        }, {
            "title": "地址本",
            "icon": "fa-address-book",
            "href": "",
            "spread": false,
            "children": [{
                "title": "Github",
                "icon": "fa-github",
                "href": "https://www.github.com/"
            }, {
                "title": "QQ",
                "icon": "fa-qq",
                "href": "http://www.qq.com/"
            }, {
                "title": "Fly社区",
                "icon": "&#xe609;",
                "href": "http://fly.layui.com/"
            }, {
                "title": "新浪微博",
                "icon": "fa-weibo",
                "href": "http://weibo.com/"
            }]
        }, {
            "title": "这是一级导航",
            "icon": "fa-stop-circle",
            "href": "https://www.baidu.com",
            "spread": false
        }, {
            "title": "其他",
            "icon": "fa-stop-circle",
            "href": "#",
            "spread": false,
            "children": [{
                "title": "子窗体中打开选项卡",
                "icon": "fa-github",
                "href": "/Element/cop.html"
            }]
        }];';
        $this -> ajaxReturn($data,'EVAL');
    }
    public function table(){
        $this -> display();
    }
}
