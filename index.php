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
        
        
        $produto = new Produto('Chinelo', 'Calçado', 'Nike', 5, 20);
        //$produto->cadastraProduto($produto); 
           
        $leProdutos = new Read();
        $leProdutos->ExeRead('estoque');
        
        if($leProdutos->getRowCount() >= 1):            
            foreach ($leProdutos->getResult() as $p):
                echo $p['cod_pro'] . " | " . $p['nom_pro'] . " | " . $p['cat_pro'] . " | " . $p['for_pro'] . " | " . $p['est_min_pro'] . " | " . $p['est_ini_pro'] . " | " . $p['est_atu_pro'] . "<br/>";
            endforeach;
        else:
            echo "Não tem produtos inseridos no estoque";
        endif;
        
        //$produto->movimentacaoProduto(9, 'bla bla bla', 2, 39.90, 'saida');
        echo "<hr>";
        
        $preco = 5.80;
        $val = 7 * $preco;
        var_dump($produto->Real($val));
        
        
        ?>
        
        
        
    </body>
</html>
