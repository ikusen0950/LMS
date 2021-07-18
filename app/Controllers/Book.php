<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use monken\TablesIgniter;
use App\Models\book_model;
use App\Models\book_status_model;
use App\Models\log_model;
use App\Models\genre_model;
use App\Models\author_model;
use App\Models\publisher_model;

class Book extends BaseController
{
   protected $book_model, $log_model, $genre_model, $author_model, $publisher_model , $validation;

   public function __construct()
   {
      $this->book_model = new book_model();           
      $this->log_model = new log_model();      
      $this->genre_model = new genre_model();      
      $this->author_model = new author_model();      
      $this->publisher_model = new publisher_model();      
      $this->validation = \Config\Services::validation();
   }

   public function index()
   {
        $book_status = new book_status_model;
        $data['book_status']= $book_status->orderBy('status', 'ASC')->findAll();
        
        $genres = new genre_model;
        $data['genres']= $genres->orderBy('genre', 'ASC')->where('status', 'Active')->findAll();

        $authors = new author_model;
        $data['authors']= $authors->orderBy('full_name', 'ASC')->where('status', 'Active')->findAll();

        $publishers = new publisher_model;
        $data['publishers']= $publishers->orderBy('publisher', 'ASC')->where('status', 'Active')->findAll();


        echo view('layout/header');
        echo view('layout/topbar');
        echo view('layout/sidebar');
        echo view('layout/footer');
        return view('book/index', $data);
   }
         
   
    public function fetch_all()
    {
        $table = new TablesIgniter();
        $table->setTable($this->book_model->noticeTable())
            ->setDefaultOrder('book_id', 'DESC')
            ->setSearch(['book_uid', 'status', 'title', 'author', 'created_by', 'updated_by'])
            ->setOrder(['book_uid', 'status', 'title', 'author', 'created_by', 'updated_by'])
            ->setOutput(['book_uid', $this->book_model->getStatus(), 'title', 'author', 'created_by', 'updated_by', $this->book_model->btn_action()]);   
        return $table->getDatatable();
    }

