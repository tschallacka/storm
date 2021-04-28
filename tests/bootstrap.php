<?php
/**
 * Define local helper functions.
 * The library should not rest on an "expected" implementation of a function.
 * Use direct helper calls.
 */

function input($name = null, $default = null)
{
    if ($name === null) {
        return Input::all();
    }

    /*
     * Array field name, eg: field[key][key2][key3]
     */
    if (class_exists('Winter\Storm\Html\Helper')) {
        $name = implode('.', Winter\Storm\Html\Helper::nameToArray($name));
    }

    return Input::get($name, $default);
}

function post($name = null, $default = null)
{
    if ($name === null) {
        return Request::post();
    }

    /*
     * Array field name, eg: field[key][key2][key3]
     */
    if (class_exists('Winter\Storm\Html\Helper')) {
        $name = implode('.', Winter\Storm\Html\Helper::nameToArray($name));
    }

    return array_get(Request::post(), $name, $default);
}

function get($name = null, $default = null)
{
    if ($name === null) {
        return Request::query();
    }

    /*
     * Array field name, eg: field[key][key2][key3]
     */
    if (class_exists('Winter\Storm\Html\Helper')) {
        $name = implode('.', Winter\Storm\Html\Helper::nameToArray($name));
    }

    return array_get(Request::query(), $name, $default);
}
function trace_log()
{
    $messages = func_get_args();

    foreach ($messages as $message) {
        $level = 'info';

        if ($message instanceof Exception) {
            $level = 'error';
        }
        elseif (is_array($message) || is_object($message)) {
            $message = print_r($message, true);
        }

        Log::$level($message);
    }
}

function traceLog()
{
    call_user_func_array('trace_log', func_get_args());
}

function trace_sql()
{
    if (!defined('WINTER_NO_EVENT_LOGGING')) {
        define('WINTER_NO_EVENT_LOGGING', 1);
    }

    if (!defined('WINTER_TRACING_SQL')) {
        define('WINTER_TRACING_SQL', 1);
    }
    else {
        return;
    }

    Event::listen('illuminate.query', function ($query, $bindings, $time, $name) {
        $data = compact('bindings', 'time', 'name');

        foreach ($bindings as $i => $binding) {
            if ($binding instanceof \DateTime) {
                $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
            } elseif (is_string($binding)) {
                $bindings[$i] = "'$binding'";
            }
        }

        $query = str_replace(['%', '?'], ['%%', '%s'], $query);
        $query = vsprintf($query, $bindings);

        traceLog($query);
    });
}

function traceSql()
{
    trace_sql();
}

function config_path($path = '')
{
    return PathResolver::join(app('path.config'), $path);
}

function plugins_path($path = '')
{
    return PathResolver::join(app('path.plugins'), $path);
}

function uploads_path($path = '')
{
    return PathResolver::join(Config::get('cms.storage.uploads.path', app('path.uploads')), $path);
}

function media_path($path = '')
{
    return PathResolver::join(Config::get('cms.storage.media.path', app('path.media')), $path);
}

function themes_path($path = '')
{
    return PathResolver::join(app('path.themes'), $path);
}


function temp_path($path = '')
{
    return PathResolver::join(app('path.temp'), $path);
}

function e($value, $doubleEncode = false)
{
    if ($value instanceof \Illuminate\Contracts\Support\Htmlable) {
        return $value->toHtml();
    }

    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', $doubleEncode);
}

function trans($id = null, $parameters = [], $locale = null)
{
    return app('translator')->trans($id, $parameters, $locale);
}

function array_build($array, callable $callback)
{
    return Arr::build($array, $callback);
}

function collect($value = null)
{
    return new Collection($value);
}

function is_countable($value)
{
    return (is_array($value) || $value instanceof Countable);
}

function array_add($array, $key, $value)
{
    return Arr::add($array, $key, $value);
}

function array_collapse($array)
{
    return Arr::collapse($array);
}

function array_divide($array)
{
    return Arr::divide($array);
}

function array_dot($array, $prepend = '')
{
    return Arr::dot($array, $prepend);
}

function array_undot(array $dotArray)
{
    return Arr::undot($dotArray);
}

function array_except($array, $keys)
{
    return Arr::except($array, $keys);
}

function array_first($array, callable $callback = null, $default = null)
{
    return Arr::first($array, $callback, $default);
}

function array_flatten($array, $depth = INF)
{
    return Arr::flatten($array, $depth);
}

function array_forget(&$array, $keys)
{
    Arr::forget($array, $keys);
}

function array_get($array, $key, $default = null)
{
    return Arr::get($array, $key, $default);
}

function array_has($array, $keys)
{
    return Arr::has($array, $keys);
}

function array_last($array, callable $callback = null, $default = null)
{
    return Arr::last($array, $callback, $default);
}

function array_only($array, $keys)
{
    return Arr::only($array, $keys);
}

function array_pluck($array, $value, $key = null)
{
    return Arr::pluck($array, $value, $key);
}

function array_prepend($array, $value, $key = null)
{
    return Arr::prepend($array, $value, $key);
}

function array_pull(&$array, $key, $default = null)
{
    return Arr::pull($array, $key, $default);
}

function array_random($array, $num = null)
{
    return Arr::random($array, $num);
}

function array_set(&$array, $key, $value)
{
    return Arr::set($array, $key, $value);
}

function array_sort($array, $callback = null)
{
    return Arr::sort($array, $callback);
}

function array_sort_recursive($array)
{
    return Arr::sortRecursive($array);
}
function array_where($array, callable $callback)
{
    return Arr::where($array, $callback);
}

function array_wrap($value)
{
    return Arr::wrap($value);
}

function camel_case($value)
{
    return Str::camel($value);
}

function ends_with($haystack, $needles)
{
    return Str::endsWith($haystack, $needles);
}

function kebab_case($value)
{
    return Str::kebab($value);
}

function snake_case($value, $delimiter = '_')
{
    return Str::snake($value, $delimiter);
}

function starts_with($haystack, $needles)
{
    return Str::startsWith($haystack, $needles);
}

function str_after($subject, $search)
{
    return Str::after($subject, $search);
}

function str_before($subject, $search)
{
    return Str::before($subject, $search);
}

function str_contains($haystack, $needles)
{
    return Str::contains($haystack, $needles);
}

function str_finish($value, $cap)
{
    return Str::finish($value, $cap);
}

function str_is($pattern, $value)
{
    return Str::is($pattern, $value);
}

function str_limit($value, $limit = 100, $end = '...')
{
    return Str::limit($value, $limit, $end);
}

function str_plural($value, $count = 2)
{
    return Str::plural($value, $count);
}

function str_random($length = 16)
{
    return Str::random($length);
}

function str_replace_array($search, array $replace, $subject)
{
    return Str::replaceArray($search, $replace, $subject);
}

function str_replace_first($search, $replace, $subject)
{
    return Str::replaceFirst($search, $replace, $subject);
}

function str_replace_last($search, $replace, $subject)
{
    return Str::replaceLast($search, $replace, $subject);
}

function str_singular($value)
{
    return Str::singular($value);
}

function str_slug($title, $separator = '-', $language = 'en')
{
    return Str::slug($title, $separator, $language);
}

function str_start($value, $prefix)
{
    return Str::start($value, $prefix);
}

function studly_case($value)
{
    return Str::studly($value);
}

function title_case($value)
{
    return Str::title($value);
}

function resolve_path($path)
{
    return PathResolver::resolve($path);
}

require_once('../vendor/autoload.php');