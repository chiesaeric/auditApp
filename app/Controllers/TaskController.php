<?php

namespace App\Controllers;

use App\Models\AreaModel;
use App\Models\AuditModel;
use App\Models\UsersModel;
use App\Models\CategoryModel;
use App\Models\CheckModel;
use App\Models\DetailAuditModel;
use App\Models\FindingModel;
use DateTime;

class TaskController extends BaseController
{
    protected $auditModel;
    protected $userModel;
    protected $categoryModel;
    protected $detailAuditModel;
    protected $checkModel;
    protected $areaModel;
    protected $findingModel;
    public function __construct()
    {
        $this->auditModel = new AuditModel();
        $this->userModel = new UsersModel();
        $this->categoryModel = new CategoryModel();
        $this->areaModel = new AreaModel();
        $this->detailAuditModel = new DetailAuditModel();
        $this->checkModel = new CheckModel();
        $this->findingModel = new FindingModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $users = $this->userModel->findAll();
        $audit = $db->query('select id_audit, task_name, a.nama as id_reporter, b.nama as id_assigne, id_reporter as reporter, id_assigne as assigne, tbl_audit.id_category as category, c.title as id_category, tbl_audit.status as status, deadline from tbl_audit inner join tbl_users a on tbl_audit.id_reporter = a.id_users inner join tbl_users b on tbl_audit.id_assigne = b.id_users inner join tbl_category c on tbl_audit.id_category = c.id_category ORDER BY id_audit DESC;')->getResultArray();
        $category = $this->categoryModel->findAll();
        $data = [
            'title' => 'Task',
            'audit' => $audit,
            'user'  => $users,
            'category' => $category
        ];


        return view('task/main', $data);
    }

    public function taskBoard()
    {
        $users = '';
        $data = [
            'title' => 'Task Board',
            'users' => $users
        ];


        return view('task/taskboard', $data);
    }

    public function taskSummary()
    {
        $db = \Config\Database::connect();
        $users = $this->userModel->findAll();
        $audit = $db->query('select id_audit, a.nama as id_reporter, b.nama as id_assigne, id_reporter as reporter, id_assigne as assigne, tbl_audit.id_category as category, c.title as id_category, tbl_audit.status, deadline from tbl_audit inner join tbl_users a on tbl_audit.id_reporter = a.id_users inner join tbl_users b on tbl_audit.id_assigne = b.id_users inner join tbl_category c on tbl_audit.id_category = c.id_category ORDER BY id_audit DESC;')->getResultArray();
        $category = $this->categoryModel->findAll();
        $data = [
            'title' => 'Task Summary',
            'audit' => $audit,
            'user'  => $users,
            'category' => $category
        ];


        return view('task/taskSummary', $data);
    }

    public function detailAudit($id)
    {
        session();
        $db = \Config\Database::connect();
        $names = ['to do'];
        $audit = $this->auditModel->find($id);
        $reporter = $this->userModel->find($audit['id_reporter']);
        $auditor = $this->userModel->find($audit['id_assigne']);
        $category = $this->categoryModel->find($audit['id_category']);
        $allCp = $this->detailAuditModel->where('id_audit', $id)->countAllResults();
        $doneCp = $this->detailAuditModel->where('id_audit', $id)->whereNotIn('status', $names)->countAllResults();
        $detailTask = $db->table('tbl_detail_audit')->select('*')->join('tbl_cp', 'tbl_cp.id_cp = tbl_detail_audit.id_cp')->where('id_audit', $id)->get()->getResultArray();
        //dd($allCp);
        $validation = \Config\Services::validation();
        $area = $this->areaModel->where('id_category', $audit['id_category'])->findAll();
        //dd($detailTask);
        //dd($area);
        $data = [
            'title' => 'Detail Audit Task',
            'audit' => $audit,
            'reporter' => $reporter,
            'auditor' => $auditor,
            'category' => $category,
            'allCp' => $allCp,
            'doneCp' => $doneCp,
            'detailTask' => $detailTask,
            'validation' => $validation,
            'area' => $area

        ];


        return view('task/detailAuditTask', $data);
    }

