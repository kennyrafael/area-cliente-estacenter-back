<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use SoapClient;

class SoapService
{

    private $client;

    public function __construct()
    {
        $opts = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $context = stream_context_create($opts);
        $wsdl = "http://acesso.salomon.inf.br:8888/g5-senior-services/sapiens_Synccom_senior_estacenter?wsdl";

        try {
            $this->client = new SoapClient(
                $wsdl,
                array(
                    'stream_context' => $context, 'trace' => true,
                    'login' => 'uAppIntegr', 'password' => 'G4J19J2!&*#'
                )
            );
        } catch (\Exception $e) {
            Log::info('Caught Exception in client' . $e->getMessage());
        }
    }

    public function getTitles($params)
    {
        try {
            return $this->client->consultaTitulos($params);
        } catch (\Exception $e) {
            Log::info('Caught Exception :' . $e->getMessage());
            return $e;
        }
    }
}
