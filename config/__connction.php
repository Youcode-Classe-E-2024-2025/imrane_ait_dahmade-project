<?php
require_once 'config.php';

class DataBaseConnection
{

  private static ?DataBaseConnection $instance = null;
 
  private PDO $connection;

  public function __construct()
  {
    try {
      $dsn = 'mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_NAME . ';charset=utf8';
      $this->connection = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // echo 'connect ' . '<br>';
    } catch (PDOException $e) {
      die('Connection failed: ' . $e->getMessage());
    }
  }

  public static function getInstance(): DataBaseConnection
  {
    if (self::$instance === null) {
      self::$instance = new DataBaseConnection();
    }
    return self::$instance;
  }

  public function getConnection(): PDO
  {
    return $this->connection;
  }
}
