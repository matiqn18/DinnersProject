<?php

namespace App\Controllers;


use App\Models\ClassModel;
use App\Models\MealModel;
use App\Models\MenuModel;
use App\Models\PaymentModel;
use App\Models\UserModel;
use App\Models\SystemDataModel;
use DateTime;
use DateInterval;
use DatePeriod;


class Admin extends BaseController
{
    protected $filters = [
        'admin_auth' => [],
    ];

    public function index(): string
    {
        return view('admin_main');
    }

    public function users(): string
    {
        $userModel = new UserModel();
        $users = $userModel->getUserWithClass(2);
        $accountants = $userModel->where('role', 1)->findAll();
        $admins = $userModel->where('role', 0)->findAll();

        $data = [
            'admins' => $admins,
            'users' => $users,
            'accountants' => $accountants,
        ];
        return view('admin_panel', $data);
    }
    public function systemData(): string
    {
        $systemModel = new SystemDataModel();
        $classModel = new ClassModel();

        $class = $classModel->orderBy('name', 'ASC')->findAll();
        $query = $systemModel->find();
        $data = [
            'startdate' => $query[0]["startdate"],
            'enddate' => $query[0]["enddate"],
            'price' => $query[0]["price"],
            'class' => $class
        ];

        return view('admin_data', $data);
    }

    public function updateSystemDate()
    {
        $startDate = $this->request->getPost('startDate');
        $endDate = $this->request->getPost('endDate');
        $recordPrice = $this->request->getPost('recordPrice');
        $resetTable = $this->request->getPost('resetTable');


        $systemModel = new SystemDataModel();
        $query = $systemModel->find();
        var_dump($query);
        if (!empty($query)) {
            $record = $query[0];
            $record['startdate'] = $startDate;
            $record['enddate'] = $endDate;
            $record['price'] = $recordPrice;
            $systemModel->update(0, $record);
        }

        if ($resetTable) {

//            TODO: Tworzenie BACKUP przed usunięciem systemu


            $menuModel = new MenuModel();
            $mealModel = new MealModel();
            $paymentModel = new PaymentModel();

            $payments = $paymentModel->findAll();

            foreach ($payments as $payment) {
                $paymentModel->delete($payment['payment_id']);
            }

            $meals = $mealModel->findAll();

            foreach ($meals as $meal) {
                $mealModel->delete($meal['id']);
            }

            $menuItems = $menuModel->findAll();

            foreach ($menuItems as $menuItem) {
                $menuModel->delete($menuItem['id']);
            }

            $startDateObj = new DateTime($startDate);
            $endDateObj = new DateTime($endDate);
            $interval = new DateInterval('P1D');
            $dateRange = new DatePeriod($startDateObj, $interval, $endDateObj);

            foreach ($dateRange as $date) {
                if ($date->format('N') >= 1 && $date->format('N') <= 5) {
                    $menuRecord = [
                        'date' => $date->format('Y-m-d'),
                        'available' => 0,
                        'ingredients' => ""
                    ];
                    $menuModel->insert($menuRecord);
                }
            }
        }


        return redirect()->to(base_url('admin/users'))->with('success', 'Dane systemowe zaktualizowane pomyślnie.');

    }

    public function updateClass()
    {
        $classModel = new ClassModel();

        $classnum = $classModel->countAllResults();

        for ($i = 1; $i <= $classnum; $i++) {
            $this->request->getPost('classID'.$i) ;
            
        }


    }
    public function edit($id)
    {
        $userModel = new UserModel();
        $classModel = new ClassModel();
        $data['user'] = $userModel->find($id);
        $data['class'] = $classModel->findAll();

        return view('edit_user', $data);
    }

    public function update($id)
    {
        $userModel = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'name' => $this->request->getPost('name'),
            'surname' => $this->request->getPost('surname'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
            'class_id' => $this->request->getPost('class')
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $userModel->update($id, $data);

        return redirect()->to(base_url('admin/users'))->with('success', 'Użytkownik zaktualizowany pomyślnie.');
    }

    public function updatePrice()
    {
        $priceModel = new SystemDataModel();
        $price = $this->request->getPost('price');
        $priceModel->updatePrice($price);
        return redirect()->to(base_url('admin/users'))->with('success', 'Cena Obiadu została zaktualizowana.');
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to(base_url('admin/users'))->with('success', 'Użytkownik usunięty pomyślnie.');
    }
}