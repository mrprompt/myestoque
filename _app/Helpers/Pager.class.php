<?php

//Realiza a gestão e a paginação de resultados do sistema
class Pager {
    
    /** DEFINE O PAGER */
    private $Page;
    private $Limit;
    private $Offset;
    
    
    /** REALIZA LEITURA */
    private $Tabela;
    private $Termos;
    private $Places;
    
    
    /** DEFINE PAGNATOR */
    private $Rows;
    private $Link;
    private $MaxLinks;
    private $First;
    private $Last;
    
    
    /** RENDERIZA O PAGINATOR */
    private $Paginator;
    
    function __construct($Link, $First = null, $Last = null, $MaxLinks = null) {
        $this->Link = (string) $Link;        
        $this->First = ((string) $First ? $First : 'Primera Página');
        $this->Last = ((string) $Last ? $Last : 'Ultima Página');
        $this->MaxLinks = ((int) $MaxLinks ? $MaxLinks : 5);
    }
    
    public function ExePager($Page,$Limit) {
        $this->Page = ((int) $Page ? $Page : 1);
        $this->Limit = (int) $Limit;
        $this->Offset = ($this->Page * $this->Limit)- $this->Limit;
    }
    
    public function ReturnPage() {
        if($this->Page > 1):
            $nPage = $this->Page - 1;
            header("Location: {$this->Link}{$nPage}");
        endif;
    }
    
    function getPage() {
        return $this->Page;
    }

    function getLimit() {
        return $this->Limit;
    }

    function getOffset() {
        return $this->Offset;
    }
    
    public function ExePaginator($Tabela, $Termos = null, $ParseString = null) {
        $this->Tabela = (string) $Tabela;
        $this->Termos = (string) $Termos;
        $this->Places = (string) $ParseString;
        $this->getSyntax();
    }
    
    public function getPaginator() {
        return $this->Paginator;
    }



}
