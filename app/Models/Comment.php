<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $article_id
 * @property string $comment
 * @property Carbon $created_at
 * @property string|null $deleted_at
 * @method static Builder|Comment newModelQuery()
 * @method Builder|Comment newQuery()
 * @method static Builder|Comment query()
 * @method static Builder|Comment whereArticleId($value)
 * @method static Builder|Comment whereComment($value)
 * @method static Builder|Comment whereCreatedAt($value)
 * @method static Builder|Comment whereDeletedAt($value)
 * @method static Builder|Comment whereId($value)
 * @method static Builder|Comment whereUserId($value)
 * @property-read \App\Models\Article $article
 * @property-read \App\Models\User $user
 * @method static Builder|Comment onlyTrashed()
 * @method static Builder|Comment withTrashed()
 * @method static Builder|Comment withoutTrashed()
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
        'update_at'
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
