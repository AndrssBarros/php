<?php
    Class Vendedores implements crud{
        //numero do cadastro
        protected $ncadastro;
        protected $nome;

        public function __construct($ncadastro=false){
            if($ncadastro){
            $sql     = "SELECT * FROM categoria WHERE ncadastro=?";
            $conexao = DB::conexao();
            $stmt    = $conexao->prepare($sql);
            $stmt->bindParam(5,$ncadastro,PDO::PARAM_INT);
            $stmt->execute();
            foreach($stmt as $obj){
                $this->setncadastro($obj["ncadastro"]);
                $this->setNome($obj["Nome"]);
            }
    }   
    public function setncadastro($S){
        $this->ncadastro = $S;
    }
    public function setNome($n){
        $this->nome = $n;
    }

    public function getncadastro(){
        return $this->S;
    }
    public function getNome(){
        return $this->n;
    }

    public function adicionar(){
        try {$sql = "INSERT INTO Vendedoress(nome,ncadastro)
            VALUES(?,?,?,?)";

            $conexao = DB::conexao();
            $stmt    = $conexao->prepare($sql);
            $stmt->bindParam(2,$this->nome);
            $stmt->bindParam(3,$this->ncadastro);
            $stmt->execute();
            }catch(PDOException $e){
                echo "Erro ao adicionar Vendedores" . $e->getMessage();
            }
        } 
public static function listar(){
    $sql     = "SELECT * FROM Vendedores";
    $conexao = DB::conexao();
    $stmt    = $conexao->prepare($sql);
    $stmt->execute();
    $Vendedor= $stmt->fetchAll();
    if($Vendedor){
    $objetos = array();
    foreach($Vendedor{
        $temporario = new Vendedor();
        $temporario->setNome($Vendedor['Nome']);
        $temporario->setId($Vendedor['ncadastro']);
        $objetos[] = $temporario;
    }
    return $objetos;
}
return false;
}    
    public static function listar(){
        $sql     = "SELECT * FROM Vendedores";
        $conexao = DB::conexao();
        $stmt    = $conexao->prepare($sql);
        $stmt->execute();
        
    } 
    public function atualizar(){
        if($this->id){
            $sql ='UPDATE Vendedores SET Vendedores = :Vendedores WHERE id = :id';
            $stmt = DB::conexao()->prepare($sql);
            $stmt->bindParam('id',$this->id);
            $stmt->bindParam('ncadatro',$this->ncadastro);
            $stmt->bindParam('nome',$this->nome);
            $stmt->execute();
        }
    } 
    public function excluir(){ 
        if($this->id){
            $sql = 'DELETE FROM Vendedores WHERE id= :id';
            $stmt = DB::conexao()->prepare($sql);
            $stmt->bindParam(':id,$this->id');
            $stmt->execute();
        }
    } 
    ?>