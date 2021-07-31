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
        'status',
        'hint',
        'floor_number',
        'maker_id'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function drinks()
    {
        $this->belongsTo(Drink::class,'drink_id');
    }

    public function maker()
    {
        $this->belongsTo(User::class,'maker_id');
    }


}
