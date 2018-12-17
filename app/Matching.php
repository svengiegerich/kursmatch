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
 | Matching Model
 |--------------------------------------------------------------------------
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
* This model handles applicants
*/
class Matching extends Model
{


  /**
  * The dates that should be available for Carbon
  *
  * @var array
  */
  protected $dates = [
    'created_at',
    'updated_at'
  ];

  public $primaryKey = 'aid';

}
