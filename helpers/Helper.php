<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']);

function dd($data)
{
    if (extension_loaded('xdebug')) {
        die(var_dump($data));
    } else {
        highlight_string("<?php\n " . var_export($data, true) . "?>");
        echo '<script>document.getElementsByTagName("code")[0].getElementsByTagName("span")[1].remove() ;document.getElementsByTagName("code")[0].getElementsByTagName("span")[document.getElementsByTagName("code")[0].getElementsByTagName("span").length - 1].remove() ; </script>';
        die();
    }
}

function json($data)
{
    header('Content-Type: application/json');
    die(json_encode($data));
}

class Helper
{
    public static function init()
    {
        self::loadEnv('/.env');
        self::initDB();
        self::setTimezone(getenv('APP_TIMEZONE'));
        self::setCachePath();
    }

    public static function loadEnv($path)
    {
        (new DotEnv(ROOT . $path))->load();
    }

    public static function initDB()
    {
        if (!empty(getenv('DB_HOST'))) {
            R::setup(
                'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME'),
                getenv('DB_USER'),
                getenv('DB_PASS'),
                TRUE
            );
            R::fancyDebug(getenv('APP_ENV') == 'dev' ? TRUE : FALSE);
        }
    }

    public static function setTimezone($timezone)
    {
        date_default_timezone_set($timezone);
    }

    public static function setCachePath()
    {
        define('CACHE', $_SERVER['DOCUMENT_ROOT'] . '/' . getenv('PATH_CACHE'));

        if (!file_exists(CACHE)) {
            mkdir(CACHE, 0777, true);
        }
    }
}
