<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';

    protected $primaryKey = 'payment_id';

    protected $allowedFields = ['payment_id', 'user_id', 'payment_amount', 'payment_date'];

}