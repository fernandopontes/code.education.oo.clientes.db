<?php

namespace ADO\Types;

use ADO\InstrucaoSqlAbstract;

final class InstrucaoSelectSql extends InstrucaoSqlAbstract
{
    private $colunas;

    public function adicionarColuna($coluna)
    {
        $this->colunas[] = $coluna;
    }

    function getInstrucaoSql()
    {
        $criterio_completo = "";

        if($this->criterio)
        {
            $criterio_ = $this->criterio->retornaExpressao();

            if($criterio_)
            {
                $criterio_completo = sprintf(' WHERE %s ', $criterio_);
            }

            $ordenacao_ = $this->criterio->getPropriedade('order');

            if($ordenacao_)
            {
                $criterio_completo .= sprintf(' ORDER BY %s ', $ordenacao_);
            }

            $limite_ = $this->criterio->getPropriedade('limit');

            if($limite_)
            {
                $criterio_completo .= sprintf(' LIMIT %s ', $limite_);
            }

            $offset_ = $this->criterio->getPropriedade('offset');

            if($offset_)
            {
                $criterio_completo .= sprintf(' OFFSET %s ', $offset_);
            }
        }

        $this->sql = sprintf("SELECT %s FROM %s %s", implode(', ', $this->colunas), $this->getTabelaDb(), $criterio_completo);

        return $this->sql;
    }

    public function setLinhaDados($coluna, $valor)
    {
        throw new \Exception("Não é possível chamar setLinhaDados para " . __CLASS__);
    }
} 