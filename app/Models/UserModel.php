<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username','name','surname','class_id', 'password', 'email', 'role'];

    public function getUserWithClass($role)
    {
        return $this->select('users.id, users.username, users.name, users.surname, users.email, class.name as class_name')
            ->join('class', 'class.id_class = users.class_id')
            ->where('users.role', $role)
            ->findAll();
    }
}