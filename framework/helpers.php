<?php

use Illuminate\Container\Container;

if (! function_exists('app')) {
    function app($make = null, $parameters = [])
    {
        if (is_null($make)) {
            return Container::getInstance();
        }

        return Container::getInstance()->make($make, $parameters);
    }
}

if (! function_exists('router')) {
    function router()
    {
        return Container::getInstance()->make('router');
    }
}

if (! function_exists('view')) {
    function view($view = null, $data = [], $mergeData = [])
    {
        $factory = app('view');

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($view, $data, $mergeData);
    }
}

if (! function_exists('base_path')) {
    function base_path($path = '')
    {
        return app()->basePath().($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('app_path')) {
    function app_path($path = '')
    {
        return app()->basePath().DIRECTORY_SEPARATOR.'app'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('resource_path')) {
    function resource_path($path = '')
    {
        return app()->basePath().DIRECTORY_SEPARATOR.'resources'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('storage_path')) {
    function storage_path($path = '')
    {
        return app()->basePath().DIRECTORY_SEPARATOR.'framework'.DIRECTORY_SEPARATOR.'cache'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('public_path')) {
    function public_path($path = '')
    {
        return app()->basePath().DIRECTORY_SEPARATOR.'public'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('elixir')) {
    function elixir($file, $buildDirectory = 'build')
    {
        static $manifest;
        static $manifestPath;

        if (is_null($manifest) || $manifestPath !== $buildDirectory) {
            $manifest = json_decode(file_get_contents(public_path($buildDirectory.'/rev-manifest.json')), true);

            $manifestPath = $buildDirectory;
        }

        if (isset($manifest[$file])) {
            return '/'.trim($buildDirectory.'/'.$manifest[$file], '/');
        }

        throw new InvalidArgumentException("File {$file} not defined in asset manifest.");
    }
}