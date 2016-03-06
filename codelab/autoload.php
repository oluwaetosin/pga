<?php
/**
 *@author Tosin Omotayo <oluwaetosin@gmail.com>
 * @since 2016
 * @copyright (c) 2016, Omotayo Tosin
 * @description A file to autoload classes and interfaces
 */
require_once 'helper_functions.php';
define("CURRENT_DIR", plugin_dir_path(__FILE__));

defined('DS')? NULL : define("DS",DIRECTORY_SEPARATOR);
define("CLASSES_FOLDER",  plugin_dir_path(dirname(__FILE__))."classes".DS);


function general_autoload($class){
    if(file_exists(CURRENT_DIR.$class)){
        require_once CURRENT_DIR.$class.".php";
    }
    else if(file_exists(CLASSES_FOLDER.$class.".php")){
        require_once CLASSES_FOLDER.$class.".php";
    }
}
spl_autoload_register('general_autoload');

