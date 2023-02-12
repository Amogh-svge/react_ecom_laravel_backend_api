<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function postContactDetails(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $message = $request->message;
        date_default_timezone_set("Asia/Kathmandu");
        $contact_time = date("h:i:sa");
        $contact_date = date("d-m-Y");


        $result = Contact::insert([
            "name" => $name,
            "email" => $email,
            "message" => $message,
            "contact_time" => $contact_time,
            "contact_date" => $contact_date,
        ]);

        return $result ? "successfully inserted" : "insertion failed";
    }
}
