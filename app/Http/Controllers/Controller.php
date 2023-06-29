<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\HttpResponse;
use App\Traits\NotificationMessage;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, HttpResponse, NotificationMessage;
}
