<?php

namespace App\Controllers;

use App\Models\profile_model;

class Profile extends BaseController
{
    protected  $profileModel, $db, $builderProfile;

    public function __construct()
    {
        $this->profileModel = new profile_model();
        $this->db = \Config\Database::connect();
        $this->builderProfile = $this->db->table('users');
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $user = $this->profileModel->getDataAll(user()->id);
        $data = [
            'title' => 'My Profile',
            'user' => $user,
        ];
        echo view('layout/header');
		echo view('layout/topbar');
		echo view('layout/sidebar');
		echo view('layout/footer');
        return view('profile/index', $data);
    }

    public function fetch_single()
    {
        $user = $this->profileModel->getDataAll(user()->id);
        $data = [
            'title' => 'My Profile',
            'user' => $user,
        ];
        $msg = [
            'data' => view('profile/fetch_card_profile', $data)
        ];

        echo json_encode($msg);
    }

    public function fetch_edit()
    {
        $user_id = $this->request->getVar('user_id');

        $result = $this->profileModel->getDataAll($user_id);

        echo json_encode($result);
    }

    public function update_user()
    {
        $id = $this->request->getVar('id');
        $useremail = $this->profileModel->getUser($id);

        // Email Condition
        if ($useremail['email'] == $this->request->getVar('email')) {
            $email_rules = 'required|valid_email';
        } else {
            $email_rules = 'required|valid_email|is_unique[users.email]';
        }

        // Profile Condition
        if ($useremail['username'] == $this->request->getVar('username')) {
            $username_rules = 'required';
        } else {
            $username_rules = 'required|is_unique[users.username]';
        }

        $valid = $this->validate([
            'username' => [
                'rules' => $username_rules,
                'errors' => [
                    'required' => 'Input is required',
                    'is_unique' => 'Profilename cannot be same other user'
                ]
            ],
            'email' => [
                'rules' => $email_rules,
                'errors' => [
                    'required' => 'Input is required',
                    'valid_email' => 'Input must email',
                    'is_unique' => 'Email cannot be same other user'
                ]
            ],
            'first_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Input is required'
                ]
            ],
            'last_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Input is required'
                ]
            ],
            'image' => [
                'rules' => 'max_size[image,1028]|is_image[image]|mime_in[image,image/jgp,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Image so big, max 1Gb',
                    'is_image' => 'You chosen not image',
                    'mime_in' => 'You chosen not image'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'error_username'    => $this->validation->getError('username'),
                    'error_email'       => $this->validation->getError('email'),
                    'error_first_name'  => $this->validation->getError('first_name'),
                    'error_last_name'   => $this->validation->getError('last_name'),
                    'error_image'       => $this->validation->getError('image')
                ]
            ];
        } else {
            // $id = $this->request->getVar('id');
            $file_photo = $this->request->getFile('image');
            $old_photo = $this->request->getVar('hidden_user_image');

            if ($file_photo->getError() == 4) {
                $photo_name = $old_photo;
            } else {
                if ($old_photo == 'user.svg') {
                    $photo_name = $file_photo->getRandomName();
                    $file_photo->move('img/profile', $photo_name);
                } else {
                    $photo_name = $file_photo->getRandomName();
                    $file_photo->move('img/profile', $photo_name);
                    unlink('img/profile/' . $old_photo);
                }
            }
            $data = [
                'username'      => $this->request->getVar('username'),
                'email'         => $this->request->getVar('email'),
                'first_name'    => $this->request->getVar('first_name'),
                'last_name'     => $this->request->getVar('last_name'),
                'image'         => $photo_name,
                'updated_at'    => date('Y-m-d h:i:s')
            ];

            $this->profileModel->update($id, $data);
            $msg =  [
                "success" => "Update user success"
            ];
        }
        echo json_encode($msg);
    }

    public function delete_user()
    {
        $id = $this->request->getVar('user_id');
        $user = $this->profileModel->getUser($id);
        $this->profileModel->delete($id);

        $msg =  [
            "success" => "Profile " . $user['users_uid'] . " was deleted"
        ];
        echo json_encode($msg);
    }
}
