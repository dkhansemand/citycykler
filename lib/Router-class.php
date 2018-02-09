<?php
/**
 * RESTfull router - based on static methods
 * @author Andreas Hansson <dkhansemand@gmail.com>
 * @version 1.0.0
 */

class Router
{
    private static  $currentRoute = null,
                    $defaultRoute,
                    $endRoutes    = [],
                    $params       = [],
                    $route,
                    $viewFolder   = 'views',
                    $view,
                    $views        = [],
                    $title        = [],
                    $REQ_ROUTES    = null;

    public static   $BASE = '';

    public static function SetDefaultRoute(string $route) : void
    {
        self::$defaultRoute = $route;
    }

    public static function SetViewFolder(string $folder) : void
    {
        self::$viewFolder = $folder;
    }

    public static function GetParams() : array
    {
        return self::$params[self::$route];
    }

    public static function GetParam(string $param) : string
    {
        return rawurldecode(self::$params[self::$route][$param]) ?? null;
    }

    public static function GetView() : string
    {
        return self::$viewFolder . self::$view;
    }

    public static function ViewTitle() : string
    {
        return self::$title[self::$view] ?? '';
    }

    public static function DumpViews() : void
    {
        var_dump(['self::$view' => self::$view]);
        var_dump(['self::$endRoutes' => self::$endRoutes]);
        var_dump(['self::$route' => self::$route]);
        var_dump(['self::$currentRoute' => self::$currentRoute]);
        var_dump(['self::$REQ_ROUTES' => self::$REQ_ROUTES]);

    }

    public static function AddEndpoint(string $endpoint, string $view, array $options = []) : void
    {
        if(!in_array($endpoint, self::$endRoutes, true))
        {
            if(file_exists(self::$viewFolder.$view))
            {
                if(array_key_exists('guard', $options))
                {
                    if($options['guard'] instanceof Guard)
                    {
                        array_push(self::$endRoutes, [$endpoint, $view, 'guard' => $options['guard']]);
                    }
                    else
                    {
                        throw new Exception("The guard is not a valid Guard instance!");
                        return;
                    }
                }
                else
                {
                    array_push(self::$endRoutes, [$endpoint, $view]);
                }
                if(array_key_exists('title', $options))
                {
                    //array_push(self::$endRoutes, [$endpoint, $view, 'guard' => $options['guard']]);
                    self::$title[$view] = $options['title'];
                }
            }
            else
            {
                if(!empty(self::$defaultRoute))
                {
                    self::Redirect(self::$defaultRoute);
                }
                else
                {
                    throw new Exception("View file '" . $view . "' in loaction '" . self::$viewFolder.$view . "' could not be found!");
                }
            }
        }
    }

    public static function Init(string $URI) : void
    {
        if(strpos($URI, "?") !== false)
        {
            $URI = substr($URI, 0, strpos($URI, "?"));
        }
        self::$BASE = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], "index.php"));
        self::$route = '/'.str_replace(self::$BASE, '', $URI);
        $match = false;
        $routeArr = explode('/', trim(self::$route, '/'));
        //echo '<pre>', var_dump(self::$endRoutes),'</pre>';
        foreach(self::$endRoutes as $idx => $endRoute)
        {
           $endPointArr = explode('/', trim($endRoute[0],'/'));
           
           self::$REQ_ROUTES[]  = (strpos($endRoute[0], ':') !== false) ? trim(substr($endRoute[0], 0, strpos($endRoute[0], ":"))) : $endRoute[0];
           // echo '<pre>',var_dump($endRoute),'</pre>';
           foreach($endPointArr as $id => $endpoint)
           {
               if(isset($routeArr[$id]) && ($endpoint ===  $routeArr[$id]))
               {
                  
                   if(!$match){

                    if( ( substr(self::$route, 0, strlen(self::$REQ_ROUTES[$idx])) === self::$REQ_ROUTES[$idx] )
                        && ( count($endPointArr) === count($routeArr) ) ){
                        $match = true;
                        self::$view = $endRoute[1];
                        if(array_key_exists('guard', $endRoute))
                        {
                            $endRoute['guard']->Protect();
                        }
                    }
                  }
               }
               elseif($match && (strpos($endpoint, ':') !== false))
               {
                    if(isset($routeArr[$id]) && ( substr(self::$route, 0, strlen(self::$REQ_ROUTES[$idx])) === self::$REQ_ROUTES[$idx] )
                   )
                    {
                        self::$params[self::$route][$endpoint] = $routeArr[$id];
                    }
                    
               }
           }
        }

        if(!$match)
        {
            try
            {
                self::Redirect(self::$defaultRoute);
            }
            catch(Exception $err)
            {
                throw new Exception("Route not found! BASE:".self::$BASE);
                exit;
            }
        }
    }
    
    public static function Link(string $link) : string
    {
        return self::$BASE . trim($link, '/');
    }

    public static function Redirect(string $url) : void
    {
        self::$BASE = '/'.trim(substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], "index.php")), '/');
        var_dump('location:'.self::$BASE.$url);
        echo '<pre>',self::DumpViews(),'</pre>';
        //header('Location:'.self::$BASE.$url.'');
        exit;
    }

    public static function RedirectToDefault() : void
    {
        self::Redirect(self::$defaultRoute);
    }

    public static function IsActive(array $routes) : string
    {
        $activeClass = '';
        foreach($routes as $route)
        {
            if(self::$route === $route){
                $activeClass = ' active ';
            }elseif(strpos(self::$route, $route) !== false)
            {
                $activeClass = ' active ';
            }
        }
        return $activeClass;
    }
}
