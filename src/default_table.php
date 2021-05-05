<?php
require_once "main_class.php";

class Default_Table extends Main_Class
{

    function __construct($db, $tn)
    {
        parent::__construct($db);
        $this->table_name = $tn;
    }


}