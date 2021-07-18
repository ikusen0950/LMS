<?php
namespace App\Models;
use CodeIgniter\Model;

class author_model extends Model {

    protected $table = 'authors';    
    protected $primaryKey = 'author_id';
    protected $allowedFields = ['author_id', 'author_uid', 'status', 'full_name', 'description', 'created_by', 'created_at', 'updated_by', 'updated_at'];
  

      
    public function noticeTable()
    {
        $builder = $this->db->table('authors');
        return $builder;
    }

    public function getMaxId()
    {
        return $this->selectMax('author_id')->first();
    }

    public function btn_action()
    {
        $action = function ($row) {
            return '<a  name="edit_author" class="px-3 text-primary edit_author" id="' . $row["author_id"] . '"><i class="uil uil-pen font-size-18"></i></a> <a name="delete_author" class="px-3 text-danger delete_author" id="' . $row["author_id"] . '"><i class="uil uil-trash-alt font-size-18"></i></a>';
            
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

