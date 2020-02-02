<?php
/**
 * 根据应用程序设置 'urlMode' 分析 $_GET 参数
 *
 * 该函数由框架自动调用，应用程序不需要调用该函数。
 */
function ___uri_filter()
{
    static $firstTime = true;

    if (!$firstTime) { return; }
    $firstTime = false;

    $pathinfo = !empty($_SERVER['PATH_INFO']) ?
                $_SERVER['PATH_INFO'] :
                (!empty($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');

    $parts = explode('/', substr($pathinfo, 1));
    if (isset($parts[0]) && strlen($parts[0]))
    {
        $_GET[FLEA::getAppInf('controllerAccessor')] = $parts[0];
    }
    if (isset($parts[1]) && strlen($parts[1]))
    {
        $_GET[FLEA::getAppInf('actionAccessor')] = $parts[1];
    }

    $style = FLEA::getAppInf('urlParameterPairStyle');
    if ($style == '/') {
        for ($i = 2; $i < count($parts); $i += 2) {
            if (isset($parts[$i + 1])) {
                $_GET[$parts[$i]] = $parts[$i + 1];
            }
        }
    } else {
        for ($i = 2; $i < count($parts); $i++) {
            $p = $parts[$i];
            $arr = explode($style, $p);
            if (isset($arr[1])) {
                $_GET[$arr[0]] = $arr[1];
            }
        }
    }

    // 将 $_GET 合并到 $_REQUEST，
    // 有时需要使用 $_REQUEST 统一处理 url 中的 id=? 这样的参数
    $_REQUEST = array_merge($_REQUEST, $_GET);
}

/**
 * 调用过滤器
 */
if (defined('FLEA_VERSION')) {
    ___uri_filter();
}
