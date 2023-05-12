<?php
Class Vendas implements crud{
    //produto vendedor
    protected $nvendedor;
    protected $produto;
    protected $cliente;
    protected $quantidade;

    public function __construct($id=false){
        if($id){
        $sql     = "SELECT * FROM Vendas WHERE id=?";
        $conexao = DB::conexao();
        $stmt    = $conexao->prepare($sql);
        $stmt->bindParam(1,$id,PDO::PARAM_INT);
        $stmt->execute();
        foreach($stmt as $obj){
            $this->setNvendedor($obj["nvendedor"]);
            $this->setproduto($obj["produto"]);
            $this->setCliente($obj["cliente"]);
            $this->setQuantidade($obj["quantidade"]);
        }
      }
    }
    
    public function setNvendedor($n){
        $this->nvendedor = $n;
    }
    public function setProduto($p){   
         $this->produto = $p;
    }
    public function setCliente($c){   
         $this->cliente = $c;
    }
    public function setQuantidade($q){   
         $this->quantidade = $q;
    }

    public function getNvendedor($n){
        $this->n;
    }
    public function getProduto($p){
        $this->p;
    }
    public function getCliente($c){
        $this->c;
    }
    public function getQuantidade($q){
        $this->q;
    }
    

    public function adicionar(){try {$sql = "INSERT INTO Vendas(nvendedor,produto,cliente,quantidade)
        VALUES(?,?,?,?)";

        $conexao = DB::conexao();
        $stmt    = $conexao->prepare($sql);
        $stmt->bindParam(1,$this->nvendedor);
        $stmt->bindParam(2,$this->produto);
        $stmt->bindParam(3,$this->cliente);
        $stmt->bindParam(4,$this->quantidade);
        $stmt->execute();
        }catch(PDOException $e){
            echo "Erro ao adicionar Vendas" . $e->getMessage();
        }
    } 
    public static function listar(){
    $sql     = "SELECT * FROM Vendas";
    $conexao = DB::conexao();
    $stmt    = $conexao->prepare($sql);
    $stmt->execute();
    $registros= $stmt->fetchAll();
    if($registros){
    $objetos = array();
    foreach($registros as $registro){
        $temporario = new Produto();
        $temporario->setId($registro['id']);
        $temporario->setnvendedor($registro['nvendedor']);
        $temporario->setproduto($registro['produto']);
        $temporario->setCliente($registro['cliente']);
        $temporario->setQuantidade($registro['quantidade']);
        $objetos[] = $temporario;
    return $objetos;
    }
    return false;
    }  
    public function atualizar(){
        if($this->id){
            $sql ='UPDATE Vendas SET produto = :produto WHERE id = :id';
            $stmt = DB::conexao()->prepare($sql);
            $stmt->bindParam('id',$this->id);
            $stmt->bindParam('nvendedor',$this->nvendedor);
            $stmt->bindParam('produto',$this->produto);
            $stmt->bindParam('cliente',$this->cliente);
            $stmt->bindParam('quantidade',$this->quantidade);
            $stmt->execute();
        }
    } 
    public function excluir(){ 
        if($this->id){
            $sql = 'DELETE FROM Vendas WHERE id= :id';
            $stmt = DB::conexao()->prepare($sql);
            $stmt->bindParam(':id,$this->id');
            $stmt->execute();
        }
    } 
}

?>