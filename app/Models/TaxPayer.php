<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TaxPayer extends Model
{
        protected $fillable = [
        'tax_number',
        'name',
        'phone',
        'email',
        'address',
        'commercial_registration',
        'total_debt',
        'total_paid',
        'is_active',
    ];

    protected $casts = [
        'total_debt' => 'decimal:2',
        'total_paid' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function taxes(): HasMany
    {
        return $this->hasMany(Tax::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function clearanceCertificate(): HasOne
    {
        return $this->hasOne(ClearanceCertificate::class);
    }

    public function getHasClearanceAttribute(): bool
    {
        return $this->clearanceCertificate()->where('is_valid', true)->exists();
    }

    public function getRemainingDebtAttribute(): float
    {
        return $this->total_debt - $this->total_paid;
    }

    public function isEligibleForClearance(): bool
    {
        return $this->getRemainingDebtAttribute() <= 0;
    }
}

