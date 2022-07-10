<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;
use Illuminate\Support\Facades\DB;

class People extends Model
{
    use HasFactory;

    private $base_table = 'peoples';
    private $planets_table = 'planets';
    private $db;

    public $name = '';
    public $height = 0;
    public $mass = 0;
    public $hair_color = '';
    public $skin_color = '';
    public $eye_color = '';
    public $birth_year = '';
    public $gender = '';
    public $homeworld = '';
    public $worldname = '';
    public $species = '';
    public $created;
    public $edited;

    public function __construct( $id = null )
    {
        parent::__construct();

        $this->db = new DB();

        if ( !empty($id) ){
            $this->loadById($id);
        }

    }

    public function loadById( $id )
    {
        $query = $this->db::table($this->base_table . ' as p');
        $result = $query->where('p.id', $id)->first();

        if (!empty($result)) {
            foreach ($result as $key => $val){
                $this->$key = $val;
            }
        }else{
            throw new Exception('People not found', 1001);
        }
    }

    public function saveNew( $newPerson ){
        $query = $this->db::table($this->base_table);
        $query->insert( $newPerson );
    }

    public function getAll( $page = null, $howMany = null, $options = ['filter' => [],'column' => '', 'direction' => 'asc']){

        $next = null;
        $previous = null;
        $query = $this->db::table($this->base_table . ' as p');

        $count = $query->count('id');

        $query->select(['p.*', 'pl.name as worldname']);
        $query->leftJoin( $this->planets_table . ' as pl','p.homeworld', '=', 'pl.id' );

        if ( !empty($options['filter']) ) {
            foreach ($options['filter'] as $col => $filter){
                $query->where('p.' . $col, $filter);
            }
        }
        if ( !empty($options['column']) ) $query->orderBy($options['column'], $options['direction']);

        if ( $page ){
            if ( $count < $page  * $howMany) {
                $page = (int)($count / $howMany) + ($count%$howMany ? 1 : 0);
                $p = $page;
                $next = null;
            }else{
                $next = $page + 1;
            }
            $previous =  --$page > 0 ? : $previous;
            if ( !$howMany) $howMany = 10;
            $offset = ($page -1 ) * $howMany;
            $query->offset($offset);
            $query->limit($howMany);

        }
        return [
            'previous' => $previous,
            'next' => $next,
            'results' => $query->get(),
        ];

    }

    public function getDetails()
    {
        return [
            'name' => $this->name,
            'height' => $this->height,
            'mass' => $this->mass,
            'hair_color' => $this->hair_color,
            'skin_color' => $this->skin_color,
            'eye_color' => $this->eye_color,
            'birth_year' => $this->birth_year,
            'gender' => $this->gender,
            'homeworld' => $this->homeworld,
            'created' => $this->created,
            'edited' => $this->edited,

        ];
    }
}
