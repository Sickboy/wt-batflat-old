<?php
namespace Inc\Modules\three;

use Inc\Core\SiteModule;

class Site extends SiteModule
{
    protected $foo;

    public function init()
    {
        $this->_foo();
    }
    public function routes()
    {
    }

    private function _foo()
        {
	    $ile = $this->core->getSettings('three', 'ile_postow');
            $posts = $this->core->db('blog')->limit($ile)->asc('id')->toArray();
            $this->tpl->set('three', $this->draw('three.html', ['posts' => $posts]));
        }
}
