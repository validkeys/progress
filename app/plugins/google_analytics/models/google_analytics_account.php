<?php
class GoogleAnalyticsAccount extends GoogleAnalyticsAppModel
{
    var $useDbConfig = 'googleAnalytics';

    function __construct()
    {
		// echo ROOT . DS .'app' . DS . 'plugins' . DS .'models'.DS.'datasources'.DS.'google_analytics_source.php'; die();
        App::import(array(
            'type' => 'File',
            'name' => 'GoogleAnalytics.GOOGLE_ANALYTICS_CONFIG',
            'file' => ROOT . DS . 'app' . DS . 'config'.DS.'google_analytics.php'));
        App::import(array(
            'type' => 'File',
            'name' => 'GoogleAnalytics.GoogleAnalyticsSource',
            'file' => ROOT . DS .'app' . DS . 'plugins' . DS . 'google_analytics' . DS .'models'.DS.'datasources'.DS.'google_analytics_source.php'));
        $config =& new GOOGLE_ANALYTICS_CONFIG();
        ConnectionManager::create('googleAnalytics', $config->googleAnalytics);

        parent::__construct();
    }
}