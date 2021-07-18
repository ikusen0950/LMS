<?php
namespace App\Models;
use CodeIgniter\Model;

class student_model extends Model {

    protected $table = 'students';    
    protected $primaryKey = 'student_id';
    protected $allowedFields = ['student_id','student_uid','index','status','full_name','address','gender','grade','date_of_birth','created_by','created_at','updated_by','updated_at'];
  

      
    public function noticeTable()
    {
        $builder = $this->db->table('students');
        return $builder;
    }

    public function getMaxId()
    {
        return $this->selectMax('student_id')->first();
    }

    public function btn_action()
    {
        $action = function ($row) {
            return '<a  name="edit_student" class="px-3 text-primary edit_student" id="' . $row["student_id"] . '"><i class="uil uil-pen font-size-18"></i></a> <a name="delete_student" class="px-3 text-danger delete_student" id="' . $row["student_id"] . '"><i class="uil uil-trash-alt font-size-18"></i></a>';
            
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

