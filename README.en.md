# eogee.com Official Website Source Code

### Introduction

Based on native `PHP`, the `Layui` frontend framework, and some native `Javascript`, the lightweight `WEB` framework: `Eogee` is designed to quickly build enterprise-level `WEB` applications.

**Lightweight**:

The native PHP forms a lightweight framework `EOGEE`, implementing the `MVC` (Model-View-Controller) architecture pattern.

**Robust**:

1. **Supports `ORM` (Object-Relational Mapping) database operations**, encapsulated SQL statements through the `Easy\Database\Database.php` class. Besides basic CRUD operations, it provides numerous database operation APIs such as filtering specific columns, summing specific column data, soft deletion, etc.
2. A base model class `Easy\Model\Model.php` is provided to facilitate basic model CRUD operations and provide `ORM` query methods.
3. The `Easy\Controller\Controller.php` class is encapsulated to **implement the `MVC` architecture pattern**, enabling request filtering, permission verification, response handling, logging, etc.
4. The `Easy\Cache\Cache.php` class allows for **routing cache** functionality.
5. The `Easy\Log\Log.php` class has a pre-set controller `App\Http\Controller\LogController.php` and a view template `Public\view\admin\list.php`, facilitating **log recording**, listing, details, deletion, downloading, exporting, and clearing functions.
6. The `Easy\Verify\Verify.php` class provides **form validation** functionality.
7. The **command-line tool** `oper.php` can **quickly generate** controllers, models, form validations, database tables, middleware, requests, responses, views, etc.
8. The `Config\config.php` configuration file separates configuration files and allows for custom configurations of core functionalities.
9. A `Helper` function provides custom functions that can be **globally used**.
10. Further encapsulates `layui.js` into `Public\js\admin\eogee-admin-layui.js`, allowing for components like data tables, button groups, pop-up layers, forms, form validations, file uploads, pagination, and content searches, thus simplifying frontend development and making it more developer-friendly.
11. The backend management system communicates data through native `ajax`, achieving **frontend-backend separation**.
12. The frontend pages embed native `PHP` code, allowing each page to define keywords, page descriptions, and other `SEO` information separately, making it **SEO-friendly**.

**Security**:

Employs session validation, CSRF validation, and sensitive field encryption, effectively addressing CSRF attacks, XSS attacks, SQL injection attacks, and other security issues.

**Simplicity**:

1. Both frontend and backend utilize the `layui` framework, simplifying frontend development and enhancing user experience.
2. Further styles are based on `layui.css` and introduced through `public\css\eogee-text-layui.css`, creating a unified style, simple appearance, and mobile-friendly backend interface.

### Functional Modules

1. Frontend Modules: Homepage, Content Center, Content Details, Search, Technical Support (Feedback), Software Tools (Download), About, Latest News, etc.
2. Backend Modules: Dashboard (Homepage), Content Center Management, Content Details Management, User Management, Role Management, Permission (Menu) Management, Log Management, Site Functions, System Settings, etc.

### Demonstration Links

**Official Website**:
[https://eogee.com](https://eogee.com)

**Frontend Demo**:
[https://eogee.com](https://eogee.com)

**Backend Demo**:
Not available at this time.

**Documentation**:
[https://eogee.com/docs](https://eogee.com/docs) Not available at this time.

**Video Presentation**:
[https://eogee.com/videos](https://eogee.com/videos) Not available at this time.

Default Username: `admin` Password: `123456`

### Directory Structure

```
EOGEE
├── App Core Application
│   ├── Http Controller Request Response
│   │   ├── Controller Controller
│   │   ├── Middleware Middleware
│   │   ├── Request Request
│   │   └── Response Response
│   ├── Model Model
│   ├── Verify Form Verification
│   ├── Mail Mail
│   ├── Notice Notice
│   ├── autoload File Upload // Use when Composer is not available
│   ├── error.php Error Handling
│   └── routes.php Routes
├── Config Configuration
│   ├── app.php Application Configuration
│   └── ...
├── Database Database Initialization Files
├── Easy Core Libraries
│   ├── Cache Cache
│   └── ...
├── Helper Helper Functions
│   ├── Password.php Password Encryption
│   ├── Path.php Path Handling
│   ├── Url.php
│   └── Window.php Window Operations
├── Public
│   ├── css
│   ├── file Uploaded Files
│   ├── font
│   ├── js
│   ├── layui Frontend Framework
│   ├── pic
│   └── view View Files
└── Storage
    ├── Cache Cache
    └── Log Log
```

### Environment Requirements

- PHP >= 7.3
- MySQL >= 8.0
- Apache >= 2.4
- Composer >= 2.0

### Installation Instructions

1. Install `composer`, execute `composer create-project eogee/eogee.com` to deploy the project in the PHP installation root directory or in the `www` directory of the Apache server.
2. Start the `mysql` database, configure the database parameters in `Config\database.php`, and run `composer oper migrate` to initialize the database.
3. Run `composer oper-run` to start the server and access the website at `http://127.0.0.1` or `http://localhost`.
4. The backend management system can be accessed at: `http://127.0.0.1/admin`.
5. Username: `admin`
6. Password: `123456`

### Contribution

1. Fork the repository.
2. Create a new branch named `Feat_xxx`.
3. Submit your code.
4. Create a Pull Request.

### Contact Us

- Official Website: [https://eogee.com](https://eogee.com)
- Official QQ: 3886370035
- Official QQ Group: 589912610
- Official Email: eogee@qq.com
- You can directly submit `Issues` or contact us via the official QQ group.

### Open Source License

This project is released under the MIT Open Source License, allowing free use for businesses or individuals.

Copyright information for third-party source codes and binary files included in this project is labeled separately.

### Acknowledgements

The birth of Eogee relies on the following open-source projects:

- [Layui](https://layui.dev/): Frontend UI Framework Layui
- [Chart.js](https://www.chartjs.org/): Frontend Chart Library Chart.js
- [editor.md](https://pandao.github.io/editor.md/): Markdown Editor Editor.md