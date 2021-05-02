<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Support\Facades\Route;

trait noteOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupnoteRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/note', [
            'as'        => $routeName.'.note',
            'uses'      => $controller.'@note',
            'operation' => 'note',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupnoteDefaults()
    {
        $this->crud->allowAccess('note');

        $this->crud->operation('note', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            // $this->crud->addButton('top', 'note', 'view', 'crud::buttons.note');
            // $this->crud->addButton('line', 'note', 'view', 'crud::buttons.note');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function note()
    {
        $this->crud->hasAccessOrFail('note');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? 'note '.$this->crud->entity_name;

        // load the view
        return view("crud::operations.note", $this->data);
    }
}
