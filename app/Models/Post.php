<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['id', 'title', 'body', 'image', 'created_at', 'user_id', 'shown_at'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    protected function shownAt(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Carbon::parse($value)->format('M d, Y h:i A') : 'Have not shown yet.'
        );
    }

}
