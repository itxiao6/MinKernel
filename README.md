MiniKernel使用简介</h1>

<p style="color:red;"><br>更新介绍:<br>
&nbsp;&nbsp;&nbsp;&nbsp;DB_LOG()获取当前请求所有的Sql<br>
&nbsp;&nbsp;&nbsp;&nbsp;类似TP的隐式路由<br>
&nbsp;&nbsp;&nbsp;&nbsp;DB()方法可以全局调用 等效DB::table()<br>
&nbsp;&nbsp;&nbsp;&nbsp;域名模块绑定<br>
&nbsp;&nbsp;&nbsp;&nbsp;模块化的模板默认<br>
&nbsp;&nbsp;&nbsp;&nbsp;更新了框架MVC的目录结构<br></p>


<p>功能介绍<br>
&nbsp;&nbsp;&nbsp;&nbsp;blade模板<br>
&nbsp;&nbsp;&nbsp;&nbsp;Eloquent 数据库模型操作<br>
&nbsp;&nbsp;&nbsp;&nbsp;主从数据库支持<br>
&nbsp;&nbsp;&nbsp;&nbsp;Session 数据库存储<br>
&nbsp;&nbsp;&nbsp;&nbsp;phpmailer 邮件发送<br>
&nbsp;&nbsp;&nbsp;&nbsp;验证码<br></p>

<p>设计思路<br>
&nbsp;&nbsp;&nbsp;&nbsp;采用了主流的Composer为主的库,使得 框架本身,更改灵活、拓展灵活、上手简单、体积极小。<br>
&nbsp;&nbsp;&nbsp;&nbsp;采用了最常见的MVC分层设计结构(简单明了)。<br>
&nbsp;&nbsp;&nbsp;&nbsp;模板采用的是 Laravel里面自带的Blade模板引擎。<br>
&nbsp;&nbsp;&nbsp;&nbsp;实现了M(表名)方法 可以直接调用实现虚拟一个模型出来直接使用<br>
&nbsp;&nbsp;&nbsp;&nbsp;数据库操作采用的是 Eloquent 表现力极强 Laravel自带的也是Eloquent<br></p>

<p>使用说明:<br>
&nbsp;&nbsp;&nbsp;&nbsp;1.安装Composer <a href="http://docs.phpcomposer.com/">Composer官网</a><br>
&nbsp;&nbsp;&nbsp;&nbsp;2.在项目 目录执行composer install<br></p>
