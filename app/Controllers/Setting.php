<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use monken\TablesIgniter;
use App\Models\setting_model;
use App\Models\log_model;

class Setting extends BaseController
{
   protected $setting_model, $log_model, $validation;

   public function __construct()
   {
      $this->setting_model = new setting_model();
      $this->log_model = new log_model();      
      $this->validation = \Config\Services::validation();
   }

   public function index()
   {
      echo view('layout/header');
      echo view('layout/topbar');
      echo view('layout/sidebar');
      echo view('layout/footer');
      return view('setting/index');
   }
         
   
    public function fetch_all()
    {
        $table = new TablesIgniter();
        $table->setTable($this->setting_model->noticeTable())
            ->setDefaultOrder('setting_id', 'DESC')
            ->setSearch(['setting_uid', 'setting', 'description', 'created_by', 'updated_by'])
            ->setOrder(['setting_uid', 'setting', 'description', 'created_by', 'updated_by'])
            ->setOutput(['setting_uid', 'setting', 'description', 'created_by', 'updated_by', $this->setting_model->btn_action()]);
        return $table->getDatatable();
    }

   public function getAutoId()
   {
       $maxValId   = $this->setting_model->getMaxId();
       $number     = $maxValId['setting_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#SI'. sprintf('%03s', $codeCount);
       $msg = [
           'success' => $codeAuto
       ];
       echo json_encode($msg);
   }

   public function add_setting()
   {
       $setting_uid    = $this->request->getVar('setting_uid');
       $setting        = $this->request->getVar('setting_name');
       $description   = $this->request->getVar('description');

       $valid = $this->validate([
            'setting_name' => [
                'rules' => 'required|is_unique[setting.setting]',
                'errors' => [
                    'required'  => 'Please enter a valid setting name!',
                    'is_unique' => 'Setting name already exists! Please enter a unique setting name.'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_setting_name' => $this->validation->getError('setting_name')
                ]
            ];

        } else {

            $data = [
                'setting_uid'  => $setting_uid,
                'setting'      => $setting,
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
                'message'   => 'Setting created successfully! Setting: ' . $setting,
                'details'   => 'INFO:'. 'Setting #: '  . $setting_uid . ' ,Setting: ' .$setting . ' ,Description: ' .$description,
                'logged_at' => date('Y-m-d H:i:s')
                ];
            $this->log_model->save($logdata);

            $this->setting_model->save($data);


            $msg = [
                'success' => 'New Setting <strong>' . $setting . '</strong> added!'
            ];

        }       
       
       echo json_encode($msg);
   }

   public function fetch_edit()
   {
       $setting_id = $this->request->getVar('setting_id');

       $result = $this->setting_model->find($setting_id);

       echo json_encode($result);
   }

   public function update_setting()
   {
        $id           = $this->request->getVar('setting_id');
        $setting_uid    = $this->request->getVar('setting_uid');
        $setting       = $this->request->getVar('setting_name');
        $description  = $this->request->getVar('description');

        $setting_rule = $this->setting_model->find($id);
        if ($setting_rule['setting'] == $setting) {
            $rule = 'required';
        } else {
            $rule = 'required|is_unique[setting.setting]';
        }

        $valid = $this->validate([
            'setting_name' => [
                'rules' => $rule,
                'errors' => [
                    'required'  => 'Please enter a valid setting name!',
                    'is_unique' => 'Setting name already exists! Please enter a unique setting name.'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_setting_name_edit' => $this->validation->getError('setting_name')
                ]
            ];
        } else {

        $data = [
            'setting'        => $setting,
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
            'message'   => 'Setting updated successfully! Setting: ' . $setting,
            'details'   => 'INFO:'. 'Setting #: '  . $setting_uid . ' ,Setting: ' .$setting . ' ,Description: ' .$description,
            'logged_at' => date('Y-m-d H:i:s')
        ];
        $this->log_model->save($logeditdata);

        $this->setting_model->update($id, $data);
        $msg =  [
            'success' => 'Setting <strong>' . $setting_uid . '</strong> was updated!'

        ];
    }
    echo json_encode($msg);

   }

   public function delete_setting()
   {
       $id = $this->request->getVar('setting_id');
       $setting = $this->setting_model->find($id);
       $this->setting_model->delete($id);

        $maxValId   = $this->log_model->getMaxId();
        $number     = $maxValId['log_id'];
        $codeCount  = ($number + 1);
        $codeAuto   = '#LI'. sprintf('%08s', $codeCount);
     

       $deltelogdata = [
        'log_uid'   => $codeAuto,
        'username'  => user()->username,
        'action'    => 'Deleted',
        'message'   => 'Student deleted successfully! Setting: ' . $setting['setting'],
        'details'   => 'INFO:'. 'Student #: '  . $setting['setting_uid'] . ' ,Setting: ' .$setting['setting'] . ' ,Description: ' .$setting['description'],
        'logged_at' => date('Y-m-d H:i:s')
        ];
       $this->log_model->save($deltelogdata);

       $msg =  [
        //    "success" => "Setting " . $setting['setting_uid'] . " was deleted"
           'success' => 'Setting <strong>' . $setting['setting_uid'] . '</strong> was deleted!'

       ];
       echo json_encode($msg);
   }


}  