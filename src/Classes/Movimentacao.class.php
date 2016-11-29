<?php

class Movimentacao {
    
    private $Data;
    private $Descricao;
    private $Cliente;
    private $Valor;
    private $Categoria;
    private $Tipo_mov;
    
    function __construct($Data = null, $Descricao = null, $Cliente = null, $Valor = null, $Categoria = null, $Tipo_mov = null) {
        $this->Data = $Data;
        $this->Descricao = $Descricao;
        $this->Cliente = $Cliente;
        $this->Valor = $Valor;
        $this->Categoria = $Categoria;
        $this->Tipo_mov = $Tipo_mov;
    } 
    
    public function movimentaProdutoEstoque($cod_pro, $descricão, $qtd, $valor, $tipo_mov) {
        $conta = new Conta();
        $p = new Produto;        
        $create = new Create();
        $ArrProduto = [
            'cod_pro' => $cod_pro,
            'des_mov' => $descricão,
            'qtd_mov' => $qtd,
            'vlr_mov' => $valor,
            'tipo_mov' => $tipo_mov
        ];
        $create->ExeCreate('estoque_movimentacao', $ArrProduto);

        if ($tipo_mov == 'entrada'):
            $p->adicionarProdutoNoEstoque($cod_pro, $qtd);
            $conta->sacar($qtd * $valor);
        elseif ($tipo_mov == 'saida'):
            $p->retirarProdutoNoEstoque($cod_pro, $qtd);
            $conta->depositar($qtd * $valor);
        else:
            echo "Nao encontrado";
        endif;
    }
    
    public function movimentaCaixa($movimento) {
        $conta = new Conta();               
        $create = new Create();
        $ArrProduto = [
            'dat_mov' => $this->Data,
            'des_mov' => $this->Descricao,
            'cli_mov' => $this->Cliente,
            'val_mov' => $this->Valor,
            'cat_mov' => $this->Categoria,
            'tip_mov' => $this->Tipo_mov
        ];
        $create->ExeCreate('conta_movimentacao', $ArrProduto);
        
        if($this->Tipo_mov == 'recebimento'):
            $conta->depositar($this->Valor);
        elseif($this->Tipo_mov == 'despesas_fixa' || 'despesas_variaveis' || 'pessoas' || 'impostos'  ):
            $conta->sacar($this->Valor);
        endif;
        
    }

}
