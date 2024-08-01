<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClassModel;
use App\Models\UserModel;
use App\Models\MealModel;
use App\Models\MenuModel;
use App\Models\PaymentModel;
use App\Models\SystemDataModel;
use Dompdf\Dompdf;

class Accountant extends BaseController
{
    protected $filters = [
        'accountant_auth' => [],
    ];

    public function index()
    {
        return view('accountant_main');
    }

    private function orderList($date)
    {
        $menuModel = new MenuModel();
        $mealModel = new MealModel();
        $userModel = new UserModel();


        $menu = $menuModel->where('date', $date)->findAll();

        $dailyOrders = [];
        foreach ($menu as $menuItem) {
            $meals = $mealModel->where('menu_id', $menuItem['id'])->findAll();

            $users = [];
            foreach ($meals as $meal) {
                $user = $userModel->find($meal['user_id']);
                if ($user) {
                    $users[] = $user;
                }
            }

            $dailyOrders[] = [
                'menu' => $menuItem,
                'users' => $users,
            ];
        }
        return $dailyOrders;
    }

    public function generatePDF($date = null)
    {
        if ($date === null) {
            $date = date('Y-m-d');
        }
        $dailyOrders = $this->orderList($date);

        $pdf = new Dompdf();
        $html = view('pdf_template', ['dailyOrders' => $dailyOrders, 'date' => $date]); // Twój szablon PDF
        $pdf->loadHtml($html);
        $pdf->render();
        $filename = 'daily_orders_'.$date.'.pdf';
        $pdf->stream($filename);

        exit();
    }

    public function uploadView()
    {
        $MenuModel = new MenuModel();
        $distinctMonths = $MenuModel->distinctMonths();

        $todayPage = 1;
        foreach ($distinctMonths as $index => $month) {
            if ($month['month'] == date('Y-m')) {
                $todayPage = $index + 1;
                break;
            }
        }

        $currentPage = $this->request->getVar('page') ? (int)$this->request->getVar('page') : $todayPage;
        $perPage = 1;

        $startIndex = ($currentPage - 1) * $perPage;

        $menuData = $MenuModel->findByRange($distinctMonths, $startIndex, $perPage);

        $pager = \Config\Services::pager();

        $data = [
            'menu' => $menuData,
            'pager' => $pager,
            'currentPage' => $currentPage,
            'distinctMonths' => $distinctMonths,
            'todayPage' => $todayPage,
            'totalPages' => ceil(count($distinctMonths) / $perPage),
        ];

        return view('accountant_menu', $data);
    }

    public function uploadMenu()
    {
        $MenuModel = new MenuModel();

        $file = $this->request->getFile('menu_file');

        if ($file && $file->isValid() && $file->getExtension() == 'txt') {
            $fileContent = $file->openFile('r');

            foreach ($fileContent as $line) {
                $line = trim($line);
                $data = explode(';', $line);

                if (count($data) == 2) {
                    $date = trim($data[0]);
                    $ingredients = trim($data[1]);
                    $existingMeal = $MenuModel->where('date', $date)->first();

                    if ($existingMeal) {
                        $updateData = [
                            'ingredients' => $ingredients,
                            'available' => true,
                        ];

                        $MenuModel->update($existingMeal['id'], $updateData);
                    } else {
                        return redirect()->back()->with('error', 'Invalid data format.');
                    }
                }
            }

            return redirect()->to('accountant/menu')->with('success', 'Menu items updated successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid file or format. Please upload a .txt file.');
        }
    }

    public function edit($id)
    {
        $MenuModel = new MenuModel();
        $data['meal'] = $MenuModel->find($id);

        return view('accountant_edit', $data);
    }

    public function update($id)
    {
        $MenuModel = new MenuModel();
        $meal = $MenuModel->find($id);

        $available = $this->request->getPost('available') == '1' ? true : false;

        $data = [
            'date' => $this->request->getPost('date'),
            'available' => $available,
            'ingredients' => $this->request->getPost('ingredients'),
        ];

        if ($MenuModel->update($id, $data)) {
            return redirect()->to('accountant/menu')->with('success', 'Meal updated successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to update meal');
        }
    }


    public function financialInfo()
    {
        $userModel = new UserModel();
        $mealModel = new MealModel();
        $paymentModel = new PaymentModel();
        $systemDataModel = new SystemDataModel();
        $classModel = new ClassModel();

        $systemData = $systemDataModel->first();
        $mealPrice = $systemData['price'];

//        $users = $userModel->where('role', '2')->findAll();
        $users = $userModel->getUserWithClass(2);

        $userData = [];

        foreach ($users as $user) {
            $mealCount = $mealModel->where('user_id', $user['id'])->countAllResults();
            $totalMealCost = $mealCount * $mealPrice;
            $totalPayments = $paymentModel->where('user_id', $user['id'])->selectSum('payment_amount')->first()['payment_amount'];
            $balance = $totalPayments - $totalMealCost;

            $userData[] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'name' => $user['name'],
                'surname' => $user['surname'],
                'email' => $user['email'],
                'class_name' => $user['class_name'],
                'meal_count' => $mealCount,
                'total_meal_cost' => $totalMealCost,
                'total_payments' => $totalPayments,
                'balance' => $balance,
            ];
        }

        $data = [
            'users' => $userData,
        ];

        return view('accountant_user', $data);

    }

    public function addPayment()
    {
        $paymentModel = new PaymentModel();

        $userId = $this->request->getPost('user_id');
        $paymentAmount = $this->request->getPost('payment_amount');

        $paymentData = [
            'user_id' => $userId,
            'payment_amount' => $paymentAmount,
            'payment_date' => date('Y-m-d H:i:s'),
        ];

        $paymentModel->insert($paymentData);

        return redirect()->to('accountant/financialInfo')->with('success', 'Payment added successfully');
    }

    public function dailyOrders($date = null)
    {
        if ($date === null) {
            $date = date('Y-m-d');
        }
        $dailyOrders = $this->orderList($date);

        $data = [
            'dailyOrders' => $dailyOrders,
            'date' => $date,
        ];

        return view('accountant_orders', $data);
    }
}