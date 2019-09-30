<?php
//include '../../database/databaseHandler.php';
error_reporting(E_ALL ^ E_NOTICE);

class CURDHandler {
    function insertUpdate($tableName, $fieldValueArray, $updateId = 0,$fieldName='id') {
        /*  insert update handler function if update id found then update data or insert data
         *  insert or update data according to given table 
         *  common insert function   
         */
        $output = '';
        if ($updateId == 0) {
            $field = '';
            $values = '';
            foreach ($fieldValueArray as $x => $x_value) {

                if (is_array($x_value)) {
                    $field = $field . "" . $x . ", ";
                    $values = $values . "'" . $x_value[$counter] . "', ";
                } else {
                    $field = $field . "" . $x . ", ";
                    $values = $values . "'" . $x_value . "', ";
                }
            }
            $field = rtrim($field, ', '); 
            $values = rtrim($values, ', ');
            $output = 'insert into ' . $tableName . ' (' . $field . ')' . ' values(' . $values . ');'; 
           mysql_query($output);
           $lastQuery = mysql_query("select id from " . $tableName . " order by id desc limit 0, 1");
           $lastId = mysql_fetch_array($lastQuery);
           return $lastId['id'];
        } else {
            $id = $updateId;
            foreach ($fieldValueArray as $x => $x_value) {
                $field = $field . $x . "=" . "'" . $x_value . "',";
            }
            $field = rtrim($field, ', ');
            $values = rtrim($values, ', ');
          $output = 'update ' . $tableName . ' set ' . $field . ' where ' . $fieldName. '= ' . $id . ';';
           mysql_query($output);
           
        return $id;
        }
        
    }
//end of inserUpdate
}

//end of class
?>
