<?php

namespace App\Http\Controllers;

use App\Models\TaxPayer;
use Illuminate\Http\Request;

class PublicTaxController extends Controller
{
    public function checkDebt()
    { 
        return view('check-debt');
    }

    public function queryDebt(Request $request)
    {
        $request->validate([
            'tax_number' => 'required|string',
        ]);

        $taxPayer = TaxPayer::where('tax_number', $request->tax_number)
            ->where('is_active', true)
            ->first();
        return view('debt-result', compact('taxPayer'));
    }

    public function requestClearance($id)
    {
        $taxPayer = TaxPayer::findOrFail($id);

        if (!$taxPayer->isEligibleForClearance()) {
            return back()->with('error', 'لا يمكن طلب وثيقة البراءة بسبب وجود ديون.');
         }
            return back()->with('success', 'تم طلب وثيقة البراءة بنجاح.');
    }
}
