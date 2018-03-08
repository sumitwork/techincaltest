<?php

/**
 * MailChimp Routes
 */
$router->group(['prefix' => 'lists'], function () use ($router) {
    
    // lists
    $router->get('{listID}',    'APIController@request');
    $router->post('',   	    'APIController@request');
    $router->patch('{listID}',  'APIController@request');
    $router->delete('{listID}', 'APIController@request');

    // members
    $router->get('{listID}/members',    'APIController@request');
    $router->post('{listID}/members',   'APIController@request');
    $router->patch('{listID}/members/{sub_hash}',  'APIController@request');
    $router->delete('{listID}/members/{sub_hash}', 'APIController@request');
});