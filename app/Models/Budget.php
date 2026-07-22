<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    // No need to specify the primary key since it's 'id' by default
    protected $fillable = ['user_id', 'month_year', 'category', 'budget_amount', 'remaining_amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
