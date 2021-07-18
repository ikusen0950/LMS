<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use monken\TablesIgniter;
use App\Models\issue_model;
use App\Models\status_model;
use App\Models\log_model;
use App\Models\book_model;
use App\Models\student_model;

class Issue extends BaseController
{
   protected $issue_model, $log_model, $book_model, $validation;

   public function __construct()
   {
      $this->issue_model = new issue_model();           
      $this->log_model = new log_model();      
      $this->log_model = new book_model();      
      $this->validation = \Config\Services::validation();
   }

   public function index()
   {
        $status = new status_model;
        $data['status']= $status->orderBy('status', 'ASC')->findAll();

        $books = new book_model;
        $data['books']= $books->orderBy('title', 'ASC')->where('status', 'Available')->findAll();

        echo view('layout/header');
        echo view('layout/topbar');
        echo view('layout/sidebar');
        echo view('layout/footer');
        return view('issue/index', $data);
   }
         
   
    public function fetch_all()
    {
        $table = new TablesIgniter();
        $table->setTable($this->issue_model->noticeTable())
            ->setDefaultOrder('issue_id', 'DESC')
            ->setSearch(['issue_uid', 'status', 'issue', 'created_by', 'updated_by'])
            ->setOrder(['issue_uid', 'status', 'issue', 'created_by', 'updated_by'])
            ->setOutput(['issue_uid', $this->issue_model->getStatus(), 'due_date', 'full_name', 'title',$this->issue_model->btn_action()]);
        return $table->getDatatable();
    }

