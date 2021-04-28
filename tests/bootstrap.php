<?php
use Winter\Storm\Support\Arr;
use Winter\Storm\Support\Helper;
use Winter\Storm\Support\Str;

/**
 * Suppresses only the weird messages about the wrong/incorrect declaration.
 * @param int $err_no
 * @param str $err_str
 * @return bool
 */
function orbisius_p3778_warning_suppressor_suppress_bad_warnings($err_no, $err_str, $errfile = '', $errline = '') {
    // If the function returns FALSE then the normal error handler continues.
    $contains_stupid_warning = stripos($err_str, 'Declaration of') !== false;
    return $contains_stupid_warning;
}

if ( version_compare( phpversion(), 7, '>=' ) ) {
    // https://stackoverflow.com/questions/36079651/silence-declaration-should-be-compatible-warnings-in-php-7
    set_error_handler('orbisius_p3778_warning_suppressor_suppress_bad_warnings');
}

/**
 * Define local helper functions.
 * The library should not rest on an "expected" implementation of a function.
 * Use direct helper calls.
 */
function throwError($called, $class, $class_method) 
{
    throw new BadFunctionCallException('Called helper method ' . $called . '() from library code. The usage of helper '.
        'methods in library code is discouraged as it may lead to undefined behaviour, as these can be overridden '.
        'with arbitrary functionality. Please use ' . $class . '::' . $class_method . '() instead.');
}

function input($name = null, $default = null)
{
    throwError('input', Helper::class, 'input');
}

function post($name = null, $default = null)
{
    throwError('post', Helper::class, 'post');
}

function get($name = null, $default = null)
{
    throwError('get', Helper::class, 'get');
}
function trace_log()
{
    throwError('trace_log', Helper::class, 'traceLog');
}

function traceLog()
{
    throwError('traceLog', Helper::class, 'traceLog');
}

function trace_sql()
{
    throwError('trace_sql', Helper::class, 'traceSql');
}

function traceSql()
{
    throwError('traceSql', Helper::class, 'traceSql');
}

function config_path($path = '')
{
    throwError('config_path', Helper::class, 'configPath');
}

function plugins_path($path = '')
{
    throwError('plugins_path', Helper::class, 'pluginsPath');
}

function uploads_path($path = '')
{
    throwError('uploads_path', Helper::class, 'uploadsPath');
}

function media_path($path = '')
{
    throwError('media_path', Helper::class, 'mediaPath');
}

function themes_path($path = '')
{
    throwError('themes_path', Helper::class, 'themesPath');
}


function temp_path($path = '')
{
    throwError('temp_path', Helper::class, 'tempPath');
}

function e($value, $doubleEncode = false)
{
    throwError('e', Helper::class, 'e');
}

function trans($id = null, $parameters = [], $locale = null)
{
    throwError('trans', Helper::class, 'trans');
}

function array_build($array, callable $callback)
{
    throwError('array_build', Arr::class, 'build');
}

function collect($value = null)
{
    throwError('collect', Helper::class, 'collect');
}

function array_add($array, $key, $value)
{
    throwError('array_add', Arr::class, 'add');
}

function array_collapse($array)
{
    throwError('array_collapse', Arr::class, 'collapse');
}

function array_divide($array)
{
    throwError('array_divide', Arr::class, 'divide');
}

function array_dot($array, $prepend = '')
{
    throwError('array_dot', Arr::class, 'dot');
}

function array_undot(array $dotArray)
{
    throwError('array_undot', Arr::class, 'undot');
}

function array_except($array, $keys)
{
    throwError('array_except', Arr::class, 'except');
}

function array_first($array, callable $callback = null, $default = null)
{
    throwError('array_first', Arr::class, 'first');
}

function array_flatten($array, $depth = INF)
{
    throwError('array_flatten', Arr::class, 'flatten');
}

function array_forget(&$array, $keys)
{
    throwError('array_forget', Arr::class, 'forget');
}

function array_get($array, $key, $default = null)
{
    throwError('array_get', Arr::class, 'get');
}

function array_has($array, $keys)
{
    throwError('array_has', Arr::class, 'has');
}

function array_last($array, callable $callback = null, $default = null)
{
    throwError('array_last', Arr::class, 'last');
}

function array_only($array, $keys)
{
    throwError('array_only', Arr::class, 'only');
}

function array_pluck($array, $value, $key = null)
{
    throwError('array_pluck', Arr::class, 'pluck');
}

function array_prepend($array, $value, $key = null)
{
    throwError('array_prepend', Arr::class, 'prepend');
}

function array_pull(&$array, $key, $default = null)
{
    throwError('array_pull', Arr::class, 'pull');
}

function array_random($array, $num = null)
{
    throwError('array_random', Arr::class, 'random');
}

function array_set(&$array, $key, $value)
{
    throwError('array_set', Arr::class, 'set');
}

function array_sort($array, $callback = null)
{
    throwError('array_sort', Arr::class, 'sort');
}

function array_sort_recursive($array)
{
    throwError('array_sort_recursive', Arr::class, 'sortRecursive');
}

function array_where($array, callable $callback)
{
    throwError('array_where', Arr::class, 'where');
}

function array_wrap($value)
{
    throwError('array_wrap', Arr::class, 'wrap');
}

function camel_case($value)
{
    throwError('camel_case', Str::class, 'camel');
    return Str::camel($value);
}

function ends_with($haystack, $needles)
{
    throwError('ends_with', Str::class, 'endsWith');
}

function kebab_case($value)
{
    throwError('kebab_case', Str::class, 'kebab');
}

function snake_case($value, $delimiter = '_')
{
    throwError('snake_case', Str::class, 'snake');
}

function starts_with($haystack, $needles)
{
    throwError('starts_with', Str::class, 'startsWith');
}

function str_after($subject, $search)
{
    throwError('str_after', Str::class, 'after');
}

function str_before($subject, $search)
{
    throwError('str_before', Str::class, 'before');
}

function str_contains($haystack, $needles)
{
    throwError('str_contains', Str::class, 'contains');
}

function str_finish($value, $cap)
{
    throwError('str_finish', Str::class, 'finish');
}

function str_is($pattern, $value)
{
    throwError('str_is', Str::class, 'is');
}

function str_limit($value, $limit = 100, $end = '...')
{
    throwError('str_limit', Str::class, 'limit');
}

function str_plural($value, $count = 2)
{
    throwError('str_plural', Str::class, 'plural');
}

function str_random($length = 16)
{
    throwError('str_random', Str::class, 'random');
}

function str_replace_array($search, array $replace, $subject)
{
    throwError('str_replace_array', Str::class, 'replaceArray');
}

function str_replace_first($search, $replace, $subject)
{
    throwError('str_replace_first', Str::class, 'replaceFirst');
}

function str_replace_last($search, $replace, $subject)
{
    throwError('str_replace_last', Str::class, 'replaceLast');
}

function str_singular($value)
{
    throwError('str_singular', Str::class, 'singular');
}

function str_slug($title, $separator = '-', $language = 'en')
{
    throwError('str_slug', Str::class, 'slug');
}

function str_start($value, $prefix)
{
    throwError('str_start', Str::class, 'start');
}

function studly_case($value)
{
    throwError('studly_case', Str::class, 'studly');
}

function title_case($value)
{
    throwError('title_case', Str::class, 'title');
}

function resolve_path($path)
{
    throwError('resolve_path', Helper::class, 'resolvePath');
}

require_once(__DIR__.'/../vendor/autoload.php');