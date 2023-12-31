<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'template_id',
        'name',
        'subject',
        'content',
        'recipients',
        'scheduled_at',
        'status',
    ];
    // @TODO add enum for status

    protected $casts = [
        'recipients' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function setScheduledAtAttribute($value)
    {
        $this->attributes['scheduled_at'] = Carbon::parse($value);
    }
}
