<?php

class Conta {

    private $Nom_con;
    private $Tip_con;
    private $Sal_con;

    function __construct($Nom_con = null, $Tip_con = null, $Sal_con = null) {
        $this->Nom_con = $Nom_con;
        $this->Tip_con = $Tip_con;
        $this->Sal_con = $Sal_con;
    }

    public function criarConta(Conta $c) {
        $create = new Create();
        $ArrProduto = [
            'nom_con' => $this->Nom_con,
            'tip_con' => $this->Tip_con,
            'sal_con' => $this->Sal_con
        ];
        $create->ExeCreate('conta', $ArrProduto);
    }

    public function editarConta($Codigo, $ArrUpdate) {
        $update = new Update();
        $update->ExeUpdate('conta', $ArrUpdate, "WHERE cod_con = :cod", 'cod=' . $Codigo);
    }

    public function excluirConta($Codigo) {
        $delete = new Delete();
        $delete->ExeDelete('conta', "WHERE cod_pro = :cod", 'cod=' . $Codigo);
    }

    public function saldo() {
        $leConta = new Read();
        $leConta->ExeRead('conta');

        foreach ($leConta->getResult() as $c):
            $this->Sal_con = $c['sal_con'];
        endforeach;

        return $this->Sal_con;
    }

    public function depositar($Valor) {
        $update = new Update();
        $ArrUpdate = ['sal_con' => $this->saldo() + $Valor];
        $update->ExeUpdate('conta', $ArrUpdate, "WHERE cod_con = :cod", 'cod=' . 1);        
    }

    public function sacar($Valor) {
        $update = new Update();
        $ArrUpdate = ['sal_con' => $this->saldo() - $Valor];
        $update->ExeUpdate('conta', $ArrUpdate, "WHERE cod_con = :cod", 'cod=' . 1);
    }
    
    public function mostraSaldo() {
        echo 'Seu saldo atual é de: ' . $this->Real($this->saldo());
    }

    public function Real($Valor) {
        return "R$ " . number_format($Valor, '2', '.', ',');
    }

}
