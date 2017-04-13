<?php
namespace Service;
use PHPMailer;
use Exception;
/**

* \Mail

*/

class Mail {
  # 发送邮件
  public static function senEmailTo($to,$toName='',$content,$title,$debug,$isHtml=true,$files=[]){
    require_once(ROOT_PATH.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'phpmailer'.DIRECTORY_SEPARATOR.'phpmailer'.DIRECTORY_SEPARATOR.'PHPMailerAutoload.php');
    if($debug){
      $mail -> SMTPDebug = 3;                               # 是否开启调试模式
    }
    $mail -> isSMTP();                                      # 使用smtp发送
    $mail -> Host = C('host','mail');                       # 设置主机名
    $mail -> SMTPAuth = true;                               # smtp认证
    $mail -> Username = C('username','mail');               # 邮箱用户名
    $mail -> Password = C('password','mail');               # 邮箱密码
    $mail -> SMTPSecure = 'tls';                            # 传输的加密方式
    $mail -> Port = C('port','mail');                       # smtp的端口号
    $mail -> setFrom(C('from','mail'),C('fromName','mail'));# 发件人邮箱和名称
    $mail -> addAddress($to,$toName);                       # 收件人地址和名字
    $mail -> addReplyTo(C('reply','mail'),C('replyName','mail'));
    $mail -> addCC(C('cc','mail'));
    $mail -> addBCC(C('bcc','mail'));
    # 判断是否添加了附件
    if(count($files)>0){
      # 遍历文件列表
      foreach($files as $key => $value){
        # 判断文件是否数组
        if( is_array($value) ){
          # 如果是数组则添加带文件名的文件
          $mail->addAttachment($value['file'],$value['name']);         # 添加附件(带名字的)
        }else{
          # 如果不是数组则直接添加文件
          $mail->addAttachment($value);                                # 添加附件(不带名字)
        }
      }
    }
    # 设置是否为html
    $mail -> isHTML($isHtml);                                  # Set email format to HTML
    # 设置主题
    $mail -> Subject = $title;
    # 设置内容
    $mail -> Body    = $content;
    # 发送邮件并判断是是否成功
    if( !$mail -> send() ){
      # 抛出异常
      throw new Exception($mail->ErrorInfo);;
    }else{
      # 发送成功返回真
      return true;
    }
  }

}