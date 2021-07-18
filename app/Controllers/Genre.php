<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use monken\TablesIgniter;
use App\Models\genre_model;
use App\Models\status_model;
use App\Models\log_model;

class Genre extends BaseController
{
   protected $genre_model, $log_model, $validation;

   public function __construct()
   {
      $this->genre_model = new genre_model();      
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
        return view('genre/index', $data);
   }
         
   
    public function fetch_all()
    {
        $table = new TablesIgniter();
        $table->setTable($this->genre_model->noticeTable())
            ->setDefaultOrder('genre_id', 'DESC')
            ->setSearch(['genre_uid', 'status', 'genre', 'created_by', 'updated_by'])
            ->setOrder(['genre_uid', 'status', 'genre', 'created_by', 'updated_by'])
            ->setOutput(['genre_uid', $this->genre_model->getStatus(), 'genre', 'created_by', 'updated_by', $this->genre_model->btn_action()]);
        return $table->getDatatable();
    }

   public function getAutoId()
   {
       $maxValId   = $this->genre_model->getMaxId();
       $number     = $maxValId['genre_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#GI'. sprintf('%03s', $codeCount);
       $msg = [
           'success' => $codeAuto
       ];
       echo json_encode($msg);
   }

   public function add_genre()
   {
       $genre_uid    = $this->request->getVar('genre_uid');       
       $status   = $this->request->getVar('status');
       $genre        = $this->request->getVar('genre');

       $valid = $this->validate([
            'genre' => [
                'rules' => 'required|is_unique[genres.genre]',
                'errors' => [
                    'required'  => 'Please enter a valid genre name!',
                    'is_unique' => 'Genre name already exists! Please enter a unique genre name.'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_genre_name' => $this->validation->getError('genre')
                ]
            ];

        } else {

            $data = [
                'genre_uid'      => $genre_uid,
                'status'         => $status,
                'genre'          => $genre,           
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
                'message'   => 'Genre created successfully! Genre: ' . $genre,
                'details'   => 'INFO:'. 'Genre #: '  . $genre_uid . ' ,Status: ' .$status . ' ,Genre: ' .$genre,
                'logged_at' => date('Y-m-d H:i:s')
                ];
            $this->log_model->save($logdata);

            $this->genre_model->save($data);
        
            $msg = [
                'success' => 'New Genre <strong>' . $genre . '</strong> added!'
            ];

        }

        echo json_encode($msg);
   }

   public function fetch_edit()
   {
       $genre_id = $this->request->getVar('genre_id');

       $result = $this->genre_model->find($genre_id);

       echo json_encode($result);
   }

   public function update_genre()
   {
       $id          = $this->request->getVar('genre_id');
       $genre_uid    = $this->request->getVar('genre_uid');
       $status      = $this->request->getVar('status');
       $genre       = $this->request->getVar('genre');


       $genre_rule = $this->genre_model->find($id);
       if ($genre_rule['genre'] == $genre) {
           $rule = 'required';
       } else {
           $rule = 'required|is_unique[genres.genre]';
       }

       $valid = $this->validate([
           'genre' => [
               'rules' => $rule,
               'errors' => [
                   'required'  => 'Please enter a valid genre name!',
                   'is_unique' => 'Genre name already exists! Please enter a unique genre name.'
               ]
           ]
       ]);

       if (!$valid) {
            $msg = [
                'error' => [
                    'error_genre_name_edit' => $this->validation->getError('genre')
                ]
            ];
        } else {

            $data = [           
                'status'   => $status,
                'genre'   => $genre,
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
                'message'   => 'Genre updated successfully! Genre: ' . $genre,
                'details'   => 'INFO:'. 'Genre #: '  . $genre_uid . ' ,Status: ' .$status . ' ,Genre: ' .$genre,
                'logged_at' => date('Y-m-d H:i:s')
            ];
            $this->log_model->save($logeditdata);

            $this->genre_model->update($id, $data);
            $msg =  [
                'success' => 'Genre <strong>' . $genre_uid . '</strong> was updated!'

            ];
        }
        echo json_encode($msg);
   }

   public function delete_genre()
   {
       $id = $this->request->getVar('genre_id');
       $genre = $this->genre_model->find($id);
       $this->genre_model->delete($id);

       $maxValId   = $this->log_model->getMaxId();
       $number     = $maxValId['log_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#LI'. sprintf('%08s', $codeCount);
    

      $deltelogdata = [
       'log_uid'   => $codeAuto,
       'username'  => user()->username,
       'action'    => 'Deleted',
       'message'   => 'Genre deleted successfully! Genre: ' . $genre['genre'],
       'details'   => 'INFO:'. 'Genre #: '  . $genre['genre_uid'] . ' ,Status: ' .$genre['status'] . ' ,Genre: ' .$genre['genre'],
       'logged_at' => date('Y-m-d H:i:s')
       ];
      $this->log_model->save($deltelogdata);

       $msg =  [
        //    "success" => "Genre " . $genre['genre_uid'] . " was deleted"
           'success' => 'Genre <strong>' . $genre['genre_uid'] . '</strong> was deleted!'

       ];
       echo json_encode($msg);
   }


}  