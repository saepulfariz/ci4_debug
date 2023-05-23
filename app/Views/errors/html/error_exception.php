<?php

use Config\Services;
use CodeIgniter\CodeIgniter;

// die;

$errorId = uniqid('error', true);
// echo urlencode($title . ' ' . preg_replace('#\'.*\'|".*"#Us', '', $exception->getMessage()));
// // var_dump($exception);
// var_dump(nl2br(esc($exception->getMessage())));
// var_dump($title);
// echo  json_encode($trace);


date_default_timezone_set('Asia/Jakarta');

$response = Services::response();
$response->setStatusCode(http_response_code());
// $response->getStatusCode() . ' - ' . $response->getReasonPhrase();

$data_log = [
    'title' => $title,
    'type' => $title,
    'base_url' => base_url(),
    // 'file' => esc(clean_path($file)),
    'file' => $file,
    // 'file' => clean_path($file),
    'line' => esc($line),
    // 'code' => $exception->getCode(),
    'code' => $response->getStatusCode(),
    'code_detail' => $response->getReasonPhrase(),
    'message' => nl2br(esc($exception->getMessage())),
    'created_at' => date('Y-m-d H:i:s'),
    'trace' => $trace,
];
$myfile = fopen('result_' . date('ymdhis') . '.json', 'w');
fwrite($myfile, json_encode($data_log));
fclose($myfile);

/*


{
  "title": "CodeIgniter\\Database\\Exceptions\\DatabaseException",
  "type": "CodeIgniter\\Database\\Exceptions\\DatabaseException",
  "code": 500,
  "message": "Unable to connect to the database.\r\nMain connection [MySQLi]: No connection could be made because the target machine actively refused it",
  "file": "C:\\xampp_8.1\\htdocs\\ci4_debug\\vendor\\codeigniter4\\framework\\system\\Database\\BaseConnection.php",
  "line": 427,
  "trace": [
    {
      "file": "C:\\xampp_8.1\\htdocs\\ci4_debug\\vendor\\codeigniter4\\framework\\system\\Database\\BaseConnection.php",
      "line": 574,
      "function": "initialize",
      "class": "CodeIgniter\\Database\\BaseConnection",
      "type": "->",
      "args": []
    },
    {
      "file": "C:\\xampp_8.1\\htdocs\\ci4_debug\\vendor\\codeigniter4\\framework\\system\\Database\\BaseBuilder.php",
      "line": 1616,
      "function": "query",
      "class": "CodeIgniter\\Database\\BaseConnection",
      "type": "->",
      "args": [
        "SELECT *\nFROM `tb_user`",
        [],
        false
      ]
    },
    {
      "file": "C:\\xampp_8.1\\htdocs\\ci4_debug\\app\\Controllers\\Home.php",
      "line": 16,
      "function": "get",
      "class": "CodeIgniter\\Database\\BaseBuilder",
      "type": "->",
      "args": []
    },
    {
      "file": "C:\\xampp_8.1\\htdocs\\ci4_debug\\vendor\\codeigniter4\\framework\\system\\CodeIgniter.php",
      "line": 934,
      "function": "get",
      "class": "App\\Controllers\\Home",
      "type": "->",
      "args": []
    },
    {
      "file": "C:\\xampp_8.1\\htdocs\\ci4_debug\\vendor\\codeigniter4\\framework\\system\\CodeIgniter.php",
      "line": 499,
      "function": "runController",
      "class": "CodeIgniter\\CodeIgniter",
      "type": "->",
      "args": [
        {}
      ]
    },
    {
      "file": "C:\\xampp_8.1\\htdocs\\ci4_debug\\vendor\\codeigniter4\\framework\\system\\CodeIgniter.php",
      "line": 368,
      "function": "handleRequest",
      "class": "CodeIgniter\\CodeIgniter",
      "type": "->",
      "args": [
        null,
        {
          "handler": "file",
          "backupHandler": "dummy",
          "storePath": "C:\\xampp_8.1\\htdocs\\ci4_debug\\writable\\cache/",
          "cacheQueryString": false,
          "prefix": "",
          "ttl": 60,
          "reservedCharacters": "{}()/\\@:",
          "file": {
            "storePath": "C:\\xampp_8.1\\htdocs\\ci4_debug\\writable\\cache/",
            "mode": 416
          },
          "memcached": {
            "host": "127.0.0.1",
            "port": 11211,
            "weight": 1,
            "raw": false
          },
          "redis": {
            "host": "127.0.0.1",
            "password": null,
            "port": 6379,
            "timeout": 0,
            "database": 0
          },
          "validHandlers": {
            "dummy": "CodeIgniter\\Cache\\Handlers\\DummyHandler",
            "file": "CodeIgniter\\Cache\\Handlers\\FileHandler",
            "memcached": "CodeIgniter\\Cache\\Handlers\\MemcachedHandler",
            "predis": "CodeIgniter\\Cache\\Handlers\\PredisHandler",
            "redis": "CodeIgniter\\Cache\\Handlers\\RedisHandler",
            "wincache": "CodeIgniter\\Cache\\Handlers\\WincacheHandler"
          }
        },
        false
      ]
    },
    {
      "file": "C:\\xampp_8.1\\htdocs\\ci4_debug\\public\\index.php",
      "line": 67,
      "function": "run",
      "class": "CodeIgniter\\CodeIgniter",
      "type": "->",
      "args": []
    },
    {
      "file": "C:\\xampp_8.1\\htdocs\\ci4_debug\\vendor\\codeigniter4\\framework\\system\\Commands\\Server\\rewrite.php",
      "line": 47,
      "args": [
        "C:\\xampp_8.1\\htdocs\\ci4_debug\\public\\index.php"
      ],
      "function": "require_once"
    }
  ]
}

*/
// die;
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">

    <title><?= esc($title) ?></title>
    <style>
        <?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.css')) ?>
    </style>

    <script>
        <?= file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.js') ?>
    </script>
