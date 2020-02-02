<?php
/**
 * 显示异常信息及调用堆栈
 *
 * @param FLEA_Exception $ex
 */
function __error_dump_trace($ex)
{
    echo '<strong>Exception: </strong>' . get_class($ex) . "<br />\n";
    if ($ex->getMessage() != '') {
        echo '<strong>Message: </strong>' . $ex->getMessage() . "<br />\n";
    }
    echo "<br />\n";

    $trace = $ex->getTrace();
    $ix = count($trace);
    foreach ($trace as $point) {
        $file = isset($point['file']) ? $point['file'] : null;
        $line = isset($point['line']) ? $point['line'] : null;
        $id = md5("{$file}({$line})");
        $function = isset($point['class']) ? "{$point['class']}::{$point['function']}" : $point['function'];

        $args = array();
        if (is_array($point['args']) && count($point['args']) > 0) {
            foreach ($point['args'] as $arg) {
                switch (gettype($arg)) {
                case 'array':
                    $args[] = 'array(' . count($arg) . ')';
                    break;
                case 'resource':
                    $args[] = gettype($arg);
                    break;
                case 'object':
                    $args[] = get_class($arg);
                    break;
                case 'string':
                    if (strlen($arg) > 30) {
                        $arg = substr($arg, 0, 27) . ' ...';
                    }
                    $args[] = "'{$arg}'";
                    break;
                default:
                    $args[] = $arg;
                }
            }
        }
        $args = implode(", ", $args);

        echo <<<EOT
<hr />
<strong>Filename:</strong> {$file} [{$line}]<br />
#{$ix} {$function}($args)
<div id="{$id}" class="filedesc">
ARGS:
EOT;

        dump($point['args']);
        echo "SOURCE CODE: <br />\n";
        echo __error_show_source($file, $line);
        echo "\n</div>\n";
        echo "<br />\n";
        $ix--;
    }
}

/**
 * 显示文件源代码
 *
 * @param string $file
 * @param int $line
 * @param int $prev
 * @param int $next
 *
 * @return string
 */
function __error_show_source($file, $line, $prev = 10, $next = 10)
{
    if (!(file_exists($file) && is_file($file))) {
        return '';
    }

    $data = file($file);
    $count = count($data) - 1;

    //count which lines to display
    $start = $line - $prev;
    if ($start < 1) {
        $start = 1;
    }
    $end = $line + $next;
    if ($end > $count) {
        $end = $count + 1;
    }

    //displaying
    $out = '<table cellspacing="0" cellpadding="0">';

    for ($x = $start; $x <= $end; $x++) {
        $out .= "  <tr>\n";
        if ($line != $x) {
            $out .= "    <td class=\"line-num\">";
        } else {
            $out .= "    <td class=\"line-num-break\">";
        }
        $out .= str_repeat('&nbsp;', (strlen($end) - strlen($x)) + 1);
        $out .= $x;
        $out .= "&nbsp;</td>\n";

        $out .= "    <td class=\"source\">&nbsp;";
        $out .= t($data[$x - 1]);
        $out .= "</td>\n  </tr>\n";
    }
    $out .= "</table>\n";
    return $out;
}

/**
 * 显示指定文件的连接
 *
 * @param string $filename
 */
function __error_filelink($filename)
{
    $path = realpath($filename);
    if ($path) {
        echo $path;
    } else {
        echo $filename;
    }
}

/**
 * 输出按照模版要求格式化以后的代码
 *
 * @param string $code
 */
function __error_highlight_string($code)
{
    $text = t2js($code);
    $code = str_replace("<br />", "\n", highlight_string($code, true));

    echo <<<EOT
<pre>
[Copy To Clipboard]

{$code}
</pre>
EOT;
}

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<h1><?php echo $ex->getMessage(); ?></h1>

<div class="error">
<h2>Error reason:</h2>
Uncaptured exception.
</div>

<p>
<strong>Details:</strong>
<?php echo t($ex->__toString()); ?>
</p>

<p></p>

<div class="track">
<?php __error_dump_trace($ex); ?>
</div>
