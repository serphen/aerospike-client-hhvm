<?php

$SERVER_IP = "localhost";
$SERVER_PORT = 3000;
$conf = array("hosts"=>array(array("addr"=>$SERVER_IP, "port"=>$SERVER_PORT)));
$db = new Aerospike($conf);
if (!$db->isConnected()) {
    echo "Connection not established!\n";
    echo "Error ". $db->errorno() . " : " . $db->error() . "\n" ;
    exit -1;
} else {
    echo "Connection is established!\n";
    $key =  $db->initKey("test", "test-set", "test-key");
    var_dump($key);
    $rec = array("name"=>"John",
                 "age"=>10);
    $status = $db->put($key, $rec);
    if ($status != Aerospike::OK) {
        echo "Error ". $db->errorno() . " : " . $db->error() . "\n" ;
    }
    echo "\n*********************Before operate*****************\n";
    $status = $db->get($key, $data);
    if ($status != Aerospike::OK) {
        echo "Error ". $db->errorno() . " : " . $db->error() . "\n" ;
    } else {
        var_dump($data);
    }

    $operations = array(
                        array("op" => Aerospike::OPERATOR_PREPEND, "bin" => "name", "val" => " Ph.D."),
                        array("op" => Aerospike::OPERATOR_APPEND, "bin" => "name", "val" => " Walker"),
                        array("op" => Aerospike::OPERATOR_WRITE, "bin" => "salary", "val" => 500000000),
                        array("op" => Aerospike::OPERATOR_INCR, "bin" => "age", "val" => -5),
                        array("op" => Aerospike::OPERATOR_READ, "bin" => "age"),
                        array("op" => Aerospik0e::OPERATOR_READ, "bin" => "salary"),
                        array("op" => Aerospike::OPERATOR_TOUCH)
                       );
    $status = $db->operate($key, $operations, $returned);
    var_dump($status, $returned);

    echo "\n*********************After operate*****************\n";
    $status = $db->get($key, $data);
    if ($status != Aerospike::OK) {
        echo "Error ". $db->errorno() . " : " . $db->error() . "\n" ;
    } else {
        var_dump($data);
    }
}
$db->close();

?>

