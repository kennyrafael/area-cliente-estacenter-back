<?php

namespace App\Http\Controllers;

use App\Soap\Request\GetConsultaTitulos;
use App\Soap\Request\GetConsultaLocale;
use App\Soap\Response\GetConsultaLocaleResponse;
use App\Soap\Response\GetConsultaTitulosResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Artisaninweb\SoapWrapper\SoapWrapper;
use DateTime;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    private $soapWrapper;
    private $wsdl;
    private $credentials;

    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;
        $this->wsdl = 'http://acesso.salomon.inf.br:8888/g5-senior-services/sapiens_Synccom_senior_estacenter?wsdl';
        $this->wsdl2 = 'http://acesso.salomon.inf.br:8888/g5-senior-services/sapiens_Synccom_senior_g5_co_ger_relatorio?wsdl';
        $this->credentials = [
            'login' => 'uAppIntegr',
            'password' => 'G4J19J2!&*#'
        ];
    }

    public function listTitles(Request $request)
    {
        $parameters = $request->all();

        $rules =  array(
            'cpfCnpj'    => 'required'
        );

        $messages = array(
            'cpfCnpj.required' => 'CPF/CNPJ é obrigatório.'
        );

        $validator = Validator::make($parameters, $rules, $messages);

        if (!$validator->fails()) {
            $this->soapWrapper->add('Estacenter', function ($service) {
                $service
                    ->wsdl($this->wsdl)
                    ->trace(true)
                    ->options($this->credentials)
                    ->classmap([
                        GetConsultaTitulos::class,
                        GetConsultaTitulosResponse::class,
                    ]);
            });

            $response = $this->soapWrapper->call('Estacenter.consultaTitulos', [
                'login' => 'uAppIntegr',
                'password' => 'G4J19J2!&*#',
                'enc' => '',
                'parameters' => [
                    'cpfCnpj' => $parameters['cpfCnpj']
                ]
            ]);
            $this->soapWrapper->client('Estacenter', function ($client) {
                Log::info($client->getLastRequest());
            });

            if (isset($response->titulos) && !is_array($response->titulos)) {
                $response->titulos = [$response->titulos];
            }

            return response()->json($response);
        } else {
            $errors = $validator->errors();
            return response()->json($errors->all());
        }
    }

    public function checkDocument(Request $request)
    {
        $parameters = $request->all();

        $rules =  array(
            'cpfCnpj'    => 'required'
        );

        $messages = array(
            'cpfCnpj.required' => 'CPF/CNPJ é obrigatório.'
        );

        $validator = Validator::make($parameters, $rules, $messages);

        if (!$validator->fails()) {
            $this->soapWrapper->add('Estacenter', function ($service) {
                $service
                    ->wsdl($this->wsdl)
                    ->trace(true)
                    ->options($this->credentials)
                    ->classmap([
                        GetConsultaTitulos::class,
                        GetConsultaTitulosResponse::class,
                    ]);
            });

            $response = $this->soapWrapper->call('Estacenter.consultaTitulos', [
                'login' => 'uAppIntegr',
                'password' => 'G4J19J2!&*#',
                'enc' => '',
                'parameters' => [
                    'cpfCnpj' => $parameters['cpfCnpj']
                ]
            ]);
            $this->soapWrapper->client('Estacenter', function ($client) {
                Log::info($client->getLastRequest());
            });

            if (!$response->erroExecucao && $response->emaCli) {
                return response()->json(true);
            }

            return response()->json(false);
        } else {
            $errors = $validator->errors();
            return response()->json(false);
        }
    }

    public function checkEmail(Request $request)
    {
        $parameters = $request->all();

        $rules =  array(
            'cpfCnpj'    => 'required',
            'emaCli'    => 'required'
        );

        $messages = array(
            'cpfCnpj.required' => 'CPF/CNPJ é obrigatório.',
            'emaCli.required' => 'Email é obrigatório.'
        );

        $validator = Validator::make($parameters, $rules, $messages);

        if (!$validator->fails()) {
            $this->soapWrapper->add('Estacenter', function ($service) {
                $service
                    ->wsdl($this->wsdl)
                    ->trace(true)
                    ->options($this->credentials)
                    ->classmap([
                        GetConsultaTitulos::class,
                        GetConsultaTitulosResponse::class,
                    ]);
            });

            $response = $this->soapWrapper->call('Estacenter.consultaTitulos', [
                'login' => 'uAppIntegr',
                'password' => 'G4J19J2!&*#',
                'enc' => '',
                'parameters' => [
                    'cpfCnpj' => $parameters['cpfCnpj']
                ]
            ]);
            $this->soapWrapper->client('Estacenter', function ($client) {
                Log::info($client->getLastRequest());
            });

            if (!$response->erroExecucao && $response->emaCli === $parameters['emaCli']) {
                return response()->json(true);
            }

            return response()->json(false);
        } else {
            $errors = $validator->errors();
            return response()->json(false);
        }
    }

    public function listLocales()
    {
        $this->soapWrapper->add('Estacenter', function ($service) {
            $service
                ->wsdl($this->wsdl)
                ->trace(true)
                ->options($this->credentials)
                ->classmap([
                    GetConsultaLocale::class,
                    GetConsultaLocaleResponse::class,
                ]);
        });

        $response = $this->soapWrapper->call('Estacenter.listarLocais', [
            'login' => 'uAppIntegr',
            'password' => 'G4J19J2!&*#',
        ]);
        return response()->json($response);
    }

    public function submitNewMonthlyClient(Request $request)
    {
        // $parameters = $request->all();
        // $this->soapWrapper->add('Estacenter', function ($service) {
        //     $service
        //         ->wsdl($this->wsdl)
        //         ->trace(true)
        //         ->options($this->credentials)
        //         ->classmap([
        //             GetConsultaLocale::class,
        //             GetConsultaLocaleResponse::class,
        //         ]);
        // });

        // $response = $this->soapWrapper->call('Estacenter.cadastrarMensalista', [
        //     'login' => 'uAppIntegr',
        //     'password' => 'G4J19J2!&*#',
        //     'enc' => '',
        //     'parameters' => $parameters
        // ]);

        // $this->soapWrapper->client('Estacenter', function ($client) {
        //     Log::info($client->getLastRequest());
        // });

        return response()->json([]);
    }

    public function getPdf(Request $request)
    {
        $parameters = $request->all();

        $rules =  array(
            'codEmp'    => 'required',
            'codFil'    => 'required',
            'codTpt'    => 'required',
            'numTit'    => 'required',
        );

        $validator = Validator::make($parameters, $rules);

        if (!$validator->fails()) {
            $this->soapWrapper->add('Estacenter', function ($service) {
                $service
                    ->wsdl($this->wsdl2)
                    ->trace(true)
                    ->options($this->credentials);
            });

            $entrada = '<![CDATA[<ECodEmp=' . $parameters['codEmp'] .
                '><ECodFil=' . $parameters['codFil'] .
                '><ECodTpt="' . $parameters['codTpt'] .
                '"><ENumTit="' . $parameters['numTit'] . '">]]>';

            $fileName = 'boleto-estacenter-' . (new DateTime())->format('YmdHisv');

            $response = $this->soapWrapper->call('Estacenter.Executar', [
                'login' => 'uAppIntegr',
                'password' => 'G4J19J2!&*#',
                'enc' => '',
                'parameters' => [
                    'prExecFmt' => 'tefFile',
                    'prFileName' => $fileName,
                    'prRelatorio' => 'FRCR237.GER',
                    'prEntrada' => $entrada,
                    'prUniqueFile' => 'S',
                    'prTypeBmp' => 'N',
                    'prRetorno' => 'blob',
                    'prSaveFormat' => 'tsfPDF',
                    'prEntranceIsXML' => 'F',
                ]
            ]);

            if (!$response->erroExecucao) {
                $path       = public_path($fileName);
                $contents   = base64_decode($response->prRetorno);

                file_put_contents($path, $contents);
                return response()->download($path, $fileName . '.pdf')->deleteFileAfterSend(true);
            }
        } else {
            $errors = $validator->errors();
            return response()->json($errors->all());
        }
    }
}
