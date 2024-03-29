<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Drink extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_url',
        'target'
    ];

    public function employeeDrinks()
    {
        return $this->hasMany(EmployeeDrink::class, 'drink_id');
    }

    public function getDrinksTodayAttribute()
    {
        return EmployeeDrink::query()->where('drink_id', $this->id)->whereDate('created_at', Carbon::today())->count();
    }

}
