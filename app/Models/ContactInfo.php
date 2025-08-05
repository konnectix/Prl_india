<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;

    protected $table = 'contact_info';

    protected $fillable = [
        'key',
        'label',
        'value',
        'type',
        'icon',
        'section',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeBySection($query, $section)
    {
        return $query->where('section', $section);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('label');
    }

    public function getFormattedValueAttribute()
    {
        switch ($this->type) {
            case 'email':
                return '<a href="mailto:' . $this->value . '">' . $this->value . '</a>';
            case 'phone':
                return '<a href="tel:' . preg_replace('/[^0-9+]/', '', $this->value) . '">' . $this->value . '</a>';
            case 'url':
                return '<a href="' . $this->value . '" target="_blank">' . $this->value . '</a>';
            default:
                return $this->value;
        }
    }
}
