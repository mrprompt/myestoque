<?php

class Create extends Conn {

    private $Tabela;
    private $Dados;
    private $Result;

    /** @var PDOStatement */
    private $Create;

    /** @var PDO */
    private $Conn;

    /**
     * <b>ExeCreate</b> Executa um cadastro simplificado no banco de dados utilizando prepared statements
     * Basta informar o nome da tabela e um array atribuitivo com nome da coluna e valor.
     * 
     * @param type $Tabela = Informe o nome da tabela no banco
     * @param array $Dados = Informe um array atribuitivo. ( Nome da Coluna => Valor).
     */
    public function ExeCreate($Tabela, array $Dados) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;

        $this->getSyntax();
        $this->Execute();
    }

    public function getResult() {
        return $this->Result;
    }

    /**
     * ****************************************
     * *********** PRIVATE METHODOS ***********
     * ****************************************
     */
    private function Connect() {
        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($this->Create);
    }

    private function getSyntax() {
        $Fileds = implode(', ', array_keys($this->Dados));
        $Places = ':' . implode(', :', array_keys($this->Dados));
        $this->Create = "INSERT INTO {$this->Tabela} ({$Fileds}) VALUES ({$Places})";
    }

    private function Execute() {
        $this->Connect();
        try {
            $this->Create->execute($this->Dados);
            $this->Result = $this->Conn->lastInsertId();
            
        } catch (PDOException $e) {
            $this->Result = null;
            WSErro("<b>Erro ao cadastrar:</b>{$e->getMessage()}", $e->getCode());
        }
    }

}
