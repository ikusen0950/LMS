<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use monken\TablesIgniter;
use App\Models\grade_model;
use App\Models\status_model;
use App\Models\log_model;

class Grade extends BaseController
{
   protected $grade_model, $log_model, $validation;

   public function __construct()
   {
      $this->grade_model = new grade_model();           
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
        return view('grade/index', $data);
   }
         
   
    public function fetch_all()
    {
        $table = new TablesIgniter();
        $table->setTable($this->grade_model->noticeTable())
            ->setDefaultOrder('grade_id', 'DESC')
            ->setSearch(['grade_uid', 'status', 'grade', 'created_by', 'updated_by'])
            ->setOrder(['grade_uid', 'status', 'grade', 'created_by', 'updated_by'])
            ->setOutput(['grade_uid', $this->grade_model->getStatus(), 'grade', 'created_by', 'updated_by', $this->grade_model->btn_action()]);
        return $table->getDatatable();
    }

   public function getAutoId()
   {
       $maxValId   = $this->grade_model->getMaxId();
       $number     = $maxValId['grade_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#GI'. sprintf('%03s', $codeCount);
       $msg = [
           'success' => $codeAuto
       ];
       echo json_encode($msg);
   }

   public function add_grade()
   {
       $grade_uid    = $this->request->getVar('grade_uid');       
       $status   = $this->request->getVar('status');
       $grade        = $this->request->getVar('grade_name');

       $valid = $this->validate([
            'grade_name' => [
                'rules' => 'required|is_unique[grades.grade]',
                'errors' => [
                    'required'  => 'Please enter a valid grade name!',
                    'is_unique' => 'Grade name already exists! Please enter a unique grade name.'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_grade_name' => $this->validation->getError('grade_name')
                ]
            ];

        } else {

            $data = [
                'grade_uid'  => $grade_uid,
                'status'     => $status,
                'grade'      => $grade,           
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
                'message'   => 'Grade created successfully! Grade: ' . $grade,
                'details'   => 'INFO:'. 'Grade #: '  . $grade_uid . ' ,Status: ' .$status . ' ,Grade: ' .$grade,
                'logged_at' => date('Y-m-d H:i:s')
                ];
            $this->log_model->save($logdata);

            $this->grade_model->save($data);
            
            $msg = [
                'success' => 'New Grade <strong>' . $grade . '</strong> added!'
            ];
        }

        echo json_encode($msg);
   }

   public function fetch_edit()
   {
       $grade_id = $this->request->getVar('grade_id');

       $result = $this->grade_model->find($grade_id);

       echo json_encode($result);
   }

   public function update_grade()
   {
       $id          = $this->request->getVar('grade_id');
       $grade_uid    = $this->request->getVar('grade_uid');
       $grade       = $this->request->getVar('grade_name');
       $status      = $this->request->getVar('status');

       $grade_rule = $this->grade_model->find($id);
       if ($grade_rule['grade'] == $grade) {
           $rule = 'required';
       } else {
           $rule = 'required|is_unique[grades.grade]';
       }

       $valid = $this->validate([
           'grade_name' => [
               'rules' => $rule,
               'errors' => [
                   'required'  => 'Please enter a valid grade name!',
                   'is_unique' => 'Grade name already exists! Please enter a unique grade name.'
               ]
           ]
       ]);

       if (!$valid) {
            $msg = [
                'error' => [
                    'error_grade_name_edit' => $this->validation->getError('grade_name')
                ]
            ];
        } else {
            $data = [
                'grade'         => $grade,
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
                'message'   => 'Grade updated successfully! Grade: ' . $grade,
                'details'   => 'INFO:'. 'Grade #: '  . $grade_uid . ' ,Status: ' .$status . ' ,Grade: ' .$grade,
                'logged_at' => date('Y-m-d H:i:s')
            ];
            $this->log_model->save($logeditdata);
            
            $this->grade_model->update($id, $data);
            $msg =  [
                'success' => 'Grade <strong>' . $grade_uid . '</strong> was updated!'

            ];
        }
        echo json_encode($msg);
   }

   public function delete_grade()
   {
       $id = $this->request->getVar('grade_id');
       $grade = $this->grade_model->find($id);
       $this->grade_model->delete($id);

       $maxValId   = $this->log_model->getMaxId();
       $number     = $maxValId['log_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#LI'. sprintf('%08s', $codeCount);
    

      $deltelogdata = [
       'log_uid'   => $codeAuto,
       'username'  => user()->username,
       'action'    => 'Deleted',
       'message'   => 'Grade deleted successfully! Grade: ' . $grade['grade'],
       'details'   => 'INFO:'. 'Grade #: '  . $grade['grade_uid'] . ' ,Status: ' .$grade['status'] . ' ,Grade: ' .$grade['grade'],
       'logged_at' => date('Y-m-d H:i:s')
       ];
      $this->log_model->save($deltelogdata);

       $msg =  [
        //    "success" => "Grade " . $grade['grade_uid'] . " was deleted"
           'success' => 'Grade <strong>' . $grade['grade_uid'] . '</strong> was deleted!'

       ];
       echo json_encode($msg);
   }


}  