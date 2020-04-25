<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalInfo extends Model
{
    protected $table = 'additional_infos';

    protected $fillable = [
        'user_id',
        'facebook_account',
        'instagram',
        'introduction',
        'total_upvotes',
        'total_downvotes',
        'total_comments',
        'total_answers',
        'total_questions'
    ];
}
