<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use monken\TablesIgniter;
use App\Models\student_model;
use App\Models\grade_model;
use App\Models\status_model;
use App\Models\log_model;

class Student extends BaseController
{
   protected $student_model, $log_model, $validation;

   public function __construct()
   {
      $this->student_model = new student_model();
      $this->log_model = new log_model();      
      $this->validation = \Config\Services::validation();
   }

   public function index()
   {
        $status = new status_model;
        $data['status']= $status->orderBy('status', 'ASC')->findAll();

        $grades = new grade_model;
        $data['grades']= $grades->orderBy('grade', 'ASC')->findAll();

        echo view('layout/header');
        echo view('layout/topbar');
        echo view('layout/sidebar');
        echo view('layout/footer');
        return view('student/index', $data);
   }

   public function fetch_student_index()
   {
        ////////////////////////////////chnage below history to issue??
       $num = $this->request->getVar('issue_index');

       $result = $this->student_model->where('index', $num)->first();

       echo json_encode($result);
   } 
   
    public function fetch_all()
    {
        $table = new TablesIgniter();
        $table->setTable($this->student_model->noticeTable())
            ->setDefaultOrder('student_id', 'DESC')
            ->setSearch(['student_uid', 'status', 'index', 'full_name', 'grade', 'created_by', 'updated_by'])
            ->setOrder(['student_uid', 'status','index', 'full_name', 'grade', 'created_by', 'updated_by'])
            ->setOutput(['student_uid', 'index',$this->student_model->getStatus(), 'full_name', 'grade', 'created_by', 'updated_by', $this->student_model->btn_action()]);
        return $table->getDatatable();
    }

