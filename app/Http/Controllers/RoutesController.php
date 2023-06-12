<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Members;
use Illuminate\Http\Request;

class RoutesController extends Controller
{

    public function index($id, Request $request)
    {
        if ($id == 'null') {
            abort(404);
        }

        $game = $request->game;

        if ($game == 'ets') {
            return view('routesETS', [
                'companyID' => $id,
                'company' => Company::getCompany($id),
                'routesETS' => Company::getETSRoutes($id)
            ]);
        } elseif ($game == 'ats') {
            return view('routesATS', [
                'companyID' => $id,
                'company' => Company::getCompany($id),
                'routesATS' => Company::getATSRoutes($id)
            ]);
        } else {
            return view('routes', [
                'companyID' => $id,
                'company' => Company::getCompany($id),
                'routes' => Company::getCompanyYearStats($id)
            ]);
        }
    }
}
