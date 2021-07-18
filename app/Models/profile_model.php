<?php 
namespace App\Models; 
use CodeIgniter\Model;

class profile_model extends Model { 

   protected $table = 'users';
   protected $primarykey = 'id';
   protected $allowedFields = ['id', 'users_uid', 'username', 'email', 'first_name', 'last_name', 'image','designation','description', 'password_hash', 'updated_at'];

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

   public function noticeTable()
   {
         $builder = $this->db->table('users');
         $builder->select('*');
         $query = $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            // ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('auth_groups_users.group_id !=', 1);
         return $query;
   }

   public function profile_image()
   {
         $image = function ($row) {
            return '<img src="/img/profile/' . $row["image"] . '" class="mx-auto d-block img-thumbnail" alt="" style="width:75px;height:75px;border-radius:50%;object-fit:cover;object-postition:center;">';
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

   public function btn_action()
   {
         $action = function ($row) {
            return '<button type="button" name="view_user" class="btn btn_lightgreen btn-sm view_user" id="' . $row["id"] . '"><i class="fas fa-eye"></i></button> <button type="button" name="edit_user" class="btn btn_lightblue btn-sm edit_user" id="' . $row["id"] . '"><i class="fas fa-edit"></i></button> <button type="button" name="delete_user" class="btn btn_tomato btn-sm delete_user" id="' . $row["id"] . '"><i class="fas fa-trash-alt"></i></button>';
         };
         return $action;
   }
}