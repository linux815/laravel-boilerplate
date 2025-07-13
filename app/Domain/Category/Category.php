<?php

namespace App\Domain\Category;

use Database\Factories\CategoryFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Orchid\Filters\Filterable;
use Orchid\Filters\HttpFilter;
use Orchid\Screen\AsSource;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @method static Builder<static>|Category defaultSort(string $column, string $direction = 'asc')
 * @method static CategoryFactory factory($count = null, $state = [])
 * @method static Builder<static>|Category filters(?mixed $kit = null, ?HttpFilter $httpFilter = null)
 * @method static Builder<static>|Category filtersApply(iterable $filters = [])
 * @method static Builder<static>|Category filtersApplySelection($class)
 * @method static Builder<static>|Category newModelQuery()
 * @method static Builder<static>|Category newQuery()
 * @method static Builder<static>|Category query()
 * @method static Builder<static>|Category whereCreatedAt($value)
 * @method static Builder<static>|Category whereId($value)
 * @method static Builder<static>|Category whereName($value)
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
