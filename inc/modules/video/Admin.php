<?php
namespace Inc\Modules\Video;

use Inc\Core\AdminModule;

class Admin extends AdminModule
{
    public function navigation()
    {
        return [
            $this->lang('index') => 'index',
        ];
    }

    public function getIndex()
    {
	$assign = [];

        // list
        $rows = $this->db('videos')->toArray();
        if (count($rows)) {
            foreach ($rows as $row) {
                $row['editURL'] = url([ADMIN, 'video',  'edit', $row['id']]);
                $row['delURL']  = url([ADMIN, 'video', 'delete', $row['id']]);

                $assign[] = $row;
            }
        }
        return $this->draw('index.html', ['videos' => $assign]);
    }

    public function anyAdd()
    {
        $location = [ADMIN, 'video', 'index'];
        
        $query = $this->db('videos')->save(['title' => $_POST['title'], 'videoid' => $_POST['videoid']]);

	if ($query) {
            $this->notify('success', 'Film dodano pomyślnie');
        } else {
            $this->notify('failure', 'Błąd podczas dodawania filmu');
        }
            
        redirect(url($location));
    }

    public function getDelete($id)
    {
        $query = $this->db('VIDEOS')->delete($id);

        if ($query) {
            $this->notify('success', 'Film usunięto pomyślnie');
        } else {
            $this->notify('failure', 'Błąd podczas usuwania filmu');
        }

        redirect(url([ADMIN, 'video', 'index']));
    }
}
