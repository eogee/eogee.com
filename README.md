# Eogee-CMS

#### 介绍
基于原生`PHP`、原生 `Javascript`、`Layui`前端框架构建的内容管理系统。

**轻量**：原生PHP构成自建轻量化框架`EOGEE`，实现`MVC`（模型-视图-控制器）架构模式。

**健全**：

1. **支持`ORM`（对象关系映射）数据库操作**，通过`Model\Database.php`类封装`SQL`，除实现基本的增、删、改、查外，还提供筛选特定列、特定列数据求和、软删除等大量数据库操作`API`。
2. 设置基础模型类 `Model\Model.php`提供弹窗提醒、重定向、获取登陆用户ID、获取当前模型名、请求响应等多种基础API。
3. 封装`Controller\Controller.php`类，实现`MVC`架构模式，并提供`Controller`基类`BaseController.php`和`AdminBaseController.php`，可实现控制器的前置操作、权限控制、请求参数过滤、请求响应等功能。
4. 进一步封装`layui.js`形成 `Resource\js\admin\eogee-admin-layui.js`，可实现数据表格、按钮组、弹出层、表单、表单验证、表单提交、文件上传、分页、内容搜索等大部分前端交互。
5. 后台管理系统通过原生ajax实现前后端分离。


session验证、crsf验证、敏感字段加密、前台采用嵌入原生PHP代码，有益于SEO。


#### 软件架构
软件架构说明


#### 安装教程

1.  xxxx
2.  xxxx
3.  xxxx

#### 使用说明

1.  xxxx
2.  xxxx
3.  xxxx

#### 参与贡献

1.  Fork 本仓库
2.  新建 Feat_xxx 分支
3.  提交代码
4.  新建 Pull Request


#### 特技

1.  使用 Readme\_XXX.md 来支持不同的语言，例如 Readme\_en.md, Readme\_zh.md
2.  Gitee 官方博客 [blog.gitee.com](https://blog.gitee.com)
3.  你可以 [https://gitee.com/explore](https://gitee.com/explore) 这个地址来了解 Gitee 上的优秀开源项目
4.  [GVP](https://gitee.com/gvp) 全称是 Gitee 最有价值开源项目，是综合评定出的优秀开源项目
5.  Gitee 官方提供的使用手册 [https://gitee.com/help](https://gitee.com/help)
6.  Gitee 封面人物是一档用来展示 Gitee 会员风采的栏目 [https://gitee.com/gitee-stars/](https://gitee.com/gitee-stars/)
