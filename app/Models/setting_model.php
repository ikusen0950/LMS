<?php
namespace App\Models;
use CodeIgniter\Model;

class setting_model extends Model {

    protected $table = 'setting';    
    protected $primaryKey = 'setting_id';
    protected $allowedFields = ['setting_id','setting_uid','setting','description','created_by','created_at','updated_by','updated_at'];
  
    // protected $table = 'tbl_product';
    // protected $primaryKey = 'product_id';
    // protected $allowedFields = ['product_id', 'product_uid', 'product_name', 'quantity', 'setting', 'created_by', 'updated_by'];


      
    public function noticeTable()
    {
        $builder = $this->db->table('setting');
        return $builder;
    }

    public function getMaxId()
    {
        return $this->selectMax('setting_id')->first();
    }

    public function btn_action()
    {
        $action = function ($row) {
            return '<a  name="edit_setting" class="px-3 text-primary edit_setting" id="' . $row["setting_id"] . '"><i class="uil uil-pen font-size-18"></i></a> <a name="delete_setting" class="px-3 text-danger delete_setting" id="' . $row["setting_id"] . '"><i class="uil uil-trash-alt font-size-18"></i></a>';
            
        };
        return $action;
    }

    public function getStatus()
    {
        $setting = function ($row) {
            if ($row['setting'] == 'Active') {
                return '<span class="badge bg-pill bg-soft-success font-size-12">Active</span>';
            } else {
                return '<span class="badge bg-pill bg-soft-danger font-size-12">Inactive</span>';
            }
        };
        return $setting;
    }
   
}

