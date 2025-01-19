<?php

require_once 'vendor/autoload.php';

use Helper\File;

define('CONFIG_OPER',require_once __DIR__ . '/Config/config.php');

// 工具函数：将文件名转换为类名
function filenameToClassName($filename)
{
    $filename = basename($filename, '.php');
    $filename = preg_replace('/^\d+_/', '', $filename); // 去掉时间戳前缀
    return str_replace('_', '', ucwords($filename, '_')); // 转换为驼峰命名
}

// 工具函数：连接数据库
function connectDatabase()
{
    $mysqli = new mysqli(
        CONFIG_OPER['database']['host'],
        CONFIG_OPER['database']['user'],
        CONFIG_OPER['database']['password'],
        CONFIG_OPER['database']['name'],
        CONFIG_OPER['database']['port']
    );

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    return $mysqli;
}

// 处理控制器、模型、请求、响应、验证等文件的创建
function handleFileCreation($type, $name)
{
    $templates = [
        'add-controller' => [
            'path' => 'App/Http/Controller/',
            'content' => "<?php\n\nnamespace App\Http\Controller;\n\nclass {name} extends Controller\n{\n\n}\n"
        ],
        'add-model' => [
            'path' => 'App/Model/',
            'content' => "<?php\n\nnamespace App\Model;\n\nclass {name} extends Model\n{\n\n}\n"
        ],
        'add-request' => [
            'path' => 'App/Http/Request/',
            'content' => "<?php\n\nnamespace App\Http\Request;\n\nclass {name} extends Request\n{\n\n}\n"
        ],
        'add-response' => [
            'path' => 'App/Http/Response/',
            'content' => "<?php\n\nnamespace App\Http\Response;\n\nclass {name} extends Response\n{\n\n}\n"
        ],
        'add-verify' => [
            'path' => 'App/Verify/',
            'content' => "<?php\n\nnamespace App\Verify;\n\nclass {name} extends Verify\n{\n    public function __construct()\n    {\n        // 设置验证规则\n".'        $this->setRules'."([\n\n        ]);\n    }\n}\n"
        ],
        'add-middleware' => [
            'path' => 'App/Http/Middleware/',
            'content' => "<?php\n\nnamespace App\Http\Middleware;\n\nclass {name}\n{\n\n}\n"
        ],
        'add-frontend' => [
            'list' => [
                'path' => 'Public/view/admin/',
                'content' => <<<EOT
<?php
    use Easy\View\View;
    View::view('/admin/head');
?> 
    <div class="layui-body">
        <!-- 内容主体区域 -->
        <div style="padding: 15px;">
            <h1 id = "tableComment"></h1>
            <div class="layui-tab layui-tab-brief">
                <ul class="layui-tab-title">
                    <li id = "list"><h2>数据列表</h2></li>
                    <li id = "recycle"><h2>回收站</a></li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <!-- 搜索栏 -->
                        <form class="layui-form layui-row layui-col-space15" id = "search" method="get"></form>
                        <!-- 表工具栏 -->
                        <script type="text/html" id="toolbar"></script>
                        <!-- 行工具栏 -->
                        <script type="text/html" id="rowToolbar"></script>
                        <!-- 移动端 行工具栏 -->
                        <script type="text/html" id="rowToolbarMobile"></script>                         
                        <table id="table" class="layui-table layui-hide" lay-filter="table"></table>
                        <!-- 移动端 列显示内容 -->
                        <script type="text/html" id="mobileCol"></script>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
    <script src = "/js/admin/{name}/list.js"></script>
<?php
    View::view('/admin/foot');
?>
EOT
            ],
            'update' => [
                'path' => 'Public/view/admin/',
                'content' => <<<EOT
<?php
    use Easy\View\View;
    View::view('/admin/updateHead');
?>
    <tr id = " ">
    <!-- You should add the item id in "" and the name should be the same as the table columns name --> 
        <td></td>
        <td>
                <!-- You can add the form item here -->
        </td>
    </tr>
    <script src = "/js/admin/{name}/update.js"></script>
<?php
    View::view('/admin/updateFoot');
?>
EOT
            ],
            'list.js' => [
                'path' => 'Public/js/admin/',
                'content' =><<<EOT
tableHeadSet(); // 表头设置
tableHeadData();// 表格及字段数据

/* 表头字段 */
var hides = [
    /* You can add the hide column name here */
];
var sorts = [
    /* You can add the sort column name here */
];

/* 表格及字段数据 */
var cols = generateColumns(tableFiledComment, hides, sorts, handleColwidth);

/* 表格渲染 */
renderRtn(true);
renderTable();
searchRow(); 
renderPage();
insertRow(); 
batch();
rowToolbar(); 
EOT
            ],
            'update.js' => [
                'path' => 'Public/js/admin/',
                'content' =><<<EOT
ajax('/'+modelName+'/updateApi/'+tableId,false,function(response){
    tableData = JSON.parse(response);
});

pushField();

if(pageName == 'edit'){
    pushData(
        /* You can add the form item here which isn't need to be auto updated */
    );
}

// upload('YouFileId','/{name}/fileUploadApi/'+tableId); // 上传图片，如涉及可解除注释
EOT
            ]
        ]
    ];

    $type = strtolower($type);
    if (!isset($templates[$type])) {
        echo "Invalid type '$type'.\n";
        return false;
    }

    if ($type === 'add-frontend') {
        // 处理前端文件创建
        foreach ($templates[$type] as $subtype => $template) {
            if($subtype === 'list.js' || $subtype === 'update.js'){
                $filename = $template['path'] . $name . '/' . $subtype;
            }else{
                $filename = $template['path'] . $name . '/' . $subtype . '.php';
            }
            $content = str_replace('{name}', $name, $template['content']);

            // 确保路径存在，如果不存在则创建它
            $directory = dirname($filename);
            if (!is_dir($directory)) {
                if (!mkdir($directory, 0777, true)) {
                    echo "Unable to create directory '$directory'.\n";
                    return false;
                }
            }

            $file = new File;
            if (!$file->createFile($filename, $content)) {
                return false;
            }
        }
    } else {
        // 处理其他类型的文件创建
        $name = ucfirst($name);

        $filename = $templates[$type]['path'] . $name . '.php';
        $content = str_replace('{name}', $name, $templates[$type]['content']);

        // 确保路径存在，如果不存在则创建它
        $directory = dirname($filename);
        if (!is_dir($directory)) {
            if (!mkdir($directory, 0777, true)) {
                echo "Unable to create directory '$directory'.\n";
                return false;
            }
        }

        $file = new File;
        return $file->createFile($filename, $content);
    }

    return true;
}

