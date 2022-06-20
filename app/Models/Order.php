<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $service_id
 * @property int $customer_car_id
 * @property int $employee_id
 * @property Status $status
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @mixin \Eloquent
 */
class Order extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = ['service_id', 'customer_car_id', 'employee_id', 'status', 'start_date', 'end_date'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function customerCar()
    {
        return $this->belongsTo(CustomerCar::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
