<?php

namespace App\Soap\Response;

class GetConsultaLocaleResponse
{
    /**
     * @var string
     */
    protected $GetConsultaLocalesResult;

    /**
     * GetConsultaLocaleResponse constructor.
     *
     * @param string
     */
    public function __construct($GetConsultaLocalesResult)
    {
        $this->GetConsultaLocalesResult = $GetConsultaLocalesResult;
    }

    /**
     * @return string
     */
    public function getGetConsultaLocalesResult()
    {
        return $this->GetConsultaLocalesResult;
    }
}
