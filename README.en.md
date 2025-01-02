# eogee.com Official Website Source Code (Content Management System)

### Introduction

A content management system built based on native `PHP`, the `Layui` front-end framework, and some native `JavaScript`.

**Lightweight**:

The native PHP forms the lightweight framework `EOGEE`, implementing the `MVC` (Model-View-Controller) architectural pattern.

**Robust**:

1. **Supports `ORM` (Object-Relational Mapping) database operations**, encapsulating `SQL` through the `Helper\Database.php` class. In addition to basic CRUD operations, it provides a large number of database operation APIs such as filtering specific columns, summing specific column data, soft deletion, etc.
2. A base model class `App\Model\Model.php` is provided for database-oriented operations, implementing model `CRUD` operations and providing `ORM` query methods.
3. The `App\Http\Controller\BasicController.php` class is encapsulated to **implement the `MVC` architectural pattern**, enabling request filtering, permission verification, request response, logging, and other functions.
4. Further encapsulation of `layui.js` into `Public\js\admin\eogee-admin-layui.js` enables components such as data tables, button groups, pop-up layers, forms, form validation, form submission, file upload, pagination, and content search, functionally building front-end pages, **simplifying front-end development**, and being friendly to back-end developers.
5. The backend management system uses native `ajax` for data interaction, achieving **front-end and back-end separation**.
6. Front-end pages embed native `PHP` code, and each page can individually define keywords, page descriptions, and other SEO information, making it **SEO-friendly**.

**Security**:

Uses `session` verification, `CSRF` verification, and sensitive field encryption to effectively counter `CSRF` attacks, `XSS` attacks, `SQL` injection attacks, and other security issues.

**Ease of Use**:

Deploy this project on an `Apache` server, execute the `Database\eogee.sql` file to complete database initialization, and then use all functions.

**Simplicity**:

1. Both the front-end and back-end use the `Layui` front-end framework, simplifying front-end development and enhancing user experience.
2. Based on `layui.css`, further development and introduction of `public\css\eogee-text-layui.css` achieve a unified style, simple design, and mobile-friendly front-end and back-end interfaces.

### Functional Modules

1. Front-end modules: Homepage, Content Center, Content Details, Search, Categories, Tags, Technical Support (Messages), Software Tools (Downloads), About, Latest News; Personal Center, Article Favorites, etc.
2. Back-end modules: Backend Dashboard (Homepage), Content Center Management, Content Details Management, Category Management, Tag Management, User Management, Role Management, Permission (Menu) Management, Log Management, Site Functions, System Settings, Personal Center, etc.

### Demo Addresses

**Official Website**:
[https://eogee.com](https://eogee.com)

**Front-end Demo**:
[https://eogee.com](https://eogee.com)

**Back-end Demo**:
Currently unavailable

**Documentation**:
[https://eogee.com/docs](https://eogee.com/docs) Currently unavailable

**Video Presentation**:
[https://eogee.com/videos](https://eogee.com/videos) Currently unavailable

Default username: `admin` Password: `123456`

### Directory Structure

```
EOGEE
├── App Application Core
│   ├── Http Controller Request Response
│   │   ├── Controllers Controllers
│   │   ├── Middleware Middleware
│   │   ├── Request Request
│   │   └── Response Response
│   ├── Model Model
│   ├── Mail Mail
│   ├── Notice Notification
│   ├── Notice Verification
│   ├── autoload.php Autoload
│   ├── error.php Error Handling
│   └── routes.php Routing
├── Config Configuration
│   ├── app.php Application Configuration
│   ├── cache.php Cache Configuration
│   ├── congig.php General Configuration
│   ├── database.php Database Configuration
│   ├── file.php File Configuration
│   ├── mail.php Mail Configuration
│   └── route.php Routing Configuration
├── Database Database Initialization Files
├── Helper Helper Functions
│   ├── Auth.php User Authentication
│   ├── Cache.php Cache
│   ├── Captcha.php Captcha
│   ├── Database.php Database Operations
│   ├── File.php File Operations
│   ├── Log.php Logging
│   ├── Password.php Password Encryption
│   ├── Session.php Session
│   ├── Url.php
│   ├── View.php View
│   └── Window.php Window Operations
├── Public
│   ├── css
│   ├── file Uploaded Files
│   ├── font
│   ├── js
│   ├── layui Front-end Framework
│   ├── pic
│   └── view View Files
└── Storage
    ├── Cache Cache
    └── Log Logs
```

### Environment Requirements

- PHP >= 7.3
- MySQL >= 8.0
- Apache >= 2.4
- It is recommended to use the `phpstudy` integrated environment.

### Installation Instructions

1. Download and extract the source code to the server directory.
2. Configure the `config.php` file to modify the database connection information.
3. Import the `eogee.sql` file into the database.
4. Configure the `Apache` server to set the `EOGEE` directory as the site directory.
5. Open the browser and visit `http://127.0.0.1`.
6. Log in to the backend management system with the default username `admin` and password `123456`.

### Contribution

1. Fork this repository.
2. Create a new Feat_xxx branch.
3. Submit your code.
4. Create a Pull Request.

### Contact Us

- Official Website: [https://eogee.com](https://eogee.com)
- Official QQ: 3886370035
- Official QQ Group: 589912610
- Official Email: eogee@qq.com
- You can directly submit an `Issue` or contact us through the official QQ group.

### Open Source License

This project is released under the MIT open-source license and is free for use by enterprises or individuals.

The copyright information for third-party source code and binary files included in this project is separately noted.

### Acknowledgments

The birth of Eogee-CMS relies on the following open-source projects:

- [Layui](https://layui.dev/): Front-end UI framework Layui
- [Chart.js](https://www.chartjs.org/): Front-end chart library Chart.js
- [editor.md](https://pandao.github.io/editor.md/): Markdown editor Editor.md

Tools used in the development and construction of this project:

- [VsCode](https://code.visualstudio.com/): Code editor
- [phpStudy](https://www.xp.cn/): Integrated environment
- [HeidiSQL](https://www.HeidiSQL.com/): Database client
- [FileZilla](https://filezilla-project.org/): FTP client