<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Planet;
use Illuminate\Http\Request;
use ReflectionClass;
use ReflectionProperty;

class PeopleController extends Controller
{
    //

    public function __construct(){

    }
    public function list(Request $request){

        if ( $request->segment(3) ){

            $list = $this->details($request->segment(3));
        }else{
            $people = new People();
            $list = $people->getAll( $request->get('page'), $request->get('howMany'));

        }
        return response( json_encode($list), 200)->header('Content-Type', 'application/json');
    }

    private function details($id){

        $people = new People($id);
        $planet = new Planet($people->homeworld);

        $details['people'] = $people->getDetails();
        $details['planet'] = $planet->getDetails();

        return $details;

    }
}
