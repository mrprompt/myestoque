<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require('./_app/Config.inc.php');  
        
        $produto = new Produto('Chinelo', 5, 20);
        //$produto->cadastraProduto($produto);        
           
        $leProdutos = new Read();
        $leProdutos->ExeRead('estoque');
        
        if($leProdutos->getRowCount() >= 1):            
            foreach ($leProdutos->getResult() as $p):
                echo $p['codigo'] . " | " . $p['nome'] . " | " . $p['estoque_minimo'] . " | " . $p['estoque_inicial'] . " | " . $p['estoque_atual'] . "<br/>";
            endforeach;
        else:
            echo "Não tem produtos inseridos no estoque";
        endif;
        //var_dump($leProdutos->getResult());
        
        //$produto->adicionarProduto(5,100);
        //$produto->retirarProduto(3, 100);
        echo "<hr>";
        
        $preco = 5.80;
        $val = 7 * $preco;
        var_dump($produto->Real($val));
        
        
        ?>
        
        
        
    </body>
</html>
