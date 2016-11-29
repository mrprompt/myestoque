<?php

class Produto {

    private $Cod_pro;
    private $Nom_pro;
    private $Cat_pro;
    private $For_pro;
    private $Est_min_pro;
    private $Est_ini_pro;
    private $Est_atu_pro;
    private $Val_ent_pro;

    function __construct($Nom_pro = null, $Cat_pro = null, $For_pro = null, $Est_min_pro = null, $Est_ini_pro = null, $Val_ent_pro = null) {
        $this->Nom_pro = $Nom_pro;
        $this->Cat_pro = $Cat_pro;
        $this->For_pro = $For_pro;
        $this->Est_min_pro = $Est_min_pro;
        $this->Est_ini_pro = $Est_ini_pro;
        $this->Est_atu_pro = $Est_ini_pro;
        $this->Val_ent_pro = $Val_ent_pro;
    }

    public function cadastraProdutoNoEstoque() {
        $create = new Create();
        $ArrProduto = [
            'nom_pro' => $this->Nom_pro,
            'cat_pro' => $this->Cat_pro,
            'for_pro' => $this->For_pro,
            'est_min_pro' => $this->Est_min_pro,
            'est_ini_pro' => $this->Est_ini_pro,
            'est_atu_pro' => $this->Est_atu_pro,
            'val_ent_pro' => $this->Val_ent_pro
        ];
        $create->ExeCreate('estoque', $ArrProduto);
        $conta = new Conta();
        $conta->depositar($this->Est_ini_pro * $this->Val_ent_pro);
    }

    public function adicionarProdutoNoEstoque($Codigo, $Qtd) {
        $read = new Read();
        $read->ExeRead('estoque');

        foreach ($read->getResult() as $produto):
            $atual = $produto['est_atu_pro'];
        endforeach;

        $update = new Update();
        $ArrUpdate = ['est_atu_pro' => $atual + $Qtd];
        $update->ExeUpdate('estoque', $ArrUpdate, "WHERE cod_pro = :cod", 'cod=' . $Codigo);
    }

    public function retirarProdutoNoEstoque($Codigo, $Qtd) {
        $read = new Read();
        $read->ExeRead('estoque');

        foreach ($read->getResult() as $produto):
            $atual = $produto['est_atu_pro'];
        endforeach;

        $update = new Update();
        $ArrUpdate = ['est_atu_pro' => $atual - $Qtd];
        $update->ExeUpdate('estoque', $ArrUpdate, "WHERE cod_pro = :cod", 'cod=' . $Codigo);
    }

    public function editarProduto($Codigo, $ArrUpdate) {
        $update = new Update();
        $update->ExeUpdate('estoque', $ArrUpdate, "WHERE cod_pro = :cod", 'cod=' . $Codigo);
    }

    public function excluirProduto($Codigo) {
        $delete = new Delete();
        $delete->ExeDelete('estoque', "WHERE cod_pro = :cod", 'cod=' . $Codigo);
    }
}