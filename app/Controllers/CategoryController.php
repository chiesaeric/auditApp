<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\CheckModel;
use App\Models\AreaModel;
use App\Models\AuditModel;
use CodeIgniter\HTTP\Request;

class CategoryController extends BaseController
{
    protected $categoryModel;
    protected $checkModel;
    protected $areaModel;
    protected $auditModel;
    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->checkModel = new CheckModel();
        $this->areaModel = new AreaModel();
        $this->auditModel = new AuditModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $category = $this->categoryModel->orderBy('id_category', 'DESC')->findAll();
        $arrCat = array();
        foreach ($category as $c) :
            $arrCat[$c['id_category']] = count($db->table('tbl_cp')->select('*')->join('tbl_area', 'tbl_area.id_area = tbl_cp.id_area')->join('tbl_category', 'tbl_category.id_category = tbl_area.id_category')->where('tbl_area.id_category', $c['id_category'])->get()->getResultArray());
        endforeach;
        $data = [
            'title' => 'Category',
            'category' => $category,
            'countCat'  => $arrCat
        ];


        return view('category/main', $data);
    }

    public function save()
    {
        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->categoryModel->save([
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'type' => $this->request->getVar('tipe')
        ]);
        $tipe = "";
        if ($this->request->getVar('tipe') == "proses") {
            $tipe = "verification";
        } else if ($this->request->getVar('tipe') == "system") {
            $tipe = "system";
        }
        $lastId = $this->categoryModel->getInsertID();
        $this->areaModel->save([
            'nama_area' => $tipe,
            'id_category' => $lastId
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/category');
    }

    public function update()
    {
        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->categoryModel->save([
            'id_category' => $this->request->getVar('id_category'),
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'type' => $this->request->getVar('tipe')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('/category');
    }

    public function duplicate()
    {
        $idCat = $this->request->getVar('id_category');
        $slug = url_title($this->request->getVar('title'), '-', true);
        //create category
        $this->categoryModel->save([
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'type' => $this->request->getVar('tipe')
        ]);
        $lastIdCat = $this->categoryModel->getInsertID();

        //create area
        $dataArea = $this->areaModel->where('id_category', $idCat)->findAll();
        foreach ($dataArea as $da) {
            $this->areaModel->save([
                'nama_area' => $da['nama_area'],
                'id_category' => $lastIdCat
            ]);
            $lastIdArea = $this->areaModel->getInsertID();

            //create checkpoint
            $dataCp = $this->checkModel->where('id_area', $da['id_area'])->findAll();
            foreach ($dataCp as $dc) {
                $this->checkModel->save([
                    'title_cp' => $dc['title_cp'],
                    'clausal' => $dc['clausal'],
                    'evidence' => $dc['evidence'],
                    'id_area' => $lastIdArea,
                    'description' => $dc['description'],
                    'tipe' => $dc['tipe']

                ]);
            }
        }


        session()->setFlashdata('pesan', 'Category berhasil diduplicate.');
        return redirect()->to('/category');
    }

    public function delete()
    {
        $dataAudit = $this->auditModel->where('id_category', $this->request->getVar('id_category'))->first();

        if ($dataAudit) {
            session()->setFlashdata('gagal', 'Category tidak dapat dihapus karena sudah ada task yg berjalan.');
            return redirect()->to('/category');
        } else {
            $dataAreaByIdCat = $this->areaModel->where('id_category', $this->request->getVar('id_category'))->findAll();
            if ($dataAreaByIdCat) {
                foreach ($dataAreaByIdCat as $da) {
                    $dataCpByIdArea = $this->checkModel->where('id_area', $da['id_area'])->findAll();
                    if ($dataCpByIdArea) {
                        foreach ($dataCpByIdArea as $dc) {
                            $this->checkModel->delete($dc['id_cp']);
                        }
                    }
                    $this->areaModel->delete($da['id_area']);
                }
            }
            $this->categoryModel->delete($this->request->getVar('id_category'));
            session()->setFlashdata('pesan', 'Data berhasil dihapus.');
            return redirect()->to('/category');
        }
    }

    public function detail($id)
    {
        $dataArr = explode("-", $id);
        $id = $dataArr[0];
        $type = $dataArr[1];
        $cekAudit = $this->auditModel->where('id_category', $id)->find();
        if ($cekAudit == null) {
            $deleteCp = true;
        } else {
            $deleteCp = false;
        }
        if ($type == "system") {
            $category = $this->categoryModel->find($id);
            $categoryAll = $this->categoryModel->where('type', 'system')->findAll();
            $area = $this->areaModel->where('id_category', $id)->findAll();
            $id_area = $area[0]['id_area'];
            $cp = $this->checkModel->where('id_area', $id_area)->where('tipe', 'system')->findAll();
            $cpCount = $this->checkModel->where('id_area', $id_area)->where('tipe', 'system')->countAllResults();
            $data = [
                'title' => 'Category Detail',
                'category' => $category,
                'categoryAll' => $categoryAll,
                'cp' => $cp,
                'cpCount' => $cpCount,
                'id_area' => $id_area,
                'deleteCp' => $deleteCp
            ];
            return view('category/detail', $data);
        } else {
            $db = \Config\Database::connect();
            $names = ['Verification', 'System'];
            $getVerif = $this->areaModel->where('id_category', $id)->where('nama_area', 'verification')->find();
            $id_area = $getVerif[0]['id_area'];
            $category = $this->categoryModel->find($id);
            $categoryAll = $this->categoryModel->where('type', 'proses')->findAll();
            $ver = $this->checkModel->where('id_area', $id_area)->where('tipe', 'verification')->findAll();
            $cp = $db->table('tbl_cp')->select('*')->join('tbl_area', 'tbl_area.id_area = tbl_cp.id_area')->where('tbl_area.id_category', $category['id_category'])->whereNotIn('nama_area', $names)->orderBy('tbl_cp.id_area', 'ASC')->get()->getResultArray();
            $verCount = $this->checkModel->where('id_area', $id_area)->where('tipe', 'verification')->countAllResults();
            $cpCount = $db->table('tbl_cp')->select('*')->join('tbl_area', 'tbl_area.id_area = tbl_cp.id_area')->where('tbl_area.id_category', $category['id_category'])->whereNotIn('nama_area', $names)->countAllResults();
            $area = $this->areaModel->where('id_category', $id)->whereNotIn('nama_area', $names)->findAll();
            $areaCount = $this->areaModel->where('id_category', $id)->whereNotIn('nama_area', $names)->countAllResults();
            $data = [
                'title' => 'Category Detail',
                'category' => $category,
                'categoryAll' => $categoryAll,
                'ver' => $ver,
                'cp' => $cp,
                'verCount' => $verCount,
                'cpCount' => $cpCount,
                'area' => $area,
                'areaCount' => $areaCount,
                'getVer' => $getVerif,
                'deleteCp' => $deleteCp

            ];


            return view('category/detailProses', $data);
        }
    }

    public function getDataCategory()
    {
        $cp = $this->categoryModel->findAll();
        echo json_encode($cp);
    }

    public function getDataByTipe()
    {
        $cp = $this->categoryModel->where('type', $this->request->getVar('id'))->findAll();
        echo json_encode($cp);
    }

    public function saveArea()
    {
        $this->areaModel->save([
            'nama_area' => $this->request->getVar('nama_area'),
            'id_category' => $this->request->getVar('id_category')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to($this->request->getVar('uri'));
    }

    public function updateArea()
    {
        $this->areaModel->save([
            'id_area' => $this->request->getVar('id_area'),
            'nama_area' => $this->request->getVar('nama_area')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to($this->request->getVar('uri'));
    }

    public function deleteArea()
    {
        $this->areaModel->delete($this->request->getVar('id_area'));
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to($this->request->getVar('uri'));
    }

    public function getDataArea()
    {
        $names = ['Verification', 'System'];
        $area = $this->areaModel->where('id_category', $this->request->getVar('id'))->whereNotIn('nama_area', $names)->orderBy('id_area', 'ASC')->findAll();
        echo json_encode($area);
    }

    public function getDataAreaById()
    {
        $area = $this->areaModel->where('id_category', $this->request->getVar('id'))->orderBy('id_area', 'ASC')->findAll();
        echo json_encode($area);
    }

    public function getDataAreaByName()
    {
        $area = $this->areaModel->where('id_category', $this->request->getVar('id'))->where('nama_area', $this->request->getVar('tipe'))->orderBy('id_area', 'ASC')->findAll();
    }
}
