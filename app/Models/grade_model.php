<?php
namespace App\Models;
use CodeIgniter\Model;

class grade_model extends Model {

    protected $table = 'grades';    
    protected $primaryKey = 'grade_id';
    protected $allowedFields = ['grade_id','grade_uid','status', 'grade','created_by','created_at','updated_by','updated_at'];
  

      
    public function noticeTable()
    {
        $builder = $this->db->table('grades');
        return $builder;
    }

    public function getMaxId()
    {
        return $this->selectMax('grade_id')->first();
    }

    public function btn_action()
    {
        $action = function ($row) {
            return '<a  name="edit_grade" class="px-3 text-primary edit_grade" id="' . $row["grade_id"] . '"><i class="uil uil-pen font-size-18"></i></a> <a name="delete_grade" class="px-3 text-danger delete_grade" id="' . $row["grade_id"] . '"><i class="uil uil-trash-alt font-size-18"></i></a>';
            
        };
        return $action;
    }

    public function getStatus()
    {
        $grades = function ($row) {
            if ($row['status'] == 'Active') {
                return '<span class="badge bg-pill bg-soft-success font-size-12">Active</span>';
            } else {
                return '<span class="badge bg-pill bg-soft-danger font-size-12">Inactive</span>';
            }
        };
        return $grades;
    }
   
}

