<?php namespace Winter\Storm\Support;

use \Illuminate\Support\Facades\Log;
use \Winter\Storm\Support\Facades\Input;
use \Winter\Storm\Support\Facades\Event;
use \Winter\Storm\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Countable;
use Exception;
use Illuminate\Container\Container;
use Winter\Storm\Filesystem\PathResolver;

class Helper
{
    /**
     * Get the available container instance.
     *
     * @param  string|null  $abstract
     * @param  array  $parameters
     * @return mixed|\Illuminate\Contracts\Foundation\Application
     */
    public static function app($abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return Container::getInstance();
        }
        
        return Container::getInstance()->make($abstract, $parameters);
    }
    
    /**
     * Returns an input parameter or the default value.
     * Supports HTML Array names.
     * <pre>
     * $value = input('value', 'not found');
     * $name = input('contact[name]');
     * $name = input('contact[location][city]');
     * </pre>
     * Booleans are converted from strings
     * @param string|null $name
     * @param string|null $default
     * @return mixed
     */
    public static function input($name = null, $default = null)
    {
        if ($name === null) {
            return Input::all();
        }
        
        /*
         * Array field name, eg: field[key][key2][key3]
         */
        if (class_exists('Winter\Storm\Html\Helper')) {
            $name = implode('.', \Winter\Storm\Html\Helper::nameToArray($name));
        }
        
        return Input::get($name, $default);
    }
    
    /**
     * Identical function to input(), however restricted to POST values.
     */
    public static function post($name = null, $default = null)
    {
        if ($name === null) {
            return Request::post();
        }
        
        /*
         * Array field name, eg: field[key][key2][key3]
         */
        if (class_exists('Winter\Storm\Html\Helper')) {
            $name = implode('.', \Winter\Storm\Html\Helper::nameToArray($name));
        }
        
        return array_get(Request::post(), $name, $default);
    }
    
    /**
     * Identical function to input(), however restricted to GET values.
     */
    public static function get($name = null, $default = null)
    {
        if ($name === null) {
            return Request::query();
        }
        
        /*
         * Array field name, eg: field[key][key2][key3]
         */
        if (class_exists('Winter\Storm\Html\Helper')) {
            $name = implode('.', \Winter\Storm\Html\Helper::nameToArray($name));
        }
        
        return array_get(Request::query(), $name, $default);
    }
    
    /**
     * Writes a trace message to a log file.
     * @param mixed $message Specifies a message to log. The message can be an object, array or string.
     * @param string $level Specifies a level to use. If this parameter is omitted, the default listener will be used (info).
     * @return void
     */
    public static function traceLog()
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
    
    /**
     * Alias for trace_sql()
     * @return void
     */
    public static function traceSql()
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
            
            self::traceLog($query);
        });
    }
    
    /**
     * Get the path to the config folder.
     *
     * @param  string  $path
     * @return string
     */
    public static function configPath($path = '')
    {
        return PathResolver::join(self::app('path.config'), $path);
    }
    
    /**
     * Get the path to the plugins folder.
     *
     * @param  string  $path
     * @return string
     */
    public static function pluginsPath($path = '')
    {
        return PathResolver::join(self::app('path.plugins'), $path);
    }
    
    /**
     * Get the path to the uploads folder.
     *
     * @param  string  $path
     * @return string
     */
    public static function uploadsPath($path = '')
    {
        return PathResolver::join(Config::get('cms.storage.uploads.path', self::app('path.uploads')), $path);
    }
    
    /**
     * Get the path to the media folder.
     *
     * @param  string  $path
     * @return string
     */
    public static function mediaPath($path = '')
    {
        return PathResolver::join(Config::get('cms.storage.media.path', self::app('path.media')), $path);
    }
    
    /**
    * Get the path to the themes folder.
    *
    * @param  string  $path
    * @return string
    */
    public static function themesPath($path = '')
    {
        return PathResolver::join(self::app('path.themes'), $path);
    }
    
    /**
     * Get the path to the temporary storage folder.
     *
     * @param  string  $path
     * @return string
     */
    public static function tempPath($path = '')
    {
        return PathResolver::join(self::app('path.temp'), $path);
    }
    
    /**
     * Encode HTML special characters in a string.
     *
     * @param  \Illuminate\Contracts\Support\Htmlable|string  $value
     * @param  bool  $doubleEncode
     * @return string
     */
    public static function e($value, $doubleEncode = false)
    {
        if ($value instanceof \Illuminate\Contracts\Support\Htmlable) {
            return $value->toHtml();
        }
        
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', $doubleEncode);
    }
    
    /**
     * Translate the given message.
     *
     * @param  string|null  $id
     * @param  array   $parameters
     * @param  string|null  $locale
     * @return string
     */
    public static function trans($id = null, $parameters = [], $locale = null)
    {
        return self::app('translator')->trans($id, $parameters, $locale);
    }

    /**
     * Resolves a path to its canonical location.
     *
     * This expands all symbolic links and resolves references to /./, /../ and extra / characters in the input path
     * and returns the canonicalized absolute pathname.
     *
     * This function operates very similar to the PHP `realpath` function, except it will also work for missing files
     * and directories.
     *
     * Returns canonical path if it can be resolved, otherwise `false`.
     *
     * @param  string  $path
     * @return string|bool
     */
    public static function resolvePath($path)
    {
        return PathResolver::resolve($path);
    }
    
    /**
     * Create a collection from the given value.
     *
     * @param  mixed  $value
     * @return \Winter\Storm\Support\Collection
     */
    public static function collect($value = null)
    {
        return new Collection($value);
    }
}