<?php

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/hub/{id}', function ($id) {
    return view('home', [
        'company' => Company::getCompany($id)
    ]);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', function (Request $request) {
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
});