    public function save()
    {
        $db = \Config\Database::connect();
        $this->auditModel->save([
            'task_name' => $this->request->getVar('task_name'),
            'id_reporter' => $this->request->getVar('id_reporter'),
            'id_assigne' => $this->request->getVar('id_assigne'),
            'id_category' => $this->request->getVar('id_category'),
            'status' => 'to do',
            'deadline' => $this->request->getVar('deadline')
        ]);
        $lastId = $this->auditModel->getInsertID();
        $dataArea = $db->table('tbl_area')->join('tbl_category', 'tbl_category.id_category = tbl_area.id_category')->where('tbl_area.id_category', $this->request->getVar('id_category'))->get()->getResultArray();
        foreach ($dataArea as $da) {
            $dataCp = $db->table('tbl_cp')->join('tbl_area', 'tbl_area.id_area = tbl_cp.id_area')->where('tbl_cp.id_area', $da['id_area'])->orderBy('tbl_area.id_area', 'ASC')->get()->getResultArray();
            foreach ($dataCp as $cp) {
                $this->detailAuditModel->save([
                    'id_audit' => $lastId,
                    'id_cp' => $cp['id_cp'],
                    'status' => 'to do'
                ]);
            }
        }

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/task');
    }

    public function saveDetail()
    {
        $no = $this->request->getVar('no');
        //check finding
        $ckFinding = $this->findingModel->where('id_detail_audit', $this->request->getVar('id_detail_audit' . $no))->first();

        if ($this->request->getFile('file_path' . $no) != "") {
            if (str_contains($this->request->getFile('file_path' . $no)->getName(), "pdf")) {
                $validationRule = [
                    'file_path' . $no => [
                        'rules' => [
                            'uploaded[file_path' . $no . ']',
                            'mime_in[file_path' . $no . ',image/jpg,image/jpeg,image/gif,image/png,image/webp,application/pdf]',
                            'max_size[file_path' . $no . ',10204]',
                        ],
                    ],
                ];
            } else {
                $validationRule = [
                    'file_path' . $no => [
                        'label' => 'Image File',
                        'rules' => [
                            'uploaded[file_path' . $no . ']',
                            'is_image[file_path' . $no . ']',
                            'mime_in[file_path' . $no . ',image/jpg,image/jpeg,image/gif,image/png,image/webp,application/pdf]',
                            'max_size[file_path' . $no . ',3072]',
                            'max_dims[file_path' . $no . ',2480,3508]',
                        ],
                    ],
                ];
            }
            if ($this->validate($validationRule) == false) {
                dd($this->request->getFile('file_path' . $no));
                $validation = \Config\Services::validation();
                //dd($validation);
                session()->setFlashdata('alert', 'Mohon upload image menggunakan file yg valid (jpg,jpeg,gif,png,pdf) dan ukuran foto maksimal 3mb dengan dimensi maksimal (1024x768)');
                session()->setFlashdata('id', $this->request->getVar('id_detail_audit' . $no));
                return redirect()->to('/taskSummary/detail/' . $this->request->getVar('id_audit' . $no))->withInput();
            }
            $img = $this->request->getFile('file_path' . $no);
            $getType = explode(".", $img->getName())[1];
            $getFileName = $this->request->getVar('id_detail_audit' . $no) . "." . $getType;
            $img->move('img/audit/' . $this->request->getVar('id_audit' . $no), $getFileName, true);

            $statusToDo = ['to do'];
            $statusDone = ['passed', 'failed'];
            $id = $this->request->getVar('id_audit' . $no);
            $doneCp = $this->detailAuditModel->where('id_audit', $id)->whereNotIn('status', $statusToDo)->countAllResults();
            $finishCp = $this->detailAuditModel->where('id_audit', $id)->whereIn('status', $statusDone)->countAllResults();
            $allCp = $this->detailAuditModel->where('id_audit', $id)->countAllResults();


            if ($doneCp == 0) {
                $this->auditModel->save([
                    'id_audit' => $id,
                    'status' => 'in progress'
                ]);
            }

            if ($finishCp == $allCp - 1) {
                $this->auditModel->save([
                    'id_audit' => $id,
                    'status' => 'in review'
                ]);
                $data = ['to do', 'in progress'];
                $totalTask = count($this->auditModel->where('id_assigne', session()->get('id_user'))->whereIn('status', $data)->where('MONTH(deadline)', Date("m"))->findAll());
                session()->set(['totalTask' => $totalTask]);
            }

            $this->detailAuditModel->save([
                'id_detail_audit' => $this->request->getVar('id_detail_audit' . $no),
                'status' => $this->request->getVar('status' . $no),
                'file_path' => '/audit/' . $this->request->getVar('id_audit' . $no) . "/" . $getFileName,
                'desc_audit' => $this->request->getVar('desc_audit' . $no)
            ]);

            //finding condition
            if ($this->request->getVar('status' . $no) == "failed" && $ckFinding == null) {
                $this->findingModel->save([
                    'id_detail_audit' => $this->request->getVar('id_detail_audit' . $no),
                    'status_finding' => 'finding',
                    'category_finding' => 'none'
                ]);
            } else if ($this->request->getVar('status' . $no) == "passed" && $ckFinding != null) {
                $this->findingModel->delete($ckFinding['id_finding']);
            }
            $totalFinding = count($this->findingModel->where('status_finding', 'finding')->findAll());
            session()->set(['totalFinding' => $totalFinding]);
            session()->setFlashdata('pesan', 'Data berhasil disimpan.');
            return redirect()->to('/taskSummary/detail/' . $this->request->getVar('id_audit' . $no));
        } else {
            //dd($ckFinding);
            //finding condition
            if ($this->request->getVar('status' . $no) == "failed" && $ckFinding == null) {
                $this->findingModel->save([
                    'id_detail_audit' => $this->request->getVar('id_detail_audit' . $no),
                    'status_finding' => 'finding',
                    'category_finding' => 'none'
                ]);
            } else if ($this->request->getVar('status' . $no) == "passed" && $ckFinding != null) {
                $this->findingModel->delete($ckFinding['id_finding']);
            }

            $statusToDo = ['to do'];
            $statusDone = ['passed', 'failed'];
            $id = $this->request->getVar('id_audit' . $no);
            $doneCp = $this->detailAuditModel->where('id_audit', $id)->whereNotIn('status', $statusToDo)->countAllResults();
            $finishCp = $this->detailAuditModel->where('id_audit', $id)->whereIn('status', $statusDone)->countAllResults();
            $allCp = $this->detailAuditModel->where('id_audit', $id)->countAllResults();



            if ($doneCp == 0) {
                $this->auditModel->save([
                    'id_audit' => $id,
                    'status' => 'in progress'
                ]);
            }

            if ($finishCp == $allCp - 1) {
                $this->auditModel->save([
                    'id_audit' => $id,
                    'status' => 'in review'
                ]);
                $data = ['to do', 'in progress'];
                $totalTask = count($this->auditModel->where('id_assigne', session()->get('id_user'))->whereIn('status', $data)->where('MONTH(deadline)', Date("m"))->findAll());
                session()->set(['totalTask' => $totalTask]);
            }

            $this->detailAuditModel->save([
                'id_detail_audit' => $this->request->getVar('id_detail_audit' . $no),
                'status' => $this->request->getVar('status' . $no),
                'desc_audit' => $this->request->getVar('desc_audit' . $no)
            ]);
            $totalFinding = count($this->findingModel->where('status_finding', 'finding')->findAll());
            session()->set(['totalFinding' => $totalFinding]);
            session()->setFlashdata('pesan', 'Data berhasil disimpan.');
            return redirect()->to('/taskSummary/detail/' . $this->request->getVar('id_audit' . $no));
        }
    }

