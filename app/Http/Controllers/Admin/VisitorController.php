<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function getVisitorDetails()
    {
        $ip_address = $_SERVER['REMOTE_ADDR']; //for ip adderss
        date_default_timezone_set('Asia/Kathmandu');
        $visited_time = date('h:i:sa');
        $visited_date = date('d-m-Y');

        $result = Visitor::insert([
            'ip_address' => $ip_address,
            'visit_date' => $visited_date,
            'visit_time' => $visited_time,
        ]);

        return $result;
    }
}
