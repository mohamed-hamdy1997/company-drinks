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
        'maker_id',
        'num_drinks',
        'sugar_num',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function drinks()
    {
        return $this->belongsTo(Drink::class,'drink_id');
    }

    public function maker()
    {
        return $this->belongsTo(User::class,'maker_id');
    }


}
