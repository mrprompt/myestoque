<?php

class Estoque {

    private $ArrEstoque = array();

    public function adicionaNoEstoque($Produto) {
        $this->ArrEstoque[] = $Produto;
        //var_dump($this->ArrEstoque);
    }

    public function mostraEstoque() {
        return $this->ArrEstoque;
    }

    public function entradaEstoque($Codigo,$Quantidade) {
        if (in_array($Codigo, $this->ArrEstoque)):
            //$atualiza = $this->ArrEstoque[$Codigo];
            //var_dump($atualiza);
            echo "O elemento está no array!";
        else:
            echo "O elemento não está no array!";
        endif;
        
        
    }

}