</head>

<body onload="init()">

    <!-- Header -->
    <div class="header">
        <div class="container">
            <h1><?= esc($title), esc($exception->getCode() ? ' #' . $exception->getCode() : '') ?></h1>
            <p>
                <?= nl2br(esc($exception->getMessage())) ?>
                <a href="https://www.duckduckgo.com/?q=<?= urlencode($title . ' ' . preg_replace('#\'.*\'|".*"#Us', '', $exception->getMessage())) ?>" rel="noreferrer" target="_blank">search &rarr;</a>
            </p>
        </div>
    </div>

    <!-- Source -->
    <div class="container">
        <p><b><?= esc(clean_path($file)) ?></b> at line <b><?= esc($line) ?></b></p>

        <?php if (is_file($file)) : ?>
            <div class="source">
                <?= static::highlightFile($file, $line, 15); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="container">

        <ul class="tabs" id="tabs">
            <li><a href="#backtrace">Backtrace</a></li>
            <li><a href="#server">Server</a></li>
            <li><a href="#request">Request</a></li>
            <li><a href="#response">Response</a></li>
            <li><a href="#files">Files</a></li>
            <li><a href="#memory">Memory</a></li>
        </ul>

        <div class="tab-content">

            <!-- Backtrace -->
            <div class="content" id="backtrace">

                <ol class="trace">
                    <?php foreach ($trace as $index => $row) : ?>

                        <li>
                            <p>
                                <!-- Trace info -->
                                <?php if (isset($row['file']) && is_file($row['file'])) : ?>
                                    <?php
                                    if (isset($row['function']) && in_array($row['function'], ['include', 'include_once', 'require', 'require_once'], true)) {
                                        echo esc($row['function'] . ' ' . clean_path($row['file']));
                                    } else {
                                        echo esc(clean_path($row['file']) . ' : ' . $row['line']);
                                    }
                                    ?>
                                <?php else : ?>
                                    {PHP internal code}
                                <?php endif; ?>

                                <!-- Class/Method -->
                                <?php if (isset($row['class'])) : ?>
                                    &nbsp;&nbsp;&mdash;&nbsp;&nbsp;<?= esc($row['class'] . $row['type'] . $row['function']) ?>
                                    <?php if (!empty($row['args'])) : ?>
                                        <?php $argsId = $errorId . 'args' . $index ?>
                                        ( <a href="#" onclick="return toggle('<?= esc($argsId, 'attr') ?>');">arguments</a> )
                            <div class="args" id="<?= esc($argsId, 'attr') ?>">
                                <table cellspacing="0">

                                    <?php
                                        $params = null;
                                        // Reflection by name is not available for closure function
                                        if (substr($row['function'], -1) !== '}') {
                                            $mirror = isset($row['class']) ? new ReflectionMethod($row['class'], $row['function']) : new ReflectionFunction($row['function']);
                                            $params = $mirror->getParameters();
                                        }

                                        foreach ($row['args'] as $key => $value) : ?>
                                        <tr>
                                            <td><code><?= esc(isset($params[$key]) ? '$' . $params[$key]->name : "#{$key}") ?></code></td>
                                            <td>
                                                <pre><?= esc(print_r($value, true)) ?></pre>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>

                                </table>
                            </div>
                        <?php else : ?>
                            ()
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if (!isset($row['class']) && isset($row['function'])) : ?>
                        &nbsp;&nbsp;&mdash;&nbsp;&nbsp; <?= esc($row['function']) ?>()
                    <?php endif; ?>
                    </p>

                    <!-- Source? -->
                    <?php if (isset($row['file']) && is_file($row['file']) && isset($row['class'])) : ?>
                        <div class="source">
                            <?= static::highlightFile($row['file'], $row['line']) ?>
                        </div>
                    <?php endif; ?>
                        </li>

                    <?php endforeach; ?>
                </ol>

            </div>

            <!-- Server -->
            <div class="content" id="server">
                <?php foreach (['_SERVER', '_SESSION'] as $var) : ?>
                    <?php
                    if (empty($GLOBALS[$var]) || !is_array($GLOBALS[$var])) {
                        continue;
                    } ?>

                    <h3>$<?= esc($var) ?></h3>

                    <table>
                        <thead>
                            <tr>
                                <th>Key</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($GLOBALS[$var] as $key => $value) : ?>
                                <tr>
                                    <td><?= esc($key) ?></td>
                                    <td>
                                        <?php if (is_string($value)) : ?>
                                            <?= esc($value) ?>
                                        <?php else : ?>
                                            <pre><?= esc(print_r($value, true)) ?></pre>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php endforeach ?>

                <!-- Constants -->
                <?php $constants = get_defined_constants(true); ?>
                <?php if (!empty($constants['user'])) : ?>
                    <h3>Constants</h3>

                    <table>
                        <thead>
                            <tr>
                                <th>Key</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($constants['user'] as $key => $value) : ?>
                                <tr>
                                    <td><?= esc($key) ?></td>
                                    <td>
                                        <?php if (is_string($value)) : ?>
                                            <?= esc($value) ?>
                                        <?php else : ?>
                                            <pre><?= esc(print_r($value, true)) ?></pre>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

            <!-- Request -->
            <div class="content" id="request">
                <?php $request = Services::request(); ?>

                <table>
                    <tbody>
                        <tr>
                            <td style="width: 10em">Path</td>
                            <td><?= esc($request->getUri()) ?></td>
                        </tr>
                        <tr>
                            <td>HTTP Method</td>
                            <td><?= esc(strtoupper($request->getMethod())) ?></td>
                        </tr>
                        <tr>
                            <td>IP Address</td>
                            <td><?= esc($request->getIPAddress()) ?></td>
                        </tr>
                        <tr>
                            <td style="width: 10em">Is AJAX Request?</td>
                            <td><?= $request->isAJAX() ? 'yes' : 'no' ?></td>
                        </tr>
                        <tr>
                            <td>Is CLI Request?</td>
                            <td><?= $request->isCLI() ? 'yes' : 'no' ?></td>
                        </tr>
                        <tr>
                            <td>Is Secure Request?</td>
                            <td><?= $request->isSecure() ? 'yes' : 'no' ?></td>
                        </tr>
                        <tr>
                            <td>User Agent</td>
                            <td><?= esc($request->getUserAgent()->getAgentString()) ?></td>
                        </tr>

                    </tbody>
                </table>


                <?php $empty = true; ?>
                <?php foreach (['_GET', '_POST', '_COOKIE'] as $var) : ?>
                    <?php
                    if (empty($GLOBALS[$var]) || !is_array($GLOBALS[$var])) {
                        continue;
                    } ?>

                    <?php $empty = false; ?>

                    <h3>$<?= esc($var) ?></h3>

                    <table style="width: 100%">
                        <thead>
                            <tr>
                                <th>Key</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($GLOBALS[$var] as $key => $value) : ?>
                                <tr>
                                    <td><?= esc($key) ?></td>
                                    <td>
                                        <?php if (is_string($value)) : ?>
                                            <?= esc($value) ?>
                                        <?php else : ?>
                                            <pre><?= esc(print_r($value, true)) ?></pre>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php endforeach ?>

                <?php if ($empty) : ?>

                    <div class="alert">
                        No $_GET, $_POST, or $_COOKIE Information to show.
                    </div>

                <?php endif; ?>

                <?php $headers = $request->headers(); ?>
                <?php if (!empty($headers)) : ?>

                    <h3>Headers</h3>

                    <table>
                        <thead>
                            <tr>
                                <th>Header</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($headers as $header) : ?>
                                <tr>
                                    <td><?= esc($header->getName(), 'html') ?></td>
                                    <td><?= esc($header->getValueLine(), 'html') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php endif; ?>
            </div>

            <!-- Response -->
            <?php
            $response = Services::response();
            $response->setStatusCode(http_response_code());
            ?>
            <div class="content" id="response">
                <table>
                    <tr>
                        <td style="width: 15em">Response Status</td>
                        <td><?= esc($response->getStatusCode() . ' - ' . $response->getReasonPhrase()) ?></td>
                    </tr>
                </table>

                <?php $headers = $response->headers(); ?>
                <?php if (!empty($headers)) : ?>
                    <?php natsort($headers) ?>

                    <h3>Headers</h3>

                    <table>
                        <thead>
                            <tr>
                                <th>Header</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (array_keys($headers) as $name) : ?>
                                <tr>
                                    <td><?= esc($name, 'html') ?></td>
                                    <td><?= esc($response->getHeaderLine($name), 'html') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php endif; ?>
            </div>

            <!-- Files -->
            <div class="content" id="files">
                <?php $files = get_included_files(); ?>

                <ol>
                    <?php foreach ($files as $file) : ?>
                        <li><?= esc(clean_path($file)) ?></li>
                    <?php endforeach ?>
                </ol>
            </div>

            <!-- Memory -->
            <div class="content" id="memory">

                <table>
                    <tbody>
                        <tr>
                            <td>Memory Usage</td>
                            <td><?= esc(static::describeMemory(memory_get_usage(true))) ?></td>
                        </tr>
                        <tr>
                            <td style="width: 12em">Peak Memory Usage:</td>
                            <td><?= esc(static::describeMemory(memory_get_peak_usage(true))) ?></td>
                        </tr>
                        <tr>
                            <td>Memory Limit:</td>
                            <td><?= esc(ini_get('memory_limit')) ?></td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div> <!-- /tab-content -->

    </div> <!-- /container -->

    <div class="footer">
        <div class="container">

            <p>
                Displayed at <?= esc(date('H:i:sa')) ?> &mdash;
                PHP: <?= esc(PHP_VERSION) ?> &mdash;
                CodeIgniter: <?= esc(CodeIgniter::CI_VERSION) ?>
            </p>

        </div>
    </div>

</body>

</html>