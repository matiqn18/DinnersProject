<?php

namespace App\Controllers;

use App\Models\MealModel;
use App\Models\MenuModel;
use App\Models\PaymentModel;
use App\Models\SystemDataModel;
use App\Models\UserModel;

class User extends BaseController
{
    protected $filters = [
        'user_auth' => [],
    ];

    public function index()
    {
        return view('user_main');
    }

    public function profile()
    {
        $session = session();
        $userId = $session->get('userId');

        $userModel = new UserModel();
        $mealModel = new MealModel();
        $paymentModel = new PaymentModel();
        $systemDataModel = new SystemDataModel();

        $user = $userModel->find($userId);

        $orderedMeals = $mealModel->where('user_id', $userId)->countAllResults();

        $systemData = $systemDataModel->find();
        $pricePerMeal = $systemData[0]['price'];

        $payments = $paymentModel->where('user_id', $userId)->findAll();
        $totalPayments = 0;

        foreach ($payments as $payment) {
            $totalPayments += $payment['payment_amount'];
        }
        $totalPaidMeals = $totalPayments / $pricePerMeal;

        return view('user_profile', [
            'user' => $user,
            'orderedMeals' => $orderedMeals,
            'totalPaidAmount' => $totalPaidMeals,
        ]);
    }

    public function showOrder($option, $startIndex = null)
    {
        $session = session();
        $userId = $session->get('userId');

        $menuModel = new MenuModel();
        $mealModel = new MealModel();

        $months = $menuModel->distinctMonths();

        if ($startIndex === null) {
            $currentMonth = date('Y-m');
            foreach ($months as $index => $month) {
                if ($month['month'] == $currentMonth) {
                    $startIndex = $index;
                    break;
                }
            }
        } else {
            if (!isset($months[$startIndex])) {
                $startIndex = 0;
            }
        }

        $currentMonth = $months[$startIndex]['month'];
        $menu = $menuModel->findByRange($months, $startIndex, 1);

        $userMeals = $mealModel->where('user_id', $userId)->findAll();
        $userMealIds = array_column($userMeals, 'menu_id');

        $currentMonthNumber = intval(date('m', strtotime($currentMonth)));
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonthNumber, date('Y', strtotime($currentMonth)));
        $firstDayOfMonth = date('N', strtotime($currentMonth . '-01'));

        $days = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = date('Y-m-d', strtotime("$currentMonth-$day"));
            $days[$date] = ['date' => $date, 'ingredients' => '', 'id' => null, 'available' => false];
        }

        foreach ($menu as $item) {
            $date = $item['date'];
            if (isset($days[$date])) {
                $days[$date]['ingredients'] = $item['ingredients'];
                $days[$date]['id'] = $item['id'];
                $days[$date]['available'] = $item['available'] == 1;
            }
        }

        $viewData = [
            'months' => $months,
            'menu' => $menu,
            'userMealIds' => $userMealIds,
            'currentMonth' => $currentMonth,
            'currentIndex' => $startIndex,
            'currentMonthFull' => $this->FullMonthPrint($currentMonthNumber),
            'days' => $days,
            'firstDayOfMonth' => $firstDayOfMonth,
        ];

        if ($option == 1) {
            return view('user_order', $viewData);
        } else {
            return view('user_order_mobile', $viewData);
        }
    }

    public function changeMonth($direction, $currentIndex)
    {
        $menuModel = new MenuModel();

        $months = $menuModel->distinctMonths();

        if ($direction == 'next' && $currentIndex < count($months) - 1) {
            $currentIndex++;
        } elseif ($direction == 'prev' && $currentIndex > 0) {
            $currentIndex--;
        }

        return redirect()->to(base_url('/user/order/' . $currentIndex));
    }

    public function saveOrder()
    {
        $session = session();
        $userId = $session->get('userId');
        $mealModel = new MealModel();
        $menuModel = new MenuModel();

        $orderedMeals = $this->request->getPost('meals');

        $currentMeals = $mealModel->where('user_id', $userId)->findAll();

        foreach ($currentMeals as $meal) {
            $menu = $menuModel->find($meal['menu_id']);
            if ($menu && $menu['available'] == 1) {
                $mealModel->delete($meal['id']);
            }
        }

        if ($orderedMeals) {
            $data = [];
            foreach ($orderedMeals as $menuId) {
                $menu = $menuModel->find($menuId);
                if ($menu && $menu['available'] == 1) {
                    $data[] = [
                        'user_id' => $userId,
                        'menu_id' => $menuId,
                    ];
                }
            }
            if (!empty($data)) {
                $mealModel->insertBatch($data);
            }
        }
        return redirect()->to(base_url('/user/order/'));
    }

    private function paymentsSummary()
    {
        $paymentModel = new PaymentModel();
        $userId = session()->get('userId');

        $totalPayments = $paymentModel->where('user_id', $userId)->sum('payment_amount');

        return $totalPayments;
    }

    private function FullMonthPrint($month)
    {
        $months = ["X", "Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień",
            "Wrzesień", "Październik", "Listopad", "Grudzień"];

        return $months[$month];
    }
}
