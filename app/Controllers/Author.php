<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use monken\TablesIgniter;
use App\Models\author_model;
use App\Models\status_model;
use App\Models\log_model;

class Author extends BaseController
{
   protected $author_model, $log_model, $validation;

   public function __construct()
   {
      $this->author_model = new author_model();
      $this->log_model = new log_model();      
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
        return view('author/index', $data);
   }
         
   
    public function fetch_all()
    {
        $table = new TablesIgniter();
        $table->setTable($this->author_model->noticeTable())
            ->setDefaultOrder('author_id', 'DESC')
            ->setSearch(['author_uid', 'status', 'full_name', 'created_by', 'updated_by'])
            ->setOrder(['author_uid', 'status', 'full_name', 'created_by', 'updated_by'])
            ->setOutput(['author_uid', $this->author_model->getStatus(), 'full_name', 'created_by', 'updated_by', $this->author_model->btn_action()]);
        return $table->getDatatable();
    }

   public function getAutoId()
   {
       $maxValId   = $this->author_model->getMaxId();
       $number     = $maxValId['author_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#AI'. sprintf('%04s', $codeCount);
       $msg = [
           'success' => $codeAuto
       ];
       echo json_encode($msg);
   }

   public function add_author()
   {
       $author_uid    = $this->request->getVar('author_uid');       
       $status        = $this->request->getVar('status_add');
       $full_name     = $this->request->getVar('full_name');
       $description   = $this->request->getVar('description');

       $valid = $this->validate([
            'full_name' => [
                'rules' => 'required|is_unique[authors.full_name]',
                'errors' => [
                    'required'  => 'Please enter a valid author name!',
                    'is_unique' => 'Author name already exists! Please enter a unique author name.'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_author_name' => $this->validation->getError('full_name')
                ]
            ];

        } else {

            $data = [
                'author_uid'     => $author_uid,
                'status'         => $status,
                'full_name'      => $full_name,
                'description'    => $description,           
                'created_by'     => user()->username,
                'created_at'     => date('Y-m-d H:i:s')
            ];

            $maxValId   = $this->log_model->getMaxId();
            $number     = $maxValId['log_id'];
            $codeCount  = ($number + 1);
            $codeAuto   = '#LI'. sprintf('%08s', $codeCount);

            $logdata = [
                'log_uid'   => $codeAuto,
                'username'  => user()->username,
                'action'    => 'Created',
                'message'   => 'Author created successfully! Author: ' . $full_name,
                'details'   => 'INFO:'. 'Author #: '  . $author_uid . ' ,Status: ' .$status . ' ,Full Name: ' .$full_name .' ,Description: ' .$description,
                'logged_at' => date('Y-m-d H:i:s')
                ];
            $this->log_model->save($logdata);

            $this->author_model->save($data);

            $msg = [
                'success' => 'New Author <strong>' . $full_name . '</strong> added!'
            ];
        }
        echo json_encode($msg);
   }

   public function fetch_edit()
   {
       $author_id = $this->request->getVar('author_id');

       $result = $this->author_model->find($author_id);

       echo json_encode($result);
   }

   public function update_author()
   {
        $id           = $this->request->getVar('author_id');
        $author_uid    = $this->request->getVar('author_uid');
        $status       = $this->request->getVar('status_edit');
        $full_name    = $this->request->getVar('full_name_edit');
        $description  = $this->request->getVar('description');

        $author_rule = $this->author_model->find($id);
        if ($author_rule['full_name'] == $full_name) {
            $rule = 'required';
        } else {
            $rule = 'required|is_unique[authors.full_name]';
        }

        $valid = $this->validate([
            'full_name_edit' => [
                'rules' => $rule,
                'errors' => [
                    'required'  => 'Please enter a valid author name!',
                    'is_unique' => 'Author name already exists! Please enter a unique author name.'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_author_full_name_edit' => $this->validation->getError('full_name_edit')
                ]
            ];
        } else {

            $data = [           
                'status'        => $status,
                'full_name'     => $full_name,
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
                'message'   => 'Author updated successfully! Author: ' . $full_name,
                'details'   => 'INFO:'. 'Author #: '  . $author_uid . ' ,Status: ' .$status . ' ,Full Name: ' .$full_name .' ,Description: ' .$description,
                'logged_at' => date('Y-m-d H:i:s')
                ];
            $this->log_model->save($logeditdata);

            $this->author_model->update($id, $data);
            $msg =  [
                'success' => 'Author <strong>' . $full_name . '</strong> was updated!'

            ];
        }

        echo json_encode($msg);
   }

   public function delete_author()
   {
       $id = $this->request->getVar('author_id');
       $author = $this->author_model->find($id);
       $this->author_model->delete($id);

       
       $maxValId   = $this->log_model->getMaxId();
       $number     = $maxValId['log_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#LI'. sprintf('%08s', $codeCount);
    

       $deltelogdata = [
        'log_uid'   => $codeAuto,
        'username'  => user()->username,
        'action'    => 'Deleted',
        'message'   => 'Author deleted successfully! Author: ' . $author['full_name'],
        'details'   => 'INFO:'. 'Author #: '  . $author['author_uid'] . ' ,Status: ' .$author['status'] . ' ,Full Name: ' .$author['full_name'] .' ,Description: ' .$author['description'],
        'logged_at' => date('Y-m-d H:i:s')
       ];
       
       $this->log_model->save($deltelogdata);

       $msg =  [
        //    "success" => "Author " . $author['author_uid'] . " was deleted"
           'success' => 'Author <strong>' . $author['full_name'] . '</strong> was deleted!'

       ];
       echo json_encode($msg);
   }


}  