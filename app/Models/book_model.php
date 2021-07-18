<?php
namespace App\Models;
use CodeIgniter\Model;

class book_model extends Model {

    protected $table = 'books';    
    protected $primaryKey = 'book_id';
    protected $allowedFields = ['book_id', 'book_uid', 'isbn', 'status', 'title', 'description', 'genre', 'author', 'publisher', 'published_date', 'entered_date', 'source', 'created_by', 'created_at', 'updated_by', 'updated_at'];
  

      
    public function noticeTable()
    {
        $builder = $this->db->table('books');
        return $builder;
    }

    public function getMaxId()
    {
        return $this->selectMax('book_id')->first();
    }

    public function btn_action()
    {
        $action = function ($row) {
            return '<a  name="edit_book" class="px-3 text-primary edit_book" id="' . $row["book_id"] . '"><i class="uil uil-pen font-size-18"></i></a> <a name="delete_book" class="px-3 text-danger delete_book" id="' . $row["book_id"] . '"><i class="uil uil-trash-alt font-size-18"></i></a>';
            
        };
        return $action;
    }

    public function getStatus()
    {
        $books = function ($row) {
            if ($row['status'] == 'Available') {
                return '<span class="badge bg-pill bg-soft-success font-size-12">Available</span>';
            } elseif ($row['status'] == 'Due') {
                return '<span class="badge bg-pill bg-soft-info font-size-12">Due</span>';
            } elseif ($row['status'] == 'In Process') {
                return '<span class="badge bg-pill bg-soft-primary font-size-12">In Process</span>';
            } elseif ($row['status'] == 'Library Use Only') {
                return '<span class="badge bg-pill bg-soft-secondary font-size-12">Library Use Only</span>';
            } elseif ($row['status'] == 'On Holdshelf') {
                return '<span class="badge bg-pill bg-soft-warning font-size-12">On Holdshelf</span>';
            } elseif ($row['status'] == 'Not Available') {
                return '<span class="badge bg-pill bg-soft-danger font-size-12">Not Available</span>';
            }elseif ($row['status'] == 'Damaged') {
                return '<span class="badge bg-pill bg-soft-danger font-size-12">Damaged</span>';
            }elseif ($row['status'] == 'Missing') {
                return '<span class="badge bg-pill bg-soft-danger font-size-12">Missing</span>';
            }elseif ($row['status'] == 'Lost') {
                return '<span class="badge bg-pill bg-soft-danger font-size-12">Lost</span>';
            }
        };
        return $books;
    }
   
}