// 处理新增路由组内容
function handleAddRouter($name)
{
    $filename = __DIR__ . '/App/routes.php';
    $newContent = <<<EOT

    \$routes = defineRoutes(\$routes, '$name', [
        'list', 'listApi', 'tableHeadDataApi', 'show', 'showApi', 'insert', 'edit', 'updateApi', 'fileUploadApi', 'deleteSoft', 'deleteSoftBatch', 'recycle', 'recycleApi', 'restore', 'restoreBatch', 'delete', 'deleteBatch'
    ]); 

    
EOT;
    $searchContent = 'if($routerCacheEnabled){';

    $file = new File;
    $file->insertContentBefore($filename, $searchContent, $newContent);

}

function handleClearCache($name)
{
    $fileName = __DIR__ . '/'.CONFIG_OPER['cache']['cache_path']. '/' . $name . '.cache';
    if (file_exists($fileName)) {
        $file = new File;
        $file->clearFileContent($fileName);
    }else{
        echo "Cache file '$fileName' not found !\n";
    }
}

// 处理数据迁移
function handleMigration()
{
    $mysqli = connectDatabase();

    $engine = CONFIG_OPER['database']['engine'] ?? 'InnoDB';
    $charset = CONFIG_OPER['database']['charset'] ?? 'utf8';
    $databaseName = CONFIG_OPER['database']['name'] ?? 'utf8';

    // 创建数据库
    $sql = "CREATE DATABASE IF NOT EXISTS $databaseName DEFAULT CHARACTER SET $charset";
    $mysqli->query($sql);

    // 创建migrations表
    $sql = "CREATE TABLE IF NOT EXISTS migrations (
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        migration VARCHAR(255) NOT NULL,
        executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=$engine DEFAULT CHARSET=$charset;";
    $mysqli->query($sql);

    // 获取已执行的迁移文件
    $executedMigrations = [];
    $result = $mysqli->query("SELECT migration FROM migrations");
    while ($row = $result->fetch_assoc()) {
        $executedMigrations[] = $row['migration'];
    }

    // 扫描迁移文件目录
    $migrationFiles = glob(__DIR__ . '/Database/*.php');

    foreach ($migrationFiles as $file) {
        $migrationName = basename($file, '.php');

        if (!in_array($migrationName, $executedMigrations)) {
            require_once $file;

            $className = filenameToClassName($migrationName);
            if (class_exists($className)) {
                $migration = new $className($mysqli);
                $migration->up();

                $mysqli->query("INSERT INTO migrations (migration) VALUES ('$migrationName')");
                echo "Migrated $migrationName.\n";
            } else {
                echo "Error: Class $className not found in $file.\n";
            }
        }
    }

    echo "Migration complete.\n";
    $mysqli->close();
}

