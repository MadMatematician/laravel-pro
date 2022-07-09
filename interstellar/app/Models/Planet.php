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
    private string $resident_table = 'people';
    private $db;

    public Integer  $id;
    public string   $name = '';
    public Integer  $rotation_period;
    public Integer  $orbital_period;
    public Integer  $diameter;
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
            $this->loadBy($id);
        }


    }

    public function loadBy($id){
        $query = $this->db->table($this->base_table . ' as p' );
        $result = $query->where('p.id', '=', $id)->first();
        if ( !empty($result)){
            foreach ($result as $key => $val){
                $this->$$key = $val;
            }
            $query = $this->db->table($this->resident_table . 'as p2');
            $this->residents = $query->where('cast( p2.homeworld as decimal)', '=', $id)->count('id');

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
    public function getAll(){

    }

}
