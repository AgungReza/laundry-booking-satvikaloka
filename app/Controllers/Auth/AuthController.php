<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function doLogin()
    {
        $email = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        $user = (new UserModel())->where('email', $email)->where('is_active', 1)->first();
        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Email atau password salah.');
        }

        session()->regenerate(true);
        session()->set([
            'user_id' => $user['id'],
            'name' => $user['name'],
            'role' => $user['role'],
            'is_logged_in' => true,
        ]);

        (new UserModel())->update($user['id'], ['last_login_at' => date('Y-m-d H:i:s')]);
        return redirect()->to($user['role'] === 'admin' ? '/admin/dashboard' : '/customer/dashboard');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function doRegister()
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'phone' => 'permit_empty|max_length[20]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        (new UserModel())->insert([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash((string) $this->request->getPost('password'), PASSWORD_BCRYPT),
            'phone' => $this->request->getPost('phone'),
            'role' => 'customer',
            'is_active' => 1,
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Berhasil logout.');
    }
}