   public function getAutoId()
   {
       $maxValId   = $this->student_model->getMaxId();
       $number     = $maxValId['student_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#SI'. sprintf('%05s', $codeCount);
       $msg = [
           'success' => $codeAuto
       ];
       echo json_encode($msg);
   }


   public function add_student()
   {
       $student_uid    = $this->request->getVar('student_uid');       
       $status   = $this->request->getVar('status');
       $index   = $this->request->getVar('index');
       $full_name        = $this->request->getVar('full_name');
       $grade        = $this->request->getVar('grade');
       $gender        = $this->request->getVar('gender');
       $date_of_birth        = $this->request->getVar('date_of_birth');
       $address        = $this->request->getVar('address');
    

   
       $valid = $this->validate([
            'index' => [
                'rules' => 'required|is_unique[students.index]',
                'errors' => [
                    'required'  => 'Please enter a valid index!',
                    'is_unique' => 'Index number already exists! Please enter a unique index number.'
                ]
            ],
            'full_name' => [
                'rules' => 'required[students.full_name]',
                'errors' => [
                    'required'  => 'Please enter a valid name!'
                ]
            ],
            'grade' => [
                'rules' => 'required[students.grade]',
                'errors' => [
                    'required'  => 'Please select a valid grade!'
                ]
            ],
            'gender' => [
                'rules' => 'required[students.gender]',
                'errors' => [
                    'required'  => 'Please select a valid grade!'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_student_index' => $this->validation->getError('index'),                
                    'error_student_full_name' => $this->validation->getError('full_name'),                
                    'error_student_grade' => $this->validation->getError('grade'),                
                    'error_student_gender' => $this->validation->getError('gender')
                ]
            ];
        } else {

            $data = [
                'student_uid'    => $student_uid,
                'status'         => $status,
                'index'          => $index,
                'full_name'      => $full_name,           
                'grade'          => $grade,           
                'gender'         => $gender,           
                'date_of_birth'  => $date_of_birth,           
                'address'        => $address,           
                'created_by'     => user()->username,
                'created_at'     => date('Y-m-d H:i:s')
            ];

            

            // Save Activity Log
            // $log_uid     = $this->request->getVar('log_uid');
            $maxValId   = $this->log_model->getMaxId();
            $number     = $maxValId['log_id'];
            $codeCount  = ($number + 1);
            $codeAuto   = '#LI'. sprintf('%08s', $codeCount);

            $logdata = [
                // 'log_uid'   => $log_uid,
                'log_uid'   => $codeAuto,
                'username' => user()->username,
                'action'    => 'Created',
                'message'   => 'Student created successfully! Student: ' . $full_name,
                'details'   => 'INFO:'. 'Student #: '  . $student_uid . ' ,Status: ' .$status . ' ,Index: ' .$index . ' ,Full Name: '.$full_name . ' ,Grade: '.$grade . ' ,Gender: '.$gender . ' ,Date of Birth: '.$date_of_birth . ' ,Address: '.$address,
                'logged_at'     => date('Y-m-d H:i:s')
                ];
            $this->log_model->save($logdata);
            // End Save Activity Log

            $this->student_model->save($data);   

            $msg = [
                'success' => 'New Student <strong>' . $full_name . '</strong> added!'
            ];
            
        }   
        echo json_encode($msg);  
    }

   public function fetch_edit()
   {
       $student_id = $this->request->getVar('student_id');

       $result = $this->student_model->find($student_id);

       echo json_encode($result);
   }

    public function update_student()
    {

               
        $id            = $this->request->getVar('student_id');
        $student_id    = $this->request->getVar('student_uid');
        $status        = $this->request->getVar('status');
        $index         = $this->request->getVar('index_edit');
        $full_name     = $this->request->getVar('full_name_edit');
        $grade         = $this->request->getVar('grade_edit');
        $gender        = $this->request->getVar('gender_edit');
        $date_of_birth = $this->request->getVar('date_of_birth_edit');
        $address       = $this->request->getVar('address_edit');

        $students = $this->student_model->find($id);
        if ($students['index'] == $index) {
            $rule = 'required';
        } else {
            $rule = 'required|is_unique[students.index]';
        }
        
        $valid = $this->validate([
            'index_edit' => [
                'rules' => $rule,
                'errors' => [
                    'required'  => 'Please enter a valid index!',
                    'is_unique' => 'Index number already exists! Please enter a unique index number.'
                ]
            ],
            'full_name_edit' => [
                'rules' => 'required[students.full_name]',
                'errors' => [
                    'required'  => 'Please enter a valid name!'
                ]
            ],
            'grade_edit' => [
                'rules' => 'required[students.grade]',
                'errors' => [
                    'required'  => 'Please select a valid grade!'
                ]
            ],
            'gender_edit' => [
                'rules' => 'required[students.gender]',
                'errors' => [
                    'required'  => 'Please select a valid grade!'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_student_index_edit'      => $this->validation->getError('index_edit'),                
                    'error_student_full_name_edit'  => $this->validation->getError('full_name_edit'),                
                    'error_student_grade_edit'      => $this->validation->getError('grade_edit'),                
                    'error_student_gender_edit'     => $this->validation->getError('gender_edit')
                ]
            ];
        } else {

            $data = [                        
                'status'        => $status,
                'index'         => $index,
                'full_name'     => $full_name,
                'grade'         => $grade,
                'gender'        => $gender,
                'date_of_birth' => $date_of_birth,
                'address'       => $address,
                'updated_by'    => user()->username,
                'updated_at'    => date('Y-m-d H:i:s')
            ];

            $this->student_model->update($id, $data);

            

            // Save Activity Log
            // $log_uid_edit     = $this->request->getVar('log_uid');

            $maxValId   = $this->log_model->getMaxId();
            $number     = $maxValId['log_id'];
            $codeCount  = ($number + 1);
            $codeAuto   = '#LI'. sprintf('%08s', $codeCount);

            $logeditdata = [
                // 'log_uid'   => $log_uid_edit,
                'log_uid'   => $codeAuto,
                'username'  =>  user()->username,
                'action'    => 'Updated',
                'message'   => 'Student updated successfully! Student: ' . $full_name,
                'details'   => 'INFO:'. 'Student #: '  . $student_id . ' ,Status: ' .$status . ' ,Index: ' .$index . ' ,Full Name: '.$full_name . ' ,Grade: '.$grade . ' ,Gender: '.$gender . ' ,Date of Birth: '.$date_of_birth . ' ,Address: '.$address,
                'logged_at'     => date('Y-m-d H:i:s')
                ];
            $this->log_model->save($logeditdata);
            // End Save Activity Log

            $msg =  [
                'success' => 'Student <strong>' . $student_id . '</strong> was updated!'

            ];
        }

        echo json_encode($msg);    
        
    }

   public function delete_student()
   {
       $id = $this->request->getVar('student_id');
       $student = $this->student_model->find($id);
       $this->student_model->delete($id);    
        

       // Save Activity Log

        $maxValId   = $this->log_model->getMaxId();
        $number     = $maxValId['log_id'];
        $codeCount  = ($number + 1);
        $codeAuto   = '#LI'. sprintf('%08s', $codeCount);
     

       $deltelogdata = [
        'log_uid'   => $codeAuto,
        'username'  => user()->username,
        'action'    => 'Deleted',
        'message'   => 'Student deleted successfully! Student: ' . $student['full_name'],
        'details'   => 'INFO:'. 'Student #: '  . $student['student_uid'] . ' ,Status: ' .$student['status'] . ' ,Index: ' .$student['index'] . ' ,Full Name: '.$student['full_name'] . ' ,Grade: '.$student['grade'] . ' ,Gender: '.$student['gender'] . ' ,Date of Birth: '.$student['date_of_birth'] . ' ,Address: '.$student['address'],
        'logged_at' => date('Y-m-d H:i:s')
        ];
       $this->log_model->save($deltelogdata);
       // End Save Activity Log

       $msg =  [
        //    "success" => "Student " . $student['student_uid'] . " was deleted"
           'success' => 'Student <strong>' . $student['student_uid'] . '</strong> was deleted!'

       ];
       echo json_encode($msg);
   }


}  