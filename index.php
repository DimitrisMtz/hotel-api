<?php
    use Slim\App;
    
    session_cache_expire(43200); // 30 days
    session_start();
    
    $CONFIG = require_once(__DIR__ . "/config.php");
    define("CONFIG", $CONFIG);
    ini_set('display_errors', '0');
    require_once(__DIR__ . "/vendor/autoload.php");
    require_once(__DIR__ . "/class/Room.php");
    require_once(__DIR__ . "/class/Database.php");
    require_once(__DIR__ . "/class/Helper.php");

    $APP = new Slim\App([
        'settings' => CONFIG["slim"]
    ]);
    $CONTAINER = $APP->getContainer();
    $CONTAINER['db'] = function ($c) {
        $db = $c['settings']['db'];
        $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'], $db['user'], $db['pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
        return $pdo;
    };
    Database::$db = $CONTAINER['db'];

    require_once(__DIR__ . "/route/get.available.rooms.php");

    $APP->run();
?>