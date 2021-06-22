<?php
namespace core;
/**
 * Application Templates view clas
 */
class View
{  
    public $appLayout = 'layout';
      
    public function getTemplate($view,$params)
    {
        ob_start();
        if(!empty($params)) extract($params);
        include_once PATH."/view/{$view}.php";
        return ob_get_clean();
    }

    public function renderView($view, $params = [])
    {
        $layout = $this->getTemplate($this->appLayout,$params);
        $content = $this->getTemplate($view,$params);
        return str_replace('{{content}}', $content, $layout);
    }
}
