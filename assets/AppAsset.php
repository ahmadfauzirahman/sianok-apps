<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

//        vendor css
        "lib/@fortawesome/fontawesome-free/css/all.min.css",
        "lib/ionicons/css/ionicons.min.css",
        "lib/typicons.font/typicons.css",

//     DashForge CSS
        "assets/css/dashforge.css",
        "assets/css/dashforge.profile.css",
    ];
    public $js = [
        "lib/jquery/jquery.min.js",
        "lib/bootstrap/js/bootstrap.bundle.min.js",
        "lib/feather-icons/feather.min.js",
        "lib/perfect-scrollbar/perfect-scrollbar.min.js",
        "lib/chart.js/Chart.bundle.min.js",
        "assets/js/dashforge.js",
        "assets/js/dashforge.aside.js",
        'https://cdn.jsdelivr.net/npm/sweetalert2@9',

//        append theme customizer
        "lib/js-cookie/js.cookie.js",
        // "assets/js/dashforge.settings.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
       'yii\bootstrap4\BootstrapAsset',
    ];
}
