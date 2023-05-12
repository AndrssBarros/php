<?php
class DB{
    public static $servidor   = "localhost";
    public static $usuario    = "root";
    public static $senha      = "";
    public static $nome_banco = "crud";

    public static function conexao(){
        $conexao = null;
        try{
            
        $servidor   = self::$servidor;
        $nome_banco = self::$nome_banco;

           $conexao = new PDO(
               "mysql:host=$servidor;dbname=$nome_banco",
               self::$usuario,
               self::$senha         
            );
           $conexao ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOExeption $e){
            echo "Erro de Conexão" . $e->getMessage();
        };      
        return $conexao;
    }
}
?>
