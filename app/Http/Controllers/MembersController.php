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
        $driver = $request->driver;
        $job = $request->job;
        $turn = $request->turn;

        if ($driver && $turn) {
            $checkDriver = Members::showMember($driver);
            if (!$checkDriver['company_id'] || $checkDriver['company_id'] != $id) {
                abort(404);
            }
            return view('member', [
                'companyID' => $id,
                'member' => $checkDriver,
                'jobs' => Members::memberJobs($driver, $turn)
            ]);
        } elseif ($driver) {
            $checkDriver = Members::showMember($driver);
            if (!$checkDriver['company_id'] || $checkDriver['company_id'] != $id) {
                abort(404);
            }
            return view('member', [
                'companyID' => $id,
                'member' => $checkDriver,
                'jobs' => Members::memberJobs($driver, null)
            ]);
        } elseif ($job) {
            $checkJob = Members::memberJob($job, null);
            if (!$checkJob['company_id'] || $checkJob['company_id'] != $id) {
                abort(404);
            }
            return view('job', [
                'companyID' => $id,
                'job' => $checkJob
            ]);
        } elseif ($page) {
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
