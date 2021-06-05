<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareTo extends Model
{
    protected $table="fileshareto";
    protected $fillable = ["fileid ","email "];
}
