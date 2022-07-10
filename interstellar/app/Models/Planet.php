<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;
use phpDocumentor\Reflection\Types\Integer;
use Illuminate\Support\Facades\DB;


class Planet extends Model
{
    use HasFactory;

    private string $base_table = 'planets';
    private string $resident_table = 'peoples';
    private $db;

    public $id;
    public string   $name = '';
    public  $rotation_period;
    public  $orbital_period;
    public  $diameter;
    public string   $climate = '';
    public string   $gravity = '';
    public string   $terrain = '';
    public string   $surface_water = '';
    public string   $population = '';
    public string   $residents = '';
    public string   $created = '';
    public string   $edited = '';

    public function __construct( $id = null)
    {
        parent::__construct();
        $this->db = new DB();
        if ( !empty($id) ){
            $this->loadById($id);
        }


    }

    private function loadById($id){

        $query = $this->db::table($this->base_table . ' as p' );
        $result = $query->where('p.id', '=', $id)->first();
        if ( !empty($result)){
//            $this->id = $id;
            foreach ($result as $key => $val){
                $this->$key = is_numeric($val) ? (int)$val : $val;
            }
            $query = $this->db::table($this->resident_table . ' as p2');
            $this->residents = $query->where('p2.homeworld', $id)->count('id');

        }else{
            throw new Exception('No planet found');
        }
    }

    public function saveNew(array $newPlanet)
    {
        try {
            $query = $this->db::table($this->base_table);
            $query->upsert($newPlanet, 'id');
        }catch (\mysql_xdevapi\Exception $e){
            return false;
        }
    }
    public function getDetails(){
        return [
                'id' => $this->id,
                'name' => $this->name,
                'rotation_period' => $this->rotation_period,
                'orbital_period' => $this->orbital_period,
                'diameter' => $this->diameter,
                'climate' => $this->climate,
                'gravity' => $this->gravity,
                'terrain' => $this->terrain,
                'surface_water' => $this->surface_water,
                'population' => $this->population,
                'residents' => $this->residents,
                'created' => $this->created,
                'edited' => $this->edited,
        ];
    }
    public function getAll(){

    }

}
