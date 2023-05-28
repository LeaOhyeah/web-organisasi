<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class EventModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'events';
    protected $guarded = [];
    public $timestamp = true;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Foreign Key Relationship
    public function userEvent()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }

    // PHP Carbon (format start at)
    public function getStartDateAttribute()
    {
        return Carbon::parse($this->attributes['start_date'])
            ->translatedFormat('l, d F Y');
    }
    public function getOriginalStartDateAttribute()
    {
        return $this->attributes['start_date'];
    }

    // PHP Carbon (format start at)
    public function getEndDateAttribute()
    {
        return Carbon::parse($this->attributes['end_date'])
            ->translatedFormat('l, d F Y');
    }
    public function getOriginalEndDateAttribute()
    {
        return $this->attributes['end_date'];
    }
    
    // PHP Carbon (format deleted at)
    public function getUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])
            ->translatedFormat('l, d F Y, H:i');
    }
    public function getOriginalUpdatedAtAttribute()
    {
        return $this->attributes['updated_at'];
    }
    // PHP Carbon (format deleted at)
    public function getDeletedAtAttribute()
    {
        return Carbon::parse($this->attributes['deleted_at'])
            ->translatedFormat('l, d F Y, H:i');
    }
    public function getOriginalDeletedAtAttribute()
    {
        return $this->attributes['deleted_at'];
    }
}