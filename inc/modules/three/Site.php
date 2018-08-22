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
	    if ($this->core->getUserInfo('username') != NULL){
	        $posts = $this->core->db('blog')->limit($ile)->desc('published_at')->toArray();
        	$this->tpl->set('three', $this->draw('three.html', ['posts' => $posts])); }
	    else {
		$posts = $this->core->db('blog')->notLike('logon_only','1')->limit($ile)->desc('published_at')->toArray();
                $this->tpl->set('three', $this->draw('three.html', ['posts' => $posts])); }
        }
}
