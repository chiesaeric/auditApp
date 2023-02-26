<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\FindingModel;
use App\Models\AuditModel;
use App\Models\DetailAuditModel;


class HomeController extends BaseController
{
    protected $usersModel;
    protected $findingModel;
    protected $auditModel;
    protected $detailAuditModel;
    public function __construct()
    {
        $this->findingModel = new FindingModel();
        $this->auditModel = new AuditModel();
        $this->usersModel = new UsersModel();
        $this->detailAuditModel = new DetailAuditModel();
    }

    public function index()
    {
        $session = session();
        if ($session->get('logged_in') == TRUE) {
            if ($session->get('tipe') == "lead" || $session->get('tipe') == "admin") {
                $data = ['to do', 'in progress'];
                $totalFinding = count($this->findingModel->where('status_finding', 'finding')->findAll());
                $unsuccess = count($this->auditModel->whereIn('status', $data)->findAll());
                $success = count($this->auditModel->where('status', 'done')->findAll());
                $inreview = count($this->auditModel->where('status', 'in review')->findAll());
                $findings = count($this->findingModel->where('status_finding', 'finding')->findAll());
                $session->set(['totalFinding' => $totalFinding]);
                $data = [
                    'title' => 'Dashboard',
                    'unsuccess' => $unsuccess,
                    'success' => $success,
                    'inreview' => $inreview,
                    'findings' => $findings
                ];
                return view('dashboard/main', $data);
            } else if ($session->get('tipe') == "auditor") {
                $data = ['to do', 'in progress'];
                $totalTask = count($this->auditModel->where('id_assigne', $session->get('id_user'))->whereIn('status', $data)->where('MONTH(deadline)', Date("m"))->findAll());
                $session->set(['totalTask' => $totalTask]);
                $data = [
                    'title' => 'Dashboard'
                ];
                return view('auditor/main', $data);
            }
        } else {
            $data = [
                'title' => 'Login'
            ];
            return view('login/main', $data);
        }
    }

    public function auth()
    {
        $session = session();
        $data = $this->usersModel->where('username', $this->request->getVar('username'))->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($this->request->getVar('password'), $pass);
            if ($verify_pass) {
                $status = $data['status'];
                if ($status == "active") {
                    $ses_data = [
                        'id_user'       => $data['id_users'],
                        'nama'          => $data['nama'],
                        'username'      => $data['username'],
                        'tipe'          => $data['tipe'],
                        'logged_in'     => TRUE
                    ];
                    $session->set($ses_data);
                    return redirect()->to('/');
                } else {
                    $session->setFlashdata('gagal', 'maaf akun mu tidak aktif, silahkan hubungi lead/admin');
                    return redirect()->to('/')->withInput();
                }
            } else {
                $session->setFlashdata('gagal', 'password yg dimasukan salah');
                return redirect()->to('/')->withInput();
            }
        } else {
            $session->setFlashdata('gagal', 'username tidak ditemukan');
            return redirect()->to('/')->withInput();
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
