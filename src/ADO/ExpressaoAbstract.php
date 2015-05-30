<?php

namespace ADO;


abstract class ExpressaoAbstract
{
    // Operadores Logicos
    const AND_OPERADOR = 'AND';
    const OR_OPERADOR  = 'OR';

    abstract public function retornaExpressao();
} 