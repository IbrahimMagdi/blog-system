<?php

if(!function_exists('trans')){
    function trans(string $key=null, string $default=null): string{
        /**
         * Retrieve a translated string from language files.
         *
         * Looks up a translation key in the active locale’s language file.
         * The key should be in dot notation format (e.g., "messages.welcome").
         *
         * The locale is determined by the current session ('locale') if set,
         * otherwise it falls back to the default or fallback language
         * defined in the `config('lang.*')` configuration.
         *
         * Example:
         *   trans('messages.hello'); // Returns the translation for 'hello' in /lang/{locale}/messages.php
         *
         * @param string|null $key The translation key in "file.key" format.
         * @param string|null $default Optional default locale to use if not found in session or config.
         * @return string The translated string if found, the key if missing, or an empty string if file not found.
         */
        $trans = explode('.', $key);
        if(session_has('locale')){
            $default = session('locale');
        }else{  
            $default = !empty(config('lang.default'))?config('lang.default'):config('lang.fallback');
        }
        $path = config('lang.path').'/'.$default.'/'.$trans[0].".php";
        if(file_exists($path) && count($trans) > 0){
            $result = include $path;
            return isset($result[$trans[1]])?$result[$trans[1]]:$key;
        }
        return "";
    }
}


if(!function_exists('set_local')){
     /**
     * Set the current locale (language) for the user session.
     *
     * Stores the given language code (e.g., 'en', 'fr', 'es') in the session
     * to be used by the translation system.
     *
     * Example:
     *   set_local('fr'); // Sets the current locale to French
     *
     * @param string|null $lang The language code to set.
     * @return void
     */
    function set_local(string $lang=null){
        session('locale', $lang);

    }
}
