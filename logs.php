<?php 

class Dblogger {

    public function addLog($ip,$browser,$action){
        
        try {
            $created_at = date('Y-m-d H:i:s');
            $updated_at = date('Y-m-d H:i:s');
            
            echo "reached before sql command ";
            $sql = 'INSERT INTO logs (ip, browser, action, created_at, updated_at) VALUES (:ip, :browser, :action, :created_at, :updated_at)';
            echo "reached before pepare statement ";
            $stmt = $this->dbConn->prepare($sql);
            echo "reached after prepare statment ";
            $stmt->bindParam(':ip', $ip);
            $stmt->bindParam(':browser', $browser);
            $stmt->bindParam(':action', $action);
            $stmt->bindParam(':created_at', $created_at);
            $stmt->bindParam(':updated_at', $updated_at);
            echo "reached before execute statement ";
            $stmt->execute();

    
        }catch(Exception $e){
            echo $e;
        }


    }


}



?>