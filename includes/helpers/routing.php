<?php
/**
 *  the array to store route configurations.
 * @var array
 */
$routes = [];

if(!function_exists('route_get')){
    /**
     * Register a new GET route.
     *
     * Adds a GET route to the global $routes array.
     *
     * Example:
     *   route_get('home', 'home_view');
     *
     * @param string $segment The URI segment for the route (e.g., 'home').
     * @param string|null $view The view or callback to handle the route.
     * @return void
     */ 
    function route_get($segmrnt,$view=null){
        global $routes;
        $routes ['GET'] [] = [
            'view' => $view,
            'segment' => '/'.public_().'/'.ltrim($segmrnt, '/')
        ];
    }
}

if(!function_exists('route_post')){
    /**
     * Register a new POST route.
     *
     * Adds a POST route to the global $routes array.
     *
     * Example:
     *   route_post('submit', 'submit_view');
     *
     * @param string $segment The URI segment for the route (e.g., 'submit').
     * @param string|null $view The view or callback to handle the route.
     * @return void
     */
    function route_post($segmrnt, $view=null){
       global $routes;
        $routes ['POST'] [] = [
            'view' => $view,
            'segment' => '/'.public_().'/'.ltrim($segmrnt, '/')
        ];
    }    
}

if(!function_exists('route_int')){
    /**
     * Initialize and dispatch registered routes.
     *
     * This function matches the current URI segment with registered GET or POST routes.
     * If a matching route is found, the corresponding view function is called.
     * Otherwise, a 404 view is rendered for unmatched POST routes.
     *
     * Requires helper functions: `segment()` and `view()`.
     *
     * @return void
     */
    function route_int(){
        global $routes;
        $GET_ROUTES = isset($routes['GET'])?$routes['GET']:[];
        $POST_ROUTES = isset($routes['POST'])?$routes['POST']:[];
        if(!isset($_POST['_method'])){
            foreach($GET_ROUTES as $rget){
                if(segment() == $rget['segment']){
                    view($rget['view']);
                }
            }
        }

        if(isset($_POST) && isset($_POST['_method']) && count($_POST) > 0 &&  strtolower($_POST['_method']) == 'post'){
            foreach($POST_ROUTES as $rpost){
                if(segment() == $rpost['segment']){
                    view($rpost['view']);
                }
            }
            if(!is_null(segment()) && !in_array(segment(), array_column($POST_ROUTES, 'segment'))){
                http_response_code(404); 
                view('404');
                exit();
            }
        }
    }    

}

if(!function_exists('redirect')){
    /**
     * Redirect to a given path.
     *
     * Performs an HTTP redirect to the specified URL path.
     *
     * Example:
     *   redirect('dashboard');
     *
     * @param string $path The path to redirect to.
     * @return void
     */ 
    function redirect($path){
        $check_path = parse_url($path);
        if(isset($check_path['scheme']) && isset($check_path['host'])){
            header('Location: '.$path);
        }else{   
            header('Location: '.url($path));
        }
        exit();
    }
}

if(!function_exists('redirect_if')){
    /** 
     * Redirect to a given path.
     *
     * Performs an HTTP redirect_if to the specified URL path.
     *
     * Example:
     *   redirect_if('dashboard');
     *
     * @param string $path The path to redirect_if to.
     * @return void
     */ 
    function redirect_if(bool   $statement,string $url){
         if($statement){
            redirect($url);
        } 
    }
}

if(!function_exists('back')){
    /**
     * back to a previos path.
     *
     * Performs an HTTP redirect to the specified URL path.
     *
     * Example:
     *   redirect('dashboard');
     *
     * @param string $path The path to redirect to.
     * @return void
     */
    function back(){
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit();;
    }
}

if(!function_exists('url')){
     /**
     * Generate a full URL from a relative segment.
     *
     * Constructs the full URL using the current host and optional HTTPS detection.
     *
     * Example:
     *   url('home'); // returns "http://example.com/home"
     *
     * @param string $segment The URI segment to append.
     * @return string The full URL.
     */
    function url($segment){
        $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
        $url .= $_SERVER['HTTP_HOST'];
        return $url.'/'.public_().'/'.ltrim($segment, '/');
    }
}

if(!function_exists('aurl')){
     /**
     * Generate a  Admin full URL from a relative segment.
     *
     * Constructs the full URL using the current host and optional HTTPS detection.
     *
     * Example:
     *   url('home'); // returns "http://example.com/home"
     *
     * @param string $segment The URI segment to append.
     * @return string The full URL.
     */
    function aurl($segment){
        $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
        $url .= $_SERVER['HTTP_HOST'];
        return $url.'/'.public_().'/'.ADMIN.'/'.ltrim($segment, '/');
    }
}

if(!function_exists('segment')){
    function segment(){
    /**
     * Get the current request URI segment.
     *
     * Returns the current request URI without query parameters, prefixed with a slash.
     *
     * Example:
     *   // If URL is http://example.com/about?lang=en
     *   segment(); // returns "/about"
     *
     * @return string The cleaned request URI segment.
     */
        $segment = ltrim($_SERVER['REQUEST_URI'], '/');
        $removeQuery_Pram = explode('?', $segment)[0];
        return !empty($segment)?'/'.$removeQuery_Pram:'/';
    }    
}

