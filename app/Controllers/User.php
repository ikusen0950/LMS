<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use monken\TablesIgniter;
use App\Models\user_model;
use App\Models\log_model;

class User extends BaseController
{
   protected $user_model, $log_model, $validation;

   public function __construct()
   {
      $this->user_model = new user_model();
      $this->log_model = new log_model();      
      $this->validation = \Config\Services::validation();
   }

   public function index()
   {
      echo view('layout/header');
      echo view('layout/topbar');
      echo view('layout/sidebar');
      echo view('layout/footer');
      return view('user/index');
   }
         
   
    public function fetch_all()
    {
        $table = new TablesIgniter();
        $table->setTable($this->user_model->noticeTable())
            ->setDefaultOrder('id', 'DESC')
            ->setSearch(['users_uid', 'status', 'first_name', 'last_name', 'created_by', 'updated_by'])
            ->setOrder(['users_uid', 'status', 'first_name', 'last_name', 'created_by', 'updated_by'])
            ->setOutput(['users_uid', $this->user_model->getStatus(), $this->user_model->profile_image(),'first_name', 'last_name', $this->user_model->role(), 'created_by', 'updated_by', $this->user_model->btn_action()]);
            // ->setOutput(['users_uid', 'status', $this->user_model->profile_image(), 'first_name', 'last_name', $this->user_model->role(), 'created_by', 'updated_by', $this->user_model->btn_action()]);
        return $table->getDatatable();
    }

   public function getAutoId()
   {
       $maxValId   = $this->user_model->getMaxId();
       $number     = $maxValId['user_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#SI'. sprintf('%03s', $codeCount);
       $msg = [
           'success' => $codeAuto
       ];
       echo json_encode($msg);
   }

   public function add_user()
   {
       $user_uid    = $this->request->getVar('user_uid');
       $user        = $this->request->getVar('user_name');
       $description   = $this->request->getVar('description');

       $valid = $this->validate([
            'user_name' => [
                'rules' => 'required|is_unique[user.user]',
                'errors' => [
                    'required'  => 'Please enter a valid user name!',
                    'is_unique' => 'User name already exists! Please enter a unique user name.'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_user_name' => $this->validation->getError('user_name')
                ]
            ];

        } else {

            $data = [
                'user_uid'  => $user_uid,
                'user'      => $user,
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
                'message'   => 'User created successfully! User: ' . $user,
                'details'   => 'INFO:'. 'User #: '  . $user_uid . ' ,User: ' .$user . ' ,Description: ' .$description,
                'logged_at' => date('Y-m-d H:i:s')
                ];
            $this->log_model->save($logdata);

            $this->user_model->save($data);


            $msg = [
                'success' => 'New User <strong>' . $user . '</strong> added!'
            ];

        }       
       
       echo json_encode($msg);
   }

   public function fetch_edit()
   {
       $user_id = $this->request->getVar('user_id');

       $result = $this->user_model->find($user_id);

       echo json_encode($result);
   }

   public function update_user()
   {
        $id           = $this->request->getVar('user_id');
        $user_uid    = $this->request->getVar('user_uid');
        $user       = $this->request->getVar('user_name');
        $description  = $this->request->getVar('description');

        $user_rule = $this->user_model->find($id);
        if ($user_rule['user'] == $user) {
            $rule = 'required';
        } else {
            $rule = 'required|is_unique[user.user]';
        }

        $valid = $this->validate([
            'user_name' => [
                'rules' => $rule,
                'errors' => [
                    'required'  => 'Please enter a valid user name!',
                    'is_unique' => 'User name already exists! Please enter a unique user name.'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_user_name_edit' => $this->validation->getError('user_name')
                ]
            ];
        } else {

        $data = [
            'user'        => $user,
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
            'message'   => 'User updated successfully! User: ' . $user,
            'details'   => 'INFO:'. 'User #: '  . $user_uid . ' ,User: ' .$user . ' ,Description: ' .$description,
            'logged_at' => date('Y-m-d H:i:s')
        ];
        $this->log_model->save($logeditdata);

        $this->user_model->update($id, $data);
        $msg =  [
            'success' => 'User <strong>' . $user_uid . '</strong> was updated!'

        ];
    }
    echo json_encode($msg);

   }

   public function delete_user()
   {
       $id = $this->request->getVar('user_id');
       $user = $this->user_model->find($id);
       $this->user_model->delete($id);

        $maxValId   = $this->log_model->getMaxId();
        $number     = $maxValId['log_id'];
        $codeCount  = ($number + 1);
        $codeAuto   = '#LI'. sprintf('%08s', $codeCount);
     

       $deltelogdata = [
        'log_uid'   => $codeAuto,
        'username'  => user()->username,
        'action'    => 'Deleted',
        'message'   => 'Student deleted successfully! User: ' . $user['user'],
        'details'   => 'INFO:'. 'Student #: '  . $user['user_uid'] . ' ,User: ' .$user['user'] . ' ,Description: ' .$user['description'],
        'logged_at' => date('Y-m-d H:i:s')
        ];
       $this->log_model->save($deltelogdata);

       $msg =  [
        //    "success" => "User " . $user['user_uid'] . " was deleted"
           'success' => 'User <strong>' . $user['user_uid'] . '</strong> was deleted!'

       ];
       echo json_encode($msg);
   }


}  