<?php

class Produto {

    private $Cod_pro;
    private $Nom_pro;
    private $Cat_pro;
    private $For_pro;
    private $Est_min_pro;
    private $Est_ini_pro;
    private $Est_atu_pro;

    function __construct($Nom_pro, $Cat_pro, $For_pro, $Est_min_pro, $Est_ini_pro) {
        $this->Nom_pro = $Nom_pro;
        $this->Cat_pro = $Cat_pro;
        $this->For_pro = $For_pro;
        $this->Est_min_pro = $Est_min_pro;
        $this->Est_ini_pro = $Est_ini_pro;
        $this->Est_atu_pro = $Est_ini_pro;
    }

    public function cadastraProduto(Produto $p) {
        $create = new Create();
        $ArrProduto = [
            'nom_pro' => $this->Nom_pro,
            'cat_pro' => $this->Cat_pro,
            'for_pro' => $this->For_pro,
            'est_min_pro' => $this->Est_min_pro,
            'est_ini_pro' => $this->Est_ini_pro,
            'est_atu_pro' => $this->Est_atu_pro
        ];
        $create->ExeCreate('estoque', $ArrProduto);
    }

    public function movimentacaoProduto($cod_pro, $descrição, $qtd, $valor, $tipo_mov) {
        $create = new Create();
        $ArrProduto = [
            'cod_pro' => $cod_pro,
            'des_mov' => $descrição,
            'qtd_mov' => $qtd,
            'vlr_mov' => $valor,
            'tipo_mov' => $tipo_mov
        ];
        $create->ExeCreate('movimentacao', $ArrProduto);

        if ($tipo_mov == 'entrada'):
            $this->adicionarProduto($cod_pro, $qtd);
        elseif ($tipo_mov == 'saida'):
            $this->retirarProduto($cod_pro, $qtd);
        else:
            echo "Nao encontrado";
        endif;
    }

    public function adicionarProduto($Codigo, $Qtd) {
        $read = new Read();
        $read->ExeRead('estoque');

        foreach ($read->getResult() as $produto):
            $atual = $produto['est_atu_pro'];
        endforeach;

        $update = new Update();
        $ArrUpdate = ['est_atu_pro' => $atual + $Qtd];
        $update->ExeUpdate('estoque', $ArrUpdate, "WHERE cod_pro = :cod", 'cod=' . $Codigo);
    }

    public function retirarProduto($Codigo, $Qtd) {
        $read = new Read();
        $read->ExeRead('estoque');

        foreach ($read->getResult() as $produto):
            $atual = $produto['est_atu_pro'];
        endforeach;

        $update = new Update();
        $ArrUpdate = ['est_atu_pro' => $atual - $Qtd];
        $update->ExeUpdate('estoque', $ArrUpdate, "WHERE cod_pro = :cod", 'cod=' . $Codigo);
    }

    public function Real($Valor) {
        return "R$ " . number_format($Valor, '2', '.', ',');
    }

}