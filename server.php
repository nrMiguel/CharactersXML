<?php
session_start();
require 'dbConn.php';
include ("funcs.inc.php");

if(isset($_POST['save_bd'])){
    echo "Estoy guardando en BD. server.php line 7</br>";    
    
    // Conectamos a BD
    PDOConn::$dbname = 'practicaM06UF3';
    PDOConn::connect();
    
    // Validamos datos formularios sean completos.
    $table = validateData($table);

    // Conseguimos objeto XML a partir de DOMDocument.
    $doc = new DOMDocument();
    $doc = createXML($table);

    // Insertamos en BD.
    PDOConn::insert($doc->saveXML()); //Ni idea de si esto funcionará...    
    header("Location:index2.php");
    die();
}

if(isset($_POST['save_file'])){
    echo "Estoy guardando en archivo. server.php line line 27</br>";
    echo $_POST['save_file'] . " server.php line line 28</br>";
    
    $table = validateData($table);      

    // Creamos XML.
    $doc = new DOMDocument();
    $doc = createXML($table);
    $doc->save('test_xml.xml');
}

if(isset($_POST['typeUpload'])) {
    if($_POST['typeUpload'] == "load_file") {
        echo $_POST['typeUpload'] . " server.php line 40</br>";
        echo "Estoy cargando desde fichero. server.php line 41</br>";
        readXML();
        header("Location:index2.php");
        die();
    }
}

if(isset($_POST['typeUpload'])) {
    if($_POST['typeUpload'] == "load_bd") {
        echo "Estoy cargando desde BD. server.php line 50</br>";
        readBD();
        header("Location:index2.php");
        die();
    }
}

// Esto lo carga en caso de que no se pulse el botón de guardar en BD, sería lo que sucede cuando se entra en server.php que carga el ficheroXML.
readXML();
header("Location:index2.php")
?>