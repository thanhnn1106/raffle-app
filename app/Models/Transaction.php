<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public const FIELD_USER_ID = 'user_id';
    public const FIELD_AMOUNT = 'amount';

    protected $guarded = [];
}
