<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect(); // Ładuje bazę danych
    }

    public function index(): string
    {
        $today = date('Y-m-d');
        if($this->isWeekend($today)){
            $data['meal'] = (object) ['ingredients' => "W weekendy nie ma posiłków"];
        }
        else {
            $query = $this->db->query("SELECT ingredients FROM menu WHERE DATE(date) = '$today'");
            $data['meal'] = $query->getRow();

        }
        return view('today_lunch', $data);
    }


    function isWeekend($date) {
        return (date('N', strtotime($date)) >= 6);
    }
}
