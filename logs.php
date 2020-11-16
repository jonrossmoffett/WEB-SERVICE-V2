<?php 
include_once('../vendor/autoload.php');

class Dblogger {

    public $ip;
    public $browser;
    public $action;


    function setip($ip) { $this->ip = $ip; }
    function getip() { return $this->ip; }
    
    function setbrowser($browser) { $this->browser = $browser; }
    function getbrowser() { return $this->browser; }

    function setaction($action) { $this->action = $action; }
    function getaction() { return $this->action; }


    public function __construct() {
        $db = new database;
        $this->dbConn = $db->connect();
        $this->validator = new Validator();
    }

    public function addLog(){
        
        try {
            echo $this->ip . " \n";
            echo $this->browser . "\n";
            echo $this->action . " \n";

            echo gettype($this->ip) . " \n";
            echo gettype($this->browser) . "\n";
            echo gettype($this->action) . " \n";
        
            
			$sql = 'INSERT INTO logs (ip, browser, action) VALUES(:ip, :browser, :action )';

			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(':ip', $this->ip);
			$stmt->bindParam(':browser', $this->browser);
            $stmt->bindParam(':action', $this->action);
			$stmt->execute();
	
    
        }catch(Exception $e){
            
        }


    }


}



?>