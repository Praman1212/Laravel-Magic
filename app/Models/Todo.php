<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Todo extends Model
{
    use HasFactory;
    protected $fillable =['title','image'];
    public static function boot()
    {
        parent::boot();
        static::deleted(function ($obj) {
            if (!is_null($obj->image)) {
                Storage::disk('public')->delete($obj->image);
            }
        });
        static::updating(function ($model) {
            if ($model->isDirty('image')) {
                $oldImagePath = $model->getOriginal('image');
                if ($oldImagePath) {
                    Storage::disk('public')->delete($oldImagePath);
                }
            }
        });
    }
}
