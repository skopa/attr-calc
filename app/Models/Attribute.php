<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Attribute
 * @package App\Models
 * @property-read string path
 * @property-read string key
 * @property-read string name
 * @property-read string rule
 * @property-read integer order
 */
class Attribute extends Model
{
    public $incrementing = false;

    protected $primaryKey = 'path';
    protected $keyType = 'string';
    protected $fillable = ['path', 'name', 'rules', 'order'];

    public function getRules(): string
    {
        if ($this->type === 'array') {
            return $this->getArrayRules();
        }

        $rules = [$this->type];

        if ($this->min) {
            $rules[] = ($this->min_strict ? 'gt' : 'gte') . ':' . $this->min;
        }

        if ($this->max) {
            $rules[] = ($this->max_strict ? 'lt' : 'lte') . ':' . $this->max;
        }

        if ($this->custom_rules) {
            $rules[] = $this->custom_rules;
        }

        return implode('|', $rules);
    }

    public function getKeyAttribute(): string
    {
        return Str::afterLast($this->path, '.');
    }

    private function getArrayRules(): string
    {
        $rules = [$this->type];

        if ($this->min) {
            $rules[] = 'min:' . $this->min;
        }

        if ($this->max) {
            $rules[] = 'max:' . $this->max;
        }

        if ($this->custom_rules) {
            $rules[] = $this->custom_rules;
        }

        return implode('|', $rules);
    }
}
