<?php

namespace Inc\Modules\Galleries;

use Inc\Core\SiteModule;

class Site extends SiteModule
{
    public function init()
    {
        $this->_importGalleries();
//	$this -> _showGallery();
    }

    public function routes(){

	$this->route('ex', '_showGallery');
    }

    private function _showGallery(){

	$this->tpl->set('bar', 'Why So Serious?');

    }

    private function _importGalleries()
    {
	$assign = [];
        $tempAssign = [];
	$galleryList = $this->db('galleries')->toArray(); //lista galerii
	$assign = '';

	if (isset($_GET['g'])){
		$galleryId = $this->db('galleries')->select('id')->where('slug', $_GET['g'])->limit(1)->toArray();
		$items = $this->db('galleries_items')->where('gallery', $galleryId[0]['id'])->asc('id')->toArray();

		if (count($items)) {
                    foreach ($items as &$item) {
                        $item['src'] = unserialize($item['src']);
                        if (!isset($item['src']['sm'])) {
                            $item['src']['sm'] = $item['src']['xs'];
                        }
                    }

                    
                   $assign = $this->draw('gallery.html', ['items' => $items, 'galleryList' => $galleryList]);
                    //$this->draw('gallery.html', ['gallery' => $tempAssign, 'galleryList' => $galleryList]);
		}
	}
	else{
		$galleryFirstTmp = $this->db('galleries')->select('id')->where('first', 1)->limit(1)->toArray();
//		print_r($galleryFirstTmp);
		$galleryFirst = $galleryFirstTmp[0]['id'];
		$items = $this->db('galleries_items')->where('gallery', $galleryFirst)->asc('id')->toArray();
//		print_r($items);
		if (count($items)) {
                    foreach ($items as &$item) {
                        $item['src'] = unserialize($item['src']);
                        if (!isset($item['src']['sm'])) {
                            $item['src']['sm'] = $item['src']['xs'];
                        }
                    }

                    

               $assign = $this->draw('gallery.html', ['items' => $items, 'galleryList' => $galleryList]);
                   // $this->draw('gallery.html', ['gallery' => $tempAssign, 'galleryList' => $galleryList]);
		}

	}

	$this->tpl->set('bar', $assign);

        $this->core->addCSS(url('inc/jscripts/lightbox/lightbox.min.css'));
        $this->core->addJS(url('inc/jscripts/lightbox/lightbox.min.js'));
    }
}
