<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['group_id',
            'enterprise_id',
            'poll_id',
            'votes',
            'votes_pending_after_deadline',
        ])]
class PollHistorical extends Model
{
    use HasFactory;

    protected $table = 'poll_historical';

    /**
     * Mapeamento automático de tipos de dados.
     * O Eloquent converterá o JSON do banco para Array do PHP e vice-versa.
     */
    protected function casts(): array
    {
        return [
            'votes' => 'array',
            'votes_pending_after_deadline' => 'array',
        ];
    }

    // -------------------------------------------------------------
    // RELACIONAMENTOS
    // -------------------------------------------------------------

    public function enterprise(): BelongsTo
    {
        return $this->belongsTo(Enterprise::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function poll(): BelongsTo
    {
        return $this->belongsTo(Poll::class);
    }
}
