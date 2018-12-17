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
 | Preference Controller
 |--------------------------------------------------------------------------
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use App\Preference;
use App\Program;
use App\Applicant;

/**
* This controller handles the preferences of applicants & programs: add/edit, arrange preferences
*/
class PreferenceController extends Controller
{


  /**
  * Store a single preference: either single or couple preferences
  *
  * @param Illuminate\Http\Request $request request
  * @return App\Preference
  */
  public function store(Request $request) {
    $preference = new Preference;
    $preference->id_from = $request->from;

    if ($request->to_1 > 1 && $request->to_2 > 1) {
      $preference->pr_kind = 2;
      $preference->id_to_1 = $request->to_1;
      $preference->id_to_2 = $request->to_2;
    } else {
      $preference->pr_kind = 1;
      $preference->id_to = $request->to_1;
    }

    $preference->rank = $request->rank;
    $preference->status = 1;
    $preference->save();

    return $preference;
  }

  /**
  * Show all preferences of an applicant on a view
  *
  * @param integer $aid Applicant-ID
  * @return view preference.showByApplicant
  */
  public function showByApplicant($a) {
    if (is_array($a)) {
      $aid = $a[1];
      $select = $a[2];
    } else {
      $aid = $a;
      $select = -1;
    }

    //Auth - start
    $auth = new AuthController();
    $aid = $auth->handelAuthentication($aid);
    //Auth - end

    $Applicant = new Applicant;
    $Program = new Program;
    $Preference = new Preference;
    $applicant = $Applicant::find($aid);
    $preferences = $Preference->getPreferencesByApplicant($aid);
    $programs = $Program->getAll();
    foreach ($preferences as $preference) {
      if ($preference->pr_kind == 2) {
        $preference->programNames = $programs->where('pid', $preference->id_to_1)->first()->name . " & " . $programs->where('pid', $preference->id_to_2)->first()->name;
      } else {
        $preference->programNames = $programs->where('pid', $preference->id_to_1)->first()->name;
      }
    }
    $select1 = array();
    $instructors = array();
    foreach ($programs as $program) {
      $select1[$program->pid] = $program->name . " (" . $program->instructor . ")";
      $instructors[$program->pid] = $program->instructor;
    }
    $select1 = array('-1' => '---') + $select1;
    $select2 = $select1;

    return view('preference.byApplicant', array('preferences' => $preferences,
                                                'applicant' => $applicant,
                                                'programs1' => $select1,
                                                'programs2' => $select2,
                                                'aid' => $aid,
                                                'select' => $select,
    ));
  }

  /**
  * Add a preference of an applicant
  *
  * @param Illuminate\Http\Request $request request
  * @param integer $aid Applicant-ID
  * @return action PreferenceController@showByApplicant
  */
  public function addByApplicant(Request $request, $aid) {

    $Preference = new Preference;
    $rank = $Preference->getLowestRankApplicant($aid) + 1;
    $preference = new Preference;

    if ($request->to_1 == -1) {
      return Redirect::back();
    }

    if ($rank > 100) {
      $rank = $rank - 100;
    }

    $preference->id_from = $aid;
    $preference->id_to_1 = $request->to_1;
    if ($request->to_2 == -1) {
      $preference->pr_kind = 1;
      $rank = $rank + 100;
      $to_2 = null;
    } else {
      $preference->pr_kind = 2;
      $preference->id_to_2 = $request->to_2;
      $to_2 = $request->to_2;
    }
    $preference->rank = $rank;
    $preference->status = 1;

    // is the preference a potential duplicate?
    $duplicate_pref = Preference::where('id_from', $aid)
                                ->where('id_to_1', $request->to_1)
                                ->where('id_to_2', $to_2)
                                ->where('status', 1)
                                ->whereIn('pr_kind', [1,2])
                                ->first();
    if (!empty($duplicate_pref)) {
      // duplicated entry -> redirect with error message
      return Redirect::back()->withErrors(['You have already submitted this selection. Please check your list of seminars.']);
    }

    $preference->save();

    // specific context
    // always add both seminars seperatly if a couple prefernce is indicated
    if ($preference->pr_kind = 2) {
      $duplicate_pref_1 = Preference::where('id_from', $aid)
        ->where('id_to_1', $request->to_1)
        ->where('status', 1)
        ->whereIn('pr_kind', [1])
        ->first();

      $duplicate_pref_2 = Preference::where('id_from', $aid)
          ->where('id_to_1', $request->to_2)
          ->where('status', 1)
          ->whereIn('pr_kind', [1])
          ->first();

      if (empty($duplicate_pref_1) && $request->to_1 > 0) {
        $preference = new Preference;
        $preference->id_from = $aid;
        $preference->pr_kind = 1;
        $preference->id_to_1 = $request->to_1;
        $preference->rank = $rank+1 + 100;

        $preference->status = 1;
        $preference->save();
      }
      if (empty($duplicate_pref_2) && $request->to_2 > 0) {
        $preference = new Preference;
        $preference->id_from = $aid;
        $preference->pr_kind = 1;
        $preference->id_to_1 = $request->to_2;
        $preference->rank = $rank+2 + 100;

        $preference->status = 1;
        $preference->save();
      }
    }

    if ($request->to_2 > -1) {
      $select = 2;
    } else {
      $select = 1;
    }

    return redirect()->action('PreferenceController@showByApplicant', array('aid' => $aid, 'select' => $select));
  }

  /**
  * Change the preference orders of a single applicant, ajax sided
  *
  * @param App\Http\Requests $request request
  * @param integer $aid Applicant-ID
  * @return json
  */
  public function reorderByApplicantAjax(Request $request, $aid) {
    $programIds = $request->all();
    //https://laracasts.com/discuss/channels/laravel/sortable-list-with-change-in-database
    parse_str($request->order, $programs);
    foreach ($programs['item'] as $index => $preferenceId) {
      $preference = Preference::find($preferenceId);
      $preference->rank = $index+1;
      $preference->save();
    }
    return response()->json([
      'success' => true
    ]);
  }

  /**
  * Prepare the ajax sided deletion of a single preference by an applicant
  *
  * @param App\Http\Requests $request request
  * @param integer $aid Applicant-ID
  * @return json
  */
  public function deleteByApplicantAjax(Request $request, $aid) {
    $prid = substr($request->itemId, strpos($request->itemId, "-") + 1);
    $this->deleteByApplicant($request, $prid);
    return response()->json([
      'success' => true
    ]);
  }

  /**
  * Delete a single preference by an applicant
  *
  * @param App\Http\Requests $request request
  * @param integer $prid Preference-ID
  * @return App\Preference
  */
  public function deleteByApplicant(Request $request, $prid) {
    $preference = Preference::find($prid);
    //temp: set status=0 instead of deleting
    $preference->status = 0;
    $preference->save();
    return $preference;
  }

  /**
  * Create a new controller instance
  *
  * @return void
  */
  public function __construct() {

  }

}
