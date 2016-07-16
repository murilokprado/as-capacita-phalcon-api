<?php
namespace App\Clients\Controllers;

use App\Controllers\RESTController;
use App\Clients\Models\Cars;

class CarsController extends RESTController
{

    public function getCars()
    {
        try {
            $cars = (new Cars())->find(
                [
                    'conditions' => 'true ' . $this->getConditions(),
                    'columns' => $this->partialFields,
                    'limit' => $this->limit
                ]
            );

            return $cars;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

 
    public function getCar($iCarId)
    {
        try {
            $car = (new Cars())->findFirst(
                [
                    'conditions' => "iCarId = '$iCarId'",
                    'columns' => $this->partialFields,
                ]
            );

            return $car;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }


    public function addCar()
    {
        try {
            $car = new Cars();
            $car->iClientId = $this->di->get('request')->getPost('iClientId');
            $car->sDesc = $this->di->get('request')->getPost('sDesc');
            $car->sPlate = $this->di->get('request')->getPost('sPlate');

            $car->saveDB();

            return $car;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public function editCar($iCarId)
    {
        try {
            $put = $this->di->get('request')->getPut();

            $car = (new Cars())->findFirst($iCarId);

            if (false === $car) {
                throw new \Exception("This record doesn't exist", 200);
            }

            $car->iClientId = isset($put['iClientId']) ? $put['iClientId'] : $car->iCarId;
            $car->sDesc = isset($put['sDesc']) ? $put['sDesc'] : $car->sDesc;
            $car->sPlate = isset($put['sPlate']) ? $put['sPlate'] : $car->sPlate;

            $car->saveDB();

            return $car;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public function deleteCar($iCarId)
    {
        try {
            $car = (new Phones())->findFirst($iCarId);

            if (false === $car) {
                throw new \Exception("This record doesn't exist", 200);
            }

            return ['success' => $car->delete()];
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