// 处理数据回滚
function handleRollback()
{
    $mysqli = connectDatabase();

    // 获取最后一次执行的迁移文件
    $result = $mysqli->query("SELECT migration FROM migrations ORDER BY executed_at DESC LIMIT 1");
    $lastMigration = $result->fetch_assoc();

    if ($lastMigration) {
        $migrationName = $lastMigration['migration'];
        $file = __DIR__ . "/Database/$migrationName.php";

        require_once $file;

        $className = filenameToClassName($migrationName);
        $migration = new $className($mysqli);
        $migration->down();

        $stmt = $mysqli->prepare("DELETE FROM migrations WHERE migration = ?");
        $stmt->bind_param('s', $migrationName);
        $stmt->execute();
        $stmt->close();

        echo "Rolled back: $migrationName\n";
    } else {
        echo "No migrations to roll back.\n";
    }

    $mysqli->close();
}

// 处理资源文件复制
function handleInclude($source, $target){
    // 检查源文件夹是否存在
    if (!is_dir($source)) {
        echo "Source folder '$source' not found !\n";
        return false;
    }

    // 创建目标文件夹（如果它不存在）
    if (!is_dir($target)) {
        if (!mkdir($target, 0777, true)) {
            echo "Unable to create target folder '$target' !\n";
            return false;
        }
    }

    // 打开源文件夹
    $files = scandir($source);
    foreach ($files as $file) {
        // 跳过 "." 和 ".."
        if ($file != "." && $file != "..") {
            $sourcePath = $source . '/' . $file;
            $targetPath = $target . '/' . $file;

            // 如果是文件夹，则递归复制
            if (is_dir($sourcePath)) {
                handleInclude($sourcePath, $targetPath);
            } else {
                // 如果是文件，则复制文件
                if (!copy($sourcePath, $targetPath)) {
                    echo "Unable to copy file '$sourcePath' to '$targetPath'。\n";
                    return false;
                }
            }
        }
    }
    echo " '$source' is copied to '$target' successfully ! \n";
    return true;
}

// 主逻辑
$type = $argv[1] ?? null;
$name = $argv[2] ?? null;

if ($type === null) {
    echo "Usage: php script.php <type> [name]\n";
    exit(1);
}

