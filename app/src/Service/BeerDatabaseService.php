<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 3/8/18
 * Time: 10:05 PM
 */

namespace App\Service;

use App\Service\Pintlabs_Service_Brewerydb as BrewryDB;

class BeerDatabaseService
{

    private $bdb;

    public function __construct()
    {
        $this->bdb = new BrewryDB('603b4395bca5ee1d022bb755bd6d6232');
    }

    public function searchForBeer(string $name = '')
    {
        $beers = $this->bdb->request('beers', ['name' => $name.'*'], 'GET');

        if ($this->isSuccessful($beers)) {
            return $beers['data'];
        } else {
            // TODO Need error handling
            return[];
        }
    }

    public function getBeerByID(string $id = '')
    {

        $beer = $this->bdb->request('beer/' . $id);

        if ($this->isSuccessful($beer)) {
            return $beer['data'];
        } else {
            // TODO Need error handling
            return [];
        }
    }

    public function getBeersByBrewery(string $id = '')
    {

        $beers = $this->bdb->request('brewery/' . $id . '/beers');

        if ($this->isSuccessful($beers)) {
            return $beers['data'];

        } else {
            // TODO Need error handling
            return [];
        }
    }

    public function searchForBrewery(string $brewery)
    {
        $brewery = $this->bdb->request('breweries', ['name' => $brewery.'*']);

        if( $this->isSuccessful($brewery) ){
            return $brewery['data'];
        } else {
            // TODO Need error handling
            return [];
        }
    }

    public function getBreweryByID(string $id = '')
    {

        $brewery = $this->bdb->request('brewery/' . $id);

        if ($this->isSuccessful($brewery)) {
            return $brewery['data'];
        } else {
            // TODO Need error handling
            return [];
        }
    }


    public function getBreweryForBeer($beer)
    {
        $brewery = $this->bdb->request('beer/'.$beer['id'].'/breweries');

        if($this->isSuccessful($brewery)){
            return $brewery['data'];
        } else {
            // TODO Need error handling
            return [];
        }
    }

    public function getGlassByID(string $id = '')
    {

        $glass = $this->bdb->request('glass/' . $id);

        if ($this->isSuccessful($glass)) {
            return $glass['data'];
        } else {
            // TODO Need error handling
            return [];
        }
    }

    private function isSuccessful($apiData)
    {
        if($apiData && $apiData['status'] == 'success' && array_key_exists('data', $apiData)){
            return true;
        } else {
            return false;
        }
    }

}