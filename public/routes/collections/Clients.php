<?php
return call_user_func(
    function () {
        $userCollection = new \Phalcon\Mvc\Micro\Collection();

        $userCollection
            ->setPrefix('/v2/clients')
            ->setHandler('\App\Clients\Controllers\ClientsController')
            ->setLazy(true);

        $userCollection->get('/', 'getClients');
        $userCollection->get('/{id:\d+}', 'getClient');

        $userCollection->post('/', 'addClient');

        $userCollection->put('/{id:\d+}', 'editClient');

        $userCollection->delete('/{id:\d+}', 'deleteClient');

        return $userCollection;
    }
);
