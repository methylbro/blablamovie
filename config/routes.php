<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use App\Controller;

return function (RoutingConfigurator $routes) {

    $routes->add('user_create', '/user')
        ->controller(Controller\CreateUserController::class)
        ->methods(['POST', 'GET'])
    ;
    $routes->add('delete_filmchoice', '/user/{user_uuid}/filmchoice/{imdbId}')
        ->controller(Controller\DeleteFilmChoiceController::class)
        ->methods(['DEL', 'GET'])
    ;
    $routes->add('read_bestfilm', '/bestfilm')
        ->controller(Controller\ReadBestFilmController::class)
        ->methods(['GET'])
    ;
    $routes->add('read_filmchoices', '/user/{user_uuid}/filmchoices')
        ->controller(Controller\ReadFilmChoicesController::class)
        ->methods(['GET'])
    ;
    $routes->add('read_userwithfilmchoice', '/users/withfilmchoice')
        ->controller(Controller\ReadUsersWithFilmChoiceController::class)
        ->methods(['GET'])
    ;
    $routes->add('save_filmchoice', '/user/{user_uuid}/filmchoice')
        ->controller(Controller\SaveFilmChoiceController::class)
        ->methods(['PUT', 'GET'])
    ;

};