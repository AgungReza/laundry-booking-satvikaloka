<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Services\ReportService;

class ReportController extends BaseController
{
    public function index()
    {
        $summary = (new ReportService())->summary(
            $this->request->getGet('start_date'),
            $this->request->getGet('end_date')
        );
        return view('layouts/admin', ['title' => 'Laporan Keuangan', 'content' => view('admin/reports/index', compact('summary'))]);
    }
}
