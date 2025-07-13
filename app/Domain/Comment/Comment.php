<?php

namespace App\Domain\Comment;

use App\Domain\Article\Article;
use App\Models\User;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
 * @property int $article_id
 * @property string $comment
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Article $article
 * @property-read User $user
 * @method static Builder<static>|Comment defaultSort(string $column, string $direction = 'asc')
 * @method static Builder<static>|Comment filters(?mixed $kit = null, ?HttpFilter $httpFilter = null)
 * @method static Builder<static>|Comment filtersApply(iterable $filters = [])
 * @method static Builder<static>|Comment filtersApplySelection($class)
 * @method static Builder<static>|Comment newModelQuery()
 * @method static Builder<static>|Comment newQuery()
 * @method static Builder<static>|Comment onlyTrashed()
 * @method static Builder<static>|Comment query()
 * @method static Builder<static>|Comment whereArticleId($value)
 * @method static Builder<static>|Comment whereComment($value)
 * @method static Builder<static>|Comment whereCreatedAt($value)
 * @method static Builder<static>|Comment whereDeletedAt($value)
 * @method static Builder<static>|Comment whereId($value)
 * @method static Builder<static>|Comment whereUpdatedAt($value)
 * @method static Builder<static>|Comment whereUserId($value)
 * @method static Builder<static>|Comment withTrashed()
 * @method static Builder<static>|Comment withoutTrashed()
 * @mixin Eloquent
 */
class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use AsSource;
    use Filterable;

    protected $fillable = [
        'user_id',
        'article_id',
        'comment',
    ];

    protected $allowedSorts = [
        'created_at',
        'update_at',
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected $with = ['user'];


    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
