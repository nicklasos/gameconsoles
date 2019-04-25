<?php

namespace App\Admin\Controllers;

use App\Company;
use App\Console;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ConsolesController extends Controller
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
        $grid = new Grid(new Console);

        $grid->id('Id');
        $grid->company_id('Company id');
        $grid->name('Name');
        $grid->description('Description');
        $grid->information('Information');
        $grid->released_at('Released at');
        $grid->unreleased_at('Unreleased at');
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
        $show = new Show(Console::findOrFail($id));

        $show->id('Id');
        $show->company_id('Company id');
        $show->name('Name');
        $show->description('Description');
        $show->information('Information');
        $show->released_at('Released at');
        $show->unreleased_at('Unreleased at');
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
        $form = new Form(new Console);

        $form
            ->select('company_id', 'Company')
            ->options(Company::all()->pluck('name', 'id'))
            ->required();

        $form->text('name', 'Name');
        $form->textarea('description', 'Description');
        $form->textarea('information', 'Information');

        $form->mediaLibrary('logo')
            ->responsive()
            ->removable();

        $form->multipleMediaLibrary('images')
            ->responsive()
            ->removable();

        $form->date('released_at', 'Released at');
        $form->date('unreleased_at', 'Unreleased at');

        return $form;
    }
}
