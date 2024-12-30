# Eogee-CMS

### Introduction
Eogee-CMS is a content management system built on native `PHP`, native `Javascript`, and the `Layui` front-end framework.

**Lightweight**: The lightweight framework `EOGEE` is constructed with native PHP, implementing the `MVC` (Model-View-Controller) architecture pattern.

**Robust**:

1. **Supports `ORM` (Object-Relational Mapping) database operations**, encapsulating SQL through the `Model\Database.php` class. In addition to basic CRUD (Create, Read, Update, Delete) operations, it provides a variety of database operation APIs such as filtering specific columns, summing specific column data, soft deletion, etc.
2. A base model class `Model\Model.php` provides various basic APIs such as popup reminders, redirection, retrieving logged-in user ID, getting the current model name, and processing requests.
3. The `Controller\BasicController.php` class encapsulates **the `MVC` architectural pattern**, allowing for pre-operation in the controller, permission controls, request parameter filtering, and request responses.
4. Further encapsulates `layui.js` into `Resource\js\admin\eogee-admin-layui.js`, allowing for the implementation of data tables, button groups, pop-up layers, forms, form validation, form submission, file uploads, pagination, content searching, and other components, building front-end pages functionally, thereby **simplifying front-end development** and being friendly to back-end developers.
5. The back-end management system is implemented through native `ajax` to achieve **front-end and back-end separation**.
6. Front-end pages embed native `PHP` variables, allowing each page to individually define keywords, descriptions, and other SEO information, thus being more **SEO-friendly**.

**Security**: Adopts `session` validation, `CSRF` validation, and sensitive field encryption to prevent `CSRF` attacks, `XSS` attacks, `SQL` injection attacks, and other security issues.

**User-Friendly**: Simply deploy this project on an `Apache` server and execute the `eogee.sql` file to complete the database initialization, thereby enabling the full functionality of the system.

**Aesthetic**:

1. Both front-end and back-end utilize the `layui` front-end framework to streamline front-end development and enhance user experience.
2. Based on `layui.css`, further styles are written and introduced through `Resource\css\eogee-text-layui.css`, achieving a unified style, simple design, and mobile-friendly interface for both front and back ends.

### Functional Modules:

1. Front-end modules: Homepage, Content Center, Content Details, Search, Categories, Tags, Technical Support (Feedback), Software Tools (Download), About, Latest News; Personal Center, Article Collection, etc.
2. Back-end modules: Dashboard (Homepage), Content Center Management, Content Details Management, Category Management, Tag Management, User Management Page, Role Management, Permission (Menu) Management, Log Management, Site Functions, System Settings, Personal Center, etc.

### Demo Links

**Official Website**:
[https://eogee.com](https://eogee.com)

**Documentation**:
[https://eogee.com/docs](https://eogee.com/docs)

**Video Presentations**:
[https://eogee.com/videos](https://eogee.com/videos)

**Front-end Demo**:
[https://CMS-demo.eogee.com](https://CMS-demo.eogee.com)

**Back-end Demo**:
[https://CMS-demo.eogee.com/admin](https://CMS-demo.eogee.com/admin)

Default Username: `admin`, Password: `123456`

### Directory Structure

```
EOGEE
├── Controller
│   ├── BasicController.php Controller base class
├── Model
│   ├── Database.php Database operation class
│   ├── Model.php Base model class
│   ├── Route.php Routing class
├── Resource
│   ├── css
│   │   ├── eogee-text-layui.css Unified layui styles
│   ├── js
│   │   ├── eogee-admin-layui.js layui components for the back-end management system
│   ├── pic Image resources
├── ├── view View files
├── autoload.php Autoload class
├── config.php Configuration file
├── eogee.sql Database initialization file
├── error.php Error handling file
├── index.php Entry file
├── routes.php Routing file
```

### System Requirements

- PHP >= 7.3
- MySQL >= 8.0
- Apache >= 2.4
- Recommended to use `phpstudy` integrated environment

### Installation Instructions

1. Download and extract the source code to the server directory.
2. Configure the `config.php` file, modifying the database connection information.
3. Import the `eogee.sql` file into the database.
4. Configure the `apache` server to set the `EOGEE` directory as the site directory.
5. Open a browser and access `http://127.0.0.1`.
6. Log into the back-end management system with the default username `admin` and password `123456`.

### Contributions

1. Fork this repository.
2. Create a new branch named Feat_xxx.
3. Submit your code.
4. Create a new Pull Request.

### Open Source License

This project is released under the MIT open source license, allowing free use for enterprises or individuals.
Copyright information for third-party source codes and binary files included in this project will be separately indicated.

### Acknowledgments

The creation of Eogee-CMS relies on the following open-source projects:

- [Layui](https://layui.dev/): Front-end UI framework Layui
- [Chart.js](https://www.chartjs.org/): Front-end chart library Chart.js
- [editor.md](https://pandao.github.io/editor.md/): Markdown editor Editor.md

Development tools used in building this project include:

- [VsCode](https://code.visualstudio.com/): Code editor
- [小皮面板](https://www.xp.cn/): Integrated environment
- [Navicat](https://www.HeidiSQL.com/): Database client
- [FileZilla](https://filezilla-project.org/): FTP client