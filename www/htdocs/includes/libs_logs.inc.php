<?php

function log_all(&$link_mysql,$tab_params=array()){

    //Récupération du contexte
    $tab_params['get'] = $_GET;
    $tab_params['post'] = $_POST;
    $tab_params['server'] = $_SERVER;
    $tab_params['cookie'] = $_COOKIE;
    $tab_params['session'] = $_SESSION;

    $tab_params_sql = array();

    foreach ($tab_params as $key => $value) {
        $value_ser = serialize($value);
        $value_esc = mysql_real_escape_string($value_ser);
        $tab_params_sql[$key] = $value_esc;
    }

    $QryInsert = 'INSERT INTO `LogsAll` ( `get`, `post`, `server`, `cookie`, `session`)
VALUES (\''.$tab_params_sql['get'].'\',\''.$tab_params_sql['post'].'\',\''.$tab_params_sql['server'].'\',\''.$tab_params_sql['cookie'].'\',\''.$tab_params_sql['session'].'\');';

    mysql_query($QryInsert,$link_mysql);
}
