<?php

namespace App\Admin\Controllers;

use App\Console;
use App\Game;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class GamesController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Game);

        $grid->id('Id');
        $grid->name('Name');
        $grid->description('Description');
        $grid->information('Information');
        $grid->released_at('Released at');
        $grid->updated_at('Updated at');
        $grid->created_at('Created at');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Game::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->description('Description');
        $show->information('Information');
        $show->released_at('Released at');
        $show->updated_at('Updated at');
        $show->created_at('Created at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Game);

        $form->multipleSelect('consoles')->options(Console::all()->pluck('name', 'id'));

        $form->text('name', 'Name');
        $form->textarea('description', 'Description');

        $form->mediaLibrary('logo')
            ->responsive()
            ->removable();

        $form->multipleMediaLibrary('images')
            ->responsive()
            ->removable();

        $form->embeds('information', function ($form) {
            $form->text('Developer');
        });

        $form->date('released_at', 'Released at')->default(date('Y-m-d'));

        return $form;
    }
}
