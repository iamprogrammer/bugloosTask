<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogFile extends Model
{
    protected $table    = "logs_txt";
    protected $fillable = ["service_name", "status_code", "method", "route", "created_date"];
}
