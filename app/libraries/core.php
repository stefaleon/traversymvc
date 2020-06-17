<?php
/*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT -/controller/method/params
 */
class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        // print_r($this->getUrl());
        $url = $this->getUrl();

        // Look in controllers for first value
        // controllers files will have capitalized first letter so we use ucwords

        if (isset($url[0])) {
            if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                // If exists, set as controller
                $this->currentController = ucwords($url[0]);
                // Unset 0 index
                unset($url[0]);
            }
        }

        // Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // Instantiate controller class
        $this->currentController = new $this->currentController;
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            // trim the right slash
            $url = rtrim($_GET['url'], '/');
            //  sanitize the url
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // break the url to an array, break on /
            $url = explode('/', $url);
            return $url;
        };
    }
}
