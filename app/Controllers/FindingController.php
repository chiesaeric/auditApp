<?php

namespace App\Controllers;

use App\Models\FindingModel;
use App\Models\AuditModel;
use App\Models\DetailAuditModel;

class FindingController extends BaseController
{
    protected $findingModel;
    protected $auditModel;
    protected $detailAuditModel;
    public function __construct()
    {
        $this->findingModel = new FindingModel();
        $this->auditModel = new AuditModel();
        $this->detailAuditModel = new DetailAuditModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $audit = $db->query('select id_audit, a.nama as id_reporter, b.nama as id_assigne, id_reporter as reporter, id_assigne as assigne, tbl_audit.id_category as category, c.title as id_category, tbl_audit.status, deadline from tbl_audit inner join tbl_users a on tbl_audit.id_reporter = a.id_users inner join tbl_users b on tbl_audit.id_assigne = b.id_users inner join tbl_category c on tbl_audit.id_category = c.id_category ORDER BY id_audit DESC;')->getResultArray();
        $detailAudit = $this->detailAuditModel->findAll();
        $finding = $this->findingModel->findAll();
        $arrFind = array();
        foreach ($audit as $ad) :
            $arrFind[$ad['id_audit']] = count($db->table('tbl_finding')->select('*')->join('tbl_detail_audit', 'tbl_detail_audit.id_detail_audit = tbl_finding.id_detail_audit')->join('tbl_audit', 'tbl_audit.id_audit = tbl_detail_audit.id_audit')->where('tbl_detail_audit.id_audit', $ad['id_audit'])->where('status_finding', 'finding')->get()->getResultArray());
        endforeach;
        $data = [
            'title' => 'Finding',
            'audit' => $audit,
            'detailAudit' => $detailAudit,
            'finding' => $finding,
            'arrFind' => $arrFind
        ];
        $totalFinding = count($this->findingModel->where('status_finding', 'finding')->findAll());
        session()->set(['totalFinding' => $totalFinding]);

        return view('finding/main', $data);
    }

    public function getDataFindingIdAudit()
    {
        $db = \Config\Database::connect();
        $cp = $db->table('tbl_finding')->select('*')->join('tbl_detail_audit', 'tbl_detail_audit.id_detail_audit = tbl_finding.id_detail_audit')->join('tbl_cp', 'tbl_cp.id_cp = tbl_detail_audit.id_cp')->where('tbl_detail_audit.id_audit', $this->request->getVar('id'))->where('tbl_detail_audit.status', 'failed')->get()->getResultArray();

        echo json_encode($cp);
    }

    public function getDataFindingIdDetail()
    {
        $db = \Config\Database::connect();
        $detail = $db->table('tbl_finding')->select('*')->join('tbl_detail_audit', 'tbl_detail_audit.id_detail_audit = tbl_finding.id_detail_audit')->where('tbl_finding.id_detail_audit', $this->request->getVar('id'))->get()->getResultArray();
        echo json_encode($detail);
    }

    public function save()
    {
        // dd($this->request->getVar());
        if ($this->request->getFile('file_path') != "") {
            $img = $this->request->getFile('file_path');
            $getType = explode(".", $img->getName())[1];
            $getFileName = $this->request->getVar('id_detail_audit') . "." . $getType;
            $img->move('img/audit/' . $this->request->getVar('id_audit'), $getFileName, true);

            if ($this->request->getVar('status_finding') == "finding") {
                $this->detailAuditModel->save([
                    'id_detail_audit' => $this->request->getVar('id_detail_audit'),
                    'file_path' => '/audit/' . $this->request->getVar('id_audit') . "/" . $getFileName,
                    'desc_audit' => $this->request->getVar('desc_audit')
                ]);
            } else {
                $this->detailAuditModel->save([
                    'id_detail_audit' => $this->request->getVar('id_detail_audit'),
                    'file_path' => '/audit/' . $this->request->getVar('id_audit') . "/" . $getFileName,
                    'desc_audit' => $this->request->getVar('desc_audit'),
                    'status' => 'passed'
                ]);
            }
            $this->findingModel->save([
                'id_finding' => $this->request->getVar('id_finding'),
                'status_finding' => $this->request->getVar('status_finding'),
                'category_finding' => $this->request->getVar('category_finding'),
                'cause' => $this->request->getVar('cause'),
                'short_term' => $this->request->getVar('short_term'),
                'long_term' => $this->request->getVar('long_term'),
                'revised' => $this->request->getVar('revised')
            ]);
        } else {
            if ($this->request->getVar('status_finding') == "finding") {
                $this->detailAuditModel->save([
                    'id_detail_audit' => $this->request->getVar('id_detail_audit'),
                    'desc_audit' => $this->request->getVar('desc_audit')
                ]);
            } else {
                $this->detailAuditModel->save([
                    'id_detail_audit' => $this->request->getVar('id_detail_audit'),
                    'desc_audit' => $this->request->getVar('desc_audit'),
                    'status' => 'passed'
                ]);
            }
            $this->findingModel->save([
                'id_finding' => $this->request->getVar('id_finding'),
                'status_finding' => $this->request->getVar('status_finding'),
                'category_finding' => $this->request->getVar('category_finding'),
                'cause' => $this->request->getVar('cause'),
                'short_term' => $this->request->getVar('short_term'),
                'long_term' => $this->request->getVar('long_term'),
                'revised' => $this->request->getVar('revised')
            ]);
        }
        $totalFinding = count($this->findingModel->where('status_finding', 'finding')->findAll());
        session()->set(['totalFinding' => $totalFinding]);
        session()->setFlashdata('pesan', 'Data finding berhasil diubah.');
        return redirect()->to('/finding');
    }
}