   public function getAutoId()
   {
       $maxValId   = $this->book_model->getMaxId();
       $number     = $maxValId['book_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#BI'. sprintf('%08s', $codeCount);
       $msg = [
           'success' => $codeAuto
       ];
       echo json_encode($msg);
   }

    // Search Book with suggest typeahead.js
    public function fetch_book_suggest()
    {
        $query = $this->request->getVar('query');

        $result = $this->book_model->like('title', $query)->where('status', 'Available')->get()->getResultArray();

        if (count($result) > 0) {
            foreach ($result as $row) {
            $output[] = $row['title'];
            }
            echo json_encode($output);
        }
    }

    // Search Book By Title
    public function fetch_book_title_single()
    {
        ////////////////////////////////chnage below history to issue??
        $title = $this->request->getVar('issue_book_search');
        $result = $this->book_model->where('title', $title)->first();
        echo json_encode($result);
    }

 

   public function add_book()
   {
       $book_uid        = $this->request->getVar('book_uid');       
       $isbn            = $this->request->getVar('book_isbn');
       $status          = $this->request->getVar('book_status');
       $title           = $this->request->getVar('book_title');
       $description     = $this->request->getVar('book_description');
       $genre           = $this->request->getVar('book_genre');
       $author          = $this->request->getVar('book_author');
       $publisher       = $this->request->getVar('book_publisher');
       $published_date  = $this->request->getVar('book_publisher_date');
       $source          = $this->request->getVar('book_source');

       $valid = $this->validate([
            'book_isbn' => [
                'rules' => 'required|is_unique[books.isbn]',
                'errors' => [
                    'required'  => 'Please enter a valid book ISBN!',                    
                    'is_unique' => 'Book ISBN already exists! Please enter a unique ISBN.'
                ]
            ],
            'book_title' => [
                'rules' => 'required|is_unique[books.title]',
                'errors' => [
                    'required'  => 'Please enter a valid book title!',
                    'is_unique' => 'Book title already exists! Please enter a unique book title.'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_book_isbn' => $this->validation->getError('book_isbn'),
                    'error_book_title' => $this->validation->getError('book_title')
                ]
            ];

        } else {

            $data = [
                'book_uid'        => $book_uid,
                'isbn'            => $isbn,
                'status'          => $status,
                'title'           => $title,
                'description'     => $description,
                'genre'           => $genre,
                'author'          => $author,
                'publisher'       => $publisher,
                'published_date'  => $published_date,
                'source'          => $source,
                'entered_date'    => date('Y-m-d H:i:s'),           
                'created_by'      => user()->username,
                'created_at'      => date('Y-m-d H:i:s')
                
            ];

            
            $maxValId   = $this->log_model->getMaxId();
            $number     = $maxValId['log_id'];
            $codeCount  = ($number + 1);
            $codeAuto   = '#LI'. sprintf('%08s', $codeCount);

            $logdata = [
                'log_uid'   => $codeAuto,
                'username'  => user()->username,
                'action'    => 'Created',
                'message'   => 'Book created successfully! Book: ' . $title,
                'details'   => 'INFO:'. 'Book #: '  . $book_uid . ' ,ISBN: ' .$isbn . ' ,Status: ' .$status . ' ,Title: ' .$title. ' ,Description: ' .$description. ' ,Genre: ' .$genre. ' ,Author: ' .$author. ' ,Publisher: ' .$publisher. ' ,Published_date: ' .$published_date. ' ,Source: ' .$source,
                'logged_at' => date('Y-m-d H:i:s')
                ];
            $this->log_model->save($logdata);

            $this->book_model->save($data);
            
            $msg = [
                'success' => 'New Book <strong>' . $title . '</strong> added!'
            ];
        }

        echo json_encode($msg);
   }

   public function fetch_edit()
   {
       $book_id = $this->request->getVar('book_id');

       $result = $this->book_model->find($book_id);

       echo json_encode($result);
   }

   public function update_book()
   {
        $id              = $this->request->getVar('book_id');
        $book_uid        = $this->request->getVar('book_uid_edit');       
        $isbn            = $this->request->getVar('book_isbn_edit');
        $status          = $this->request->getVar('book_status_edit');
        $title           = $this->request->getVar('book_title_edit');
        $description     = $this->request->getVar('book_description_edit');
        $genre           = $this->request->getVar('book_genre_edit');
        $author          = $this->request->getVar('book_author_edit');
        $publisher       = $this->request->getVar('book_publisher_edit');
        $published_date  = $this->request->getVar('book_publisher_date_edit');
        $source          = $this->request->getVar('book_source_edit');

        $book_rule = $this->book_model->find($id);
        if ($book_rule['isbn'] == $isbn) {   
            $rule = 'required';
        } else {        
            $rule = 'required|is_unique[books.isbn]';     
        }
        if ($book_rule['title'] == $title) {
            $rule1 = 'required';
        } else {
            $rule1 = 'required|is_unique[books.title]';
        }

        $valid = $this->validate([
            'book_isbn_edit' => [
                'rules' => $rule,
                'errors' => [
                    'required'  => 'Please enter a valid book ISBN!',
                    'is_unique' => 'Book ISBN already exists! Please enter a unique ISBN.'
                ]
            ],
            'book_title_edit' => [
                'rules' => $rule1,
                'errors' => [
                    'required'  => 'Please enter a valid book title!',
                    'is_unique' => 'Book title already exists! Please enter a unique book title.'
                ]
            ]
        ]);

       if (!$valid) {
            $msg = [
                'error' => [
                    'error_book_isbn_edit' => $this->validation->getError('book_isbn_edit'),
                    'error_book_title_edit' => $this->validation->getError('book_title_edit')
                ]
            ];
        } else {
            $data = [                
                'isbn'            => $isbn,
                'status'          => $status,
                'title'           => $title,
                'description'     => $description,
                'genre'           => $genre,
                'author'          => $author,
                'publisher'       => $publisher,
                'published_date'  => $published_date,
                'source'          => $source,
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
                'message'   => 'Book updated successfully! Book: ' . $title,
                'details'   => 'INFO:'. 'Book #: '  . $book_uid . ' ,ISBN: ' .$isbn . ' ,Status: ' .$status . ' ,Title: ' .$title. ' ,Description: ' .$description. ' ,Genre: ' .$genre. ' ,Author: ' .$author. ' ,Publisher: ' .$publisher. ' ,Published_date: ' .$published_date. ' ,Source: ' .$source,
                'logged_at' => date('Y-m-d H:i:s')
            ];
            $this->log_model->save($logeditdata);
            
            $this->book_model->update($id, $data);
            $msg =  [
                'success' => 'Book <strong>' . $title . '</strong> was updated!'

            ];
        }
        echo json_encode($msg);
   }

   public function delete_book()
   {
       $id = $this->request->getVar('book_id');
       $book = $this->book_model->find($id);
       $this->book_model->delete($id);

       $maxValId   = $this->log_model->getMaxId();
       $number     = $maxValId['log_id'];
       $codeCount  = ($number + 1);
       $codeAuto   = '#LI'. sprintf('%08s', $codeCount);
    

      $deltelogdata = [
       'log_uid'   => $codeAuto,
       'username'  => user()->username,
       'action'    => 'Deleted',
       'message'   => 'Book deleted successfully! Book: ' . $book['title'],
        'details'   => 'INFO:'. 'Book #: '  . $book['book_uid'] . ' ,ISBN: ' .$book['isbn'] . ' ,Status: ' .$book['status'] . ' ,Title: ' .$book['title']. ' ,Description: ' .$book['description']. ' ,Genre: ' .$book['genre']. ' ,Author: ' .$book['author']. ' ,Publisher: ' .$book['publisher']. ' ,Published_date: ' .$book['published_date']. ' ,Source: ' .$book['source'],
       'logged_at' => date('Y-m-d H:i:s')
       ];
      $this->log_model->save($deltelogdata);

       $msg =  [
        //    "success" => "Book " . $book['book_uid'] . " was deleted"
           'success' => 'Book <strong>' . $book['title'] . '</strong> was deleted!'

       ];
       echo json_encode($msg);
   }


}  