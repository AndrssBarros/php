<?php
include_once("interfaces/crud.php");
class Categoria implements crud{
    protected $id;
    protected $nome;
 
    public function __construct($id=false){
      if($id){
      $sql     = "SELECT * FROM categoria WHERE id=?";
      $conexao = DB::conexao();
      $stmt    = $conexao->prepare($sql);
      $stmt->bindParam(1,$id,PDO::PARAM_INT);
      $stmt->execute();
      foreach($stmt as $obj){
          $this->setId($obj["id"]);
          $this->setNome($obj["nome"]);
      }
    }
  }

    public function setId($i){
        $this->id = $i;
    }
    public function setNome($n){
        $this->nome = $n;
    }

    public function getId(){
        return $this->id;
    }
    public function getNome(){
        return $this->nome;
    }
  
    public function adicionar(){try {$sql = "INSERT INTO produtos(categoria_id,nome,preco,quantidade)
        VALUES(?,?,?,?)";
        

        $conexao = DB::conexao();
        $stmt    = $conexao->prepare($sql);
        $stmt->bindParam(1,$this->categoria_id);
        $stmt->bindParam(2,$this->nome);
        $stmt->bindParam(3,$this->preco);
        $stmt->bindParam(4,$this->quantidade);
        $stmt->execute();
        }catch(PDOException $e){
            echo "Erro na Função adicionar Produto" . $e->getMessage();
        }
    } 
    public static function listar(){
    $sql     = "SELECT * FROM Categoria";
    $conexao = DB::conexao();
    $stmt    = $conexao->prepare($sql);
    $stmt->execute();
    $registros= $stmt->fetchAll();
    if($registros){
    $objetos = array();
    foreach($registros as $registro){
        $temporario = new Produto();
        $temporario->setId($registro['id']);
        $temporario->setCategoria_id($registro['categoria_id']);
        $temporario->setNome($registro['nome']);
        $temporario->setPreco($registro['preco']);
        $temporario->setQuantidade($registro['quantidade']);
        $objetos[] = $temporario;
    }
    return $objetos;
    }
    return false;
    }  
    public function atualizar(){
        if($this->id){
            $sql ='UPDATE categoria SET nome = :nome WHERE id = :id';
            $stmt = DB::conexao()->prepare($sql);
            $stmt->bindParam('nome',$this->nome);
            $stmt->bindParam('id',$this->id);
            $stmt->execute();
        }
    } 
    public function excluir(){ 
        if($this->id){
            $sql = 'DELETE FROM Categoria WHERE id= :id';
            $stmt = DB::conexao()->prepare($sql);
            $stmt->bindParam(':id,$this->id');
            $stmt->execute();
        }
    } 
}

?>