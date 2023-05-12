<?php
include_once("interfaces/crud.php");
include_once("class/DB.Class.php");

    class Produto implements crud{
        protected $id;
        protected $categoria_id;
        protected $nome;
        protected $preco;
        protected $quantidade;

        public function __construct($id=false){
            if($id){
            $sql     = "SELECT * FROM produtos WHERE id=?";
            $conexao = DB::conexao();
            $stmt    = $conexao->prepare($sql);
            $stmt->bindParam(1,$id,PDO::PARAM_INT);
            $stmt->execute();
            foreach($stmt as $obj){
                $this->setId($obj["id"]);
                $this->setCategoria_id($obj["categoria_id"]);
                $this->setNome($obj["nome"]);
                $this->setPreco($obj["preco"]);
                $this->setQuantidade($obj["quantidade"]);
            }
          }
        }

        public function setId($i){
            $this->id = $i;
        }
        public function setCategoria_id($c){
            $this->categoria_id = $c;
        }
        public function setNome($n){
            $this->nome = $n;
        }
        public function setPreco($p){
            $this->preco = $p;
        }
        public function setQuantidade($q){
            $this->preco = $q;
        }


        public function getId(){
            return $this->id;
        }
        public function getCategoria_id(){
            return $this->categoria_id;
        }
        public function getNome(){
            return $this->nome;
        }
        public function getPreco(){
            return $this->preco;
        }
        public function getQuantidade(){
            return $this->quantidade;
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
        $sql     = "SELECT * FROM Produtos";
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
                $sql ='UPDATE Produtos SET nome = :nome WHERE id = :id';
                $stmt = DB::conexao()->prepare($sql);
                $stmt->bindParam('id',$this->id);
                $stmt->bindParam('categoria_id',$this->categoria_id);
                $stmt->bindParam('nome',$this->nome);
                $stmt->bindParam('preco',$this->preco);
                $stmt->bindParam('quantidade',$this->quantidade);
                $stmt->execute();
            }
        } 
        public function excluir(){ 
            if($this->id){
                $sql = 'DELETE FROM Produtos WHERE id= :id';
                $stmt = DB::conexao()->prepare($sql);
                $stmt->bindParam(':id,$this->id');
                $stmt->execute();
            }
        } 
    }
    

?>