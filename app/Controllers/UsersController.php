<?php

namespace App\Controllers;

use App\Models\UsersModel;

class UsersController extends BaseController
{
    protected $usersModel;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $users = $this->usersModel->orderBy('id_users', 'DESC')->findAll();
        $data = [
            'title' => 'Users',
            'users' => $users
        ];


        return view('users/main', $data);
    }

    public function save()
    {
        $slug = url_title($this->request->getVar('nama'), '-', true);
        $this->usersModel->save([
            'nama' => $this->request->getVar('nama'),
            'slug' => $slug,
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'tipe' => $this->request->getVar('tipe'),
            'status' => 'deactive'
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/users');
    }

    public function update()
    {
        if ($this->request->getVar('nama')) {
            $slug = url_title($this->request->getVar('nama'), '-', true);
            if ($this->request->getVar('password') != "") {
                $this->usersModel->save([
                    'id_users' => $this->request->getVar('id_users'),
                    'nama' => $this->request->getVar('nama'),
                    'slug' => $slug,
                    'username' => $this->request->getVar('username'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'tipe' => $this->request->getVar('tipe')
                ]);
            } else {
                $this->usersModel->save([
                    'id_users' => $this->request->getVar('id_users'),
                    'nama' => $this->request->getVar('nama'),
                    'slug' => $slug,
                    'username' => $this->request->getVar('username'),
                    'tipe' => $this->request->getVar('tipe')
                ]);
            }
        } else {
            $this->usersModel->save([
                'id_users' => $this->request->getVar('id_users'),
                'status' => $this->request->getVar('status')
            ]);
        }
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('/users');
    }

    public function delete()
    {
        $this->usersModel->delete($this->request->getVar('id_users'));
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/users');
    }
}
