<?php

class Produto {

    private $Codigo;
    private $Nome;
    private $Descricao;
    private $TipoUnitario;
    private $Fornecedor;
    private $EstoqueMinimo;
    private $EstoqueInicial;
    private $EstoqueAtual;

    function __construct($Nome, $EstoqueMinimo, $EstoqueInicial) {
        $this->Nome = $Nome;
        $this->EstoqueMinimo = $EstoqueMinimo;
        $this->EstoqueInicial = $EstoqueInicial;
        $this->EstoqueAtual = $EstoqueInicial;
    }

    public function cadastraProduto(Produto $p) {
        $create = new Create();
        $ArrProduto = [
            'nome' => $this->Nome,
            'estoque_minimo' => $this->EstoqueMinimo,
            'estoque_inicial' => $this->EstoqueInicial,
            'estoque_atual' => $this->EstoqueAtual
        ];
        $create->ExeCreate('estoque', $ArrProduto);
    }

    public function retirarProduto($Codigo, $Qtd) {
        $read = new Read();
        $create = new Create();
        $update = new Update();
        $read->ExeRead('estoque');

        if ($read->getRowCount() != 0):
            foreach ($read->getResult() as $p):
                if ($Codigo == $p['codigo']):
                    $ArrProduto = [
                        'cod_produto' => $Codigo,
                        'quantidade' => $Qtd,
                    ];
                    $create->ExeCreate('saida', $ArrProduto);
                    $atual = $p['estoque_atual'];
                    $ArrAtualiza = ['estoque_atual' => $atual - $Qtd];
                    $update->ExeUpdate('estoque', $ArrAtualiza, "WHERE codigo = :cod", 'cod=' . $Codigo);
                endif;
            endforeach;
        else:
            echo "Não tem produtos no estoque!";
        endif;
    }

    public function adicionarProduto($Codigo, $Qtd) {
        $read = new Read();
        $create = new Create();
        $update = new Update();

        $read->ExeRead('estoque');

        $ArrProduto = ['cod_produto' => $Codigo, 'quantidade' => $Qtd];

        if ($read->getRowCount() != 0):
            foreach ($read->getResult() as $p):
                if ($Codigo == $p['codigo']):
                    $create->ExeCreate('entrada', $ArrProduto);
                    $atual = $p['estoque_atual'];
                    $ArrAtualiza = ['estoque_atual' => $atual + $Qtd];
                    $update->ExeUpdate('estoque', $ArrAtualiza, "WHERE codigo = :cod", 'cod=' . $Codigo);
                endif;
            endforeach;
        else:
            echo "Não tem produto cadastrado no estoque pelo codigo informado!";
        endif;
    }

    public function Real($Valor) {
        return "R$ " . number_format($Valor, '2', '.', ',');
    }

}
