# eogee.com 官方网站源码

### 介绍

基于原生`PHP`、`Layui`前端框架及部分原生 `Javascript`构建轻量`WEB`框架:`Eogee`，可快速构建企业级`WEB`应用

**轻量**：

原生PHP构成轻量化框架`EOGEE`，实现`MVC`（模型-视图-控制器）架构模式

**健壮**：

1. **支持`ORM`（对象关系映射）数据库操作**，通过`Easy\Database\Database.php`类封装`SQL`语句，除实现基本的增、删、改、查外，还提供筛选特定列、特定列数据求和、软删除等大量数据库操作`API`
2. 设置基础模型类 `Easy\Model\Model.php`提供面向数据库的基础模型类，实现模型的`CURD`操作，并提供`ORM`查询方法
3. 封装`Easy\Controller\Controller.php`类，**实现`MVC`架构模式**，可实现请求过滤`request`，权限验证，请求响应`responce`，日志记录等功能
4. 提供`Easy\Cache\Cache.php`类，可实现**路由缓存**功能
5. 提供`Easy\Log\Log.php`类，预置`App\Http\Controller\LogController.php`控制器和`Public\view\admin\list.php`视图模板，实现**日志记录**、列表、详情、删除、下载、导出和清空等功能
6. 提供`Easy\Verify\Verify.php`类，实现**表单验证**功能
7. 提供**命令行工具**`oper.php`可**快速生成**控制器、模型、表单验证、数据库表、中间件、请求、响应、视图等文件
8. 提供`Config\config.php`配置文件，**配置文件分离**并实现对核心功能进行自定义配置
9. 提供`Helper`助手函数，可自定义函数并**全局使用**
10. 进一步封装`layui.js`为 `Public\js\admin\eogee-admin-layui.js`，可实现数据表格、按钮组、弹出层、表单、表单验证、表单提交、文件上传、分页、内容搜索等组件，函数式构建前端页面，**简化前端开发**，对后端开发人员友好
11. 后台管理系统通过原生`ajax`进行数据交互，实现**前后端分离**
12. 前台页面嵌入原生`PHP`代码，各页面均可单独定义关键字、页面描述等`SEO`信息，对**`SEO`友好**

**安全**：

采用`session`验证、`crsf`验证、敏感字段加密，有效应对`CSRF`攻击、`XSS`攻击、`SQL`注入攻击等安全问题

**简洁**：

1. 前后台均采用`layui`前端框架，简化前端开发，提升用户体验
2. 基于`layui.css`进一步编写并引入了`public\css\eogee-text-layui.css`，实现风格统一、样式朴素、移动端友好的前后台界面

### 功能模块

1. 前台模块：首页、内容中心、内容详情、搜索、技术支持（留言）、软件工具（下载）、关于、最新动态等
2. 后台模块：后台看板（首页）、内容中心管理、内容详情管理、用户管理页、角色管理、权限（菜单）管理、日志管理、站点功能、系统设置等

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
│   │   ├── Controller 控制器
│   │   ├── Middleware 中间件
│   │   ├── Request 请求
│   │   └── Response 响应
│   ├── Model 模型
│   ├── Verify 表单验证
│   ├── Mail 邮件
│   ├── Notice 通知
│   ├── autoload 文件上传//composer不可用时使用
│   ├── error.php 错误处理
│   └── routes.php 路由
├── Config 配置
│   ├── app.php 应用配置
│   └── ...
├── Database 数据库初始化文件
├── Easy 核心类库
│   ├── Cache 缓存
│   └── ...
├── Helper 助手函数
│   ├── Password.php 密码加密
│   ├── Path.php 路径处理
│   ├── Url.php
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
- Composer >= 2.0

### 安装说明

1. 安装`composer`,通过执行`composer create-project eogee/eogee.com`将本项目部署于PHP安装根目录或Apache服务器的`www`目录之下
2. 启动`mysql`数据库并根据`Config\database.php`配置数据库参数，执行`composer oper migrate`初始化数据库
3. 执行`composer oper-run`启动服务器，访问`http://127.0.0.1`或`http://localhost`即可访问网站
4. 后台管理系统地址：`http://127.0.0.1/admin`
5. 用户名：`admin`
6. 密码：`123456`

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

Eogee的诞生依赖于以下开源项目：

- [Layui](https://layui.dev/)：前端UI框架 Layui
- [Chart.js](https://www.chartjs.org/)：前端图表库 Chart.js
- [editor.md](https://pandao.github.io/editor.md/)：Markdown编辑器 Editor.md