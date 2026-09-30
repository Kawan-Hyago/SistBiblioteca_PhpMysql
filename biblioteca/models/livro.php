<?php
 
 class Livro {
    public $id;
    public $nome;
    public $editora;
    public $edicao;
    public $autor;
    public $estoque;
    public function __construct($id,
                        $nome,
                         $editora,
                         $edicao,
                         $autor,
                         $estoque) {
        $this->id=$id;
        $this->nome = $nome;
        $this->editora = $editora;
        $this->edicao = $edicao;
        $this->autor = $autor;
        $this->estoque = $estoque;
    }
    public function cadastrar($conn) {
    $sql = "INSERT INTO livro (id, nome, editora, edicao, autor, estoque) VALUES ('".$this->id."', '".$this->nome."', '".$this->editora."', '".$this->edicao.
    "', '".$this->autor."', '".$this->estoque."')";
    $conn->query($sql);
}
    public static function listarTodos($conn){
        $sql = "SELECT * FROM livro";
        $retorno = [];
        $resultado = $conn->query($sql);
        if($resultado->num_rows>0) {
            while($linha = $resultado->fetch_assoc()) {
                 array_push($retorno, new Livro($linha["id"], $linha["nome"], $linha["editora"], $linha["edicao"], $linha["autor"], $linha["estoque"]));
            }
        }
        return $retorno;
    }
    public function remover($conn) {
        $sql = "DELETE FROM livro WHERE id =  ".$this->id;
        $conn->query($sql);
    }
    public static function findById($conn, $id) {
        $sql = "SELECT * FROM livro WHERE id = " . $id;
        $resultado = $conn->query($sql);
        if($resultado->num_rows>0) {
            while($linha = $resultado->fetch_assoc()) {
                return new Livro($linha["id"], $linha["nome"], $linha["editora"], $linha["edicao"], $linha["autor"], $linha["estoque"]);
            }
        }
        return null;
    }
    public function alterar($conn) {
        $sql = "UPDATE livro SET nome = '".$this->nome."',
        editora = '".$this->editora."',
        edicao = '".$this->edicao."',
        autor = '".$this->autor."',
        estoque = '".$this->estoque."'
        WHERE id = ".$this->id."
        ";
        $conn->query($sql);
    }
}
 
//https://github.com/vitorpadilha/DEV_WEB_I_2026.git
?>