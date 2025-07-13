<?php

namespace App\Models;

use Database\Factories\ArticleFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Orchid\Filters\Filterable;
use Orchid\Filters\HttpFilter;
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
 * @property Carbon|null $deleted_at
 * @property-read Category $category
 * @property-read Collection<int, Comment> $comments
 * @property-read int|null $comments_count
 * @property-read User $user
 * @method static Builder<static>|Article defaultSort(string $column, string $direction = 'asc')
 * @method static ArticleFactory factory($count = null, $state = [])
 * @method static Builder<static>|Article filters(?mixed $kit = null, ?HttpFilter $httpFilter = null)
 * @method static Builder<static>|Article filtersApply(iterable $filters = [])
 * @method static Builder<static>|Article filtersApplySelection($class)
 * @method static Builder<static>|Article newModelQuery()
 * @method static Builder<static>|Article newQuery()
 * @method static Builder<static>|Article onlyTrashed()
 * @method static Builder<static>|Article query()
 * @method static Builder<static>|Article whereCategoryId($value)
 * @method static Builder<static>|Article whereContent($value)
 * @method static Builder<static>|Article whereCreatedAt($value)
 * @method static Builder<static>|Article whereDeletedAt($value)
 * @method static Builder<static>|Article whereId($value)
 * @method static Builder<static>|Article whereTitle($value)
 * @method static Builder<static>|Article whereUpdatedAt($value)
 * @method static Builder<static>|Article whereUserId($value)
 * @method static Builder<static>|Article withTrashed()
 * @method static Builder<static>|Article withoutTrashed()
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
