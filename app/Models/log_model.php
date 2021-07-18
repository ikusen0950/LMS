<?php
namespace App\Models;
use CodeIgniter\Model;

class log_model extends Model {

    protected $table = 'logs';    
    protected $primaryKey = 'log_id';
    protected $allowedFields = ['log_id', 'log_uid', 'action', 'message', 'details', 'username', 'logged_at'];    
  

      
    public function noticeTable()
    {
        $builder = $this->db->table('logs');
        return $builder;
    }

    public function getMaxId()
    {
        return $this->selectMax('log_id')->first();
    }

    public function btn_action()
    {
        $action = function ($row) {
            return '<a  name="edit_log" class="px-3 text-primary edit_log" id="' . $row["log_id"] . '"><i class="uil uil-pen font-size-18"></i></a> <a name="delete_log" class="px-3 text-danger delete_log" id="' . $row["log_id"] . '"><i class="uil uil-trash-alt font-size-18"></i></a>';
            
        };
        return $action;
    }

    public function getStatus()
    {
        $logs = function ($row) {
            if ($row['status'] == 'Active') {
                return '<span class="badge bg-pill bg-soft-success font-size-12">Active</span>';
            } else {
                return '<span class="badge bg-pill bg-soft-danger font-size-12">Inactive</span>';
            }
        };
        return $logs;
    }

    public function action()
    {
        $action = function ($row) {
            if ($row['action'] == 'Created') {
                return '<span class="badge bg-pill bg-soft-success font-size-12">Created</span>';
            } else if ($row['action'] == 'Updated') {
                return '<span class="badge bg-pill bg-soft-warning font-size-12">Updated</span>';
            } else if ($row['action'] == 'Deleted') {
                return '<span class="badge bg-pill bg-soft-danger font-size-12">Deleted</span>';
            } else if ($row['action'] == 'Issued') {
                return '<span class="badge bg-pill bg-soft-info font-size-12">Issued</span>';
            } else {
                return '<span class="badge bg-pill bg-soft-danger font-size-12">Error Logged</span>';
            }
        };
        return $action;
    }
   
}

