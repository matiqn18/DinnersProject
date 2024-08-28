<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id';
    protected $allowedFields = ['date', 'available', 'ingredients'];

    public function distinctMonths()
    {
        return $this->distinct()->select('DATE_FORMAT(date, "%Y-%m") as month')->orderBy('date', 'asc')->findAll();
    }

    public function findByRange($months, $startIndex, $perPage)
    {
        $selectedMonths = array_slice($months, $startIndex, $perPage);
        $monthStrings = array_map(function ($month) {
            return $month['month'];
        }, $selectedMonths);

        return $this->whereIn('DATE_FORMAT(date, "%Y-%m")', $monthStrings)->orderBy('date', 'asc')->findAll();
    }


    public function getTodayAndNextMeals()
    {
        $today = date('Y-m-d');
        $dayOfWeek = date('N');

        if ($dayOfWeek >= 6) {
            $monday = date('Y-m-d', strtotime('next monday'));
        } else {
            $monday = $today;
        }

        $meals = $this->where('date >=', $monday)
            ->orderBy('date', 'asc')
            ->findAll(11);

        return $meals;
    }

}