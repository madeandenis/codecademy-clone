<?php

namespace app\components\admin;

class ModalBuilder{
    public static function buildModal($table, $columns, $column_values = []) {
        $modalBuilder = "
            <div class=\"modal-form\">
                <form id=\"addDataForm\" method=\"POST\" onsubmit=\"event.preventDefault()\">
        ";
    
        for ($i = 0; $i < count($columns); $i++) {
            $column_name = $columns[$i];
            
            $modalBuilder .= "<label for=\"$column_name\">$column_name:</label><br>";
            
            if($column_values){
                $column_value = $column_values[$i];
                $modalBuilder .= "<input type=\"text\" id=\"$column_name\" name=\"$column_name\" value=\"" . htmlspecialchars($column_value) . "\"><br>";
            }
            else{
                $modalBuilder .= "<input type=\"text\" id=\"$column_name\" name=\"$column_name\"><br>";
            }
        }

        $modalBuilder .= 
        "   </form>
        </div>";
    
        return $modalBuilder;
    }

    public static function insertModal($table, $columns){
        // Modal header
        $insertModal = "
        <div class=\"modal-header\">
            <h3>Add new $table</h3>
            <span class=\"close\" onclick=\"closeModal()\">&times;</span>
        </div>
        ";     

        $insertModal .= ModalBuilder::buildModal($table,$columns);

        // Modal form end and footer
        $insertModal .= "
            <div class=\"modal-footer\">
                <button type=\"submit\" class=\"btn-submit\" onclick=\"updateDatabase()\">Add</button>
                <button type=\"button\" class=\"btn-cancel\" onclick=\"closeModal()\">Cancel</button>
            </div>
        ";

        echo $insertModal;
    }
    public static function updateModal($table, $columns, $column_values){
        $updateModal = "
        <div class=\"modal-header\">
            <h3>Update $table</h3>
            <span class=\"close\" onclick=\"closeModal()\">&times;</span>
        </div>
        ";     

        $updateModal .= ModalBuilder::buildModal($table, $columns, $column_values);

        $updateModal .= "
            <div class=\"modal-footer\">
                <button type=\"submit\" class=\"btn-submit\" onclick=\"updateDatabase()\">Update</button>
                <button type=\"button\" class=\"btn-cancel\" onclick=\"closeModal()\">Cancel</button>
            </div>
        ";

        echo $updateModal;
    }
    
}