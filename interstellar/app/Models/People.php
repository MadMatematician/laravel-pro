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
        $query = $this->db::table($this->base_table . 'as p');
        $result = $query->where('p.id', $id)->first();
        if (!empty($result)) {
            foreach ($result as $key => $val){
                $this->$$key = $val;
            }
        }else{
            throw new Exception('People not found', 1001);
        }
    }

    public function saveNew( $newPerson ){
        $query = $this->db::table($this->base_table);
        $query->insert( $newPerson );
    }

    public function getAll( $options = ['filter' => [],'column' => '', 'direction' => 'asc']){
        $query = $this->db::table($this->base_table . 'as p');
        if ( !empty($options['filter']) ) {
            foreach ($options['filter'] as $col => $filter){

            $query->where('p.' . $col, '=', $filter);
            }
        }
        if ( !empty($options['column']) ) $query->orderBy($options['column'], $options['direction']);

        return $query->select();

    }
}
