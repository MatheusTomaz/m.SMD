<?php
    $host="localhost";
    $dbname="bd_smd";
    $usuario="root";
    $password="";

    $conexao = mysql_connect($host, $usuario, $password) or die ("Não foi possível conectar-se com o banco de dados");

    mysql_select_db($dbname) or die ("Não foi possível conectar-se com o banco de dados");
    mysql_query("SET NAMES utf8",$conexao);
?>