<?php
class DataBaseConnection{
  
  private static ?DataBaseConnection $instance = null; 
  private PDO $connection;
   
  private function __construct() {
    try {
        $dsn = 'mysql:host=' . $_ENV['DB_HOSTNAME'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=utf8';
        $this->connection = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
}

  public static function getInstance() : DataBaseConnection {
    if (self::$instance === null) {
      self::$instance = new DataBaseConnection();
    }
    return self::$instance;
  }

  public function getConnection() : PDO  {
    return $this->connection; 
  }
}

?>