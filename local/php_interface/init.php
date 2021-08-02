<?php

include('define.php');

function printr($array) {
    if(STATUS == 'DEV') {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
    elseif($_GET['debug']) {
        echo "<pre style='display: none'>";
        print_r($array);
        echo "</pre>";
    }
}


CModule::AddAutoloadClasses(
    '', // не указываем имя модуля
    array(
        // ключ - имя класса, значение - путь относительно корня сайта к файлу с классом
        '\Helper'         => '/local/php_interface/include/classes/Helper.php',
    )
);