<?php
namespace Inc\Modules\Sql;

use Inc\Core\SiteModule;

/**
 * Sample site class
 */
class Site extends SiteModule
{
    /**
     * Example module variable
     *
     * @var string
     */
    protected $foo;

    /**
     * Module initialization
     * Here everything is done while the module starts
     *
     * @return void
     */
    public function init()
    {
        $this->foo = 'Hello';
    }
    /**
     * Register module routes
     * Call the appropriate method/function based on URL
     *
     * @return void
     */
    public function routes()
    {
        // Simple:
        $this->route('sample', 'getIndex');
        /*
            * Or:
            * $this->route('sample', function() {
            *  $this->getIndex();
            * });
            *
            * or:
            * $this->router->set('sample', $this->getIndex());
            *
            * or:
            * $this->router->set('sample', function() {
            *  $this->getIndex();
            * });
            */
    }

    /**
     * GET: /sample
     * Called method by router
     *
     * @return string
     */
    public function getIndex()
    {
        $page = [
            'title' => $this->lang('title'),
            'desc' => 'Your page description here',
            'content' => $this->draw('hello.html')
        ];

        $this->setTemplate('index.html');
        $this->tpl->set('page', $page);
    }
}
