<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Adb
 *
 * @author OLUWATOSIN
 */
 global $db; 
class ABaseClass implements ITableObjects{
   
    public function _create(array $data) {
        global $db;
        $calling_class = strtolower(get_called_class());
         $table  = $db->$calling_class();
         $result = $table->insert($data);
         return $result;
    }

    public function _delete($_index) {
       global $db;
        $calling_class = strtolower(get_called_class()); 
        $table = $db->$calling_class()[$_index];
        if($table && $table->delete()){
            return true;
        }
        else{
            return false;
        }
    }

    public function _get($_condition = null,$_cols=null) {
        global $db;
        $calling_class = strtolower(get_called_class());
         $result = array();
         if($_condition && $_cols){
            
             $result = $db->$calling_class()->select(join(",",$_cols))->where($_condition[0],$_condition[1]);
         }
         else if($_cols && !$_condition){
           $result =  $db->$calling_class()->select($_cols);
         }
         else if(!$_cols && $_condition){
           $result =  $db->$calling_class->where($_condition[0],$_condition[1]); 
         }else{
          $result =  $db->$calling_class();  
         }
        return $result;
    }

    public function _update($_index,array $_data) {
        global $db;
        $calling_class = strtolower(get_called_class()); 
        $table = $db->$calling_class()[$_index];
        if($table){
            return $table->update($_data);
        }
        else{
            return false;
        }  
    }

//put your code her
}
