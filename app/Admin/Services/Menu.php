<?php

namespace App\Admin\Services;

use DB;

class Menu
{
    private $table = 'admin_menu';

    private $data = [];

    public function uri(string $uri): self
    {
        $this->data['uri'] = $uri;

        return $this;
    }

    public function icon(string $icon): self
    {
        $this->data['icon'] = $icon;

        return $this;
    }

    public function title(string $title): self
    {
        $this->data['title'] = $title;

        return $this;
    }

    public function order(int $order): self
    {
        $this->data['order'] = $order;

        return $this;
    }

    public function parent(string $parentTitle = ''): self
    {
        $this->data['parent_id'] = 0;

        if (!empty($parentTitle)) {
            $this->data['parent_id'] = DB::table($this->table)
                    ->where('title', $parentTitle)
                    ->value('id') ?? 0;
        }

        return $this;
    }

    public function create()
    {
        DB::table($this->table)->insert($this->data);
    }

    public function drop(string $title)
    {
        DB::table($this->table)->where('title', '=', $title)->delete();
    }

    public function update(string $title)
    {
        DB::table($this->table)->where('title', $title)->update($this->data);
    }
}
