<?php
/**
 * The library should internally not rely on helper functions. These may be overwritten by the end user of the library
 * giving unpredictable results when something like array_dot would return just dots for every item in an array.
 */
function throwBadFunctionCallException($called, $class, $class_method) 
{
    throw new BadFunctionCallException('Called helper method ' . $called . '() from library code. The usage of helper '.
        'methods in library code is discouraged as it may lead to undefined behaviour, as these can be overridden '.
        'with arbitrary functionality. Please use ' . $class . '::' . $class_method . '() instead.');
}

function input($name = null, $default = null)
{
    throwBadFunctionCallException('input', 'Winter\Storm\Support\Helper', 'input');
}

function post($name = null, $default = null)
{
    throwBadFunctionCallException('post', 'Winter\Storm\Support\Helper', 'post');
}

function get($name = null, $default = null)
{
    throwBadFunctionCallException('get', 'Winter\Storm\Support\Helper', 'get');
}
function trace_log()
{
    throwBadFunctionCallException('trace_log', 'Winter\Storm\Support\Helper', 'traceLog');
}

function traceLog()
{
    throwBadFunctionCallException('traceLog', 'Winter\Storm\Support\Helper', 'traceLog');
}

function trace_sql()
{
    throwBadFunctionCallException('trace_sql', 'Winter\Storm\Support\Helper', 'traceSql');
}

function traceSql()
{
    throwBadFunctionCallException('traceSql', 'Winter\Storm\Support\Helper', 'traceSql');
}

function config_path($path = '')
{
    throwBadFunctionCallException('config_path', 'Winter\Storm\Support\Helper', 'configPath');
}

function plugins_path($path = '')
{
    throwBadFunctionCallException('plugins_path', 'Winter\Storm\Support\Helper', 'pluginsPath');
}

function uploads_path($path = '')
{
    throwBadFunctionCallException('uploads_path', 'Winter\Storm\Support\Helper', 'uploadsPath');
}

function media_path($path = '')
{
    throwBadFunctionCallException('media_path', 'Winter\Storm\Support\Helper', 'mediaPath');
}

function themes_path($path = '')
{
    throwBadFunctionCallException('themes_path', 'Winter\Storm\Support\Helper', 'themesPath');
}


function temp_path($path = '')
{
    throwBadFunctionCallException('temp_path', 'Winter\Storm\Support\Helper', 'tempPath');
}

function e($value, $doubleEncode = false)
{
    throwBadFunctionCallException('e', 'Winter\Storm\Support\Helper', 'e');
}

function trans($id = null, $parameters = [], $locale = null)
{
    throwBadFunctionCallException('trans', 'Winter\Storm\Support\Helper', 'trans');
}

function array_build($array, callable $callback)
{
    throwBadFunctionCallException('array_build', 'Winter\Storm\Support\Arr', 'build');
}

function array_add($array, $key, $value)
{
    throwBadFunctionCallException('array_add', 'Winter\Storm\Support\Arr', 'add');
}

function array_collapse($array)
{
    throwBadFunctionCallException('array_collapse', 'Winter\Storm\Support\Arr', 'collapse');
}

function array_divide($array)
{
    throwBadFunctionCallException('array_divide', 'Winter\Storm\Support\Arr', 'divide');
}

function array_dot($array, $prepend = '')
{
    throwBadFunctionCallException('array_dot', 'Winter\Storm\Support\Arr', 'dot');
}

function array_undot(array $dotArray)
{
    throwBadFunctionCallException('array_undot', 'Winter\Storm\Support\Arr', 'undot');
}

function array_except($array, $keys)
{
    throwBadFunctionCallException('array_except', 'Winter\Storm\Support\Arr', 'except');
}

function array_first($array, callable $callback = null, $default = null)
{
    throwBadFunctionCallException('array_first', 'Winter\Storm\Support\Arr', 'first');
}

function array_flatten($array, $depth = INF)
{
    throwBadFunctionCallException('array_flatten', 'Winter\Storm\Support\Arr', 'flatten');
}

function array_forget(&$array, $keys)
{
    throwBadFunctionCallException('array_forget', 'Winter\Storm\Support\Arr', 'forget');
}

function array_get($array, $key, $default = null)
{
    throwBadFunctionCallException('array_get', 'Winter\Storm\Support\Arr', 'get');
}

function array_has($array, $keys)
{
    throwBadFunctionCallException('array_has', 'Winter\Storm\Support\Arr', 'has');
}

function array_last($array, callable $callback = null, $default = null)
{
    throwBadFunctionCallException('array_last', 'Winter\Storm\Support\Arr', 'last');
}

function array_only($array, $keys)
{
    throwBadFunctionCallException('array_only', 'Winter\Storm\Support\Arr', 'only');
}

