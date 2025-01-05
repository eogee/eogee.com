<?php

// 检查参数数量
if ($argc < 3) {
    echo "Usage: php ogee.php must be 2 parameters,<type> <name>\n";
    exit(1);
}

// 获取参数
$type = $argv[1];
$name = $argv[2];

if ($type == "create-controller" || $type == "create-Controller") {
    $filename = "App/Http/Controller/$name.php";
    $content = <<<EOT
<?php

namespace App\Http\Controller;

class $name extends BasicController
{

}
EOT;
    // 创建文件并写入控制器文件内容
    if (file_put_contents($filename, $content) !== false) {
        echo "Controller '$filename' created successfully!\n";
    } else {
        echo "Failed to create Controller '$filename'.\n";
        exit(1);
    }
}else if ($type == "create-model" || $type == "create-Model") {
    $filename = "App/Model/$name.php";
    $content = <<<EOT
<?php

namespace App\Model;

class $name extends Model
{

}
EOT;
    // 创建文件并模型文件内容
    if (file_put_contents($filename, $content) !== false) {
        echo "Model '$filename' created successfully!\n";
    } else {
        echo "Failed to create Model '$filename'.\n";
        exit(1);
    }
}else if($type == "create-request" || $type == "create-Request") {
    $filename = "App/Http/Request/$name.php";
    $content = <<<EOT
<?php

namespace App\Http\Request;

class $name extends Request
{

}
EOT;
    // 创建文件并写入请求文件内容
    if (file_put_contents($filename, $content) !== false) {
        echo "Request '$filename' created successfully!\n";
    } else {
        echo "Failed to create Request '$filename'.\n";
        exit(1);
    }
}else if($type == "create-response" || $type == "create-Response") {
    $filename = "App/Http/Response/$name.php";
    $content = <<<EOT
<?php

namespace App\Http\Response;

class $name extends Response
{

}
EOT;
    // 创建文件并写入响应文件内容
    if (file_put_contents($filename, $content) !== false) {
        echo "Response '$filename' created successfully!\n";
    } else {
        echo "Failed to create Response '$filename'.\n";
        exit(1);
    }
}else if($type == "create-verify" || $type == "Create-Verify") {
    $filename = "App/Verify/$name.php";
    $content = <<<EOT
<?php

namespace App\Verify;

class $name extends Verify
{

}
EOT;
    // 创建文件并写入验证文件内容
    if (file_put_contents($filename, $content) !== false) {
        echo "Verify '$filename' created successfully!\n";
    } else {
        echo "Failed to create Verify '$filename'.\n";
        exit(1);
    }
}else if($type == "create-all" || $type == "Create-All"){
    $filenameController = "App/Http/Controller/".$name."Controller.php";
    $filenameModel = "App/Model/".$name."Model.php";
    $filenameRequest = "App/Http/Request/".$name."Request.php";
    $filenameResponse = "App/Http/Response/".$name."Response.php";
    $filenameVerify = "App/Verify/".$name."Verify.php";

    $nameController = $name."Controller";
    $nameModel = $name."Model";
    $nameRequest = $name."Request";
    $nameResponse = $name."Response";
    $nameVerify = $name."Verify";

    $contentController = <<<EOT
<?php

namespace App\Http\Controller;

class $nameController extends BasicController
{

}
EOT;
    $contentModel = <<<EOT
<?php

namespace App\Model;

class $nameModel extends Model
{

}
EOT;
    $contentRequest = <<<EOT
<?php

namespace App\Http\Request;

class $nameRequest extends Request
{

}
EOT;
    $contentResponse = <<<EOT
<?php

namespace App\Http\Response;

class $nameResponse extends Response
{

}
EOT;
    $contentVerify = <<<EOT
<?php

namespace App\Verify;

class $nameVerify extends Verify
{

}
EOT;
    // 创建文件并写入验证文件内容
    if (file_put_contents($filenameController, $contentController) !== false) {
        echo "Controller '$filenameController' created successfully!\n";
    } else {
        echo "Failed to create Controller '$filenameController'.\n";
        exit(1);
    }
    if (file_put_contents($filenameModel, $contentModel) !== false) {
        echo "Model '$filenameModel' created successfully!\n";
    } else {
        echo "Failed to create Model '$filenameModel'.\n";
        exit(1);
    }
    if (file_put_contents($filenameRequest, $contentRequest) !== false) {
        echo "Request '$filenameRequest' created successfully!\n";
    } else {
        echo "Failed to create Request '$filenameRequest'.\n";
        exit(1);
    }
    if (file_put_contents($filenameResponse, $contentResponse) !== false) {
        echo "Response '$filenameResponse' created successfully!\n";
    } else {
        echo "Failed to create Response '$filenameResponse'.\n";
        exit(1);
    }
    if (file_put_contents($filenameVerify, $contentVerify) !== false) {
        echo "Verify '$filenameVerify' created successfully!\n";
    } else {
        echo "Failed to create Verify '$filenameVerify'.\n";
        exit(1);
    }
}else{
    echo "Invalid type '$type'.\n";
    exit(1);
}