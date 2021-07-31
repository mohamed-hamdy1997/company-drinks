<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDrink extends Model
{
    use HasFactory;

    protected $table = 'employee_drinks';

    protected $fillable = [
        'user_id',
        'drink_id',
        'drink_name',
        'status'
    ];
}
