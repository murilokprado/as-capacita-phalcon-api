<?php
return call_user_func(
    function () {
        $userCollection = new \Phalcon\Mvc\Micro\Collection();

        $userCollection
            ->setPrefix('/v2/cars')
            ->setHandler('\App\Clients\Controllers\CarsController')
            ->setLazy(true);

        $userCollection->get('/', 'getCars');
        $userCollection->get('/{id:\d+}', 'getCar');

        $userCollection->post('/', 'addCar');

        $userCollection->put('/{id:\d+}', 'editCar');

        $userCollection->delete('/{id:\d+}', 'deleteCar');

        return $userCollection;
    }
);
