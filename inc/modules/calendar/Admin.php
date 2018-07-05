<?php

namespace Inc\Modules\Calendar;

use Inc\Core\AdminModule;

/**
 * Sample admin class
 */
class Admin extends AdminModule
{
public function navigation()
    {
        return [
            'Podgląd'	=> 'index',
	    $this->lang('manage', 'general')    => 'manage',
            'Dodaj wydarzenie'                => 'add'
        ];
    }

    public function getIndex()
    {
	$rows = $this->db('calendar')->toArray();
	foreach($rows as $row)
	{
		$data[] = array(
		 'id'   => $row["id"],
		 'title'   => $row["title"],
 		 'start'   => $row["start"],
  		 'end'   => $row["stop"],
		 'color' => $row["color"]
 		);
	}
        return $this->draw('index.html', ['data' => $data]);
    }
    public function getManage()
    {
	$rows = $this->db('calendar')->toArray();
        if (count($rows)) {
            foreach ($rows as $row) {
                $row['delURL']  = url([ADMIN, 'calendar', 'delete', $row['id']]);

                $assign[] = $row;
            }
        }

        return $this->draw('manage.html', ['calendar' => $assign]);
    }
    public function getAdd()
    {
        return $this->draw('add.html');
    }
    public function anySafe()
    {
	$query = $this->db('calendar')->save(['title' => $_POST['tytul'], 'start' => $_POST['od'], 'stop' => $_POST['do'],'user_id' => $this->core->getUserInfo('id') ,'color' => $_POST['kolor']]);

        if ($query) {
            $this->notify('success', 'Wydarzenie dodano do kalendarza');
        }
	$location = [ADMIN, 'calendar', 'add'];
	redirect(url($location));
    }
    public function getDelete($id)
    {
	$query = $this->db('calendar')->delete($id);

        if ($query) {
            $this->notify('success', 'Wydarzenie usunięto pomyślnie');
        } else {
            $this->notify('failure', 'Usunięcie wydarzenia niepowiodło się');
        }

        redirect(url([ADMIN, 'calendar', 'manage']));
    }

}
