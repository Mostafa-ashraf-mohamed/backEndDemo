<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ["id","title","fileExt","des","file","userid","shareStatus"];
}
