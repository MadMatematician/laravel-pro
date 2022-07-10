<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Planet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;


class RetrievePeoples extends Controller
{
    //

    private string $sourcePeople = 'https://swapi.dev/api/people';
    private string $sourcePlanet = 'https://swapi.dev/api/planets/';
    private array $headers = [];

    public function __construct(){
//        $this->db = new DB();
    }

    public function peopleFromSource(){
        $output = new \stdClass();
        $output->next = $this->sourcePeople;
        while ($output->next){

            $output = $this->myCurl( $output->next );
            $people = new People();
            $planet = new Planet();
            foreach ($output->results as $personDetails){
                $newPeople['name'] = $personDetails->name;
                $newPeople['height'] = (int)$personDetails->height ?:null;
                $newPeople['hair_color'] = $personDetails->hair_color;
                $newPeople['skin_color'] = $personDetails->skin_color;
                $newPeople['eye_color'] = $personDetails->eye_color;
                $newPeople['birth_year'] = $personDetails->birth_year;
                $newPeople['gender'] = $personDetails->gender;
                $newPeople['mass'] = (int)$personDetails->mass ?:null;
                $newPeople['homeworld'] = explode('/', strrev($personDetails->homeworld))[1];
                $newPeople['created'] = date('Y-m-d H:i:s', strtotime($personDetails->created));
                $newPeople['edited'] = date('Y-m-d H:i:s', strtotime($personDetails->edited));
                $people->saveNew( $newPeople );

                $planetDetails = $this->myCurl($personDetails->homeworld);
                $id = $newPeople['homeworld'];
                $newPlanet['id'] = $id;
                $newPlanet['name'] = $planetDetails->name;
                $newPlanet['rotation_period'] = $planetDetails->rotation_period;
                $newPlanet['orbital_period'] = $planetDetails->orbital_period;
                $newPlanet['diameter'] = $planetDetails->diameter;
                $newPlanet['climate'] = $planetDetails->climate;
                $newPlanet['gravity'] = $planetDetails->gravity;
                $newPlanet['terrain'] = $planetDetails->terrain;
                $newPlanet['surface_water'] = $planetDetails->surface_water;
                $newPlanet['population'] = $planetDetails->population;
    //            $newPlanet['residents'] = $planetDetails->residents;
                $newPlanet['created'] = date('Y-m-d H:i:s', strtotime($planetDetails->created));
                $newPlanet['edited'] = date('Y-m-d H:i:s', strtotime($planetDetails->edited));

                $planet->saveNew($newPlanet);

            }
        }

    }

    private function myCurl( $endpoint )
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
// SSL important
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output);
    }
}
