<?php

require_once("../config/config.php");
require_once("../config/define.php");
include_once("nusoap/nusoap.php");

function getProd($category) {
    if ($category == "books") {
        return join(",", array(
            "The WordPress Anthology",
            "PHP Master: Write Cutting Edge Code",
            "Build Your Own Website the Right Way"));
    }
    else {
        return "No products listed under that category";
    }
}

$server = new soap_server();

//using soap_server to create server object
$server = new soap_server;
$server->configureWSDL("productlist", "urn:productlist");
$server->wsdl->schemaTargetNamespace = HOME.'WS/';
$server->register("getProd",
    array("category" => "xsd:string"),
    array("return" => "xsd:string"),
    "urn:productlist",
    "urn:productlist#getProd",
    "rpc",
    "encoded",
    "Get a listing of products by category");

$HTTP_RAW_POST_DATA = file_get_contents('php://input');
$server->service($HTTP_RAW_POST_DATA);

?>