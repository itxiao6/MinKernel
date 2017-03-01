<?php
namespace App\Home\Controller;
use Illuminate\Database\Capsule\Manager as DB;
/**
* 初始欢迎页
*/

class Index extends Base{
  public function index(){
    // 获取一级标题
    $data = M('type') -> where(['pid'=>0]) -> limit(10) -> orderBy('sort') -> get() -> toArray();
    // 品牌活动周
     if($advert = M('goods') -> where(['status'=>1]) -> where('dis_price','>',0) ->limit(5) -> get()){
        $advert = $advert -> toArray();
      }
    // 分配变量
    $this -> assign('data',$data);
    $this -> assign('advert',$advert);
    // 展示位调用数据
      // 获取一级分类
      $one = M('type')  -> where(['pid'=>0]) -> get() -> toArray();
      // 组装路径
      foreach($one as $key => $value){
         // 获取二级分类
        if($two = M('type') -> where(['pid'=>$value['id']]) -> get()){
          $two = $two -> toArray();
          $one[$key]['two'] = $two;
          foreach($two as $k1=>$v1){
            $three[] = M('type')  -> where(['pid'=>$v1['id']]) -> get() -> toArray();
            $one[$key]['san'] = $three;
            foreach($three[0] as $k2=>$v2){
              if($abc = M('goods') -> where(['type'=>$v2['id']]) -> limit(8) -> get()){
                $one[$key]['advert'] = $abc -> toArray();
              }
            }
          }
          
        }
      }
    $this -> assign('show',$one);
    // dump(M('banner') -> orderBy('sort') -> get() -> toArray());die;
    $this -> assign('banner',M('banner') -> orderBy('sort') -> get() -> toArray());
    $this -> assign('article',M('article') -> orderBy('sort') -> get() -> toArray());
    $this -> display();
    // $this -> success('Hwllo World','恭喜您框架搭建成功');
  }
  

  // 退出
  public function logout(){
    $_SESSION['home']['user']=null;
  echo "<script>alert('退出成功');location='/Home/Index/index.html'</script>";
  }
  // 获取二级三级分类
  public function get_2_3(){
      if($tow = M('type') -> where(['pid'=>$_GET['n']]) -> get()){
          $tow = $tow -> toArray();
      }else{
        $this -> ajaxReturn(['status'=>2]);
      }
      foreach ($tow as $key => $value) {
        if($tmp = M('type') -> where(['pid'=>$value['id']]) -> get()){
            $tow[$key]['tow'] = $tmp -> toArray();
        }
      }
      // 返回数据
      $this -> ajaxReturn(['status'=>1,'data'=>$tow]);
  }
  // 获取广告信息
  public function advert(){

    // 获取商品活动周
    if($_GET['n']==0){

      if($data = M('goods') -> where(['status'=>1]) -> where('dis_price','>',0) ->limit(5) -> get()){
        $data = $data -> toArray();
      }

      $this -> ajaxReturn(['status'=>1,'data'=>$data]);
    // 获取热卖商品
    }elseif($_GET['n']==1){
      if($data = M('goods') -> where(['hot'=>1,'status'=>1]) ->limit(5) -> get()){
        $data = $data -> toArray();
      }
      $this -> ajaxReturn(['status'=>1,'data'=>$data]);
    // 获取新品
    }elseif($_GET['n']==2){
      if($data = M('goods') -> where(['new'=>1,'status'=>1]) ->limit(5) -> get()){
        $data = $data -> toArray();
      }

      $this -> ajaxReturn(['status'=>1,'data'=>$data]);
    }
  }

  // 获取盒子信息
  public function box(){
     if($data = M('type') -> where(['pid'=>$_GET['type']]) -> get()){
          $data = $data -> toArray();
          foreach ($data as $key => $value) {
            if($result = M('goods') -> where(['type'=>$value['id']])-> limit(8) ->get()){
              $result  = $result -> toArray();
            }
          }
          $this -> ajaxReturn(['status'=>1,'data'=>$result]);
        }
    }

    // 文章模板
  public function notice(){
    if($data = M('article') -> where(['id'=>$_GET['id']]) -> first()){
      $data = $data -> toArray();
    }
    $this -> assign('data',$data);
    $this -> display('Index.notice');
  }
}
