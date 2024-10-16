<?php
class Database
{
    

    private static $cont  = null;

    public static function connect()
    {

        $dbName = 'onthejob.db' ;
        $dbHost = 'localhost' ;
        $dbUsername = 'root';
        $dbUserPassword = '';
        $port = '';
  

       // One connection through whole application
       if ( null == self::$cont )
       {
        try
        {
          self::$cont =  new PDO("mysql:host=".$dbHost.";port=".$port.";"."dbname=".$dbName, $dbUsername, $dbUserPassword);
        }
        catch(PDOException $e)
        {
          die($e->getMessage());
        }
       }
       return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>
