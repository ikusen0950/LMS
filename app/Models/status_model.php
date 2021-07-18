<?php
namespace App\Models;
use CodeIgniter\Model;

class status_model extends Model {

    protected $table = 'status';    
    protected $primaryKey = 'status_id';
    protected $allowedFields = ['status_id','status_uid','status','description','created_by','created_at','updated_by','updated_at'];
  
    // protected $table = 'tbl_product';
    // protected $primaryKey = 'product_id';
    // protected $allowedFields = ['product_id', 'product_uid', 'product_name', 'quantity', 'status', 'created_by', 'updated_by'];


      
    public function noticeTable()
    {
        $builder = $this->db->table('status');
        return $builder;
    }

    public function getMaxId()
    {
        return $this->selectMax('status_id')->first();
    }

    public function btn_action()
    {
        $action = function ($row) {
            return '<a  name="edit_status" class="px-3 text-primary edit_status" id="' . $row["status_id"] . '"><i class="uil uil-pen font-size-18"></i></a> <a name="delete_status" class="px-3 text-danger delete_status" id="' . $row["status_id"] . '"><i class="uil uil-trash-alt font-size-18"></i></a>';
            
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

