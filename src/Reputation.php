<?php

namespace QCod\Gamify;

use Illuminate\Database\Eloquent\Model;

class Reputation extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Payee user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payee()
    {
        return $this->belongsTo(config('gamify.payee_model'), 'payee_id');
    }

    /**
     * Get the owning subject model
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * Undo last point
     *
     * @throws \Exception
     */
    public function undo($points_to_remove)
    {
        if ($this->exists) {
            $this->payee->reducePoint($points_to_remove);
            $this->delete();
        }
    }
}
