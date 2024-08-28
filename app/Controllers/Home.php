<?php

namespace App\Controllers;

use App\Models\MealModel;
use App\Models\MenuModel;

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

//public function showOrder($option, $startIndex = null)
//{
//
//    $menuModel = new MenuModel();
//    $mealModel = new MealModel();
//
//    $months = $menuModel->distinctMonths();
//
//    if ($startIndex === null) {
//        $currentMonth = date('Y-m');
//        foreach ($months as $index => $month) {
//            if ($month['month'] == $currentMonth) {
//                $startIndex = $index;
//                break;
//            }
//        }
//    } else {
//        if (!isset($months[$startIndex])) {
//            $startIndex = 0;
//        }
//    }
//
//    $currentMonth = $months[$startIndex]['month'];
//    $menu = $menuModel->findByRange($months, $startIndex, 1);
//
//    $userMeals = $mealModel->where('user_id', $userId)->findAll();
//    $userMealIds = array_column($userMeals, 'menu_id');
//
//    $currentMonthNumber = intval(date('m', strtotime($currentMonth)));
//    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonthNumber, date('Y', strtotime($currentMonth)));
//    $firstDayOfMonth = date('N', strtotime($currentMonth . '-01'));
//
//    $days = [];
//    for ($day = 1; $day <= $daysInMonth; $day++) {
//        $date = date('Y-m-d', strtotime("$currentMonth-$day"));
//        $days[$date] = ['date' => $date, 'ingredients' => '', 'id' => null, 'available' => false];
//    }
//
//    foreach ($menu as $item) {
//        $date = $item['date'];
//        if (isset($days[$date])) {
//            $days[$date]['ingredients'] = $item['ingredients'];
//            $days[$date]['id'] = $item['id'];
//            $days[$date]['available'] = $item['available'] == 1;
//        }
//    }
//
//    $viewData = [
//        'months' => $months,
//        'menu' => $menu,
//        'userMealIds' => $userMealIds,
//        'currentMonth' => $currentMonth,
//        'currentIndex' => $startIndex,
//        'currentMonthFull' => $this->FullMonthPrint($currentMonthNumber),
//        'days' => $days,
//        'firstDayOfMonth' => $firstDayOfMonth,
//    ];
//
//    if ($option == 1) {
//        return view('user_order', $viewData);
//    } else {
//        return view('user_order_mobile', $viewData);
//    }
//}
