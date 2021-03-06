<?php

abstract class Contato {
    public $Email;
    public $Telelefone;
    public $Endereco;
    public $Numero;
    public $Complemento;
    public $Bairoo;
    public $Cep;
    public $Estado;
    public $Cidade;
    public $Aniversario;
    public $Descricao;
    public $Tipo_contato;
    
    function __construct($Email, $Telelefone, $Endereco, $Numero, $Complemento, $Bairoo, $Cep, $Estado, $Cidade, $Aniversario, $Descricao,$Tipo_contato) {
        $this->Email = $Email;
        $this->Telelefone = $Telelefone;
        $this->Endereco = $Endereco;
        $this->Numero = $Numero;
        $this->Complemento = $Complemento;
        $this->Bairoo = $Bairoo;
        $this->Cep = $Cep;
        $this->Estado = $Estado;
        $this->Cidade = $Cidade;
        $this->Aniversario = $Aniversario;
        $this->Descricao = $Descricao;
        $this->Tipo_contato = $Tipo_contato;
    }
    
    public function adicionarContato($Arr = null, $c = null ) {
        $create = new Create();
        $create->ExeCreate('contatos', $Arr);
    }
    
     public function editarContato($Codigo,$ArrUpdate){
        $update = new Update();
        $update->ExeUpdate('contatos', $ArrUpdate, "WHERE cod_cnt = :cod", 'cod=' . $Codigo);
    }
    
    public function excluirContato($Codigo) {
        $delete = new Delete();
        $delete->ExeDelete('contatos', "WHERE cod_cnt = :cod", 'cod=' . $Codigo);
    }
    

}
