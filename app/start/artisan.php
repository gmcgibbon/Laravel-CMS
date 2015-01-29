<?php

/*
|--------------------------------------------------------------------------
| Register The Artisan Commands
|--------------------------------------------------------------------------
|
| Each available Artisan command must be registered with the console so
| that it is available to be called. We'll register every command so
| the console gets access to each of the command object instances.
|
*/

// Automatically recreate SQLite file if removed
// from http://stackoverflow.com/questions/17872110/migrations-fail-when-sqlite-database-file-does-not-exist
//
// Laravel seems to lack the ability to automatically recreate SQLite databases when they are deleted
// This if statement recreates the file if it does not exist
// 
if (Config::get('database.default') === 'sqlite') 
{
    $path = Config::get('database.connections.sqlite.database');

    if (! file_exists($path) && is_dir(dirname($path)))
    {
        touch($path);
    }
}