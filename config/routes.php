<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use App\Controller;

return function (RoutingConfigurator $routes) {

    $routes->add('user_create', '/user')
        ->controller(Controller\CreateUserController::class)
        ->methods(['POST'])
    ;
    $routes->add('delete_moviechoice', '/user/{user_uuid}/moviechoice/{imdbId}')
        ->controller(Controller\DeleteMovieChoiceController::class)
        ->methods(['DEL'])
    ;
    $routes->add('read_bestfilm', '/bestfilm')
        ->controller(Controller\ReadBestMovieController::class)
        ->methods(['GET'])
    ;
    $routes->add('read_moviechoices', '/user/{user_uuid}/moviechoices')
        ->controller(Controller\ReadMovieChoicesController::class)
        ->methods(['GET'])
    ;
    $routes->add('read_userwithmoviechoice', '/users/withmoviechoice')
        ->controller(Controller\ReadUsersWithMovieChoiceController::class)
        ->methods(['GET'])
    ;
    $routes->add('save_moviechoice', '/user/{user_uuid}/moviechoice')
        ->controller(Controller\SaveMovieChoiceController::class)
        ->methods(['POST'])
    ;

};