<?php 
    include 'inc/class.PassHash.inc.php';
    include 'inc/class.db_connect.inc.php';

    $checkedFormsFields = checkFormField::cleanFormField($_POST);
    DB_Connect::test();
    $sql = 'select * from users where username = "'.$checkedFormsFields['username'].'"';
    $result = DB_Connect::query($sql);
    $fila = mysql_fetch_assoc($result);
    
    echo json_encode($fila);
?>