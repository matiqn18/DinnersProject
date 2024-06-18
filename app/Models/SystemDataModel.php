<?php

namespace App\Models;

use CodeIgniter\Model;

class SystemDataModel extends Model
{
    protected $table = 'admin_panels';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'startdate', 'enddate', 'price'];


    public function updatePrice($newPrice)
    {
        $data = [ 'price' => $newPrice ];
        $this->update(0, $data);
    }
}