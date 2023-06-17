<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $primaryKey = 'AnnouncementID';
    protected $fillable = [
        'AnnouncementID',
        'user_id',
        'AnnouncementTitle',
        'AnnouncementDate',
        'AnnouncementDesc',
    ];

    //relationship
    public function user()
    {
        return belongsTo(User::class);
    }
}
