<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @method static Builder|Category newModelQuery()
 * @method Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereName($value)
 * @mixin Eloquent
 */
class Category extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public const UPDATED_AT = null;

    protected $fillable = ['name'];

    protected $dates = ['created_at'];


    protected $allowedSorts = [
        'created_at',
    ];
}
