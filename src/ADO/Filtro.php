<?php

namespace ADO;


class Filtro extends ExpressaoAbstract
{
    private $variavel;
    private $operador;
    private $valor;

    public function __construct($variavel, $operador, $valor)
    {
        $this->variavel = $variavel;
        $this->operador = $operador;
        $this->valor    = $this->formatar($valor);
    }

    private function formatar($valor)
    {
        if(is_array($valor))
        {
            foreach($valor as $item)
            {
                if(is_integer($item))
                {
                    $registro[] = $item;
                }
                elseif(is_string($item))
                {
                    $registro[] = "'$item'";
                }
            }

            $resultado = '(' . implode(',', $registro) . ')';
        }
        elseif(is_string($valor))
        {
            $resultado = "'$valor'";
        }
        elseif(is_null($valor))
        {
            $resultado = 'NULL';
        }
        elseif(is_bool($valor))
        {
            $resultado = $valor ? 'TRUE' : 'FALSE';
        }
        else {
            $resultado = $valor;
        }

        return $resultado;
    }

    public function retornaExpressao()
    {
        return "{$this->variavel} {$this->operador} {$this->valor}";
    }
} 