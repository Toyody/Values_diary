<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
  public function posts()
  {
    return $this->belongsToMany(Post::class, 'post_value', 'value_name', 'post_id');
  }
}
