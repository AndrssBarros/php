<?php
Class Cliente implements crud{
    protected $nome;
    protected $endereco;
    protected $compras;

    public function __construct($id=false){
        if($id){
        $sql     = "SELECT * FROM cliente WHERE id=?";
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

    public function setNome($nome){
        $this->nome = $nome;
    }
    public function setEndereco($e){
        $this->endereco = $e;
    }
    public function setCompras($c){
        $this->Compras = $c;
    }

    public function getNome(){
        return $this->nome;
    }
    public function getEndereco(){
        return $this->endereco;
    }
    public function getCompras()?{
        return $this->compras;
    }
    
    public function adicionar(){
        try {
        $sql = "INSERT INTO produtos(id,endereco,compras)
        VALUES(?,?,?,?)";

        $conexao = DB::conexao();
        $stmt    = $conexao->prepare($sql);
        $stmt->bindParam(1,$this->id);
        $stmt->bindParam(2,$this->endereco);
        $stmt->bindParam(3,$this->compras);
        $stmt->execute();
        }catch(PDOException $e){
            echo "Erro ao adicionar Cliente . $e->getMessage();
        }
    } 
    public static function listar(){
    $sql     = "SELECT * FROM Clientes";
    $conexao = DB::conexao();
    $stmt    = $conexao->prepare($sql);
    $stmt->execute();
    $registros= $stmt->fetchAll();
    if($registros){
    $objetos = array();
    foreach($registros as $registro){
        $temporario = new Produto();
        $temporario->setId($registro['id']);
        $temporario->setEndereco($registro['endereco']);
        $temporario->setCompras($registro['compras']);
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
            $stmt->bindParam('id',$this->id);
            $stmt->bindParam('endereco',$this->endereco);
            $stmt->bindParam('compras',$this->compras);
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