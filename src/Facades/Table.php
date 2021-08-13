<?php namespace Costa\LaravelTable\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelTable extends Facade {

    protected static function getFacadeAccessor() { return 'table'; }

}
