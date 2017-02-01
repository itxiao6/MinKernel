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
&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://laravel.com/api/4.2/Illuminate/Database/Eloquent/Model.html">Eloquent 数据库模型操作</a><br>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://github.com/itxiao6/MinKernel/wiki/%E4%B8%BB%E4%BB%8E%E6%95%B0%E6%8D%AE%E5%BA%93%E6%94%AF%E6%8C%81">主从数据库支持</a><br>
&nbsp;&nbsp;&nbsp;&nbsp;Session 数据库存储<br>
&nbsp;&nbsp;&nbsp;&nbsp;phpmailer 邮件发送<br>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://github.com/itxiao6/MinKernel/wiki/%E9%AA%8C%E8%AF%81%E7%A0%81">验证码</a><br></p>

<p>设计思路<br>
&nbsp;&nbsp;&nbsp;&nbsp;采用了主流的Composer为主的库,使得 框架本身,更改灵活、拓展灵活、上手简单、体积极小。<br>
&nbsp;&nbsp;&nbsp;&nbsp;采用了最常见的MVC分层设计结构(简单明了)。<br>
&nbsp;&nbsp;&nbsp;&nbsp;模板采用的是 Laravel里面自带的Blade模板引擎。<br>
&nbsp;&nbsp;&nbsp;&nbsp;实现了M(表名)方法 可以直接调用实现虚拟一个模型出来直接使用<br>
&nbsp;&nbsp;&nbsp;&nbsp;数据库操作采用的是 Eloquent 表现力极强 Laravel自带的也是Eloquent<br></p>

<a href="https://github.com/itxiao6/MinKernel/wiki/%E5%AE%89%E8%A3%85%E9%85%8D%E7%BD%AE"><p>使用说明:<br>
&nbsp;&nbsp;&nbsp;&nbsp;1.安装Composer</a><br>
&nbsp;&nbsp;&nbsp;&nbsp;2.在项目 目录执行composer install<br></p></a>
