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
 | Auth Controller
 |--------------------------------------------------------------------------
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ApplicantController;
use App\Matching;
use App\Applicant;
use App\Program;
use App\Preference;

/**
* This controller handles authentication.
*/
class AuthController extends Controller
{

  /**
  * Create a new controller instance
  *
  * @return void
  */
  public function __construct() {

  }

  // Shibboleth related: first login to the site
  public function handelInitAuthentication() {
    if (isset($_SERVER['matrikelnummer'])) {
      $studentID = $_SERVER['matrikelnummer'];
      return redirect()->action('ApplicantController@show', $studentID);
    } else {
      abort(403, 'Unauthorized action. There were problems with Shibboleth and your student-id. Please contact zewkursm@mail.uni-mannheim.de');
    }
  }

  // Shibboleth related: authentication on every site (no cookie used)
  public function handelAuthentication($aid) {
    if (isset($_SERVER['matrikelnummer']) && $aid == $_SERVER['matrikelnummer']) {
      $studentID = $_SERVER['matrikelnummer'];
      return $studentID;
    } else {
      $applicant = Applicant::where('aid', '=', $aid)->firstOrFail();
      if ($applicant->aid > 1000000) {
        return $applicant->aid;
      } else {
        abort(403, 'Unauthorized action. There were problems with Shibboleth and your student-id. Please contact zewkursm@mail.uni-mannheim.de');
      }
    }
  }

  public function isUserValid($aid) {
    if (isset($_SERVER['matrikelnummer']) && $_SERVER['matrikelnummer'] == $aid) {
      return true;
    } else {
      return false;
    }
  }

  public function loginExchange() {
    return view('applicant.activationcode');
  }

  public function activate(Request $request) {
    $applicant = Applicant::where('aid', '=', $request->code)->first();
    if ($applicant && $applicant->aid > 1000000) {
      return redirect()->action('ApplicantController@show', $request->code);
    } else {
      return Redirect::back()->withErrors(['Wrong Activation Code. Please check your input.']);
    }
  }
}
