<?php
namespace App\Clients\Controllers;

use App\Controllers\RESTController;
use App\Clients\Models\Clients;


class ClientsController extends RESTController
{
    public function getClients()
    {
        try {
            $query = new \Phalcon\Mvc\Model\Query\Builder();
            $query->addFrom('\App\Clients\Models\Clients', 'Clients')
                ->columns(
                    [
                        'Clients.iClientId',
                        'Clients.sName',
                        'Clients.sEmail',
                        'Cars.iCarId',
                        'Cars.iClientId as iCarClientId',
                        'Cars.sDesc',
                        'Cars.sPlate',
                    ]
                )
                ->leftJoin('\App\Clients\Models\Cars', 'Cars.iClientId = Clients.iClientId', 'Cars')
                ->where('true');

            return $query
                ->getQuery()
                ->execute();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getClient($iClientId)
    {
        try {
            $client = (new Clients())->findFirst(
                [
                    'conditions' => "iClientId = '$iClientId'",
                    'columns' => $this->partialFields,
                ]
            );

            return $client;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public function addClient()
    {
        try {
            $clientModel = new Clients();
            $clientModel->sName = $this->di->get('request')->getPost('sName');
            $clientModel->sEmail = $this->di->get('request')->getPost('sEmail');

            $clientModel->saveDB();

            return $clientModel;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public function editClient($iClientId)
    {
        try {
            $put = $this->di->get('request')->getPut();

            $client = (new Clients())->findFirst($iClientId);

            if (false === $client) {
                throw new \Exception("This record doesn't exist", 200);
            }
            
            $client->sName = isset($put['sName']) ? $put['sName'] : $client>sName;
            $client->sEmail = isset($put['sEmail']) ? $put['sEmail'] : $client>sEmail;

            $client->saveDB();

            return $client;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public function deleteClient($iClientId)
    {
        try {
            $client = (new Clients())->findFirst($iClientId);

            if (false === $client) {
                throw new \Exception("This record doesn't exist", 200);
            }

            return ['success' => $client->delete()];
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}

