<?php

class ContatoFisico extends Contato {

    private $Nome;
    private $CPF;

    function __construct($Nome, $CPF, $Email, $Telelefone, $Endereco, $Numero, $Complemento, $Bairoo, $Cep, $Estado, $Cidade, $Aniversario, $Descricao,$Tipo_contato) {
        parent::__construct($Email, $Telelefone, $Endereco, $Numero, $Complemento, $Bairoo, $Cep, $Estado, $Cidade, $Aniversario, $Descricao,$Tipo_contato);
        $this->Nome = $Nome;
        $this->CPF = $CPF;
    }

    public function adicionarContato($Arr = null, $c = null) {
        $ArrContato = [        
            'nom_cnt' => $this->Nome,
            'cpf_cnt' => $this->CPF,            
            'email_cnt' => $this->Email,
            'tel_cnt' => $this->Telelefone,
            'end_cnt' => $this->Endereco,
            'num_cnt' => $this->Numero,
            'com_cnt' => $this->Complemento,
            'bai_cnt' => $this->Bairoo,
            'cep_cnt' => $this->Cep,
            'est_cnt' => $this->Estado,
            'cid_cnt' => $this->Cidade,
            'ani_cnt' => $this->Aniversario,
            'des_cnt' => $this->Descricao,
            'tip_cnt' => $this->Tipo_contato
        ];
        parent::adicionarContato($ArrContato);        
    }
    
    public function editarContato($Codigo,$ArrUpdate){
        parent::editarContato($Codigo, $ArrUpdate);
    }
    
    public function excluirContato($Codigo) {
        parent::excluirContato($Codigo);
    } 
}