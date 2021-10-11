<?php

namespace App\Soap\Response;

class GetConsultaTitulosResponse
{
    /**
     * @var string
     */
    protected $GetConsultaTitulosResult;

    /**
     * GetConsultaTitulosResponse constructor.
     *
     * @param string
     */
    public function __construct($GetConsultaTitulosResult)
    {
        $this->GetConsultaTitulosResult = $GetConsultaTitulosResult;
    }

    /**
     * @return string
     */
    public function getGetConsultaTitulosResult()
    {
        return $this->GetConsultaTitulosResult;
    }
}
