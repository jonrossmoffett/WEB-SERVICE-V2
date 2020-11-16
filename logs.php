<?php 
include_once('../vendor/autoload.php');

class Dblogger {

    public $ip;
    public $browser;
    public $action;
    public $request;

    function setip($ip) { $this->ip = $ip; }
    function getip() { return $this->ip; }
    
    function setbrowser($browser) { $this->browser = $browser; }
    function getbrowser() { return $this->browser; }

    function setaction($action) { $this->action = $action; }
    function getaction() { return $this->action; }

    
    function setrequest($request) { $this->request = $request; }
    function getrequest() { return $this->request; }

    public function __construct() {
        $db = new database;
        $this->dbConn = $db->connect();
        $this->validator = new Validator();
    }

    public function addLog(){
        
        try {

            $created_at = date('Y-m-d H:i:s');
            $updated_at = date('Y-m-d H:i:s');
            
			$sql = 'INSERT INTO logs (ip, browser, action, request, created_at, updated_at) VALUES(:ip, :browser, :action, :request, :created_at, :updated_at )';

			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(':ip', $this->ip);
			$stmt->bindParam(':browser', $this->browser);
            $stmt->bindParam(':action', $this->action);
            $stmt->bindParam(':request', $this->request);
            $stmt->bindParam(':created_at', $created_at);
            $stmt->bindParam(':updated_at', $updated_at);
			$stmt->execute();
	
    
        }catch(Exception $e){
            
        }


    }


}



?>