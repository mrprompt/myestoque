<?php

class ContatoJuridico extends Contato{
    private $Nome_fantasia;
    private $Razao_social;
    private $CNPJ;
    private $Inscricao_estadual;
    
    function __construct($Nome_fantasia, $Razao_social, $CNPJ, $Inscricao_estadual,$Email, $Telelefone, $Endereco, $Numero, $Complemento, $Bairoo, $Cep, $Estado, $Cidade, $Aniversario, $Descricao, $Tipo_contato) {
        parent::__construct($Email, $Telelefone, $Endereco, $Numero, $Complemento, $Bairoo, $Cep, $Estado, $Cidade, $Aniversario, $Descricao, $Tipo_contato);
        $this->Nome_fantasia = $Nome_fantasia;
        $this->Razao_social = $Razao_social;
        $this->CNPJ = $CNPJ;
        $this->Inscricao_estadual = $Inscricao_estadual;
    }
    
    public function adicionarContato(Contato $c) {
        $create = new Create();
        $ArrContato = [        
            'nom_cnt' => ' ',
            'cpf_cnt' => ' ',
            'nom_fnt_cnt' => $this->Nome_fantasia,
            'raz_soc_cnt' => $this->Razao_social,
            'cnpj_cnt' => $this->CNPJ,
            'ins_est_cnt' => $this->Inscricao_estadual,
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
        $create->ExeCreate('contatos', $ArrContato);
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
