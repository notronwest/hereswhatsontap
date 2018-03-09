<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 3/8/18
 * Time: 10:05 PM
 */

namespace App\Service;

use App\Service\Pintlabs_Service_Brewerydb as BrewryDB;

class BeerService
{

    public function getByName( string $name = '' )
    {
        $bdb = new BrewryDB('603b4395bca5ee1d022bb755bd6d6232');
        return $bdb->request('beers', [ 'name' => 'Long Trail Ale'], 'GET');
    }

}