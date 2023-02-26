<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\CheckModel;
use App\Models\AreaModel;
use App\Models\AuditModel;
use App\Models\DetailAuditModel;

class CheckController extends BaseController
{
    protected $categoryModel;
    protected $checkModel;
    protected $areaModel;
    protected $auditModel;
    protected $detailAuditModel;
    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->checkModel = new CheckModel();
        $this->areaModel = new AreaModel();
        $this->auditModel = new AuditModel();
        $this->detailAuditModel = new DetailAuditModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $check = $db->table('tbl_cp')->select('*')->join('tbl_area', 'tbl_area.id_area = tbl_cp.id_area')->join('tbl_category', 'tbl_category.id_category = tbl_area.id_category')->orderBy('id_cp', 'DESC')->get()->getResultArray();
        $detail = $this->detailAuditModel->select('*')->orderBy('id_cp')->findAll();
        $arrDetail = [];
        foreach ($detail as $d) {
            $arrDetail[$d['id_cp']] = 0;
        }
        $category = $this->categoryModel->findAll();
        $data = [
            'title' => 'Check Point',
            'check' => $check,
            'category' => $category,
            'arrDetail' => $arrDetail
        ];


        return view('check/main', $data);
    }

    public function bulkAdd()
    {
        $db = \Config\Database::connect();
        $check = $db->table('tbl_cp')->select('*')->join('tbl_area', 'tbl_area.id_area = tbl_cp.id_area')->join('tbl_category', 'tbl_category.id_category = tbl_area.id_category')->orderBy('id_cp', 'DESC')->get()->getResultArray();
        $category = $this->categoryModel->findAll();
        $data = [
            'title' => 'Bulk Check Point',
            'check' => $check,
            'category' => $category
        ];


        return view('check/add_bulk', $data);
    }

    public function save()
    {
        $this->checkModel->save([
            'title_cp' => $this->request->getVar('title_cp'),
            'clausal' => $this->request->getVar('clausal'),
            'evidence' => $this->request->getVar('evidence'),
            'id_area' => $this->request->getVar('id_area'),
            'tipe' => $this->request->getVar('tipe'),
            'description' => $this->request->getVar('description')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to($this->request->getVar('uri'));
    }

    public function saveMulti()
    {
        $count = $this->request->getVar('count');
        $checkPost = false;
        for ($i = 1; $i <= $count; $i++) {
            if ($this->request->getVar('check' . $i)) {
                $this->checkModel->save([
                    'title_cp' => $this->request->getVar('title_cp' . $i),
                    'clausal' => $this->request->getVar('clausal' . $i),
                    'evidence' => $this->request->getVar('evidence' . $i),
                    'id_area' => $this->request->getVar('id_area' . $i),
                    'tipe' => $this->request->getVar('tipe' . $i),
                    'description' => $this->request->getVar('description' . $i)
                ]);
                $checkPost = true;
            }
        }
        if ($checkPost) {
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
            return redirect()->to($this->request->getVar('uri'));
        } else {
            session()->setFlashdata('gagal', 'Tidak ada data yang dipilih.');
            return redirect()->to($this->request->getVar('uri'));
        }
    }

    public function saveMultiBulk()
    {
        $count = $this->request->getVar('count');
        if ($count != "0") {
            for ($i = 1; $i <= $count; $i++) {
                if ($this->request->getVar('title' . $i) != null) {
                    $this->checkModel->save([
                        'title_cp' => $this->request->getVar('title' . $i),
                        'clausal' => $this->request->getVar('clausal' . $i),
                        'evidence' => $this->request->getVar('evidence' . $i),
                        'id_area' => $this->request->getVar('id_area' . $i),
                        'tipe' => $this->request->getVar('tipe' . $i),
                        'description' => $this->request->getVar('keterangan' . $i)
                    ]);
                }
            }
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
            return redirect()->to('check');
        } else {
            session()->setFlashdata('gagal', 'Tidak ada data yg tambah.');
            return redirect()->to('/check/bulk');
        }
    }

    public function update()
    {
        $this->checkModel->save([
            'id_cp' => $this->request->getVar('id_cp'),
            'title_cp' => $this->request->getVar('title_cp'),
            'clausal' => $this->request->getVar('clausal'),
            'evidence' => $this->request->getVar('evidence'),
            'id_area' => $this->request->getVar('id_area'),
            'description' => $this->request->getVar('description')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to($this->request->getVar('uri'));
    }

    public function delete()
    {
        $this->checkModel->delete($this->request->getVar('id_cp'));
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to($this->request->getVar('uri'));
    }

    public function getDataById()
    {
        $area = $this->areaModel->where('id_category', $this->request->getVar('id'))->findAll();
        $id_area = $area[0]['id_area'];
        $cp = $this->checkModel->where('id_area', $id_area)->where('tipe', 'system')->findAll();
        echo json_encode($cp);
    }

    public function getDataByIdProses()
    {
        $db = \Config\Database::connect();
        $names = ['Verification', 'System'];
        $cp = $db->table('tbl_cp')->select('*')->join('tbl_area', 'tbl_area.id_area = tbl_cp.id_area')->where('tbl_area.id_category', $this->request->getVar('id'))->whereNotIn('nama_area', $names)->orderBy('tbl_cp.id_area', 'ASC')->get()->getResultArray();
        echo json_encode($cp);
    }

    public function search()
    {
        $db = \Config\Database::connect();
        $cp = $db->table('tbl_cp')->select('*')->like('title_cp', $this->request->getVar('id'))->get()->getResultArray();

        $resultData = [];
        $inum = 0;
        for ($i = 0; $i < count($cp); $i++) {
            $task = $db->table('tbl_audit')->select('task_name, tbl_category.title, deadline, tbl_detail_audit.status')->join('tbl_detail_audit', 'tbl_detail_audit.id_audit = tbl_audit.id_audit')->join('tbl_cp', 'tbl_cp.id_cp = tbl_detail_audit.id_cp')->join('tbl_category', 'tbl_category.id_category = tbl_audit.id_category')->where('tbl_detail_audit.id_cp', $cp[$i]['id_cp'])->orderBy('tbl_audit.id_audit', 'DESC')->limit(5)->get()->getResultArray();
            $data = array();
            for ($a = 0; $a < count($task); $a++) {
                $data[$a] = ['task' => $task[$a]['task_name'], 'category' => $task[$a]['title'], 'date' => $task[$a]['deadline'], 'status' => $task[$a]['status']];
            }

            if (count($resultData) == 0) {
                $resultData[$inum] = [
                    'title_cp' => $cp[$i]['title_cp'],
                    'evidence' => $cp[$i]['evidence'],
                    'clausal' => $cp[$i]['clausal'],
                    'description' => $cp[$i]['description'],
                    'data' => $data
                ];
            } else {
                $match = false;
                $numbTemp = null;
                for ($z = 0; $z < count($resultData); $z++) {
                    if ($resultData[$z]['title_cp'] == $cp[$i]['title_cp']) {
                        $match = true;
                        $numbTemp = $z;
                        break;
                    }
                }
                if ($match == true) {
                    for ($c = 0; $c < count($data); $c++) {
                        array_push($resultData[$numbTemp]['data'], $data[$c]);
                    }
                    $inum = $inum - 1;
                } else {
                    $resultData[$inum] = [
                        'title_cp' => $cp[$i]['title_cp'],
                        'evidence' => $cp[$i]['evidence'],
                        'clausal' => $cp[$i]['clausal'],
                        'description' => $cp[$i]['description'],
                        'data' => $data
                    ];
                }
            }
            $inum++;
        }
        echo json_encode($resultData);
    }

    public function searchClausal()
    {
        $db = \Config\Database::connect();
        $cp = $db->table('tbl_cp')->select('*')->like('clausal', $this->request->getVar('id'))->get()->getResultArray();

        $resultData = [];
        $inum = 0;
        for ($i = 0; $i < count($cp); $i++) {
            $task = $db->table('tbl_audit')->select('task_name, tbl_category.title, deadline, tbl_detail_audit.status')->join('tbl_detail_audit', 'tbl_detail_audit.id_audit = tbl_audit.id_audit')->join('tbl_cp', 'tbl_cp.id_cp = tbl_detail_audit.id_cp')->join('tbl_category', 'tbl_category.id_category = tbl_audit.id_category')->where('tbl_detail_audit.id_cp', $cp[$i]['id_cp'])->orderBy('tbl_audit.id_audit', 'DESC')->limit(5)->get()->getResultArray();
            $data = array();
            for ($a = 0; $a < count($task); $a++) {
                $data[$a] = ['task' => $task[$a]['task_name'], 'category' => $task[$a]['title'], 'date' => $task[$a]['deadline'], 'status' => $task[$a]['status']];
            }

            if (count($resultData) == 0) {
                $resultData[$inum] = [
                    'title_cp' => $cp[$i]['title_cp'],
                    'evidence' => $cp[$i]['evidence'],
                    'clausal' => $cp[$i]['clausal'],
                    'description' => $cp[$i]['description'],
                    'data' => $data
                ];
            } else {
                $match = false;
                $numbTemp = null;
                for ($z = 0; $z < count($resultData); $z++) {
                    if ($resultData[$z]['title_cp'] == $cp[$i]['title_cp']) {
                        $match = true;
                        $numbTemp = $z;
                        break;
                    }
                }
                if ($match == true) {
                    for ($c = 0; $c < count($data); $c++) {
                        array_push($resultData[$numbTemp]['data'], $data[$c]);
                    }
                    $inum = $inum - 1;
                } else {
                    $resultData[$inum] = [
                        'title_cp' => $cp[$i]['title_cp'],
                        'evidence' => $cp[$i]['evidence'],
                        'clausal' => $cp[$i]['clausal'],
                        'description' => $cp[$i]['description'],
                        'data' => $data
                    ];
                }
            }
            $inum++;
        }
        echo json_encode($resultData);
    }
}
