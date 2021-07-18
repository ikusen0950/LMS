<?php
namespace App\Models;
use CodeIgniter\Model;

class book_status_model extends Model {

    protected $table = 'book_status';    
    protected $primaryKey = 'book_status_id';
    protected $allowedFields = ['book_status_id','book_status_uid','status','description','created_by','created_at','updated_by','updated_at'];
  
    // protected $table = 'tbl_product';
    // protected $primaryKey = 'product_id';
    // protected $allowedFields = ['product_id', 'product_uid', 'product_name', 'quantity', 'book_status', 'created_by', 'updated_by'];


      
    public function noticeTable()
    {
        $builder = $this->db->table('book_status');
        return $builder;
    }

    public function getMaxId()
    {
        return $this->selectMax('book_status_id')->first();
    }

    public function btn_action()
    {
        $action = function ($row) {
            return '<a  name="edit_book_status" class="px-3 text-primary edit_book_status" id="' . $row["book_status_id"] . '"><i class="uil uil-pen font-size-18"></i></a> <a name="delete_book_status" class="px-3 text-danger delete_book_status" id="' . $row["book_status_id"] . '"><i class="uil uil-trash-alt font-size-18"></i></a>';
            
        };
        return $action;
    }

    public function getBookStatus()
    {
        $book_status = function ($row) {
            if ($row['status'] == 'Active') {
                return '<span class="badge bg-pill bg-soft-success font-size-12">Active</span>';
            } else {
                return '<span class="badge bg-pill bg-soft-danger font-size-12">Inactive</span>';
            }
        };
        return $book_status;
    }
   
}

