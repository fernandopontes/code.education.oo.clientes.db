<?php

namespace ADO;


abstract class InstrucaoSqlAbstract
{
    protected $sql;
    protected $criterio;
    protected $coluna_valor;
    private $tabela_db;

    final public function setTabelaDb($tabela_db)
    {
        $this->tabela_db = $tabela_db;
    }

    final public function getTabelaDb()
    {
        return $this->tabela_db;
    }

    public function setLinhaDados($coluna, $valor)
    {
        if(is_string($valor))
        {
            $valor = addslashes($valor);
            $this->coluna_valor[$coluna] = "'$valor'";
        }
        elseif(is_bool($valor))
        {
            $this->coluna_valor[$coluna] = $valor ? 'TRUE' : 'FALSE';
        }
        elseif(isset($valor))
        {
            $this->coluna_valor[$coluna] = $valor;
        }
        else {
            $this->coluna_valor[$coluna] = "NULL";
        }
    }

    public function setCriterio(Criterios $criterio)
    {
        $this->criterio = $criterio;
    }

    abstract function getInstrucaoSql();
} 