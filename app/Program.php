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
 | Program Model
 |--------------------------------------------------------------------------
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
* This model handles applicants
*/
class Program extends Model
{

  /**
  * Get all programs with status 1 ordered by name asc
  *
  * @return Illuminate\Database\Eloquent\Collection programs
  */
  public function getAll() {
    return (Program::whereIn('status', [1])->orderBy('name', 'asc')->get());
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

  public $primaryKey = 'pid';

}
