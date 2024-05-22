<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    public const FIELD_USER_ID = 'user_id';
    public const FIELD_TRANSACTION_ID = 'transaction_id';
    public const FIELD_ENTRIES = 'entries';

    protected $table = 'user_entries';

    protected $guarded = [];
}
