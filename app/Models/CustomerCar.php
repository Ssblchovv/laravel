<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CustomerCar
 *
 * @property int $id
 * @property int $car_id
 * @property int $customer_id
 * @property int $year
 * @property string $number
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerCar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerCar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerCar query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerCar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerCar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerCar whereCarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerCar whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerCar whereYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerCar whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerCar whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerCar whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CustomerCar extends Model
{
    use HasFactory;

    protected $fillable = ['car_id', 'customer_id', 'year', 'number', 'image'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
