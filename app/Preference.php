<?php
/*
 * This file is part of the KitaMatch app.
 *
 * (c) Sven Giegerich <sven.giegerich@mailbox.org>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 /*
 |--------------------------------------------------------------------------
 | Preference Model
 |--------------------------------------------------------------------------
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
* This model handles applicants
*/
class Preference extends Model
{


  public function getPreferencesByApplicant($aid) {
    $preferences = DB::table('preferences')->where('id_from', '=', $aid)
      ->whereIn('pr_kind', [1,2])
      ->where('status', '=', 1)
      ->orderBy('rank', 'asc')
      ->get();
    return $preferences;
  }

  /**
  * Get the lowest preference rank of an applicant.
  * For example applicant 1 has ranked (1,2,3,4), the lowest rank would be 4.
  *
  * @param integer $aid Applicant-ID
  * @return integer
  */
  public function getLowestRankApplicant($aid) {
    $sql = "SELECT rank FROM preferences WHERE id_from = " . $aid . " AND (pr_kind = 1 OR pr_kind = 2) ORDER BY rank DESC LIMIT 1";
    $lowestRank = DB::select($sql);
    if (count($lowestRank) > 0) {
      $rank = $lowestRank['0']->rank;
    } else {
      $rank = 1;
    }
    return $rank;
  }

  /**
  * The dates that should be available for Carbon
  *
  * @var array
  */
  protected $dates = [
    'created_at',
    'updated_at'
  ];

  public $primaryKey = 'prid';

}