   public function getAutoId()
   {
       $maxValId   = $this->issue_model->getMaxId();
       $number     = $maxValId['issue_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#SI'. sprintf('%08s', $codeCount);
       $msg = [
           'success' => $codeAuto
       ];
       echo json_encode($msg);
   }

 

   public function add_issue()
   {
       $issue_uid    = $this->request->getVar('issue_uid');  
    //    $index        = $this->request->getVar('issue_index');
    //    $student_uid  = $this->request->getVar('issue_student_uid');
    //    $full_name    = $this->request->getVar('issue_full_name');
    //    $grade        = $this->request->getVar('issue_grade');
    //    $book_uid     = $this->request->getVar('issue_book_uid');
    //    $isbn         = $this->request->getVar('issue_book_isbn');
    //    $title        = $this->request->getVar('issue_book_title');
    //    $due_date     = $this->request->getVar('issue_due_date');

       $valid = $this->validate([
            'issue_index' => [
                'rules' => 'required[issue.index]',
                'errors' => [
                    'required'  => 'Please enter a valid index!']
            ],
            'issue_full_name' => [
                'rules' => 'required[issue.full_name]',
                'errors' => [
                    'required'  => 'Please enter a valid name!'
                ]
            ],
            'issue_student_uid' => [
                'rules' => 'required[issue.student_uid]',
                'errors' => [
                    'required'  => 'Please enter a valid student #!'
                ]
            ],
            'issue_book_search' => [
                'rules' => 'required[issue.title]',
                'errors' => [
                    'required'  => 'Please select a valid title!'
                ]
            ],
            'issue_grade' => [
                'rules' => 'required[issue.grade]',
                'errors' => [
                    'required'  => 'Please select a valid grade!'
                ]
            ],
            'issue_due_date' => [
                'rules' => 'required[issue.due_date]',
                'errors' => [
                    'required'  => 'Please select a valid due date!'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_issue_index' => $this->validation->getError('issue_index'),
                    'error_issue_full_name' => $this->validation->getError('issue_full_name'),
                    'error_issue_student_id' => $this->validation->getError('issue_student_uid'),
                    'error_issue_grade' => $this->validation->getError('issue_grade'),
                    'error_issue_issue_book_search' => $this->validation->getError('issue_book_search')
                ]
            ];

        } else {

            $data = [
                'issue_uid'     => $issue_uid,
                // 'index'         => $index,
                // 'student_uid'   => $student_uid,
                // 'full_name'     => $full_name,
                // 'grade'         => $grade,
                // 'book_uid'      => $book_uid,
                // 'isbn'          => $isbn,
                // 'title'         => $title,
                // 'due_date'      => $due_date
                // 'status'        => 'Borrowed',
                // 'issue_date'    => date('Y-m-d'),           
                // 'created_by'    => user()->username,
                // 'created_at'    => date('Y-m-d H:i:s')
            ];

            // $Bookdata = [
            //     'status'        => 'In Process'
            // ];
            // $this->book_model->update($book_fetch['book_uid'], $Bookdata);
            
            // $maxValId   = $this->log_model->getMaxId();
            // $number     = $maxValId['log_id'];
            // $codeCount  = ($number + 1);
            // $codeAuto   = '#LI'. sprintf('%08s', $codeCount);

            // $logdata = [
            //     'log_uid'   => $codeAuto,
            //     'username'  => user()->username,
            //     'action'    => 'Created',
            //     'message'   => 'Book issued successfully! Book: ' . $title,
            //     // 'details'   => 'INFO:'. 'Issue #: '  . $issue_uid . ' ,Status: In Process ,Issue: ' .$issue,
            //     'logged_at' => date('Y-m-d H:i:s')
            //     ];
            // $this->log_model->save($logdata);

            $this->issue_model->save($data);
            
            // $msg = [
            //     // 'success' => 'New Issue <strong>' . $issue_uid . '</strong> added!'
            // ];
        }

        // echo json_encode($msg);
   }

   public function fetch_edit()
   {
       $issue_id = $this->request->getVar('issue_id');

       $result = $this->issue_model->find($issue_id);

       echo json_encode($result);
   }

   public function fetch_student()
   {
       $issue_id = $this->request->getVar('issue_id');

       $result = $this->issue_model->find($issue_id);

       echo json_encode($result);
   }

   public function update_issue()
   {
       $id          = $this->request->getVar('issue_id');
       $issue_uid    = $this->request->getVar('issue_uid');
       $issue       = $this->request->getVar('issue_name');
       $status      = $this->request->getVar('status');

       $issue_rule = $this->issue_model->find($id);
       if ($issue_rule['issue'] == $issue) {
           $rule = 'required';
       } else {
           $rule = 'required|is_unique[issues.issue]';
       }

       $valid = $this->validate([
           'issue_name' => [
               'rules' => $rule,
               'errors' => [
                   'required'  => 'Please enter a valid issue name!',
                   'is_unique' => 'Issue name already exists! Please enter a unique issue name.'
               ]
           ]
       ]);

       if (!$valid) {
            $msg = [
                'error' => [
                    'error_issue_name_edit' => $this->validation->getError('issue_name')
                ]
            ];
        } else {
            $data = [
                'issue'         => $issue,
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
                'message'   => 'Issue updated successfully! Issue: ' . $issue,
                'details'   => 'INFO:'. 'Issue #: '  . $issue_uid . ' ,Status: ' .$status . ' ,Issue: ' .$issue,
                'logged_at' => date('Y-m-d H:i:s')
            ];
            $this->log_model->save($logeditdata);
            
            $this->issue_model->update($id, $data);
            $msg =  [
                'success' => 'Issue <strong>' . $issue_uid . '</strong> was updated!'

            ];
        }
        echo json_encode($msg);
   }

   public function delete_issue()
   {
       $id = $this->request->getVar('issue_id');
       $issue = $this->issue_model->find($id);
       $this->issue_model->delete($id);

       $maxValId   = $this->log_model->getMaxId();
       $number     = $maxValId['log_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#LI'. sprintf('%08s', $codeCount);
    

      $deltelogdata = [
       'log_uid'   => $codeAuto,
       'username'  => user()->username,
       'action'    => 'Deleted',
       'message'   => 'Issue deleted successfully! Issue: ' . $issue['issue'],
       'details'   => 'INFO:'. 'Issue #: '  . $issue['issue_uid'] . ' ,Status: ' .$issue['status'] . ' ,Issue: ' .$issue['issue'],
       'logged_at' => date('Y-m-d H:i:s')
       ];
      $this->log_model->save($deltelogdata);

       $msg =  [
        //    "success" => "Issue " . $issue['issue_uid'] . " was deleted"
           'success' => 'Issue <strong>' . $issue['issue_uid'] . '</strong> was deleted!'

       ];
       echo json_encode($msg);
   }


}  