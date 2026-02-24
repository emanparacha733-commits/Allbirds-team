<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $fillable = ['section', 'key', 'value'];

    /**
     * Get all settings as a nested array: ['hero' => ['image' => '...', 'heading' => '...']]
     */
    public static function allAsArray(): array
    {
        $data = [];
        foreach (self::all() as $row) {
            $data[$row->section][$row->key] = $row->value;
        }
        return $data;
    }

    /**
     * Set a value (upsert)
     */
    public static function setValue(string $section, string $key, ?string $value): void
{
    self::updateOrCreate(
        ['section' => $section, 'key' => $key],
        ['value'   => $value ?? '']
    );
}
}