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
        $graduated = $userModel->where('role', 3)->findAll();
        $admins = $userModel->where('role', 0)->findAll();

        $data = [
            'admins' => $admins,
            'users' => $users,
            'accountants' => $accountants,
            'graduated'  =>  $graduated,
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
        $graduation = $this->request->getPost('graduation');


        $systemModel = new SystemDataModel();
        $query = $systemModel->find();
        if (!empty($query)) {
            $record = $query[0];
            $record['startdate'] = $startDate;
            $record['enddate'] = $endDate;
            $record['price'] = $recordPrice;
            $systemModel->update(0, $record);
        }

        if ($resetTable) {
            $menuModel = new MenuModel();
            $mealModel = new MealModel();
            $paymentModel = new PaymentModel();

            $payments = $paymentModel->findAll();
            $meals = $mealModel->findAll();
            $menuItems = $menuModel->findAll();

            $backupPath = WRITEPATH . 'backups/';
            if (!is_dir($backupPath)) {
                mkdir($backupPath, 0777, true);
            }


            $this->exportTableToCSV($menuItems, 'backup_menu.csv');
            $this->exportTableToCSV($meals, 'backup_meals.csv');
            $this->exportTableToCSV($payments, 'backup_payments.csv');


            foreach ($payments as $payment) {
                $paymentModel->delete($payment['payment_id']);
            }

            foreach ($meals as $meal) {
                $mealModel->delete($meal['id']);
            }

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

        if ($graduation) {
            $this->graduationUser();
        }

        return redirect()->to(base_url('admin/data'))->with('success', 'Dane systemowe zaktualizowane pomyślnie.');
    }
    private function exportTableToCSV($data, $filename): void
    {
        $filePath = WRITEPATH . 'backups/' . $filename;
        $file = fopen($filePath, 'w');

        if (!empty($data)) {
            fputcsv($file, array_keys($data[0]));
            foreach ($data as $row) {
                fputcsv($file, $row);
            }
        }

        fclose($file);
    }
    public function updateClass()
    {
        $classModel = new ClassModel();
        $allClasses = $classModel->findAll();
        $db = \Config\Database::connect();
        $builder = $db->table('class');

        $dataToUpdate = [];

        foreach ($allClasses as $class) {
            $classId = $class['id_class'];
            $postedValue = $this->request->getPost($classId) !== null ? 1 : 0;

            // Dodaj do listy aktualizacji tylko wtedy, gdy wartość się zmieniła
            if ($class['available'] != $postedValue) {
                $dataToUpdate[] = [
                    'id_class' => $classId,
                    'available' => $postedValue
                ];
            }
        }

        if (!empty($dataToUpdate)) {
            $builder->updateBatch($dataToUpdate, 'id_class');
        }

        return redirect()->to(base_url('admin/data'))->with('message', 'Class availability updated successfully');
    }
    public function editUser($id): string
    {
        $userModel = new UserModel();
        $classModel = new ClassModel();
        $data['user'] = $userModel->find($id);
        $data['class'] = $classModel->findAll();

        return view('edit_user', $data);
    }
    public function updateUser($id)
    {
        $userModel = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'name' => $this->request->getPost('name'),
            'surname' => $this->request->getPost('surname'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
            'class_id' => $this->request->getPost('class_id')
        ];

        if (empty($data['class_id']) && $data['role'] == '2') {
            $data['class_id'] = 1002;
        }

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $userModel->update($id, $data);

        return redirect()->to(base_url('admin/users'))->with('success', 'Użytkownik zaktualizowany pomyślnie.');
    }
    public function delete($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $userModel = new UserModel();
        $mealModel = new MealModel();
        $paymentModel = new PaymentModel();

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $paymentModel->where('user_id', $id)->delete();
            $mealModel->where('user_id', $id)->delete();
            $userModel->delete($id);

            if ($db->transStatus() === FALSE) {
                $db->transRollback();
                return redirect()->to(base_url('admin/users'))->with('error', 'Nie udało się usunąć użytkownika. Proszę spróbować ponownie później.');
            } else {
                $db->transCommit();
                return redirect()->to(base_url('admin/users'))->with('success', 'Użytkownik usunięty pomyślnie.');
            }
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->to(base_url('admin/users'))->with('error', 'Wystąpił błąd: ' . $e->getMessage());
        }
    }

    private function  graduationUser(): void
    {
        $SpClass = ['1', '2', '4', '5', '6', '7'];
        $LoClass = ['1', '2', '3'];
        $TeClass = ['1', '2', '3', '4'];

        $this->promoteClassesByYear($SpClass, 'SP');
        $this->promoteClassesByYear($LoClass, 'LO');
        $this->promoteClassesByYear($TeClass, 'TE');

        $this->classAvailable($SpClass, 'SP');
        $this->classAvailable($LoClass, 'LO');
        $this->classAvailable($TeClass, 'TE');

    }
    private function promoteClassesByYear(array $promotableYears, string $classPrefix)
    {
        $classModel = new ClassModel();
        $userModel = new UserModel();

        $allClasses = $classModel->findAll();
        $classesArray = [];
        foreach ($allClasses as $class) {
            $classesArray[$class['id_class']] = $class['name'];
        }

        $students = $userModel->select('users.id, users.class_id, class.name as class_name')
            ->join('class', 'class.id_class = users.class_id')
            ->like('class.name', $classPrefix . '%')
            ->findAll();

        foreach ($students as $student) {
            $className = $student['class_name'];
            $classLetter = $className[strlen($className) - 1]; // Ostatni znak (litera klasy)
            $classYear = $className[strlen($className) - 2]; // Przedostatni znak (cyfra rocznika)


            if (in_array($classYear, $promotableYears)) {
                $newClassYear = (int)$classYear + 1;
                $newClassName = substr($className, 0, -2) . $newClassYear . $classLetter;

                $newClassId = array_search($newClassName, $classesArray);
            }
            else {
                if (str_contains($className, 'SP_3')) {
                    $newClassId = 1000;
                } elseif (str_contains($className, 'SP_8')) {
                    $newClassId = 1001;
                } elseif (str_contains($className, 'LO_4') || str_contains($className, 'TE_5')) {
                    $newClassId = 1002;
                }
            }
            if ($newClassId !== false && $newClassId !== null) {
                $userModel->where('id', $student['id'])
                    ->set('class_id', $newClassId)
                    ->update();
            }
        }
    }
    private function classAvailable(array $promotableYears, string $classPrefix): void
    {
        $db = \Config\Database::connect();
        $classModel = new ClassModel();

        $allClasses = $classModel->findAll();
        $classesArrayNew = $allClasses; // New array to hold modified class data

        foreach ($allClasses as $index => $class) {
            $className = $class['name'];
            $classLetter = $className[strlen($className) - 1]; // Last character (class letter)
            $classYear = $className[strlen($className) - 2]; // Second to last character (class year)
            $school = substr($className, 0, -3); // Everything except last two characters (school prefix)


            // Check if the class year is promotable and if the prefix matches
            if (in_array($classYear, $promotableYears) && $classPrefix == $school) {
                $newClassYear = (int)$classYear + 1;
                $newClassName = $classPrefix . "_" .  $newClassYear . $classLetter;

                $newClassId = array_search($newClassName, array_column($allClasses, 'name'));

                if ($newClassId !== false) {
                    $classesArrayNew[$newClassId]['available'] = $class['available'];
                }
            } else {
                if (str_contains($className, 'SP_4') || str_contains($className, 'SP_1') ||
                    str_contains($className, 'LO_1') || str_contains($className, 'TE_1')) {

                    $classesArrayNew[$index]['available'] = 1;
                }
            }
        }

        foreach ($classesArrayNew as $updatedClass) {
            $idClass = (int)$updatedClass['id_class'];
            $available = (int)$updatedClass['available'];

            $db->query("UPDATE class SET available = ? WHERE id_class = ?", [$available, $idClass]);
        }
    }
}