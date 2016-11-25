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
        
        echo "<h1>Estoque</h1>";
        
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
        
        //$produto->movimentacaoProduto(9, 'bla bla bla', 2, 39.90, 'entrada');
        
        echo "<hr>";
        echo "<h1>Movimentação</h1>";
        
        $leMovimentacao = new Read();
        $leMovimentacao->ExeRead('movimentacao', 'INNER JOIN estoque LIMIT :limit' ,'limit=3');
        //SELECT * FROM movimentacao INNER JOIN estoque
        //"R$ " . number_format($m['vlr_mov'], '2', '.', ',')
        if($leMovimentacao->getRowCount() >= 1):            
            foreach ($leMovimentacao->getResult() as $m):
                echo $m['nom_pro'] . " | " . $m['qtd_mov'] . " | " . "R$ " . number_format($m['vlr_mov'], '2', '.', ',') . " | " ."<br/>";
            endforeach;
        endif;
        
        echo "<hr>";
        echo "<h1>Conta</h1>";
        
        $conta = new Conta('Principal', 'Conta Corrente', 100.0);
        //$conta->criarConta($conta);
                
        $conta->mostraSaldo();
        var_dump($conta->saldo());
        
        echo "<hr>";
        echo "<h1>Contatos</h1>";
        
        //$contato = new ContatoFisico('Fred', '12312312311', 'fred@teste.com', '99999-9999', 'Rua dois', '8', 'casa', 'centro', '45678-000', 'MG', 'Congonhas','08/08/08', 'bla bla bla','Cliente');
        //$cnt = new ContatoJuridico('loja', 'lojinha', '12345678787', '12345689', 'lojinha@venda.com', '34567678', 'rua', '3', 'casa', 'centro', '34567890', 1, 23, '23/09/1990', 'bla bla', 'Fornecedor');
        //$cnt->adicionarContato($cnt);
        
        //$contato = new ContatoFisico('Marcos', '12312312311', 'fred@teste.com', '99999-9999', 'Rua dois', '8', 'casa', 'centro', '45678-000', 'MG', 'Congonhas','08/08/08', 'bla bla bla','Cliente');
        //$contato->adicionarContato($conta); 
        //$arr = ['nom_cnt' => 'MO'];
        //$contato->editarContato(7, $arr);
        //$contato->excluirContato(7);
        //$cnt = new ContatoJuridico('custela', 'lojinha', '12345678787', '12345689', 'lojinha@venda.com', '34567678', 'rua', '3', 'casa', 'centro', '34567890', 1, 23, '23/09/1990', 'bla bla', 'Fornecedor');
        //$cnt->adicionarContato($cnt);
        ?>
        
        
        
    </body>
</html>
