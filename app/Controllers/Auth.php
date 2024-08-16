<?php

namespace App\Controllers;

use App\Models\ClassModel;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function loginForm()
    {
        return view('login_form');
    }

    public function registerForm()
    {
        $classModel = new ClassModel();
        $data['classes'] = $classModel->where('available', 1)->findAll();
        return view('register_form', $data);
    }
    public function forgotpass()
    {
        return view('password_forgot');
    }

    public function processRegister()
    {
        $request = service('request');

        $username = $request->getPost('username');
        $name = $request->getPost('name');
        $surname = $request->getPost('surname');
        $class = $request->getPost('class');
        $email = $request->getPost('email');
        $password = $request->getPost('password');

        $userModel = new UserModel();
        $existingUser = $userModel->where('email', $email)->first();

        if ($existingUser) {
            return redirect()->back()->with('error', 'Użytkownik o podanym adresie e-mail już istnieje.');
        }

        $existingUsername = $userModel->where('username', $username)->first();

        if ($existingUsername) {
            return redirect()->back()->with('error', 'Użytkownik o podanej nazwie użytkownika już istnieje.');
        }

        $userData = [
            'username' => $username,
            'name' => $name,
            'surname' => $surname,
            'class_id' => $class,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'email' => $email,
            'role' => 2
        ];

        $userModel->insert($userData);
        $userId = $userModel->insertID();

        $session = session();
        $session->set([
            'isLoggedIn' => true,
            'userId' => $userId,
            'username' => $username,
            'email' => $email,
            'role' => 2,
        ]);
        return $this->redirectToDashboard("2");
    }
    public function processLogin()
    {
        $request = service('request');

        $usernameOrEmail = $request->getPost('username');
        $password = $request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $usernameOrEmail)->orWhere('email', $usernameOrEmail)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session = session();
            $session->set([
                'isLoggedIn' => true,
                'userId' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
            ]);

            $role = $user['role'];
            return $this->redirectToDashboard($role);
        } else {
            return redirect()->back()->with('error', 'Niepoprawna nazwa użytkownika, adres e-mail lub hasło.');
        }
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url())->with('success', 'Wylogowano pomyślnie.');
    }

    private function redirectToDashboard($role)
    {
        return match ($role) {
            '0' => redirect()->to(base_url('admin')),
            '1' => redirect()->to(base_url('accountant')),
            '2' => redirect()->to(base_url('user')),
            default => redirect()->to(base_url())->with('error', 'Nieprawidłowa rola użytkownika.'),
        };
    }
}