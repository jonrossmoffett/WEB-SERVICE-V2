<?php 

class Dblogger {

    public function addLog($ip,$browser,$action){
        
        try {
            $created_at = date('Y-m-d H:i:s');
            $updated_at = date('Y-m-d H:i:s');
            
			$sql = 'INSERT INTO logs (ip, browser, action) VALUES(:ip, :browser, :action )';

			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(':id', $ip);
			$stmt->bindParam(':browser', $browser);
            $stmt->bindParam(':action', $action);

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