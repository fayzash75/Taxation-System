<?php

namespace App\Http\Controllers;

use App\Models\ClearanceCertificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function view(ClearanceCertificate $certificate)
    {
        $taxPayer = $certificate->taxPayer;
        $data = [
            'certificate' => $certificate,
            'taxPayer' => $taxPayer,
        ];
        return view('certificates.view',$data);
        // return view('view', $data);
    }

    //   طباعة وثيقة براءة الذمة 
    public function print(ClearanceCertificate $certificate)
    {
        $certificate->load('taxPayer');
        if (!$certificate->taxPayer) {
            abort(404, 'خطأ في بيانات المكلف لا يمكن العثور عليه');
        }
        // التحقق من صلاحية الوثيقة
        if (!$certificate->is_valid) {
            abort(403, 'هذه الوثيقة ملغاة أو غير سارية');
        }
        $taxPayer = $certificate->taxPayer;
        $data = [
            'certificate' => $certificate,
            'taxPayer' => $taxPayer,
        ];
        $pdf = Pdf::loadView('certificates.pdf', $data);
        return $pdf->stream('وثيقة_براءة.pdf');
    }
}
