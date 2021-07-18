<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use monken\TablesIgniter;
use App\Models\publisher_model;
use App\Models\status_model;
use App\Models\log_model;

class Publisher extends BaseController
{
   protected $publisher_model, $log_model, $validation;

   public function __construct()
   {
      $this->publisher_model = new publisher_model();      
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
        return view('publisher/index', $data);
   }
         
   
    public function fetch_all()
    {
        $table = new TablesIgniter();
        $table->setTable($this->publisher_model->noticeTable())
            ->setDefaultOrder('publisher_id', 'DESC')
            ->setSearch(['publisher_uid', 'status', 'publisher', 'created_by', 'updated_by'])
            ->setOrder(['publisher_uid', 'status', 'publisher', 'created_by', 'updated_by'])
            ->setOutput(['publisher_uid', $this->publisher_model->getStatus(), 'publisher', 'created_by', 'updated_by', $this->publisher_model->btn_action()]);
        return $table->getDatatable();
    }

   public function getAutoId()
   {
       $maxValId   = $this->publisher_model->getMaxId();
       $number     = $maxValId['publisher_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#PI'. sprintf('%03s', $codeCount);
       $msg = [
           'success' => $codeAuto
       ];
       echo json_encode($msg);
   }

   public function add_publisher()
   {
       $publisher_uid    = $this->request->getVar('publisher_uid');       
       $status   = $this->request->getVar('status');
       $publisher        = $this->request->getVar('publisher');

       $valid = $this->validate([
            'publisher' => [
                'rules' => 'required|is_unique[publishers.publisher]',
                'errors' => [
                    'required'  => 'Please enter a valid publisher name!',
                    'is_unique' => 'Publisher name already exists! Please enter a unique publisher name.'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_publisher_name' => $this->validation->getError('publisher')
                ]
            ];

        } else {

            $data = [
                'publisher_uid'     => $publisher_uid,
                'status'         => $status,
                'publisher'     => $publisher,           
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
                'message'   => 'Publisher created successfully! Publisher: ' . $publisher,
                'details'   => 'INFO:'. 'Publisher #: '  . $publisher_uid . ' ,Status: ' .$status . ' ,Publisher: ' .$publisher,
                'logged_at' => date('Y-m-d H:i:s')
                ];
            $this->log_model->save($logdata);

            $this->publisher_model->save($data);

            $msg = [
                'success' => 'New Publisher <strong>' . $publisher . '</strong> added!'
            ];
        }
        
        echo json_encode($msg);
   }

   public function fetch_edit()
   {
       $publisher_id = $this->request->getVar('publisher_id');

       $result = $this->publisher_model->find($publisher_id);

       echo json_encode($result);
   }

   public function update_publisher()
   {
       $id           = $this->request->getVar('publisher_id');
       $publisher_uid    = $this->request->getVar('publisher_uid');
       $status   = $this->request->getVar('status');
       $publisher   = $this->request->getVar('publisher_name');


       $publisher_rule = $this->publisher_model->find($id);
        if ($publisher_rule['publisher'] == $publisher) {
            $rule = 'required';
        } else {
            $rule = 'required|is_unique[publishers.publisher]';
        }

        $valid = $this->validate([
            'publisher_name' => [
                'rules' => $rule,
                'errors' => [
                    'required'  => 'Please enter a valid publisher name!',
                    'is_unique' => 'Publisher name already exists! Please enter a unique publisher name.'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_publisher_name_edit' => $this->validation->getError('publisher_name')
                ]
            ];
        } else {

        $data = [           
            'status'   => $status,
            'publisher'   => $publisher,
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
            'message'   => 'Publisher updated successfully! Publisher: ' . $publisher,
            'details'   => 'INFO:'. 'Publisher #: '  . $publisher_uid . ' ,Status: ' .$status . ' ,Publisher: ' .$publisher,
            'logged_at' => date('Y-m-d H:i:s')
        ];
        $this->log_model->save($logeditdata);

        $this->publisher_model->update($id, $data);
        $msg =  [
            'success' => 'Publisher <strong>' . $publisher_uid . '</strong> was updated!'

        ];
        }
        echo json_encode($msg);
   }

   public function delete_publisher()
   {
       $id = $this->request->getVar('publisher_id');
       $publisher = $this->publisher_model->find($id);
       $this->publisher_model->delete($id);

       $maxValId   = $this->log_model->getMaxId();
       $number     = $maxValId['log_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#LI'. sprintf('%08s', $codeCount);
    

      $deltelogdata = [
       'log_uid'   => $codeAuto,
       'username'  => user()->username,
       'action'    => 'Deleted',
       'message'   => 'Publisher deleted successfully! Publisher: ' . $publisher['publisher'],
       'details'   => 'INFO:'. 'Publisher #: '  . $publisher['publisher_uid'] . ' ,Status: ' .$publisher['status'] . ' ,Publisher: ' .$publisher['publisher'],
       'logged_at' => date('Y-m-d H:i:s')
       ];
      $this->log_model->save($deltelogdata);

       $msg =  [
        //    "success" => "Publisher " . $publisher['publisher_uid'] . " was deleted"
           'success' => 'Publisher <strong>' . $publisher['publisher_uid'] . '</strong> was deleted!'

       ];
       echo json_encode($msg);
   }


}  