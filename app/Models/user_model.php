<?php
namespace App\Models;
use CodeIgniter\Model;

class user_model extends Model {

    protected $table = 'users';    
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'users_uid', 'email', 'username', 'first_name', 'last_name', 'designation', 'description', 'image', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash', 'status', 'status_message', 'active', 'force_pass_reset', 'created_at', 'updated_at', 'deleted_at'];
    // protected $allowedFields = ['id', 'user_uid', 'status', 'full_name', 'description', 'created_by', 'created_at', 'updated_by', 'updated_at'];
  
    public function getUser($id = 0)
    {
        return $this->where(['id' => $id])->first();
    }

    public function getDataAll($id)
    {
        $builder = $this->db->table('users');
        $builder->select('*,users.id as userid');
        $query = $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            // ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('users.id', $id);
        $result = $query->get();
        return $result->getRowArray();
    }

    public function getDataRole()
    {
        $builder = $this->db->table('auth_groups');
        $result = $builder->get();
        return $result->getResultArray();
    }

    public function getPermission()
    {
        $builder = $this->db->table('auth_permissions');
        $result = $builder->get();
        return $result->getResultArray();
    }

    public function getRole($id)
    {
        $builder = $this->db->table('auth_groups');
        $builder->where('id', $id);
        $result = $builder->get();
        return $result->getRowArray();
    }

    public function groupPermissions($group_id, $permission_id)
    {
        $builder = $this->db->table('auth_groups_permissions');
        $builder->where('group_id', $group_id);
        $builder->where('permission_id', $permission_id);
        $result = $builder->get();

        if (count($result->getResultArray()) > 0) {
            return "checked='checked'";
        }
    }

    public function updatePermission($permission_id, $role_id)
    {
        $builder = $this->db->table('auth_groups_permissions');
        $builder->where('group_id', $role_id);
        $builder->where('permission_id', $permission_id);
        $result = $builder->get();

        if (count($result->getResultArray()) < 1) {
            $builder->set('group_id', $role_id);
            $builder->set('permission_id', $permission_id);
            $builder->insert();
        } else {
            $builder->where('group_id', $role_id);
            $builder->where('permission_id', $permission_id);
            $builder->delete();
        }
    }
      
    public function noticeTable()
    {
        $builder = $this->db->table('users');
        return $builder;
    }

    public function getMaxId()
    {
        return $this->selectMax('id')->first();
    }

    public function btn_action()
    {
        $action = function ($row) {
            return '<a  name="reset_user" class="px-3 text-warning reset_user" id="' . $row["id"] . '"><i class="uil-padlock font-size-18"></i></a> <a  name="edit_user" class="px-3 text-primary edit_user" id="' . $row["id"] . '"><i class="uil uil-pen font-size-18"></i></a> <a name="delete_user" class="px-3 text-danger delete_user" id="' . $row["id"] . '"><i class="uil uil-trash-alt font-size-18"></i></a>';
            
        };
        return $action;
    }
    public function profile_image()
    {
        $image = function ($row) {
            return '<img src="/img/profile/' . $row["image"] . '" class="mx-auto d-block img-thumbnail" alt="" style="width:55px;height:55px;border-radius:50%;object-fit:cover;object-postition:center;">';
        };
        return $image;
    }


    public function role()
    {
        $role = function ($row) {
            $builder = $this->db->table('users');
            $builder->select('*');
            $query = $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
                ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
                ->where('users.id', $row['id']);
            $result = $query->get();
            $field = $result->getRowArray();
            return '<span class="text-capitalize">' . $field['name'] . '</span>';
        };
        return $role;
    }
        

    public function getStatus()
    {
        $status = function ($row) {
            if ($row['status'] == 'Active') {
                return '<span class="badge bg-pill bg-soft-success font-size-12">Active</span>';
            } elseif ($row['status'] == 'Inactive') {
                return '<span class="badge bg-pill bg-soft-danger font-size-12">Inactive</span>';
            }
        };
        return $status;
    }
   
}

