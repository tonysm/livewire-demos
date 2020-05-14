<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $type
 * @property string $price
 */
class Boat extends Model
{
    const BOAT_TYPES = [
        'Ferry',
        'Yacht',
        'Luxury',
    ];
}
