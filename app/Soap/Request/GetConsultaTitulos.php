<?php

namespace App\Soap\Request;

class GetConsultaTitulos {
    protected $cpfCnpj;

    public function __construct($cpfCnpj)
    {
        $this->cpfCnpj = $cpfCnpj;
    }

    public function getCpfCnpj() {
        return $this->cpfCnpj;
    }
}
