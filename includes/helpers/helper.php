<?php
if(!function_exists(('config'))){
     /**
     * Retrieve a configuration value from a PHP config file.
     *
     * The function expects a key in the format "filename.key",
     * where "filename" refers to a PHP file inside the /config directory,
     * and "key" is an array key within that configuration file.
     *
     * Example:
     *   config('app.name') will load '/config/app.php' and return $result['name'].
     *
     * @param string $key The configuration key in dot notation (e.g., 'app.name').
     * @return mixed|null The configuration value, or null if not found.
     */
    function config(string $key){
        $config = explode('.', $key);
        if(count($config) > 0){
            $result = include base_path('/config/'.$config[0].".php");
            return $result[$config[1]];
        }
        return null;
    }
}

if(!function_exists('base_path')){
    /**
     * Get the absolute path to the base directory with an optional subpath.
     *
     * @param string $path The relative path to append to the base path directory.
     * @return string The absolute path.
     */
    function base_path($path){
        return getcwd().'/../'.$path;
    }
}

if(!function_exists('public_path')){
    /**
     * Get the absolute path to the public directory with an optional subpath.
     *
     * @param string $path The relative path to append to the public path directory.
     * @return string The absolute path.
     */
    function public_path($path){
        return getcwd().'/'.$path;
    }
}

if(!function_exists('public_')){
    /**
     * Get the absolute path to the public directory with an optional subpath.
     *
     * @param string $path The relative path to append to the public_ directory.
     * @return string The absolute path.
     */
    function public_(){
        return 'public';
    }
}
