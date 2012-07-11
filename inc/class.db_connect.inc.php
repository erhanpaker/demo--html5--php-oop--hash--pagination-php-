<?php
include 'config/db-cred.inc.php';

foreach ( $C as $name => $val )
    define($name, $val);

class DB_Connect {
    
    private static $connection;
    
    function test()
    {
        self::$connection = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("unable to connect to database");
        $db_select = mysql_select_db(DB_NAME, self::$connection);

        if(!$db_select)
            die("Database selection failed: ".mysql_error());
    }
    
    function query($query)
    {
        echo 'query => '.$query;
        $querydata = mysql_query($query);
        
        echo '<pre> query data';
        print_r($querydata);
        echo '</pre>';
        
        self::confirm_query($querydata);
        return $querydata;
    }

    function confirm_query($result_set)
    {
        if (!$result_set)
            die("Database query failed: " . mysql_error());
    }
}
?>