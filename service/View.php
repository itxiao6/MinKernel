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
    # 获取视图实例
    public static function getView(){
      # 循环处理模板目录
      foreach(C('view_path','sys') as $value){
        # 判断模板目录是否存在
        if( !file_exists($value) ){
            throw new \Exception("模板目录不存在或没有权限".$value);
        }
      }
      # 判断模板编译目录是否存在并且有写入的权限
      if( (!file_exists(CACHE_VIEW)) or (!is_writable(CACHE_VIEW)) ){
          throw new \Exception("模板编译目录不存在或没有权限");
      }
      $compiler = new BladeCompiler(CACHE_VIEW);
      $engine = new CompilerEngine($compiler);
      $finder = new FileViewFinder(C('view_path','sys'),C('extensions','sys'));
      $factory = new Factory($engine,$finder);
      return $factory;
    }
}