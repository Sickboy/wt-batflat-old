<?php
namespace Inc\Modules\Video;

use Inc\Core\SiteModule;

class Site extends SiteModule
{
public function init()
    {
        $this->_importVideos();
    }

    private function _importVideos()
    {
        $assign = [];
        $videos = $this->db('videos')->toArray();

/*	foreach ($videos as $video){
		
	}
*/
        $assign = $this->draw('videos.html', ['videos' => $videos]);

        $this->tpl->set('videos', $assign);

        $this->core->addCSS(url('inc/jscripts/lightbox/lightbox.min.css'));
        $this->core->addJS(url('inc/jscripts/lightbox/lightbox.min.js'));
    }}
