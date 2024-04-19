<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $title
 * @property string $content
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 * @method Builder|Article newQuery()
 * @method static Builder|Article newModelQuery()
 * @method static Builder|Article query()
 * @method static Builder|Article whereCategoryId($value)
 * @method static Builder|Article whereContent($value)
 * @method static Builder|Article whereCreatedAt($value)
 * @method static Builder|Article whereDeletedAt($value)
 * @method static Builder|Article whereId($value)
 * @method static Builder|Article whereTitle($value)
 * @method static Builder|Article whereUserId($value)
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\User $user
 * @method static Builder|Article defaultSort(string $column, string $direction = 'asc')
 * @method static \Database\Factories\ArticleFactory factory($count = null, $state = [])
 * @method static Builder|Article filters(?mixed $kit = null, ?\Orchid\Filters\HttpFilter $httpFilter = null)
 * @method static Builder|Article filtersApply(iterable $filters = [])
 * @method static Builder|Article filtersApplySelection($class)
 * @method static Builder|Article onlyTrashed()
 * @method static Builder|Article withTrashed()
 * @method static Builder|Article withoutTrashed()
 * @mixin Eloquent
 */
class Article extends Model
{
    use HasFactory;
    use SoftDeletes;
    use AsSource;
    use Filterable;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
    ];

    protected $allowedSorts = [
        'id',
        'created_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'article_id')->orderBy('created_at', 'desc');
    }
}
