<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = []; //all the fills will automatically be listed of contact

    // $contact_time = date("h:i:sa");
    // $contact_date = date("d-m-Y");
}
