<?php

require_once 'vendor/autoload.php';

define('CONFIG_OPER',require_once __DIR__ . '/Config/config.php');

// 工具函数：将文件名转换为类名
function filenameToClassName($filename)
{
    $filename = basename($filename, '.php');
    $filename = preg_replace('/^\d+_/', '', $filename); // 去掉时间戳前缀
    return str_replace('_', '', ucwords($filename, '_')); // 转换为驼峰命名
}

// 工具函数：创建文件
function createFile($filename, $content)
{
    if (file_put_contents($filename, $content) !== false) {
        echo "File '$filename' created successfully!\n";
        return true;
    } else {
        echo "Failed to create file '$filename'.\n";
        return false;
    }
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
            'content' => "<?php\n\nnamespace App\Verify;\n\nclass {name} extends Verify\n{\n\n}\n"
        ],
        'add-middleware' => [
            'path' => 'App/Http/Middleware/',
            'content' => "<?php\n\nnamespace App\Http\Middleware;\n\nclass {name}\n{\n\n}\n"
        ]
    ];

    $type = strtolower($type);
    if (!isset($templates[$type])) {
        echo "Invalid type '$type'.\n";
        return false;
    }

    $filename = $templates[$type]['path'] . $name . '.php';
    $content = str_replace('{name}', $name, $templates[$type]['content']);

    return createFile($filename, $content);
}

// 处理数据迁移
function handleMigration()
{
    $mysqli = connectDatabase();

    $engine = CONFIG_OPER['database']['engine'] ?? 'InnoDB';
    $charset = CONFIG_OPER['database']['charset'] ?? 'utf8';

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

    case 'add-all':
        if ($name === null) {
            echo "Name is required for type '$type'.\n";
            exit(1);
        }
        handleFileCreation('add-controller', $name . 'Controller');
        handleFileCreation('add-model', $name . 'Model');
        handleFileCreation('add-request', $name . 'Request');
        handleFileCreation('add-response', $name . 'Response');
        handleFileCreation('add-verify', $name . 'Verify');
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

class $className
{
    protected \$tableName = '$tableName';

    private \$mysqli;

    public function __construct(\$mysqli)
    {
        \$this->mysqli = \$mysqli;
    }

    public function up()
    {
        \$sql = "CREATE TABLE IF NOT EXISTS \$this->tableName (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'ID',

            

            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
        ) ENGINE= $engine DEFAULT CHARSET=$charset;
        ";
        \$this->executeQuery(\$sql);
    }

    public function down()
    {
        \$sql = "DROP TABLE IF EXISTS \$this->tableName;";
        \$this->executeQuery(\$sql);
    }

    private function executeQuery(\$sql)
    {
        if (\$this->mysqli->query(\$sql) === TRUE) {
            echo "Query executed successfully.\\n";
        } else {
            echo "Error executing query: " . \$this->mysqli->error . "\\n";
        }
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
