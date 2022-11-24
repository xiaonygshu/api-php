<?php
header('Content-type: text/javascript;charset=utf-8');
require "./config/DBconfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $dbname = $_REQUEST['db'];
    $table = $_REQUEST['table'];

    if (empty($dbname) || empty($table)) {
        echo json_encode(array("message"=>"Bad Request!"), JSON_PRETTY_PRINT);
    } else {
        $connector = new MysqlDBconnect($dbname);
        $res = $connector->SELECT_ALL($table);
        echo json_encode($res, JSON_PRETTY_PRINT);
    }
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $dbname = $_REQUEST['db'];
    $table = $_REQUEST['table'];

    if (empty($dbname) || empty($table)) {
        echo json_encode(array("message"=>"Bad Request!"), JSON_PRETTY_PRINT);
    } else {
        $connector = new MysqlDBconnect($dbname);
        $res = $connector->SELECT_ALL($table);
        echo json_encode($res, JSON_PRETTY_PRINT);
    }
}
