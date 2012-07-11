<?php

    /**
     * @author Mubashir Ali
     * @category Pagination
     * @copyright - GNU
     * @since 05-04-2012
     * Example
     * @version 1.0
     */

    require_once('CompletePagination.class.php');
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
    $result = mysql_query($query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Simple Pagination Example</title>
        <link rel="stylesheet" type="text/css" href="completepagination.css" />
    </head>
    <body>
        <div align="center">
        <?php echo $pagination_html; ?>
        <form method="post" action="">
            Country Name: <input type="text" name="txt_name" value="<?php echo @$_REQUEST['txt_name'];?>" />
            <input type="submit" value="Submit" />            
        </form>
        <table border="1" cellpadding="2" cellspacing="2">
            <thead>
            <tr>
                <th>Country</th>
                <th>Country Abb</th>
                <th>Currency Abb</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    while($record = mysql_fetch_array($result)){
                ?>
                <tr>
                    <td><?php echo $record['Country'];?></td>
                    <td><?php echo $record['CountryAbbrev'];?></td>
                    <td><?php echo $record['CurrencyAbbr'];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php echo $pagination_html2;?>
        </div>
    </body>
</html>