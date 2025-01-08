<?php


class chefProjetModal{
    
    private PDO $conn;

    public function __construct()
    {
        $this->conn = DataBaseConnection::getInstance()->getConnection();
    }


}

?>