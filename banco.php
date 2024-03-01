<?php
class Banco
{

    private static $dbName = 'db_Crud';
    private static $dbHost = 'localhost';
    private static $dbUser = 'root';
    private static $dbPass = '';

    private static $cont = null;

   public function_construct()
   {
    die('A funçãon int não é permetido!')
   }
   public static function conectar()
   {
    if (null == self::$cont)
   {
    try
    {
        self::$cont = new PDO("mysql:host=".self::$dbHost.";"."dbname=".self::$dbNome, self::$dbUsuario,sel::$dbSenha);
    }
    catch(PDOException $exception)
    {
        die($exception->getmessage());
    }
   }
   return self::$cont;
   }
   public static function desconectar()
   {
    self::$cont = null;
   }
}
?>