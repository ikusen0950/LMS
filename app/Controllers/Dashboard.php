<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use monken\TablesIgniter;
use App\Models\grade_model;
use App\Models\status_model;
use App\Models\log_model;
use App\Models\book_model;

class Dashboard extends BaseController
{
		protected $grade_model, $log_model, $validation;

		public function __construct()
		{
			$this->grade_model = new grade_model();           
			$this->log_model = new log_model();      
			$this->book_model = new book_model();      
			$this->status_model = new status_model();      
			$this->validation = \Config\Services::validation();
		}
		public function index()
		{
		

		$data = [
			'total_students' => count($this->status_model->findAll()),
			'total_available_books' => count($this->book_model->where('status', 'Available')->findAll()),
			'total_due_books' => count($this->book_model->where('status', 'Due')->findAll()),
			'total_library_use_only_books' => count($this->book_model->where('status', 'Library Use Only')->findAll()),
			'total_in_process_books' => count($this->book_model->where('status', 'In Process')->findAll())

		];
	

		echo view('layout/header');
		echo view('layout/topbar');
		echo view('layout/sidebar');
		echo view('layout/footer');
		return view('dashboard', $data);

	}

}
