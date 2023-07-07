<?php
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED) ; 

$host         = "localhost";
$username     = "root";
$password     = "welcome";
$dbname       = "nusoap";
try {
    $dbconn = new PDO('mysql:host=localhost;dbname=nusoap', $username, $password);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

if(!function_exists('pr'))  {
    function pr($d)    {
        $appPath = '';
        $bt = debug_backtrace();
        $caller = array_shift($bt);
        $relativePath = str_replace( $appPath, '', $caller['file']);
        $file_line = $relativePath . "(line " . $caller['line'] . ")\n";
        print($file_line . "\n");
        print("<pre>");
        print_r($d);
        print("</pre>");
        print_r("\n");
    }
}