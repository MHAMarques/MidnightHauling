<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Members;
use Illuminate\Http\Request;

class MembersController extends Controller
{

    public function index($id, Request $request)
    {
        if ($id == 'null') {
            abort(404);
        }

        $page = $request->page;
        if ($page) {
            return view('members', [
                'companyID' => $id,
                'company' => Company::getCompany($id),
                'members' => Members::listMembers($id, $page)
            ]);
        } else {
            return view('members', [
                'companyID' => $id,
                'company' => Company::getCompany($id),
                'members' => Members::listMembers($id, null)
            ]);
        }
    }
}
