<?php

/**
 * @author Mubashir Ali
 * @category Pagination
 * @copyright - GNU
 * @since 05-04-2012
 * @version 1.0
 */
class CompletePagination 
{
    private $rows_per_page;
    private $url;
    private $page_no;
    
    public $total_rows;
    public $show_dropdown;
    public $show_total_records;
    public $show_page_no;
    public $show_ellipsis = 9;     //Show ... if total pages are more than 10

    /**
     *
     * @param int $rperpage - show the record per page
     * @param int $totrows - total records
     */
    public function __construct($rperpage, $totrows = "") 
    {
        $this->rows_per_page = $rperpage;
        $this->total_rows = $totrows;
        $this->setPageNumber();
        $this->generateCompleteURL();
    }

    /**
     * This function sets the pageNumber
     */
    private function setPageNumber() 
    {
        if($_POST)
            $this->page_no = 1;
        else
        {
            if (!isset($_REQUEST['page_no']) && @$_REQUEST['page_no'] == "")
                $this->page_no = 1;
            else
                $this->page_no = $_REQUEST['page_no'];
        }
    }

    /**
     * This function gets the limit of pagination
     * @return int 
     */
    public function getLimit() 
    {
        return ($this->page_no - 1) * $this->rows_per_page;
    }

    /**
     * This function generates the complete URL along with the query string
     */
    private function generateCompleteURL() 
    {
        $page_query = (count($_REQUEST) == 0 ? "page_no=" : "&page_no=");

        if (isset($_REQUEST['page_no']))
            unset($_REQUEST['page_no']);

        $this->url = $_SERVER['PHP_SELF'] . "?" . http_build_query($_REQUEST) . $page_query;
    }

    /**
     * This function returns the last page, that is generates as the result of Pagination
     * @return int 
     */
    private function getLastPage() 
    {
        return ceil($this->total_rows / $this->rows_per_page);
    }

    /**
     * This function generates the DropDown for Pagination
     * @return string 
     */
    private function generateDropdown() 
    {
        if ($this->total_rows == 0)
            return "";

        $str = "";
        $str .= '<select name="drp_page_no" id="drp_page_no" onchange="document.location.href = this.value;">';
        for ($cnt = 1; $cnt <= $this->getLastPage(); $cnt++) 
        {
            if (isset($this->page_no) && $this->page_no == $cnt)
                $str .= '<option value="' . $this->url . $cnt . '" selected="selected">' . $cnt . '</option>';
            else
                $str .= '<option value="' . $this->url . $cnt . '">' . $cnt . '</option>';
        }
        $str .= '</select>';
        return $str;
    }

    /**
     * This function actually generates the complete pagination
     * @return string 
     */
    public function showCompletePagination() 
    {
        $pagination = "";
        $lpm1 = $this->getLastPage() - 1;
        $page = $this->page_no;
        $prev = $this->page_no - 1;
        $next = $this->page_no + 1;

        $pagination .= "<div class=\"pagination\"";

        if (@$margin || @$padding) 
        {
            $pagination .= " style=\"";
            if ($margin)
                $pagination .= "margin: $margin;";
            if ($padding)
                $pagination .= "padding: $padding;";
            $pagination .= "\"";
        }
        if ($this->show_total_records)
            $pagination .= "><span class='tableStandardBold' style='margin-right:50px;'> Total Number of record(s) found: " . $this->total_rows . " </span>";
        else
            $pagination .= ">";


        if ($this->getLastPage() > 1) 
        {            
            if ($page > 1)
            {
                $pagination .= "<a href={$this->url}1>&laquo; first</a>";
                $pagination .= "<a href=$this->url$prev>&lsaquo; prev</a>";
            }
            else
            {
                $pagination .= "<span class=\"disabled\">&laquo; first</span>";
                $pagination .= "<span class=\"disabled\">&lsaquo; prev</span>";
            }


            if ($this->getLastPage() < $this->show_ellipsis) 
            {
                for ($counter = 1; $counter <= $this->getLastPage(); $counter++) 
                {
                    if ($counter == $page)
                        $pagination .= "<span class=\"current\">" . $counter . "</span>";
                    else
                        $pagination .= "<a href=$this->url$counter>" . $counter . "</a>";
                }
            }
            elseif ($this->getLastPage() >= $this->show_ellipsis)
            {
                if ($page < 4) 
                {
                    for ($counter = 1; $counter < 6; $counter++) 
                    {
                        if ($counter == $page)
                            $pagination .= "<span class=\"current\">" . $counter . "</span>";
                        else
                            $pagination .= "<a href=\"$this->url$counter\">" . $counter . "</a>";
                    }
                    $pagination .= "...";
                    $pagination .= "<a href=$this->url$lpm1>" . $lpm1 . "</a>";
                    $pagination .= "<a href={$this->url}{$this->getLastPage()}>" . $this->getLastPage() . "</a>";
                }
                elseif ($this->getLastPage() - 3 > $page && $page > 1) 
                {
                    $pagination .= "<a href={$this->url}1>1</a>";
                    $pagination .= "<a href={$this->url}2>2</a>";
                    $pagination .= "...";
                    for ($counter = $page - 1; $counter <= $page + 1; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<span class=\"current\">" . $counter . "</span>";
                        else
                            $pagination .= "<a href=$this->url$counter>" . $counter . "</a>";
                    }
                    $pagination .= "...";
                    $pagination .= "<a href=$this->url$lpm1>$lpm1</a>";
                    $pagination .= "<a href={$this->url}{$this->getLastPage()}>" . $this->getLastPage() . "</a>";
                }
                else 
                {
                    $pagination .= "<a href={$this->url}1>1</a>";
                    $pagination .= "<a href={$this->url}2>2</a>";
                    $pagination .= "...";
                    for ($counter = $this->getLastPage() - 4; $counter <= $this->getLastPage(); $counter++) 
                    {
                        if ($counter == $page)
                            $pagination .= "<span class=\"current\">" . $counter . "</span>";
                        else
                            $pagination .= "<a href=$this->url$counter>" . $counter . "</a>";
                    }
                }
            }

            if ($page < $counter - 1)
            {
                $pagination .= "<a href=$this->url$next>next &rsaquo;</a>";
                $pagination .= "<a href={$this->url}{$this->getLastPage()}>last &raquo;</a>";
            }
            else
            {
                $pagination .= "<span class=\"disabled\">next &rsaquo;</span>";
                $pagination .= "<span class=\"disabled\">last &raquo;</span>";
            }

            if ($this->show_dropdown)
                $pagination .= "<span class='tableStandardBold' style='margin-left:20px;'>Go to page:  " . $this->generateDropdown() . "</span>\n";

            if ($this->show_page_no)
            {
                $page = 1;
                if (isset($this->page_no) && $this->page_no != "")
                    $page = $this->page_no;
                $pagination .= "<span class='tableStandardBold' style='margin-left:20px;'> Page " . $page . " of " . $this->getLastPage() . "</span>\n";
            }

            $pagination .= "</div>\n";
        }
        return $pagination;
    }

}

?>