<?php
return array(
    /**
     * 应用层序的默认时区设置，仅针对 PHP 5.1 以后版本
     *
     * 如果该设置为 null，则以服务器设置为准。如果服务器没有设置时区，则设置为 Asia/ShangHai。
     */
    'defaultTimezone'           => null,

    /**
     * 指示控制器的 url 参数名和默认控制器名
     *
     * 控制器名字只能是a-z字母和0-9数字，以及“_”下划线。
     */
    'controllerAccessor'        => 'c',
    'defaultController'         => 'default',

    /**
     * 指示 动作方法的 url 参数名和默认 动作方法名
     */
    'actionAccessor'            => 'a',
    'defaultAction'             => 'index',

    /**
     * url 参数的传递模式，可以是标准、PATHINFO、URL 重写等模式
     */
    'urlMode'                   => URL_STANDARD,

    /**
     * 指示默认的应用程序入口文件名
     */
    'urlBootstrap'              => 'index.php',

    /**
     * 指示在生成 url 时，是否总是使用应用程序入口文件名，仅限 URL_STANDARD 模式
     *
     * 如果该设置为 false，则生成的 url 类似：
     *
     * http://www.example.com/?controller=xxx&action=yyy
     */
    'urlAlwaysUseBootstrap'     => true,

    /**
     * 指示在 PATHINFO 和 REWRITE 模式下，用什么符号作为 URL 参数名和参数值的连接字符
     */
    'urlParameterPairStyle'     => '-',

    /**
     * 是否将 url 参数中包含的控制器名字和动作名字强制转为小写
     */
    'urlLowerChar'              => false,

    /**
     * 调用 url() 函数时，要调用的 callback 方法
     */
    'urlCallback'               => null,

    /**
     * 控制器类名称前缀
     */
    'controllerClassPrefix'     => 'controller_',

    /**
     * FleaPHP 内部及 cache 系列函数使用的缓存目录
     * 应用程序必须设置该选项才能使用 cache 功能。
     */
    'internalCacheDir'          => null,

    /**
     * 指示要自动载入的文件
     */
    'autoLoad'                  => array(),

    /**
     * 指示使用哪些过滤器对 HTTP 请求进行过滤
     */
    'requestFilters'            => array(),

    // }}}

    // {{{ 数据库相关

    /**
     * 数据库配置，可以是数组，也可以是 DSN 字符串
     */
    'dbDSN'                     => null,

    /**
     * 指示构造 TableDataGateway 对象时，是否自动连接到数据库
     */
    'dbTDGAutoInit'             => true,

    /**
     * 数据表的全局前缀
     */
    'dbTablePrefix'             => '',

    /**
     * 数据表元数据缓存时间（秒），如果 dbMetaCached 设置为 false，则不会缓存数据表元数据
     * 通常开发时，该设置为 10，以便修改数据库表结构后应用程序能够立刻刷新元数据
     */
    'dbMetaLifetime'            => 900,

    /**
     * 指示是否缓存数据表的元数据
     */
    'dbMetaCached'              => true,

    // }}}

    /**
     * 指示 FleaPHP 应用程序内部处理数据和输出内容要使用的编码
     */
    'responseCharset'           => 'utf-8',

    /**
     * 当 FleaPHP 连接数据库时，用什么编码传递数据
     */
    'databaseCharset'           => 'utf8',

    /**
     * 是否自动输出 Content-Type: text/html; charset=responseCharset
     */
    'autoResponseHeader'        => true,

// }}}

    // {{{ 日志和错误处理
    /**
     * 异常处理例程
     */
    'exceptionHandler'          => '__FLEA_EXCEPTION_HANDLER',

    /**
     * 指示是否显示错误信息
     */
    'displayErrors'             => true,
    // }}}

    // {{{ 助手库

    /**
     * 数据验证服务助手
     */
    'helper.verifier'           => 'FLEA_Helper_Verifier',

    /**
     * 分页助手
     */
    'helper.pager'              => 'FLEA_Helper_Pager',

    // }}}
);