# eogee.com 岳极技术官方网站源码（内容管理系统）

### 介绍

基于原生`PHP`、`Layui`前端框架及部分原生 `Javascript`构建的内容管理系统。

**轻量**：

原生PHP构成轻量化框架`EOGEE`，实现`MVC`（模型-视图-控制器）架构模式。

**健壮**：

1. **支持`ORM`（对象关系映射）数据库操作**，通过`Helper\Database.php`类封装`SQL`，除实现基本的增、删、改、查外，还提供筛选特定列、特定列数据求和、软删除等大量数据库操作`API`。
2. 设置基础模型类 `App\Model\Model.php`提供面向数据库，实现模型的`CURD`操作，并提供`ORM`查询方法。
3. 封装`App\Http\Controller\BasicController.php`类，**实现`MVC`架构模式**，可实现请求过滤，权限验证，请求响应，日志记录等功能。
4. 进一步封装`layui.js`为 `Public\js\admin\eogee-admin-layui.js`，可实现数据表格、按钮组、弹出层、表单、表单验证、表单提交、文件上传、分页、内容搜索等组件，函数式构建前端页面，**简化前端开发**，对后端开发人员友好。
5. 后台管理系统通过原生`ajax`进行数据交互，实现**前后端分离**。
6. 前台页面嵌入原生`PHP`代码，各页面均可单独定义关键字、页面描述等SEO信息，对**SEO友好**。

**安全**：

采用`session`验证、`crsf`验证、敏感字段加密，有效应对`CSRF`攻击、`XSS`攻击、`SQL`注入攻击等安全问题。

**易用**：

将本项目部署于`apache`服务器中，执行`Database\eogee.sql`文件即可完成数据库初始化，即可使用全部功能。

**简洁**：

1. 前后台均采用`layui`前端框架，简化前端开发，提升用户体验。
2. 基于`layui.css`进一步编写并引入了`public\css\eogee-text-layui.css`，实现风格统一、样式朴素、移动端友好的前后台界面。

### 功能模块

1. 前台模块：首页、内容中心、内容详情、搜索、分类、标签、技术支持（留言）、软件工具（下载）、关于、最新动态；个人中心、文章收藏等。
2. 后台模块：后台看板（首页）、内容中心管理、内容详情管理、分类管理、标签管理、用户管理页、角色管理、权限（菜单）管理、日志管理、站点功能、系统设置、个人中心等。

### 演示地址

**官方网站**：
[https://eogee.com](https://eogee.com)

**前台演示**：
[https://eogee.com](https://eogee.com)

**后台演示**：
暂不可用

**说明文档**：
[https://eogee.com/docs](https://eogee.com/docs)暂不可用

**视频讲演**：
[https://eogee.com/videos](https://eogee.com/videos)暂不可用

默认用户名`admin`密码`123456`

### 目录结构

```
EOGEE
├── App 应用核心
│   ├── Http 控制器请求响应
│   │   ├── Controllers 控制器
│   │   ├── Middleware 中间件
│   │   ├── Request 请求
│   │   └── Response 响应
│   ├── Model 模型
│   ├── Mail 邮件
│   ├── Notice 通知
│   ├── Notice 验证
│   ├── autoload.php 自动加载
│   ├── error.php 错误处理
│   └── routes.php 路由
├── Config 配置
│   ├── app.php 应用配置
│   ├── cache.php 缓存配置
│   ├── congig.php 总配置
│   ├── database.php 数据库配置
│   ├── file.php 文件配置
│   ├── mail.php 邮件配置
│   └── route.php 路由配置
├── Database 数据库初识化文件
├── Helper 核心功能及助手函数
│   ├── Auth.php 用户验证
│   ├── Cache.php 缓存
│   ├── Captcha.php 验证码
│   ├── Database.php 数据库操作
│   ├── File.php 文件操作
│   ├── Log.php 日志
│   ├── Password.php 密码加密
│   ├── Session.php 会话
│   ├── Url.php
│   ├── View.php 视图
│   └── Window.php 窗口操作
├── Public
│   ├── css
│   ├── file 上传的文件
│   ├── font
│   ├── js
│   ├── layui 前端框架
│   ├── pic
│   └── view 视图文件
└── Storage
    ├── Cache 缓存
    └── Log 日志
```
### 环境要求

- PHP >= 7.3
- MySQL >= 8.0
- Apache >= 2.4
- 建议使用`phpstudy`集成环境

### 安装说明

1.  下载并解压源码到服务器目录
2.  配置`config.php`文件，修改数据库连接信息
3.  导入`eogee.sql`文件到数据库
4.  配置`apache`服务器，将`EOGEE`目录设置为站点目录
5.  打开浏览器访问`http://127.0.0.1`
6.  登录后台管理系统，默认用户名`admin`密码`123456`

### 参与贡献

1.  Fork 本仓库
2.  新建 Feat_xxx 分支
3.  提交代码
4.  新建 Pull Request

### 联系我们

- 官方网站：[https://eogee.com](https://eogee.com)
- 官方QQ：3886370035
- 官方QQ群：589912610
- 官方邮箱：eogee@qq.com
- 您可以直接提交`Issue`或者通过官方QQ群联系我们

### 开源协议

本项目遵循 MIT 开源协议发布并供企业或个人免费使用。

本项目包含的第三方源码和二进制文件之版权信息另行标注。

### 鸣谢

Eogee-CMS的诞生依赖于以下开源项目：

- [Layui](https://layui.dev/)：前端UI框架 Layui
- [Chart.js](https://www.chartjs.org/)：前端图表库 Chart.js
- [editor.md](https://pandao.github.io/editor.md/)：Markdown编辑器 Editor.md

开发构建本项目使用到的工具：

- [VsCode](https://code.visualstudio.com/)：代码编辑器
- [小皮面板](https://www.xp.cn/)：集成环境
- [heidiSQL](https://www.HeidiSQL.com/)：数据库客户端
- [FileZilla](https://filezilla-project.org/)：FTP客户端