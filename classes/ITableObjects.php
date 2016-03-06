<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ITableObjects
 *
 * @author OLUWATOSIN
 */
interface ITableObjects {
    public function _get($_condition);
    
    public function _create(array $_data);
    
    public function  _update($_index,array $_data);
    
    public function _delete($_index);
}
