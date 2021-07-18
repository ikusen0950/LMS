<?php
namespace App\Models;
use CodeIgniter\Model;

class genre_model extends Model {

    protected $table = 'genres';    
    protected $primaryKey = 'genre_id';
    protected $allowedFields = ['genre_id', 'genre_uid', 'status', 'genre', 'created_by', 'created_at', 'updated_by', 'updated_at'];
  

      
    public function noticeTable()
    {
        $builder = $this->db->table('genres');
        return $builder;
    }

    public function getMaxId()
    {
        return $this->selectMax('genre_id')->first();
    }

    public function btn_action()
    {
        $action = function ($row) {
            return '<a  name="edit_genre" class="px-3 text-primary edit_genre" id="' . $row["genre_id"] . '"><i class="uil uil-pen font-size-18"></i></a> <a name="delete_genre" class="px-3 text-danger delete_genre" id="' . $row["genre_id"] . '"><i class="uil uil-trash-alt font-size-18"></i></a>';
            
        };
        return $action;
    }

    public function getStatus()
    {
        $status = function ($row) {
            if ($row['status'] == 'Active') {
                return '<span class="badge bg-pill bg-soft-success font-size-12">Active</span>';
            } else {
                return '<span class="badge bg-pill bg-soft-danger font-size-12">Inactive</span>';
            }
        };
        return $status;
    }
   
}

