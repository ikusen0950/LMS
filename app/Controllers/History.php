<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use monken\TablesIgniter;
use App\Models\history_model;
use App\Models\status_model;
use App\Models\book_model;
use App\Models\log_model;

class History extends BaseController
{
   protected $history_model, $book_model, $log_model, $validation;

   public function __construct()
   {
      $this->history_model = new history_model();           
      $this->log_model = new log_model();      
      $this->book_model = new book_model();      
      $this->validation = \Config\Services::validation();
   }

   public function index()
   {
        $status = new status_model;
        $data['status']= $status->orderBy('status', 'ASC')->findAll();

        echo view('layout/header');
        echo view('layout/topbar');
        echo view('layout/sidebar');
        echo view('layout/footer');
        return view('history/index', $data);
   }
         
   
   public function fetch_all()
   {
       $table = new TablesIgniter();
       $table->setTable($this->history_model->noticeTable())
           ->setDefaultOrder('history_id', 'DESC')
           ->setSearch(['history_uid', 'status', 'title', 'created_by', 'updated_by'])
           ->setOrder(['history_uid', 'status', 'title', 'created_by', 'updated_by'])
           ->setOutput(['history_uid', $this->history_model->getStatus(), 'due_date', 'full_name', 'title',$this->history_model->btn_action()]);
       return $table->getDatatable();
   }

   public function getAutoId()
   {
       $maxValId   = $this->history_model->getMaxId();
       $number     = $maxValId['history_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#SI'. sprintf('%08s', $codeCount);
       $msg = [
           'success' => $codeAuto
       ];
       echo json_encode($msg);
   }


   public function add_history()
   {
       $history_uid    = $this->request->getVar('history_uid');       
       $index        = $this->request->getVar('history_index');
       $full_name        = $this->request->getVar('history_full_name');
       $student_uid        = $this->request->getVar('history_student_uid');
       $grade        = $this->request->getVar('history_grade');
       $title        = $this->request->getVar('history_book_title');
       $book_uid        = $this->request->getVar('history_book_uid');
       $isbn        = $this->request->getVar('history_book_isbn');       
       $due_date        = $this->request->getVar('history_due_date');
       

       $valid = $this->validate([
            'history_index' => [
                'rules' => 'required',
                'errors' => [
                    'required'  => 'Please enter a valid index!'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_history_index' => $this->validation->getError('history_index')
                ]
            ];

        } else {

            $data = [
                'history_uid'   => $history_uid,
                'status'        => 'Borrowed',          
                'index'         => $index,           
                'full_name'     => $full_name,           
                'student_uid'   => $student_uid,           
                'grade'         => $grade,           
                'book_uid'      => $book_uid,           
                'isbn'          => $isbn,           
                'title'         => $title,           
                'due_date'      => $due_date,           
                'issue_date'    => date('Y-m-d'),           
                'created_by'    => user()->username,
                'created_at'    => date('Y-m-d H:i:s')
            ];

            
            $maxValId   = $this->log_model->getMaxId();
            $number     = $maxValId['log_id'];
            $codeCount  = ($number + 1);
            $codeAuto   = '#LI'. sprintf('%08s', $codeCount);

            $logdata = [
                'log_uid'   => $codeAuto,
                'username'  => user()->username,
                'action'    => 'Created',
                'message'   => 'History created successfully! History: ' . $full_name,
                // 'details'   => 'INFO:'. 'History #: '  . $history_uid . ' ,Status: ' .$status . ' ,History: ' .$history,
                'logged_at' => date('Y-m-d H:i:s')
                ];
            $this->log_model->save($logdata);

            $this->history_model->save($data);

         

            // Please change this on you is not working
            $book_id   = $this->request->getVar('history_book_id');
            $books = $this->book_model->where('book_id', $book_id)->where('status', 'Available')->findAll();

            $book = $this->book_model->where('book_id', $book_id)->where('status', 'Available')->first();

            if (count($books) == 1) {
            $bookdata = ['status' => 'In Process'];

            $this->book_model->update($book['book_id'], $bookdata);

            // Or you can try this
            // $this->book_model->set($bookdata)->where('book_id', $book['book_id'])->update();
            
            }

            
            $msg = [
                'success' => 'New History <strong>' . $full_name . '</strong> added!'
            ];
        }

        echo json_encode($msg);
    }

   public function fetch_edit()
   {
       $history_id = $this->request->getVar('history_id');

       $result = $this->history_model->find($history_id);

       echo json_encode($result);
   }

   public function update_history()
   {
       $id          = $this->request->getVar('history_id');
       $history_uid    = $this->request->getVar('history_uid');
       $history       = $this->request->getVar('history_name');
       $status      = $this->request->getVar('status');

       $history_rule = $this->history_model->find($id);
       if ($history_rule['history'] == $history) {
           $rule = 'required';
       } else {
           $rule = 'required|is_unique[historys.history]';
       }

       $valid = $this->validate([
           'history_name' => [
               'rules' => $rule,
               'errors' => [
                   'required'  => 'Please enter a valid history name!',
                   'is_unique' => 'History name already exists! Please enter a unique history name.'
               ]
           ]
       ]);

       if (!$valid) {
            $msg = [
                'error' => [
                    'error_history_name_edit' => $this->validation->getError('history_name')
                ]
            ];
        } else {
            $data = [
                'history'         => $history,
                'status'        => $status,
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
                'message'   => 'History updated successfully! History: ' . $history,
                'details'   => 'INFO:'. 'History #: '  . $history_uid . ' ,Status: ' .$status . ' ,History: ' .$history,
                'logged_at' => date('Y-m-d H:i:s')
            ];
            $this->log_model->save($logeditdata);
            
            $this->history_model->update($id, $data);

            

            $msg =  [
                'success' => 'History <strong>' . $history_uid . '</strong> was updated!'

            ];
        }
        echo json_encode($msg);
   }

   public function delete_history()
   {
       $id = $this->request->getVar('history_id');
       $history = $this->history_model->find($id);
       $this->history_model->delete($id);

       $maxValId   = $this->log_model->getMaxId();
       $number     = $maxValId['log_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#LI'. sprintf('%08s', $codeCount);
    

      $deltelogdata = [
       'log_uid'   => $codeAuto,
       'username'  => user()->username,
       'action'    => 'Deleted',
       'message'   => 'History deleted successfully! History: ' . $history['history'],
       'details'   => 'INFO:'. 'History #: '  . $history['history_uid'] . ' ,Status: ' .$history['status'] . ' ,History: ' .$history['history'],
       'logged_at' => date('Y-m-d H:i:s')
       ];
      $this->log_model->save($deltelogdata);

       $msg =  [
        //    "success" => "History " . $history['history_uid'] . " was deleted"
           'success' => 'History <strong>' . $history['history_uid'] . '</strong> was deleted!'

       ];
       echo json_encode($msg);
   }


}  