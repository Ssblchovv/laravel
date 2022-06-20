<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ServiceCategory
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function services()
    {
        return $this->hasMany(Service::class, 'id_service_category', 'id');
    }
}