    public function update()
    {
        $this->auditModel->save([
            'id_audit' => $this->request->getVar('id_audit'),
            'task_name' => $this->request->getVar('task_name'),
            'id_assigne' => $this->request->getVar('id_assigne'),
            'id_category' => $this->request->getVar('id_category'),
            'deadline' => $this->request->getVar('deadline')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('/task');
    }

    public function delete()
    {
        $detailAudit = $this->detailAuditModel->where('id_audit', $this->request->getVar('id_audit'))->findAll();
        foreach ($detailAudit as $da) {
            $this->detailAuditModel->delete($da['id_detail_audit']);
        }
        $this->auditModel->delete($this->request->getVar('id_audit'));
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/task');
    }


    public function deleteFoto()
    {
        $getData = $this->detailAuditModel->find($this->request->getVar('id_detail_audit'));
        unlink('img' . $getData['file_path']);
        $this->detailAuditModel->save([
            'id_detail_audit' => $this->request->getVar('id_detail_audit'),
            'file_path' => ""
        ]);
        session()->setFlashdata('pesan', 'Foto berhasil dihapus.');
        return redirect()->to('/taskSummary/detail/' . $this->request->getVar('id_audit'));
    }

    public function taskAuditor()
    {
        $db = \Config\Database::connect();
        // $month = $db->query("select * from tbl_audit where MONTH(deadline) = " . Date('m'))->getResultArray();
        // dd($month);
        $audit = $db->query('select id_audit, a.nama as id_reporter, b.nama as id_assigne, id_reporter as reporter, id_assigne as assigne, tbl_audit.id_category as category, c.title as id_category, tbl_audit.status, deadline from tbl_audit inner join tbl_users a on tbl_audit.id_reporter = a.id_users inner join tbl_users b on tbl_audit.id_assigne = b.id_users inner join tbl_category c on tbl_audit.id_category = c.id_category where id_assigne = ' . session()->get('id_user') . ' and MONTH(deadline) = ' . Date("m") . ' ORDER BY id_audit DESC;')->getResultArray();
        $data = ['to do', 'in progress'];
        $totalTask = count($this->auditModel->where('id_assigne', session()->get('id_user'))->whereIn('status', $data)->where('MONTH(deadline)', Date("m"))->findAll());
        session()->set(['totalTask' => $totalTask]);
        $arrDetail = array();
        foreach ($audit as $ad) :
            $arrDetail[$ad['id_audit']] = count($db->table('tbl_detail_audit')->select('*')->join('tbl_audit', 'tbl_audit.id_audit = tbl_detail_audit.id_audit')->where('tbl_detail_audit.id_audit', $ad['id_audit'])->get()->getResultArray());
        endforeach;
        $data = [
            'title' => 'Task Auditor',
            'audit' => $audit,
            'arrDetail' => $arrDetail
        ];
        return view('auditor/task', $data);
    }

    public function taskDetailAuditor($id)
    {
        $db = \Config\Database::connect();
        $names = ['to do'];
        $audit = $this->auditModel->find($id);
        if ($audit['status'] != "done") {
            $reporter = $this->userModel->find($audit['id_reporter']);
            $auditor = $this->userModel->find($audit['id_assigne']);
            $category = $this->categoryModel->find($audit['id_category']);
            $allCp = $this->detailAuditModel->where('id_audit', $id)->countAllResults();
            $doneCp = $this->detailAuditModel->where('id_audit', $id)->whereNotIn('status', $names)->countAllResults();
            $detailTask = $db->table('tbl_detail_audit')->select('*')->join('tbl_cp', 'tbl_cp.id_cp = tbl_detail_audit.id_cp')->where('id_audit', $id)->get()->getResultArray();
            //dd($allCp);
            $validation = \Config\Services::validation();
            $area = $this->areaModel->where('id_category', $audit['id_category'])->findAll();
            //dd($detailTask);
            //dd($area);
            $data = [
                'title' => 'Detail Task Auditor',
                'audit' => $audit,
                'reporter' => $reporter,
                'auditor' => $auditor,
                'category' => $category,
                'allCp' => $allCp,
                'doneCp' => $doneCp,
                'detailTask' => $detailTask,
                'validation' => $validation,
                'area' => $area

            ];
            return view('auditor/detail_task', $data);
        } else {
            return redirect()->to('/task/auditor');
        }
    }

    public function saveDetailAuditor()
    {
        $no = $this->request->getVar('no');
        //check finding
        $ckFinding = $this->findingModel->where('id_detail_audit', $this->request->getVar('id_detail_audit' . $no))->first();

        if ($this->request->getFile('file_path' . $no) != "") {
            if (str_contains($this->request->getFile('file_path' . $no)->getName(), "pdf")) {
                $validationRule = [
                    'file_path' . $no => [
                        'rules' => [
                            'uploaded[file_path' . $no . ']',
                            'mime_in[file_path' . $no . ',image/jpg,image/jpeg,image/gif,image/png,image/webp,application/pdf]',
                            'max_size[file_path' . $no . ',10204]',
                        ],
                    ],
                ];
            } else {
                $validationRule = [
                    'file_path' . $no => [
                        'label' => 'Image File',
                        'rules' => [
                            'uploaded[file_path' . $no . ']',
                            'is_image[file_path' . $no . ']',
                            'mime_in[file_path' . $no . ',image/jpg,image/jpeg,image/gif,image/png,image/webp,application/pdf]',
                            'max_size[file_path' . $no . ',3072]',
                            'max_dims[file_path' . $no . ',2480,3508]',
                        ],
                    ],
                ];
            }
            if ($this->validate($validationRule) == false) {
                dd($this->request->getFile('file_path' . $no));
                $validation = \Config\Services::validation();
                //dd($validation);
                session()->setFlashdata('alert', 'Mohon upload image menggunakan file yg valid (jpg,jpeg,gif,png.pdf) dan ukuran foto maksimal 3mb dengan dimensi maksimal (1024x768)');
                session()->setFlashdata('id', $this->request->getVar('id_detail_audit' . $no));
                return redirect()->to('/task/detail/' . $this->request->getVar('id_audit' . $no))->withInput();
            }
            $img = $this->request->getFile('file_path' . $no);
            $getType = explode(".", $img->getName())[1];
            $getFileName = $this->request->getVar('id_detail_audit' . $no) . "." . $getType;
            $img->move('img/audit/' . $this->request->getVar('id_audit' . $no), $getFileName, true);

            $statusToDo = ['to do'];
            $statusDone = ['passed', 'failed'];
            $id = $this->request->getVar('id_audit' . $no);
            $doneCp = $this->detailAuditModel->where('id_audit', $id)->whereNotIn('status', $statusToDo)->countAllResults();
            $finishCp = $this->detailAuditModel->where('id_audit', $id)->whereIn('status', $statusDone)->countAllResults();
            $allCp = $this->detailAuditModel->where('id_audit', $id)->countAllResults();

            if ($doneCp == 0) {
                $this->auditModel->save([
                    'id_audit' => $id,
                    'status' => 'in progress'
                ]);
            }

            $this->detailAuditModel->save([
                'id_detail_audit' => $this->request->getVar('id_detail_audit' . $no),
                'status' => $this->request->getVar('status' . $no),
                'file_path' => '/audit/' . $this->request->getVar('id_audit' . $no) . "/" . $getFileName,
                'desc_audit' => $this->request->getVar('desc_audit' . $no)
            ]);

            //finding condition
            if ($this->request->getVar('status' . $no) == "failed" && $ckFinding == null) {
                $this->findingModel->save([
                    'id_detail_audit' => $this->request->getVar('id_detail_audit' . $no),
                    'status_finding' => 'finding',
                    'category_finding' => 'none'
                ]);
            } else if ($this->request->getVar('status' . $no) == "passed" && $ckFinding != null) {
                $this->findingModel->delete($ckFinding['id_finding']);
            }
            $totalFinding = count($this->findingModel->where('status_finding', 'finding')->findAll());
            session()->set(['totalFinding' => $totalFinding]);
            session()->setFlashdata('pesan', 'Data berhasil disimpan.');
            return redirect()->to('/task/detail/' . $this->request->getVar('id_audit' . $no));
        } else {
            //dd($ckFinding);
            //finding condition
            if ($this->request->getVar('status' . $no) == "failed" && $ckFinding == null) {
                $this->findingModel->save([
                    'id_detail_audit' => $this->request->getVar('id_detail_audit' . $no),
                    'status_finding' => 'finding',
                    'category_finding' => 'none'
                ]);
            } else if ($this->request->getVar('status' . $no) == "passed" && $ckFinding != null) {
                $this->findingModel->delete($ckFinding['id_finding']);
            }

            $statusToDo = ['to do'];
            $statusDone = ['passed', 'failed'];
            $id = $this->request->getVar('id_audit' . $no);
            $doneCp = $this->detailAuditModel->where('id_audit', $id)->whereNotIn('status', $statusToDo)->countAllResults();

            if ($doneCp == 0) {
                $this->auditModel->save([
                    'id_audit' => $id,
                    'status' => 'in progress'
                ]);
            }


            $this->detailAuditModel->save([
                'id_detail_audit' => $this->request->getVar('id_detail_audit' . $no),
                'status' => $this->request->getVar('status' . $no),
                'desc_audit' => $this->request->getVar('desc_audit' . $no)
            ]);
            $totalFinding = count($this->findingModel->where('status_finding', 'finding')->findAll());
            session()->set(['totalFinding' => $totalFinding]);
            session()->setFlashdata('pesan', 'Data berhasil disimpan.');
            return redirect()->to('/task/detail/' . $this->request->getVar('id_audit' . $no));
        }
    }

    public function deleteFotoAuditor()
    {
        $getData = $this->detailAuditModel->find($this->request->getVar('id_detail_audit'));
        unlink('img' . $getData['file_path']);
        $this->detailAuditModel->save([
            'id_detail_audit' => $this->request->getVar('id_detail_audit'),
            'file_path' => ""
        ]);
        session()->setFlashdata('pesan', 'Foto berhasil dihapus.');
        return redirect()->to('/task/detail/' . $this->request->getVar('id_audit'));
    }

    public function finishTaskAuditor()
    {
        $statusDone = ['passed', 'failed'];
        $id = $this->request->getVar('id_audit');
        $finishCp = $this->detailAuditModel->where('id_audit', $id)->whereIn('status', $statusDone)->countAllResults();
        $allCp = $this->detailAuditModel->where('id_audit', $id)->countAllResults();

        if ($finishCp == $allCp) {
            $this->auditModel->save([
                'id_audit' => $id,
                'status' => 'in review'
            ]);
            $data = ['to do', 'in progress'];
            $totalTask = count($this->auditModel->where('id_assigne', session()->get('id_user'))->whereIn('status', $data)->where('MONTH(deadline)', Date("m"))->findAll());
            session()->set(['totalTask' => $totalTask]);
            session()->setFlashdata('pesan', 'Task berhasil diselesaikan.');
            return redirect()->to('/task/auditor');
        } else {
            session()->setFlashdata('gagal', 'Selesaikan semua task dahulu.');
            return redirect()->to('/task/detail/' . $id);
        }
    }

    public function approve()
    {
        $id = $this->request->getVar('id_audit');
        $this->auditModel->save([
            'id_audit' => $id,
            'status' => 'done'
        ]);
        session()->setFlashdata('pesan', 'Task berhasil diapprove.');
        return redirect()->to('/task');
    }

    public function detailTask($id)
    {
        session();
        $db = \Config\Database::connect();
        $names = ['to do'];
        $audit = $this->auditModel->find($id);
        $reporter = $this->userModel->find($audit['id_reporter']);
        $auditor = $this->userModel->find($audit['id_assigne']);
        $category = $this->categoryModel->find($audit['id_category']);
        $allCp = $this->detailAuditModel->where('id_audit', $id)->countAllResults();
        $todoCart = $this->detailAuditModel->where('id_audit', $id)->where('status', 'to do')->countAllResults();
        $passedCart = $this->detailAuditModel->where('id_audit', $id)->where('status', 'passed')->countAllResults();
        $failedCart = $this->detailAuditModel->where('id_audit', $id)->where('status', 'failed')->countAllResults();
        $doneCp = $this->detailAuditModel->where('id_audit', $id)->whereNotIn('status', $names)->countAllResults();
        $detailTask = $db->table('tbl_detail_audit')->select('*')->join('tbl_cp', 'tbl_cp.id_cp = tbl_detail_audit.id_cp')->where('id_audit', $id)->get()->getResultArray();
        $allFn = $db->table('tbl_detail_audit')->select('*')->join('tbl_finding', 'tbl_finding.id_detail_audit = tbl_detail_audit.id_detail_audit')->where('id_audit', $id)->countAllResults();
        $detailFinding = $this->findingModel->findAll();
        //dd($allCp);
        $validation = \Config\Services::validation();
        $area = $this->areaModel->where('id_category', $audit['id_category'])->findAll();
        //dd($detailTask);
        //dd($area);
        $data = [
            'title' => 'Detail Audit Task',
            'audit' => $audit,
            'reporter' => $reporter,
            'auditor' => $auditor,
            'category' => $category,
            'allCp' => $allCp,
            'doneCp' => $doneCp,
            'detailTask' => $detailTask,
            'validation' => $validation,
            'area' => $area,
            'todo' => $todoCart,
            'passed' => $passedCart,
            'failed' => $failedCart,
            'finding' => $detailFinding,
            'allFin' => $allFn

        ];


        return view('task/detailTaskInfo', $data);
    }

    public function audity()
    {
        $db = \Config\Database::connect();
        $id = $this->request->getVar('id_audit');
        $id_area = $this->request->getVar('id_area');
        $data = $db->table('tbl_detail_audit')->join('tbl_cp', 'tbl_cp.id_cp = tbl_detail_audit.id_cp')->where('tbl_detail_audit.id_audit', $id)->where('tbl_cp.id_area', $id_area)->get()->getResultArray();
        foreach ($data as $dt) {
            $this->detailAuditModel->save([
                'id_detail_audit' => $dt['id_detail_audit'],
                'nama_audity' => $this->request->getVar('audity_name')
            ]);
        }
        session()->setFlashdata('pesan', 'Nama audity telah disimpan.');
        return redirect()->to('/taskSummary/detail/' . $id);
    }

    public function audityAuditor()
    {
        $db = \Config\Database::connect();
        $id = $this->request->getVar('id_audit');
        $id_area = $this->request->getVar('id_area');
        $data = $db->table('tbl_detail_audit')->join('tbl_cp', 'tbl_cp.id_cp = tbl_detail_audit.id_cp')->where('tbl_detail_audit.id_audit', $id)->where('tbl_cp.id_area', $id_area)->get()->getResultArray();
        foreach ($data as $dt) {
            $this->detailAuditModel->save([
                'id_detail_audit' => $dt['id_detail_audit'],
                'nama_audity' => $this->request->getVar('audity_name')
            ]);
        }
        session()->setFlashdata('pesan', 'Nama audity telah disimpan.');
        return redirect()->to('/task/detail/' . $id);
    }
}
