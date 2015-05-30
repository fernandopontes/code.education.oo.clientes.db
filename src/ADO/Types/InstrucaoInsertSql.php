<?php

namespace ADO\Types;

use ADO\InstrucaoSqlAbstract;

final class InstrucaoInsertSql extends InstrucaoSqlAbstract
{
    public function setCriterio($criterio)
    {
        throw new \Exception("Não é possível chamar setCriterio para " . __CLASS__);
    }

    function getInstrucaoSql()
    {
        $this->sql = sprintf("INSERT INTO %s (%s) VALUES (%s)",
                                $this->getTabelaDb(),
                                implode(', ', array_keys($this->coluna_valor)),
                                implode(', ', array_values($this->coluna_valor))
                            );

        return $this->sql;
    }


} 