<?php

namespace App\Models;

use CodeIgniter\Model;

class issue_model extends Model
{

	protected $table = 'issue';
	protected $primaryKey = 'issue_id';
	protected $allowedFields = ['issue_id', 'issue_uid', 'status', 'student_uid', 'index', 'full_name', 'grade', 'book_id', 'book_uid', 'isbn', 'title', 'issue_date', 'due_date', 'returned_date', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];


	public function noticeTable()
	{
		// $builder = $this->db->table('issue')->where('status', 'borrowed');
		$builder = $this->db->table('issue');
		return $builder;
	}

	public function getMaxId()
	{
		return $this->selectMax('issue_id')->first();
	}

	public function btn_action()
	{
		$action = function ($row) {
			return '<a  name="edit_return" class="px-3 text-success edit_return" id="' . $row["issue_id"] . '" book_id="' . $row['book_id'] . '" data-book="' . $row['book_id'] . '"><i class="uil-check font-size-20"></i></a> <a  name="edit_view" class="px-3 text-warning edit_view" id="' . $row["issue_id"] . '"><i class="uil uil-eye font-size-18"></i></a> <a  name="edit_issue" class="px-3 text-primary edit_issue" id="' . $row["issue_id"] . '"><i class="uil uil-pen font-size-18"></i></a>';
		};
		return $action;
	}

	public function getStatus()
	{
		$issue = function ($row) {
			// if ($row['due_date'] < date('Y-m-d')) {
			// 	return '<span class="badge bg-secondary text-white">Due</span>';
			// }

			// if ($row['status'] == 'Borrowed') {
			// 	return '<span class="badge bg-pill bg-soft-success font-size-12">Borrowed</span>';
			// } elseif ($row['status'] == 'Returned') {
			// 	return '<span class="badge bg-pill bg-soft-warning font-size-12">Returned</span>';
			// } elseif ($row['status'] == 'Not Returned') {
			// 	return '<span class="badge bg-pill bg-soft-danger font-size-12">Not Returned</span>';
			// }

			if ($row['status'] == 'Returned') {
				return '<span class="badge bg-pill bg-soft-warning font-size-12">Returned</span>';
			} else {
				if ($row['due_date'] < date('Y-m-d')) {
					return '<span class="badge bg-secondary text-white">Due</span>';
				} else {
					return '<span class="badge bg-pill bg-soft-danger font-size-12">Not Returned</span>';
				}
			}
		};
		return $issue;
	}
}
