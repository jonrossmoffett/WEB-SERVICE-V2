<?php 

class Dblogger {

    public function addLog($ip,$browser,$action){

        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        $sql = 'INSERT INTO logs (ip, browser, action, created_at, updated_at) VALUES (:ip, :browser, :action, :created_at, :updated_at)';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':ip', $ip);
        $stmt->bindParam(':browser', $browser);
        $stmt->bindParam(':action', $action);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':updated_at', $updated_at);


    }


}



?>