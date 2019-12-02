<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'user_id', 'value_tags', 'actions_for_value', 'score', 'good_things', 'troubles', 'memo',
    ];

    public function values()
    {
        return $this->belongsToMany(Value::class, 'post_value', 'post_id', 'value_name')->withTimestamps();
    }
}
