<?php

namespace Inc\Modules\three;

use Inc\Core\AdminModule;

class Admin extends AdminModule
{
    public function navigation()
    {
        return [
//            $this->lang('index') => 'index',
        ];
    }

    public function getIndex()
    {	
	
        $ile = $this->core->getSettings('three', 'ile_postow');;
	return $this->draw('index.html', ['ile' => $ile]);
    }
}
