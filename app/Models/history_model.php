<?php
namespace App\Models;
use CodeIgniter\Model;

class history_model extends Model {

    protected $table = 'history';    
    protected $primaryKey = 'history_id';
    protected $allowedFields = ['history_id', 'history_uid', 'status', 'student_uid', 'index', 'full_name', 'grade', 'book_uid', 'isbn', 'title', 'issue_date', 'due_date', 'returned_date', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];
    

      
    public function noticeTable()
    {
        $builder = $this->db->table('history')->where('status', 'borrowed');
        return $builder;
    }

    public function getMaxId()
    {
        return $this->selectMax('history_id')->first();
    }

    public function btn_action()
    {
        $action = function ($row) {
            return '<a  name="edit_history" class="px-3 text-primary edit_history" id="' . $row["history_id"] . '"><i class="uil uil-pen font-size-18"></i></a> <a name="delete_history" class="px-3 text-danger delete_history" id="' . $row["history_id"] . '"><i class="uil uil-trash-alt font-size-18"></i></a>';
            
        };
        return $action;
    }

    public function getStatus()
    {
        $issue = function ($row) {
            if ($row['status'] == 'Borrowed') {                
                return '<span class="badge bg-pill bg-soft-success font-size-12">Borrowed</span>';
            } elseif ($row['status'] == 'Returned') {
                return '<span class="badge bg-pill bg-soft-warning font-size-12">Returned</span>';
            } elseif ($row['status'] == 'Not Returned') {
                return '<span class="badge bg-pill bg-soft-danger font-size-12">Not Returned</span>';
            }
        };
        return $issue;
    }
   
}

