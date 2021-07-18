<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use monken\TablesIgniter;
use App\Models\status_model;
use App\Models\log_model;

class Status extends BaseController
{
   protected $status_model, $log_model, $validation;

   public function __construct()
   {
      $this->status_model = new status_model();
      $this->log_model = new log_model();      
      $this->validation = \Config\Services::validation();
   }

   public function index()
   {
      echo view('layout/header');
      echo view('layout/topbar');
      echo view('layout/sidebar');
      echo view('layout/footer');
      return view('status/index');
   }
         
   
    public function fetch_all()
    {
        $table = new TablesIgniter();
        $table->setTable($this->status_model->noticeTable())
            ->setDefaultOrder('status_id', 'DESC')
            ->setSearch(['status_uid', 'status', 'description', 'created_by', 'updated_by'])
            ->setOrder(['status_uid', 'status', 'description', 'created_by', 'updated_by'])
            ->setOutput(['status_uid', 'status', 'description', 'created_by', 'updated_by', $this->status_model->btn_action()]);
        return $table->getDatatable();
    }

   public function getAutoId()
   {
       $maxValId   = $this->status_model->getMaxId();
       $number     = $maxValId['status_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#SI'. sprintf('%03s', $codeCount);
       $msg = [
           'success' => $codeAuto
       ];
       echo json_encode($msg);
   }

   public function add_status()
   {
       $status_uid    = $this->request->getVar('status_uid');
       $status        = $this->request->getVar('status_name');
       $description   = $this->request->getVar('description');

       $valid = $this->validate([
            'status_name' => [
                'rules' => 'required|is_unique[status.status]',
                'errors' => [
                    'required'  => 'Please enter a valid status name!',
                    'is_unique' => 'Status name already exists! Please enter a unique status name.'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_status_name' => $this->validation->getError('status_name')
                ]
            ];

        } else {

            $data = [
                'status_uid'  => $status_uid,
                'status'      => $status,
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
                'message'   => 'Status created successfully! Status: ' . $status,
                'details'   => 'INFO:'. 'Status #: '  . $status_uid . ' ,Status: ' .$status . ' ,Description: ' .$description,
                'logged_at' => date('Y-m-d H:i:s')
                ];
            $this->log_model->save($logdata);

            $this->status_model->save($data);


            $msg = [
                'success' => 'New Status <strong>' . $status . '</strong> added!'
            ];

        }       
       
       echo json_encode($msg);
   }

   public function fetch_edit()
   {
       $status_id = $this->request->getVar('status_id');

       $result = $this->status_model->find($status_id);

       echo json_encode($result);
   }

   public function update_status()
   {
        $id           = $this->request->getVar('status_id');
        $status_uid    = $this->request->getVar('status_uid');
        $status       = $this->request->getVar('status_name');
        $description  = $this->request->getVar('description');

        $status_rule = $this->status_model->find($id);
        if ($status_rule['status'] == $status) {
            $rule = 'required';
        } else {
            $rule = 'required|is_unique[status.status]';
        }

        $valid = $this->validate([
            'status_name' => [
                'rules' => $rule,
                'errors' => [
                    'required'  => 'Please enter a valid status name!',
                    'is_unique' => 'Status name already exists! Please enter a unique status name.'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_status_name_edit' => $this->validation->getError('status_name')
                ]
            ];
        } else {

        $data = [
            'status'        => $status,
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
            'message'   => 'Status updated successfully! Status: ' . $status,
            'details'   => 'INFO:'. 'Status #: '  . $status_uid . ' ,Status: ' .$status . ' ,Description: ' .$description,
            'logged_at' => date('Y-m-d H:i:s')
        ];
        $this->log_model->save($logeditdata);

        $this->status_model->update($id, $data);
        $msg =  [
            'success' => 'Status <strong>' . $status_uid . '</strong> was updated!'

        ];
    }
    echo json_encode($msg);

   }

   public function delete_status()
   {
       $id = $this->request->getVar('status_id');
       $status = $this->status_model->find($id);
       $this->status_model->delete($id);

        $maxValId   = $this->log_model->getMaxId();
        $number     = $maxValId['log_id'];
        $codeCount  = ($number + 1);
        $codeAuto   = '#LI'. sprintf('%08s', $codeCount);
     

       $deltelogdata = [
        'log_uid'   => $codeAuto,
        'username'  => user()->username,
        'action'    => 'Deleted',
        'message'   => 'Student deleted successfully! Status: ' . $status['status'],
        'details'   => 'INFO:'. 'Student #: '  . $status['status_uid'] . ' ,Status: ' .$status['status'] . ' ,Description: ' .$status['description'],
        'logged_at' => date('Y-m-d H:i:s')
        ];
       $this->log_model->save($deltelogdata);

       $msg =  [
        //    "success" => "Status " . $status['status_uid'] . " was deleted"
           'success' => 'Status <strong>' . $status['status_uid'] . '</strong> was deleted!'

       ];
       echo json_encode($msg);
   }


}  