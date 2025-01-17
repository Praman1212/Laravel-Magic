<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Http\Controllers\AjaxController;

class Ajax extends Model
{
    use HasFactory;
    protected $fillable = ['name','phone','email'];
}
