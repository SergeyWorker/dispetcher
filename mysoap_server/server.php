<?php
class CountF{
    public function countAll() {
        return 20;
    }
    
    public function getAll($status) {
        
    }
}
ini_set("soap.wsdl_cache_enabled", "0"); 
$server = new SoapServer("http://disp/describe.wsdl");
//$list_func=array("countAll", "getAll");
//$server->addFunction($list_func);  
$server->setClass("CountF");  
$server->handle();  
