<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use monken\TablesIgniter;
use App\Models\log_model;
use App\Models\status_model;

class Log extends BaseController
{
   protected $log_model;

   public function __construct()
   {
      $this->log_model = new log_model();
   }

   public function index()
   {

        echo view('layout/header');
        echo view('layout/topbar');
        echo view('layout/sidebar');
        echo view('layout/footer');
        return view('log/index');
   }
         
   
    public function fetch_all()
    {
        $table = new TablesIgniter();
        $table->setTable($this->log_model->noticeTable())
            ->setDefaultOrder('log_id', 'DESC')
            ->setSearch(['log_uid', 'action', 'message', 'username', 'logged_at'])
            ->setOrder(['log_uid', 'action', 'message', 'username', 'logged_at'])
            ->setOutput(['log_uid', $this->log_model->action(), 'message', 'username', 'logged_at']);
        return $table->getDatatable();
    }

   public function getAutoLogId()
   {
       $maxValId   = $this->log_model->getMaxId();
       $number     = $maxValId['log_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#LI'. sprintf('%08s', $codeCount);
       $msg = [
           'success' => $codeAuto
       ];
       echo json_encode($msg);
   }

   public function add_log()
   {
       $log_uid    = $this->request->getVar('log_uid');       
       $status   = $this->request->getVar('status');
       $log        = $this->request->getVar('log_name');

       $data = [
           'log_uid'  => $log_uid,
           'status'     => $status,
           'log'      => $log,           
           'created_by'  => user()->username,
           'created_at'  => date('Y-m-d H:i:s')
       ];
       $this->log_model->save($data);
    //    $data = ['log'=>'Log Inserted Successfully'];
    //    return $this->response->setJSON($data);
       $msg = [
           'success' => 'New Log <strong>' . $log . '</strong> added!'
       ];
       echo json_encode($msg);
   }

   

   public function delete_log()
   {
       $id = $this->request->getVar('log_id');
       $log = $this->log_model->find($id);
       $this->log_model->delete($id);

       $msg =  [
        //    "success" => "Log " . $log['log_uid'] . " was deleted"
           'success' => 'Log <strong>' . $log['log_uid'] . '</strong> was deleted!'

       ];
       echo json_encode($msg);
   }


}  