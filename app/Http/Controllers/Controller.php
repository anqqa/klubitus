<?php namespace klubitus\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as IlluminateController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends IlluminateController {

	use DispatchesCommands, ValidatesRequests;

}
