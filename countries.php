<?php

    include 'inc/class.CompletePagination.inc.php';
    include 'inc/class.db_connect.inc.php';
    
    $row_per_page = 20;
    $pagination = new CompletePagination($row_per_page);
    
    $link = mysql_connect('localhost', 'root', '');
    mysql_selectdb('register');
    
    $where = "";
    
    if(isset($_POST['txt_name']))
        $where = " WHERE Country LIKE '%{$_POST['txt_name']}%'";
    else if(isset($_GET['txt_name']) && isset($_GET['page_no']))
        $where = " WHERE Country LIKE '%{$_GET['txt_name']}%'";

    $query_count = "SELECT COUNT(Country) AS tot_rec FROM countries ".$where;
    $result_count = mysql_query($query_count);
    $record_count = mysql_fetch_array($result_count);
    $total_rec = $record_count['tot_rec'];
    
    $pagination->total_rows = $total_rec;    
    $pagination->show_dropdown = true;
    $pagination->show_total_records = true;
    $pagination->show_page_no = true;
    $pagination->show_ellipsis = 20;   //Show Ellipsis if total Pages are greater than or eqaul to 100
    $pagination_html = $pagination->showCompletePagination();

    $pagination->show_ellipsis = 10;
    $pagination->show_dropdown = false;
    $pagination->show_total_records = false;
    $pagination->show_page_no = false;
    $pagination_html2 = $pagination->showCompletePagination();
    
    $query = "SELECT Country, CountryAbbrev, CurrencyAbbr FROM countries ".$where." LIMIT ".$pagination->getLimit() . ", " . $row_per_page;
    //$result = mysql_query($query);
    
    DB_Connect::test();
    $result = DB_Connect::query($query);

?>