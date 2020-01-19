<?php

namespace App;

use Nestable\NestableTrait;

class Category extends \Eloquent {

    use NestableTrait;

    protected $parent = 'parent_id';
}