switch (strtolower($type)) {
    case 'add-controller':
    case 'add-model':
    case 'add-request':
    case 'add-response':
    case 'add-verify':
    case 'add-middleware':
        if ($name === null) {
            echo "Name is required for type '$type'.\n";
            exit(1);
        }
        handleFileCreation($type, $name);
        break;
    case 'add-router':
        if ($name === null) {
            echo "Name is required for type '$type'.\n";
            exit(1);
        }
        handleAddRouter($name);
        break;
    case 'add-frontend':
        if ($name === null) {
            echo "Name is required for type '$type'.\n";
            exit(1);
        }
        handleFileCreation($type, $name);
        break;
    case 'add-all':
        if ($name === null) {
            echo "Name is required for type '$type'.\n";
            exit(1);
        }
        handleFileCreation('add-controller', $name . 'Controller');
        handleFileCreation('add-model', $name);
        handleFileCreation('add-request', $name . 'Request');
        handleFileCreation('add-response', $name . 'Response');
        handleFileCreation('add-verify', $name . 'Verify');
        handleAddRouter($name);
        handleFileCreation('add-fronend', $name);
        break;
    
    case 'clear-cache':
        if ($name === null) {
            echo "Name is required for type '$type'.\n";
            exit(1);
        }
        handleClearCache($name);
        break;

    case 'include-vendor':
        if ($name === null) {
            echo "Name is required for type '$type'.\n";
            exit(1);
        }
        $sourceFolder = __DIR__ . '/'.CONFIG_OPER['file']['composer_dir_name']. $name;
        $targetFolder = __DIR__ . '/'.CONFIG_OPER['file']['dist_dir_name']. $name;
        handleInclude($sourceFolder, $targetFolder);
        break;

    case 'include-module':
        if ($name === null) {
            echo "Name is required for type '$type'.\n";
            exit(1);
        }
        $sourceFolder = __DIR__ . '/'.CONFIG_OPER['file']['module_dir_name']. $name;
        $targetFolder = __DIR__ . '/'.CONFIG_OPER['file']['dist_dir_name']. $name;
        handleInclude($sourceFolder, $targetFolder);
        break;

    case 'include-all':
        $sourceFolder = __DIR__ . '/'.CONFIG_OPER['file']['module_dir_name'];
        $targetFolder = __DIR__ . '/'.CONFIG_OPER['file']['dist_dir_name'];
        handleInclude($sourceFolder, $targetFolder);
        break;

    case 'migrate':
        handleMigration();
        break;

    case 'rollback':
        handleRollback();
        break;
    
    case 'migration':
        $name = $argv[2] ?? null;
    
        if ($name === null) {
            echo "Usage: php oper.php migration <TableName>\n";
            echo "Example: php oper.php migration users\n";
            exit(1);
        }
    
        // 生成迁移文件名
        $dateNum = date('YmdHis');
        $filename = __DIR__ . '/Database/' . $dateNum . '_create_' . $name . '_table.php';

        function generateMigrationContent($tableName)
        {
            $className = 'Create' . ucfirst($tableName) . 'Table';
            $engine = CONFIG_OPER['database']['engine'] ?? 'InnoDB';
            $charset = CONFIG_OPER['database']['charset'] ?? 'utf8';

            return <<<EOT
<?php

use Easy\Database\CreateTable;

class $className extends CreateTable
{
    protected \$tableName = '$tableName';

    protected function setSql()
    {
        return "CREATE TABLE IF NOT EXISTS \$this->tableName (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'ID',

            // You can add your columns here...

            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
        ) ENGINE= $engine DEFAULT CHARSET=$charset;
        ";
    }
}
EOT;
        }
        // 生成迁移文件内容
        $content = generateMigrationContent($name);
        // 创建文件
        if (file_put_contents($filename, $content) !== false) {
            echo "Migration file '$filename' created successfully!\n";
        } else {
            echo "Failed to create migration file '$filename'.\n";
            exit(1);
        }
        break;
    default:
        echo "Invalid type '$type'.\n";
        exit(1);
}
