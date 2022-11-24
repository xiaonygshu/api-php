<?php
header('Content-type: text/javascript;charset=utf-8');
class MysqlDBconnect
{
    public function __construct($dbname = null)
    {
        // $hostname = "localhost";
        $hostname = "moulasilz.theworkpc.com";
        $port = 3306;
        // $port = 3307;
        $user = "moulasilz";
        $passwd = "123456";
        $dbname = $dbname;
        $conn = mysqli_connect($hostname, $user, $passwd, null, $port);
        $conn->set_charset("utf8mb4");
        if (!$conn) {
            $this->error("Connection attempt failed");
        }
        if (!mysqli_select_db( $conn, $dbname)) {
            $this->error("Dbase Select failed");
        }
        $this->CONN = $conn;
        return true;
    }
    function error($var = null)
    {
        echo $var;
    }

    function close()
    {
        $conn = $this->CONN;
        $close = mysqli_close($conn);
        if (!$close) {
            $this->error("Connection close failed");
        }
        return true;
    }

    function sql_query($sql = "")
    {
        if (empty($sql)) {
            return false;
        }
        if (empty($this->CONN)) {
            return false;
        }
        $conn = $this->CONN;
        $results = mysqli_query($conn, $sql) or die("Query Failed..<hr>" . mysqli_error($conn));
        if (!$results) {
            $message = "Bad Query !";
            $this->error($message);
            return false;
        }
        $count = 0;
        $data = array();
        while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
            $data[$count] = $row;
            $count++;
        }
        mysqli_free_result($results);
        return $data;
        // }
    }
    public function SELECT_ALL($table = null)
    {
        $sql = "SELECT * FROM $table";
        $res =$this->sql_query($sql);
        return $res;
    }
}
