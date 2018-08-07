<?php

namespace Inc\Modules\Calendar;

use Inc\Core\SiteModule;

class Site extends SiteModule
{
    protected $foo;

    public function init()
    {
        $this->_showCalendar();
	$this->_incEvent();
	$this->_incoming();
    }

    public function routes()
    {
        $this->route('sample', 'getIndex');
    }

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

    public function _showCalendar()
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

	$this->tpl->set('showCalendar', $this->draw('calendar.html', ['data' => $data ]));
    }

    public function _incEvent()
    {
	$today =  date('Y-m-d');
	$items = $this->db('calendar')->where('start', '>' , $today)->asc('start')->limit(3)->toArray();
	$this->tpl->set('incomingEvent', $this->draw('event.html', ['items' => $items ]));
    }

    private function _incoming()
    {
            $ile = 4;
            $events = $this->core->db('calendar')->where('start', '>' , date("Y-m-d"))->limit($ile)->asc('start')->toArray();
            $this->tpl->set('incoming', $this->draw('incoming.html', ['events' => $events]));
    }
}
