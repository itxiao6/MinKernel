<?php
namespace Service;
use Xiaoler\Blade\Compilers\BladeCompiler;
use Xiaoler\Blade\Engines\CompilerEngine;
use Xiaoler\Blade\FileViewFinder;
use Xiaoler\Blade\Factory;
/**
 * 视图类
 */
class View{
    // 定义魔板目录
    CONST VIEW_PATH = [ROOT_PATH.'app/View'];
    // 定义编译缓存目录
    CONST CACHE_PATH = ROOT_PATH.'runtime/view';
    // 模板的后缀名
    CONST EXTENSIONS = ['php','html','tpl'];
    // 获取视图实例
    public static function getView(){
      // 循环处理模板目录
      foreach(self::VIEW_PATH as $value){
        // 判断模板目录是否存在
        if( !file_exists($value) ){
            throw new \Exception("模板目录不存在或没有权限".$value);
        }
      }
      // 判断模板编译目录是否存在并且有写入的权限
      if( (!file_exists(self::CACHE_PATH)) or (!is_writable(self::CACHE_PATH)) ){
          throw new \Exception("模板编译目录不存在或没有权限");
      }
      $compiler = new BladeCompiler(self::CACHE_PATH);
      $engine = new CompilerEngine($compiler);
      $finder = new FileViewFinder(self::VIEW_PATH,self::EXTENSIONS);
      $factory = new Factory($engine,$finder);
      return $factory;
    }
}