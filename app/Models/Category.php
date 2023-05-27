<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    public $timestamp = true;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Static 
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($parent) {
            // Hapus child dengan soft delete
            $parent->categoryNews()->delete();
        });

        static::restoring(function ($parent) {
            // Mengembalikan (restore) child secara rekursif
            $parent->categoryNews()->withTrashed()->restore();
        });
    }

    // Foreign Key Relationship
    public function userCategory()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }

    public function categoryNews()
    {
        return $this->hasMany(News::class, 'category_id');
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
        return $this->attributes['created_at'];
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