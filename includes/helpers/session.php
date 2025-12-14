<?php
if(!function_exists('session')){
    /**
     * Get or set a session value with encryption.
     *
     * When a value is provided, it is encrypted and stored in the session.
     * When no value is provided, the stored session value is decrypted and returned.
     *
     * Requires `encrypt()` and `decrypt()` helper functions to exist.
     *
     * Example:
     *   session('user_id', 42); // Set value
     *   $id = session('user_id'); // Retrieve value
     *
     * @param string $key   The session key name.
     * @param mixed|null $value The value to store (optional).
     * @return mixed The decrypted session value, or an empty string if not set.
     */
    function session(string $key, mixed $value=null): mixed{
        if(!is_null($value)){
            $_SESSION[$key] = encrypt($value);
        }
        return isset($_SESSION[$key])?decrypt($_SESSION[$key]):'';
    }
}
if(!function_exists('session_has')){
    /**
     * Check if a session key exists.
     *
     * Example:
     *   if (session_has('user_id')) { ... }
     *
     * @param string $key The session key name.
     * @return bool True if the session key exists, false otherwise.
     */
    function session_has(string $key): mixed{
        return isset($_SESSION[$key]);
    }
}

if(!function_exists('session_flash')){
    /**
     * Store or retrieve a flash session value.
     *
     * Flash data is only available for the next request and is then removed automatically.
     *
     * Example:
     *   session_flash('success', 'Profile updated successfully!');
     *   $message = session_flash('success'); // Retrieves and deletes it
     *
     * @param string $key   The flash session key.
     * @param mixed|null $value The value to set (optional).
     * @return mixed The flash value if set, otherwise an empty string.
     */
    function session_flash(string $key, mixed $value=null): mixed{
        if(!is_null($value)){
            $_SESSION[$key] = $value;
        }
        $session = isset($_SESSION[$key])? decrypt($_SESSION[$key]):'';
        session_forget($key);
        return $session;
    }
}


if(!function_exists('session_forget')){
    /**
     * Remove a specific key from the session.
     *
     * Example:
     *   session_forget('user_id');
     *
     * @param string $key The session key to remove.
     * @return void
     */
    function session_forget(string $key){
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
    }
}


if(!function_exists('session_delete_all')){
    /**
     * Destroy all session data.
     *
     * Ends the current session and clears all stored session variables.
     *
     * Example:
     *   session_delete_all();
     *
     * @return void
     */
    function session_delete_all(){
        session_destroy();
    }
}