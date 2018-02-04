<?php
/**
 * RESTfull router - based on static methods
 * @author Andreas Hansson <dkhansemand@gmail.com>
 * @version 1.0.0
 */

class Router
{
    private static  $currentRoute = '/',
                    $defaultRoute,
                    $endRoutes    = [],
                    $params       = [],
                    $route,
                    $viewFolder   = 'views',
                    $view,
                    $views        = [],
                    $title        = [];

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
        return self::$params;
    }

    public static function GetParam(string $param) : string
    {
        return rawurldecode(self::$params[$param]) ?? null;
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
        var_dump(self::$views);
        var_dump(self::$endRoutes);
        var_dump(self::$route);
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
        foreach(self::$endRoutes as $idx => $endRoute)
        {
           $endPointArr = explode('/', trim($endRoute[0],'/'));
           foreach($endPointArr as $id => $endpoint)
           {
               if(isset($routeArr[$id]) && ($endpoint ===  $routeArr[$id]))
               {
                    self::$currentRoute .= $endpoint;
                    $match = true;
                    self::$view = $endRoute[1];
                    if(count($endPointArr) === count($routeArr))
                    {
                        if(array_key_exists('guard', $endRoute))
                        {
                            $endRoute['guard']->Protect();
                        }
                    }
               }
               elseif($match && (strpos($endpoint, ':') !== false))
               {
                    if(!empty($routeArr[$id]))
                    {
                        self::$params[$endpoint] = $routeArr[$id];
                    }
                    else
                    {
                        self::$params[$endpoint] = '';
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
        //var_dump('location:'.self::$BASE.$url);
        header('Location:'.self::$BASE.$url.'');
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
