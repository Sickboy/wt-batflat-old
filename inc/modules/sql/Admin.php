<?php
namespace Inc\Modules\Sql;

use Inc\Core\AdminModule;

/**
 * Sample admin class
 */
class Admin extends AdminModule
{
    /**
     * Module navigation
     * Items of the returned array will be displayed in the administration sidebar
     *
     * @return array
     */
    public function navigation()
    {
        return [
            $this->lang('index') => 'index',
        ];
    }

    /**
     * GET: /admin/sample/index
     * Subpage method of the module
     *
     * @return string
     */
    public function getIndex()
    {
        $text = 'Hello World';
        return $this->draw('index.html', ['text' => $text]);
    }

    public function anyExecute()
    {
	if ($this->core->db()->pdo()->exec($_POST['row']))
	{
  		$this->notify('success', 'Zapytanie wykonano pomyślnie');
	}
	else
	{
		$this->notify('failure', 'Wykonanie zapytania nie powiodło się');
	}
    }
}
