<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClearanceCertificate extends Model
{
    protected $fillable = [
        'tax_payer_id',
        'certificate_number',
        'issue_date',
        'valid_until',
        'notes',
        'is_valid',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'valid_until' => 'date',
        'is_valid' => 'boolean',
    ];

    public function taxPayer(): BelongsTo
    {
        return $this->belongsTo(TaxPayer::class);
    }
}
