<?php

namespace App\Http\Controller;

/**
 * Summary of SiteController
 * 站点功能 控制器
 */

class SiteController extends indexController
{
    public static function post()
    {
        $urls = array(
            'https://www.eogee.com/'
            ,'https://www.eogee.com/contentParent/detail/19'
            ,'https://www.eogee.com/contentParent/detail/18'
            ,'https://www.eogee.com/contentParent/detail/17'
            ,'https://www.eogee.com/contentParent/detail/1'
            ,'https://www.eogee.com/content/detailChild/3'
            ,'https://www.eogee.com/content/detailChild/2'
            ,'https://www.eogee.com/content/detailChild/1'
            ,'https://www.eogee.com/about'
            ,'https://www.eogee.com/support'
        );
        $api = 'http://data.zz.baidu.com/urls?site=https://www.eogee.com&token=XyQOXYMLk9EZ8nc7';
        $ch = curl_init();
        $options =  array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urls),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);        
        
        require_once 'Resource/view/admin/site/post.php';
    }
}
