<?php 

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
			$stmt->bindValue(':ip', $this->ip);
			$stmt->bindValue(':browser', $this->browser);
            $stmt->bindValue(':action', $this->action);

			if($stmt->execute()) {
				return true;
			} else {
				return false;
			}

    
        }catch(Exception $e){
            echo $e;
        }


    }


}



?>