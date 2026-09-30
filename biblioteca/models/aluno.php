<?php

 class Aluno {
    public $nome;
    public $matricula;
    public $sexo; 
    public $dataNasc;
    public function __construct(                         $nome, 
                         $matricula, 
                         $sexo, 
                         $dataNasc) {
        $this->nome = $nome;
        $this->matricula = $matricula;
        $this->sexo = $sexo;
        $this->dataNasc = $dataNasc;
    }
    public function cadastrar($conn) {
    $sql = "INSERT INTO aluno (nome, matricula, sexo, data_nascimento) VALUES ('".$this->nome."', '".$this->matricula."', '".
    $this->sexo."', '".$this->dataNasc."')";
    $conn->query($sql);
}
    public static function listarTodos($conn){
        $sql = "SELECT * FROM aluno";
        $retorno = [];
        $resultado = $conn->query($sql);
        if($resultado->num_rows>0) {
            while($linha = $resultado->fetch_assoc()) {
                 array_push($retorno, new Aluno($linha["nome"], $linha["matricula"], $linha["sexo"], $linha["data_nascimento"]));
            }
        }
        return $retorno;
    }
    public function remover($conn) {
        $sql = "DELETE FROM aluno WHERE matricula =  ".$this->matricula;
        $conn->query($sql);
    }
    public static function findByMatricula($conn, $matricula) {
        $sql = "SELECT * FROM aluno WHERE matricula = ".$matricula;
        $resultado = $conn->query($sql);
        if($resultado->num_rows>0) {
            while($linha = $resultado->fetch_assoc()) {
                return new Aluno($linha["nome"], $linha["matricula"], $linha["sexo"], $linha["data_nascimento"]);
            }
        }
        return null;
    }
    public function alterar($conn) {
        $sql = "UPDATE aluno SET nome = '".$this->nome."', 
        data_nascimento = '".$this->dataNasc."', 
        sexo = '".$this->sexo."'
        WHERE matricula = ".$this->matricula."
        ";
        $conn->query($sql);
    }
}
 