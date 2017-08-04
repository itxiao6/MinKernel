<?php
namespace Service;
use Service\Http;
/**
 * Class Page
 * @package Service
 */
class Page{

    /**
     * 当前页
     * @var int
     */
    protected static $page = 1;

    /**
     * 默认每页条数
     * @var int
     */
    protected static $num = 10;

    /**
     * 操作的模型
     * @var Object
     */
    protected static $model;

    /**
     * 条件
     * @var Array
     */
    protected static $where;

    /**
     * 总条数
     * @var Int
     */
    public static $count;

    /**
     * 当页条数
     * @var Int
     */
    public static $page_num;

    /**
     * 最后一页
     * @var Int
     */
    public static $last_page;

    /**
     * 上一页链接
     * @var String
     */
    protected static $prev_page_url;

    /**
     * 下一页链接
     * @var String
     */
    protected static $next_page_url;

    /**
     *  数组分页
     * @var array
     */
    protected static $array_data = [];

    /**
     * 数组分页开始位置
     * @var Int
     */
    protected static $start;

    /**
     * 数组排序规则 0:不变,1:反序
     * @var Int
     */
    protected static $order = 0;
    /**
     * 链接的模板
     * @var Array
     */
    protected static $template = [
        'start'=>'<ul><li><a href="{$start_link}">首页</a></li>',
        'item'=>'<li><a href="{$link}">{$num}</a></li>',
        'end'=>'<li><a href="{$end_link}">尾页</a></li></ul>',
    ];
    /**
     * 设置当前页数
     * @param int $page
     */
    public static function set_page($page = 1)
    {
        self::$page = $page;
    }

    /**
     * 设置links 模板
     * @param string $start 头模板
     * @param string $item 每条模板
     * @param string $end 尾部模板
     */
    public static function set_template($start = '<ul><li><a href="{$start_link}">首页</a></li>',$item = '<li><a href="{$link}">{$num}</a></li>',$end = '<li><a href="{$end_link}">尾页</a></li></ul>'){
        # 设置头模板
        self::$template['start'] = $start;
        # 设置每条模板
        self::$template['item'] = $item;
        # 设置尾部模板
        self::$template['end'] = $end;
    }

    /**
     * 设置当前每页条数
     * @param $num
     */
    public static function set_num($num)
    {
        self::$num = $num;
    }

    /**
     * 输出链接组
     */
    public static function links()
    {
        # 拼接头
        $str = str_replace('{$start_link}',self::get_url().'page=1',self::$template['start']);
        # 循环页
        for ($i=1;$i<=self::$last_page;$i++){
            # 替换链接
            $item = str_replace('{$link}',self::get_url().'&page='.$i,self::$template['item']);
            # 替换页数
            $item = str_replace('{$num}',$i,$item);
            # 拼接页数
            $str .= $item;
        }
        # 拼接尾
        $str .= str_replace('{$end_link}',self::get_url().'&page='.self::$last_page,self::$template['end']);
        # 返回结果
        return $str;
    }

    /**
     * 设置当前模型
     * @param $object
     */
    public static function set_model(&$model)
    {
        self::$model = $model;
    }

    /**
     * 分页
     * @param int $num
     * @return Object
     */
    public static function page($num = 0,$model = false,$page=0)
    {
        # 判断调试是否小于等于0
        if($num <= 0){
            $num = self::$num;
        }else{
            self::$num = $num;
        }
        # 判断是否传了模型
        if($model){
            self::$model = $model;
        }
        # 判断是否传入了页数
        if($page != 0){
            self::$page = $page;
        }
        # 获取数据总条数
        self::$count = self::$model -> count();

        # 设置分页
        self::$model = self::$model -> skip(self::$num * (self::$page - 1))->take(self::$num);

        # 获取当页条数
        self::$page_num = self::$model -> count();

        # 获取总页数
        self::$last_page = sprintf('%d',ceil(self::$count / self::$num));

        # 判断是否已经到达末页了
        if(self::$page < self::$last_page){
            # 下一页链接地址
            self::$next_page_url = self::get_url().'&page='.(self::$page + 1);
        }else{
            # 空链接
            self::$next_page_url = null;
        }

        # 判断是否已经是首页
        if(self::$page > 1){
            # 上一页链接地址
            self::$prev_page_url = self::get_url().'&page='.(self::$page - 1);
        }else{
            # 空链接
            self::$prev_page_url = null;
        }

        # 返回分页过的模型
        return self::$model;
    }
    /**
     * 数组分页函数
     * 用此函数之前要先将数据库里面的所有数据按一定的顺序查询出来存入数组中
     * @param int $num 每页多少条数据
     * @param int $page 当前第几页
     * @param array $array_data 查询出来的所有数组
     * @param int $order 0:不变 1:反序
     * @return array
     */
    public static function page_array($num = 0,$page = 0,$array_data = [],$order = 0){

        # 判断是否传入的每页的数量
        if($num != 0){
            self::$num = $num;
        }

        # 判断是否传入了页数
        if($page != 0){
            self::$page = $page;
        }

        # 判断是否传入了数据
        if(count($array_data) > 0){
            self::$array_data = $array_data;
        }

        # 判断是否传入了排序规则
        if($order != 0){
            self::$order = $order;
        }

        # 判断当前页面是否为空 如果为空就表示为第一页面
        self::$page = empty(self::$page) ? 1 : self::$page;

        # 计算每次分页的开始位置
        self::$start=(self::$page - 1) * self::$num;

        # 判断数组是反序
        if($order == 1){
            # 翻转数组
            self::$array_data = array_reverse(self::$array_data);
        }
        # 获取数据总数
        self::$count = count(self::$array_data);

        #计算总页面数
        self::$last_page = sprintf('%d',ceil(self::$count / self::$num));

        #返回查询数据
        return array_slice(self::$array_data,self::$start,self::$num);
    }

    /**
     *
     * @return mixed
     */
    public static function get_data(){
        return self::$model -> get();
    }

    /**
     * 获取当前url
     * @return mixed
     */
    protected static function get_url()
    {
        return preg_replace('!page=!','',$_SERVER['REQUEST_URI']);
    }
}