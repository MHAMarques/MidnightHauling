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

    public function admin($id)
    {
        if ($id == 'null') {
            return view('welcome');
        }

        return view('admin', [
            'companyID' => $id,
            'company' => Company::getCompany($id)
        ]);
    }

    public function logoff()
    {
        echo '<script>
            // Clear all cookies
            const cookies = document.cookie.split(";");
            
            for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i];
            const eqPos = cookie.indexOf("=");
            const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
            document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
            }
                
            localStorage.removeItem("MHCompanyId");
                window.location.replace("/");
            </script>';
    }
}
