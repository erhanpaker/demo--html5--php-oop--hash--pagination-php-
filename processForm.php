<?php 

include 'inc/class.PassHash.inc.php';
include 'inc/class.db_connect.inc.php';

$checkedFormsFields = checkFormField::cleanFormField($_POST);
DB_Connect::test();
   
if(isset($checkedFormsFields['save'])){
    
    $today = date("Ymd"); 
    $query = 'insert into users (username, pass, name, firstName, lastName, regDate) values ("'.$checkedFormsFields['username'].'", "'.PassHash::hash($checkedFormsFields['password']).'", "'.$checkedFormsFields['name'].'", "'.$checkedFormsFields['firstName'].'", "'.$checkedFormsFields['lastName'].'", "'.$today.'")';
    $result = DB_Connect::query($query);
    
    if($result == 1)
        header('Location: index.php');
}
else{
    $query = 'select * from users where username = "'.$checkedFormsFields['username'].'"';
    $result = DB_Connect::query($query);
    $fila = mysql_fetch_assoc($result);
    
    if($checkedFormsFields['validateUsername'])
        echo json_encode($fila);
    else
        if(PassHash::check_password($fila["pass"], $checkedFormsFields['password']))
            header('Location: success.php');
}
?>