<?php
namespace App\Models;
use CodeIgniter\Model;

class publisher_model extends Model {

    protected $table = 'publishers';    
    protected $primaryKey = 'publisher_id';
    protected $allowedFields = ['publisher_id','publisher_uid','status', 'publisher','created_by','created_at','updated_by','updated_at'];
  

      
    public function noticeTable()
    {
        $builder = $this->db->table('publishers');
        return $builder;
    }

    public function getMaxId()
    {
        return $this->selectMax('publisher_id')->first();
    }

    public function btn_action()
    {
        $action = function ($row) {
            return '<a  name="edit_publisher" class="px-3 text-primary edit_publisher" id="' . $row["publisher_id"] . '"><i class="uil uil-pen font-size-18"></i></a> <a name="delete_publisher" class="px-3 text-danger delete_publisher" id="' . $row["publisher_id"] . '"><i class="uil uil-trash-alt font-size-18"></i></a>';
            
        };
        return $action;
    }

    public function getStatus()
    {
        $publishers = function ($row) {
            if ($row['status'] == 'Active') {
                return '<span class="badge bg-pill bg-soft-success font-size-12">Active</span>';
            } else {
                return '<span class="badge bg-pill bg-soft-danger font-size-12">Inactive</span>';
            }
        };
        return $publishers;
    }
   
}

