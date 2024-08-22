<?php

namespace App\Models;

use App\Traits\LikableModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

  use HasFactory, LikableModel;

}
