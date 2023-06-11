<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Members;
use Illuminate\Http\Request;

class MarketController extends Controller
{

    public function index($id, Request $request)
    {
        if ($id == 'null') {
            abort(404);
        }

        $game = $request->game;

        if ($game == 'ets') {
            return view('marketETS', [
                'companyID' => $id,
                'company' => Company::getCompany($id),
                'marketETS' => Company::getETSMarket()
            ]);
        } elseif ($game == 'ats') {
            return view('marketATS', [
                'companyID' => $id,
                'company' => Company::getCompany($id),
                'marketATS' => Company::getATSMarket()
            ]);
        } else {
            return view('market', [
                'companyID' => $id,
                'company' => Company::getCompany($id),
                'marketETS' => Company::getETSMarket(),
                'marketATS' => Company::getATSMarket()
            ]);
        }
    }
}
