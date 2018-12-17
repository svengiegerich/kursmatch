<?php
/*
 * This file is part of the Kursmatch app.
 *
 * (c) Sven Giegerich <sven.giegerich@mailbox.org>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 /*
 |--------------------------------------------------------------------------
 | Applican Controller
 |--------------------------------------------------------------------------
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AuthController;
use App\Matching;
use App\Applicant;
use App\Program;
use App\Preference;

/**
* This controller handles applicants: the creation of new applicants, update of existing ones, as well as status changes.
*/
class ApplicantController extends Controller
{
  /**
   * Create a new controller instance
   *
   * @return void
   */
  public function __construct() {
  }

  public function show($aid) {
    //Auth - start
    $auth = new AuthController();
    $aid = $auth->handelAuthentication($aid);
    //Auth - end
    return view('applicant.show', array('aid' => $aid));
  }

  public function submitted($aid) {
    //Auth - start
    $auth = new AuthController();
    $aid = $auth->handelAuthentication($aid);
    //Auth - end
    return view('applicant.submitted', array('aid' => $aid));
  }

  public function add(Request $request, $aid) {
    $Applicant = new Applicant;
    //look for a extising record
    $entry = $Applicant->find($aid);
    if (empty($entry)) {
      $this->store($request);

    }
    return redirect()->action('PreferenceController@showByApplicant', array('aid' => $request->aid, 'select' => -1));
  }

  public function store(Request $request) {
    $applicant = new Applicant;
    $applicant->aid = $request->aid;
    $applicant->status = 1;
    $applicant->save();
    return $applicant;
  }

}