function array_pluck($array, $value, $key = null)
{
    throwBadFunctionCallException('array_pluck', 'Winter\Storm\Support\Arr', 'pluck');
}

function array_prepend($array, $value, $key = null)
{
    throwBadFunctionCallException('array_prepend', 'Winter\Storm\Support\Arr', 'prepend');
}

function array_pull(&$array, $key, $default = null)
{
    throwBadFunctionCallException('array_pull', 'Winter\Storm\Support\Arr', 'pull');
}

function array_random($array, $num = null)
{
    throwBadFunctionCallException('array_random', 'Winter\Storm\Support\Arr', 'random');
}

function array_set(&$array, $key, $value)
{
    throwBadFunctionCallException('array_set', 'Winter\Storm\Support\Arr', 'set');
}

function array_sort($array, $callback = null)
{
    throwBadFunctionCallException('array_sort', 'Winter\Storm\Support\Arr', 'sort');
}

function array_sort_recursive($array)
{
    throwBadFunctionCallException('array_sort_recursive', 'Winter\Storm\Support\Arr', 'sortRecursive');
}

function array_where($array, callable $callback)
{
    throwBadFunctionCallException('array_where', 'Winter\Storm\Support\Arr', 'where');
}

function array_wrap($value)
{
    throwBadFunctionCallException('array_wrap', 'Winter\Storm\Support\Arr', 'wrap');
}

function camel_case($value)
{
    throwBadFunctionCallException('camel_case', 'Winter\Storm\Support\Str', 'camel');
    return Str::camel($value);
}

function ends_with($haystack, $needles)
{
    throwBadFunctionCallException('ends_with', 'Winter\Storm\Support\Str', 'endsWith');
}

function kebab_case($value)
{
    throwBadFunctionCallException('kebab_case', 'Winter\Storm\Support\Str', 'kebab');
}

function snake_case($value, $delimiter = '_')
{
    throwBadFunctionCallException('snake_case', 'Winter\Storm\Support\Str', 'snake');
}

function starts_with($haystack, $needles)
{
    throwBadFunctionCallException('starts_with', 'Winter\Storm\Support\Str', 'startsWith');
}

function str_after($subject, $search)
{
    throwBadFunctionCallException('str_after', 'Winter\Storm\Support\Str', 'after');
}

function str_before($subject, $search)
{
    throwBadFunctionCallException('str_before', 'Winter\Storm\Support\Str', 'before');
}

function str_contains($haystack, $needles)
{
    throwBadFunctionCallException('str_contains', 'Winter\Storm\Support\Str', 'contains');
}

function str_finish($value, $cap)
{
    throwBadFunctionCallException('str_finish', 'Winter\Storm\Support\Str', 'finish');
}

function str_is($pattern, $value)
{
    throwBadFunctionCallException('str_is', 'Winter\Storm\Support\Str', 'is');
}

function str_limit($value, $limit = 100, $end = '...')
{
    throwBadFunctionCallException('str_limit', 'Winter\Storm\Support\Str', 'limit');
}

function str_plural($value, $count = 2)
{
    throwBadFunctionCallException('str_plural', 'Winter\Storm\Support\Str', 'plural');
}

function str_random($length = 16)
{
    throwBadFunctionCallException('str_random', 'Winter\Storm\Support\Str', 'random');
}

function str_replace_array($search, array $replace, $subject)
{
    throwBadFunctionCallException('str_replace_array', 'Winter\Storm\Support\Str', 'replaceArray');
}

function str_replace_first($search, $replace, $subject)
{
    throwBadFunctionCallException('str_replace_first', 'Winter\Storm\Support\Str', 'replaceFirst');
}

function str_replace_last($search, $replace, $subject)
{
    throwBadFunctionCallException('str_replace_last', 'Winter\Storm\Support\Str', 'replaceLast');
}

function str_singular($value)
{
    throwBadFunctionCallException('str_singular', 'Winter\Storm\Support\Str', 'singular');
}

function str_slug($title, $separator = '-', $language = 'en')
{
    throwBadFunctionCallException('str_slug', 'Winter\Storm\Support\Str', 'slug');
}

function str_start($value, $prefix)
{
    throwBadFunctionCallException('str_start', 'Winter\Storm\Support\Str', 'start');
}

function studly_case($value)
{
    throwBadFunctionCallException('studly_case', 'Winter\Storm\Support\Str', 'studly');
}

function title_case($value)
{
    throwBadFunctionCallException('title_case', 'Winter\Storm\Support\Str', 'title');
}

function resolve_path($path)
{
    throwBadFunctionCallException('resolve_path', 'Winter\Storm\Support\Helper', 'resolvePath');
}
