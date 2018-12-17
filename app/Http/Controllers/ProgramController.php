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
 | Program Controller
 |--------------------------------------------------------------------------
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Program;
use App\Matching;

/**
* This controller handles programss
*/
class ProgramController extends Controller
{
  /**
  * Create a new controller instance
  *
  * @return void
  */
  public function __construct() {

  }

}
