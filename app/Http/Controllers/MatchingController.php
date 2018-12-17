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
 | Matching Controller
 |--------------------------------------------------------------------------
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProgramController;
use App\Matching;
use App\Applicant;
use App\Program;
use App\Preference;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

/**
* This controller is responsible for the matching process.
*/
class MatchingController extends Controller
{

  /**
  * Create a new controller instance
  *
  * @return void
  */
  public function __construct() {

  }

  // Data privacy protection - generates two seperate files: i) a preference file with completly anonymised applicant ids, ii) a "matching table" between the true applicant id (e.g. a student id) and the anonymised id
  public function writeCsvFiles() {
    $sql_applicants = "SELECT * FROM applicants;";
    $sql_programs = "SELECT * FROM programs;";
    $sql_preferences = "SELECT preferences.prid, preferences.id_from, preferences.id_to_1, preferences.id_to_2, preferences.pr_kind, preferences.rank, preferences.status, preferences.created_at, preferences.updated_at, applicants.anonymised_id FROM preferences INNER JOIN applicants ON applicants.aid=preferences.id_from;";

    $applicants = DB::select($sql_applicants);
    $programs = DB::select($sql_programs);
    $preferences = DB::select($sql_preferences);

    $applicant_string = "aid, anonymised_id" . PHP_EOL;
    foreach ($applicants as $applicant) {
      $applicant_string = $applicant_string . $applicant->aid . "," . $applicant->anonymised_id;
      $applicant_string = $applicant_string . PHP_EOL;
    }

    $program_string = "pid, name, capacity" . PHP_EOL;
    foreach ($programs as $program) {
      $program_string = $program_string . $program->pid . "," . $program->name. "," . $program->capacity;
      $program_string = $program_string . PHP_EOL;
    }

    $preference_string = "prid, id_to_1, id_to_2, pr_kind, rank, status, created_at, updated_at, aid" . PHP_EOL;
    foreach ($preferences as $preference) {
      $preference_string = $preference_string . $preference->prid . "," . $preference->id_to_1 . "," . $preference->id_to_2 . "," . $preference->pr_kind . "," . $preference->rank . "," . $preference->status . "," . $preference->created_at . "," . $preference->updated_at . "," . $preference->anonymised_id;
      $preference_string = $preference_string . PHP_EOL;
    }

    $date = date('Ymd_H:i:s');
    // default storage location: "/storage/app"
    Storage::put('students_' . $date . '.csv', $applicant_string);
    Storage::put('programs_' . $date . '.csv', $program_string);
    Storage::put('preferences_' . $date . '.csv', $preference_string);
  }

}
