
<?php

 class Emprestimo {
    public $idLivro;
  public $alunoMat;
  public $dataEmprestimo;
  public $dataDevolucao;
    public function __construct(                         $idLivro,  
                         $alunoMat, 
                         $dataEmprestimo,
                         $dataDevolucao) {
        $this->idLivro = $idLivro;
        $this->alunoMat = $alunoMat;
        $this->dataEmprestimo = $dataEmprestimo;
        $this->dataDevolucao = $dataDevolucao;
    }
    public function cadastrar($conn) {
    $sql = "INSERT INTO emprestimo (idLivro, alunoMat, dataEmprestimo, dataDevolucao) VALUES ('".$this->idLivro."', '".
    $this->alunoMat."', '".$this->dataEmprestimo."', '".$this->dataDevolucao."')";
    $conn->query($sql);
}
    public static function listarTodos($conn){
        $sql = "SELECT * FROM emprestimo";
        $retorno = [];
        $resultado = $conn->query($sql);
        if($resultado->num_rows>0) {
            while($linha = $resultado->fetch_assoc()) {
                 array_push($retorno, new Emprestimo ($linha["idLivro"], $linha["alunoMat"], $linha["dataEmprestimo"], $linha["dataDevolucao"]));
            }
        }
        return $retorno;
    }
    public function remover($conn, $id) {
        $sql = "DELETE FROM emprestimo WHERE idEmp =  ".$id;
        $conn->query($sql);
    }
    public static function findById($conn, $id) {
        $sql = "SELECT * FROM emprestimo WHERE idEmp= ".$id;
        $resultado = $conn->query($sql);
        if($resultado->num_rows>0) {
            while($linha = $resultado->fetch_assoc()) {
                return new Emprestimo($linha["idLivro"], $linha["alunoMat"], $linha["dataEmprestimo"], $linha["dataDevolucao"]);
            }
        }
        return null;
    }
    public function alterar($conn, $id) {
    $sql = "UPDATE emprestimo SET 
            idLivro = '".$this->idLivro."', 
            alunoMat = '".$this->alunoMat."', 
            dataEmprestimo = '".$this->dataEmprestimo."', 
            dataDevolucao = '".$this->dataDevolucao."' 
            WHERE idEmp = ".$id;
            
    $conn->query($sql);
}
 }