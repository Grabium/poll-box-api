<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\{Fillable, Table};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, };

#[Table('votes_receipts')]
#[Fillable(['poll_id', 'user_id', 'date_vote'])]
class VoteReceipt extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    public function poll(): BelongsTo
    {
        return $this->BelongsTo(Poll::class);
    }

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
