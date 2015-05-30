<?php

namespace ADO;


class Criterios extends ExpressaoAbstract
{
    private $expressoes;
    private $operadores;
    private $propriedades;

    public function adicionarExpressao(ExpressaoAbstract $expressao, $operador = self::AND_OPERADOR)
    {
        if(empty($this->operadores))
            $operador = '';

        $this->expressoes[] = $expressao;
        $this->operadores[] = $operador;
    }

    public function retornaExpressao()
    {
        if(is_array($this->expressoes))
        {
            $resultado = '';

            foreach($this->expressoes as $chave => $item)
            {
                $operado = $this->operadores[$chave];

                $resultado .= $operado . $item->retornaExpressao() . ' ';
            }

            $resultado = trim($resultado);

            return "({$resultado})";
        }
    }

    public function setPropriedade($propriedade, $valor)
    {
        $this->propriedades[$propriedade] = $valor;
    }

    public function getPropriedade($propriedade)
    {
        if(isset($this->propriedades[$propriedade]))
        {
            return $this->propriedades[$propriedade];
        }
        else {
            return NULL;
        }
    }
} 