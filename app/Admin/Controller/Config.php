<?php
namespace App\Admin\Controller;

/**
 * 系统管理
 * Class System
 * @package App\Admin\Controller
 */
class Config extends Base
{
    # 七牛配置
    public function qiniu()
    {
        if(IS_POST){
            $data = [];
            # 访问key
            $data['accessKey'] = $_POST['accessKey'];
            # 秘钥
            $data['secretKey'] = $_POST['secretKey'];
            # 存储块的名称
            $data['bucket_name'] = $_POST['bucket_name'];
            # 外网访问域名
            $data['bucket_host'] = $_POST['bucket_host'];
            try{
                \App\Model\Config::set_qiniu_config($data);
                $this -> ajaxReturn(['status'=>1,'message'=>'保存成功']);
            }catch (\Exception $exception){
                $this -> ajaxReturn(['status'=>2,'message'=>$exception -> getMessage()]);
            }
        }else{
            # 获取七牛云的配置 并分配到模板引擎
            $this -> assign('data',\App\Model\Config::where(['type'=>4]) -> pluck('value','name'));
            # 渲染模板
            $this -> display();
        }
    }
    # 阿里OSS配置
    public function alioss()
    {
        if(IS_POST){
            $data = [];
            # 访问key
            $data['accessKey'] = $_POST['accessKey'];
            # 秘钥
            $data['secretKey'] = $_POST['secretKey'];
            # 存储块的名称
            $data['bucket_name'] = $_POST['bucket_name'];
            # 外网访问域名
            $data['bucket_host'] = $_POST['bucket_host'];
            # vpc 网络 内网域名
            $data['vpc_host'] = $_POST['vpc_host'];
            # 经典网络内网域名
            $data['loca_host'] = $_POST['loca_host'];
            try{
                \App\Model\Config::set_alioss_config($data);
                $this -> ajaxReturn(['status'=>1,'message'=>'保存成功']);
            }catch (\Exception $exception){
                $this -> ajaxReturn(['status'=>2,'message'=>$exception -> getMessage()]);
            }
        }else{
            # 获取七牛云的配置 并分配到模板引擎
            $this -> assign('data',\App\Model\Config::where(['type'=>5]) -> pluck('value','name'));
            # 渲染模板
            $this -> display();
        }
    }
}