<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use monken\TablesIgniter;
use App\Models\book_status_model;
use App\Models\log_model;

class BookStatus extends BaseController
{
   protected $book_status_model, $log_model, $validation;

   public function __construct()
   {
      $this->book_status_model = new book_status_model();
      $this->log_model = new log_model();      
      $this->validation = \Config\Services::validation();
   }

   public function index()
   {
      echo view('layout/header');
      echo view('layout/topbar');
      echo view('layout/sidebar');
      echo view('layout/footer');
      return view('bookstatus/index');
   }
         
   
    public function fetch_all()
    {
        $table = new TablesIgniter();
        $table->setTable($this->book_status_model->noticeTable())
            ->setDefaultOrder('book_status_id', 'DESC')
            ->setSearch(['book_status_uid', 'status', 'description', 'created_by', 'updated_by'])
            ->setOrder(['book_status_uid', 'status', 'description', 'created_by', 'updated_by'])
            ->setOutput(['book_status_uid', 'status', 'description', 'created_by', 'updated_by', $this->book_status_model->btn_action()]);
        return $table->getDatatable();
    }

   public function getAutoId()
   {
       $maxValId   = $this->book_status_model->getMaxId();
       $number     = $maxValId['book_status_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#BSI'. sprintf('%03s', $codeCount);
       $msg = [
           'success' => $codeAuto
       ];
       echo json_encode($msg);
   }

   public function add_book_status()
   {
       $book_status_uid    = $this->request->getVar('book_status_uid');
       $book_status        = $this->request->getVar('book_status_name');
       $description   = $this->request->getVar('description');

       $valid = $this->validate([
            'book_status_name' => [
                'rules' => 'required|is_unique[book_status.status]',
                'errors' => [
                    'required'  => 'Please enter a valid book_status name!',
                    'is_unique' => 'Book Status name already exists! Please enter a unique book_status name.'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_book_status_name' => $this->validation->getError('book_status_name')
                ]
            ];

        } else {

            $data = [
                'book_status_uid'  => $book_status_uid,
                'status'      => $book_status,
                'description' => $description,
                'created_by'  => user()->username,
                'created_at'  => date('Y-m-d H:i:s')
            ];

            $maxValId   = $this->log_model->getMaxId();
            $number     = $maxValId['log_id'];
            $codeCount  = ($number + 1);
            $codeAuto   = '#LI'. sprintf('%08s', $codeCount);

            $logdata = [
                'log_uid'   => $codeAuto,
                'username'  => user()->username,
                'action'    => 'Created',
                'message'   => 'Book Status created successfully! Book Status: ' . $book_status,
                'details'   => 'INFO:'. 'Book Status #: '  . $book_status_uid . ' ,Book Status: ' .$book_status . ' ,Description: ' .$description,
                'logged_at' => date('Y-m-d H:i:s')
                ];
            $this->log_model->save($logdata);

            $this->book_status_model->save($data);


            $msg = [
                'success' => 'New Book Status <strong>' . $book_status . '</strong> added!'
            ];

        }       
       
       echo json_encode($msg);
   }

   public function fetch_edit()
   {
       $book_status_id = $this->request->getVar('book_status_id');

       $result = $this->book_status_model->find($book_status_id);

       echo json_encode($result);
   }

   public function update_book_status()
   {
        $id           = $this->request->getVar('book_status_id');
        $book_status_uid    = $this->request->getVar('book_status_uid');
        $book_status       = $this->request->getVar('book_status_name');
        $description  = $this->request->getVar('description');

        $book_status_rule = $this->book_status_model->find($id);
        if ($book_status_rule['status'] == $book_status) {
            $rule = 'required';
        } else {
            $rule = 'required|is_unique[book_status.status]';
        }

        $valid = $this->validate([
            'book_status_name' => [
                'rules' => $rule,
                'errors' => [
                    'required'  => 'Please enter a valid book status name!',
                    'is_unique' => 'Book status name already exists! Please enter a unique book status name.'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_book_status_name_edit' => $this->validation->getError('book_status_name')
                ]
            ];
        } else {

        $data = [
            'status'        => $book_status,
            'description'   => $description,
            'updated_by'    => user()->username,
            'updated_at'    => date('Y-m-d H:i:s')
        ];

        $maxValId   = $this->log_model->getMaxId();
        $number     = $maxValId['log_id'];
        $codeCount  = ($number + 1);
        $codeAuto   = '#LI'. sprintf('%08s', $codeCount);

        $logeditdata = [
            'log_uid'   => $codeAuto,
            'username'  => user()->username,
            'action'    => 'Updated',
            'message'   => 'Book Status updated successfully! Book Status: ' . $book_status,
            'details'   => 'INFO:'. 'Book Status #: '  . $book_status_uid . ' ,Book Status: ' .$book_status . ' ,Description: ' .$description,
            'logged_at' => date('Y-m-d H:i:s')
        ];
        $this->log_model->save($logeditdata);

        $this->book_status_model->update($id, $data);
        $msg =  [
            'success' => 'Book Status <strong>' . $book_status_uid . '</strong> was updated!'

        ];
    }
    echo json_encode($msg);

   }

   public function delete_book_status()
   {
       $id = $this->request->getVar('book_status_id');
       $book_status = $this->book_status_model->find($id);
       $this->book_status_model->delete($id);

        $maxValId   = $this->log_model->getMaxId();
        $number     = $maxValId['log_id'];
        $codeCount  = ($number + 1);
        $codeAuto   = '#LI'. sprintf('%08s', $codeCount);
     

       $deltelogdata = [
        'log_uid'   => $codeAuto,
        'username'  => user()->username,
        'action'    => 'Deleted',
        'message'   => 'Student deleted successfully! Book Status: ' . $book_status['status'],
        'details'   => 'INFO:'. 'Student #: '  . $book_status['book_status_uid'] . ' ,Book Status: ' .$book_status['status'] . ' ,Description: ' .$book_status['description'],
        'logged_at' => date('Y-m-d H:i:s')
        ];
       $this->log_model->save($deltelogdata);

       $msg =  [
        //    "success" => "Book Status " . $book_status['book_status_uid'] . " was deleted"
           'success' => 'Book Status <strong>' . $book_status['book_status_uid'] . '</strong> was deleted!'

       ];
       echo json_encode($msg);
   }


}  