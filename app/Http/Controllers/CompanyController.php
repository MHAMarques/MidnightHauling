<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function show($id)
    {
        if ($id == 'null') {
            return view('welcome');
        }

        return view('hub', [
            'companyID' => $id,
            'company' => Company::getCompany($id)
        ]);
    }

    public function search(Request $request)
    {
        $companySearch = $request->company;
        if ($companySearch) {
            return view('search', [
                'company' => $companySearch,
                'companies' => Company::listCompanies($companySearch)
            ]);
        } else {
            return view('search', [
                'company' => null,
                'companies' => []
            ]);
        }
    }
}
