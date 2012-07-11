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
    $row_per_page = 100;
    $total_rec = 2000;
    $_REQUEST['f_name'] = "FName";
    $_REQUEST['l_name'] = "LName";
    

    $pagination = new CompletePagination($row_per_page, $total_rec);
    $pagination->show_dropdown = false;
    $pagination->show_total_records = false;
    $pagination->show_page_no = false;
    $pagination_html = $pagination->showCompletePagination();
    
    $pagination->show_dropdown = true;
    $pagination->show_total_records = true;
    $pagination->show_page_no = true;
    $pagination->show_ellipsis = 20;   //Show Ellipsis if total Pages are greater than or eqaul to 100
    $pagination_html2 = $pagination->showCompletePagination();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Simple Pagination Example</title>
        <link rel="stylesheet" type="text/css" href="completepagination.css" />
    </head>
    <body>
        <?php echo $pagination_html; ?>
        <?php echo $pagination_html2; ?>
    </body>
</html>