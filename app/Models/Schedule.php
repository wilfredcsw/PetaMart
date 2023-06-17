<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    protected $primaryKey ='ScheduleID';
    protected $fillable = [
        'ScheduleID',
        'ScheduleTitle',
        'WorkingDate',
        'WorkingTime',
        'AssignUser',
    ];
    use HasFactory;
}
