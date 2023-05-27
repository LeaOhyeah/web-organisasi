<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    public $timestamp = true;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Foreign Key Relationship
    public function userNews()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function categoryNews()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // PHP Carbon (format created at)
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('l, d F Y, H:i');
    }
    public function getOriginalCreatedAtAttribute()
    {
        return $this->attributes['created_at'];
    }

    // PHP Carbon (format updated at)
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