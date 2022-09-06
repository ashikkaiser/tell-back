<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\Api\v1\AuthController;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {

    // return loadColumns(2);
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->get('/countries', 'Api\v1\AuthController@countries');

    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post('/register', 'Api\v1\AuthController@register');
        $router->post('/login', 'Api\v1\AuthController@login');

        //auth
        $router->group(['middleware' => 'jwt'], function () use ($router) {
            $router->post('/me', 'Api\v1\AuthController@me');
        });
    });
    $router->group(['prefix' => 'affiliate-networks', ['middleware' => 'jwt']], function () use ($router) {
        $router->get('/common', 'Api\v1\AffiliateNetworkController@common');
        $router->post('/addNetwork', 'Api\v1\AffiliateNetworkController@addNetwork');
        $router->post('/editNetwork/{id}', 'Api\v1\AffiliateNetworkController@editNetwork');
        $router->get('/allNetworks', 'Api\v1\AffiliateNetworkController@allNetworks');
        $router->get('/view/{id}', 'Api\v1\AffiliateNetworkController@view');
        $router->post('/delete', 'Api\v1\AffiliateNetworkController@delete');
    });
    $router->group(['prefix' => 'traffic-sources', ['middleware' => 'jwt']], function () use ($router) {
        $router->get('/common', 'Api\v1\TrafficSourceController@common');
        $router->post('/addTrafficSource', 'Api\v1\TrafficSourceController@addTrafficSource');
        $router->get('/allTrafficSource', 'Api\v1\TrafficSourceController@allTrafficSource');
        $router->get('/view/{id}', 'Api\v1\TrafficSourceController@view');
        $router->post('/editTrafficSource/{id}', 'Api\v1\TrafficSourceController@editTrafficSource');
    });
    $router->group(['prefix' => 'workspace', ['middleware' => 'jwt']], function () use ($router) {
        $router->get('/get', 'Api\v1\WorkSpaceController@workspaces');
    });
    $router->group(['prefix' => 'offers', ['middleware' => 'jwt']], function () use ($router) {
        $router->get('/common', 'Api\v1\OffersController@common');
        $router->post('/addOffer', 'Api\v1\OffersController@addOffer');
        $router->get('/all', 'Api\v1\OffersController@allOffers');
        $router->get('/view/{id}', 'Api\v1\OffersController@view');
        $router->post('/editOffer/{id}', 'Api\v1\OffersController@editOffer');
    });
    $router->group(['prefix' => 'landers', ['middleware' => 'jwt']], function () use ($router) {
        $router->get('/common', 'Api\v1\LandersController@common');
        $router->post('/addLander', 'Api\v1\LandersController@addLander');
        $router->get('/all', 'Api\v1\LandersController@allLanders');
        $router->get('/view/{id}', 'Api\v1\LandersController@view');
        $router->post('/editLander/{id}', 'Api\v1\LandersController@editLander');
    });
    $router->group(['prefix' => 'flows', ['middleware' => 'jwt']], function () use ($router) {
        $router->get('/common', 'Api\v1\FlowsController@common');
        $router->post('/addLander', 'Api\v1\FlowsController@addLander');
        $router->get('/all', 'Api\v1\FlowsController@allLanders');
        $router->get('/view/{id}', 'Api\v1\FlowsController@view');
        $router->post('/editLander/{id}', 'Api\v1\FlowsController@editLander');
    });
    $router->group(['prefix' => 'settings', ['middleware' => 'jwt']], function () use ($router) {
        $router->post('/resizeColumn/{id}', 'Api\v1\SettingsController@resizeColumn');
        $router->post('/global', 'Api\v1\SettingsController@global');
        $router->post('/domains', 'Api\v1\SettingsController@domains');
        $router->post('/settings', 'Api\v1\SettingsController@settings');
        $router->get('/settings', 'Api\v1\SettingsController@settings');
    });
    $router->group(['prefix' => 'dictionary', ['middleware' => 'jwt']], function () use ($router) {
        $router->post('/isp', 'Api\v1\DictionaryController@getIsps');
        $router->post('/city', 'Api\v1\DictionaryController@getCity');
        $router->post('/mobile_carrier', 'Api\v1\DictionaryController@getMobileCarreir');
        $router->post('/region', 'Api\v1\DictionaryController@getRegions');
    });
});
