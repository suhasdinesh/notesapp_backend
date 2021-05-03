<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NoteRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class NoteCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class NoteCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Note::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/note');
        CRUD::setEntityNameStrings('note', 'notes');
        
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        //  CRUD::addColumn([ 'name' => 'files', 'label' => 'IMG', 'type' => 'text']);
        CRUD::column('name');
        CRUD::column('college_name');
        CRUD::column('course');
        CRUD::column('semester');
        CRUD::addColumn([
            'name'      => 'files', // The db column name
            'label'     => 'Files', // Table column heading
            'type'      => 'upload_multiple',
            'prefix'    => 'storage/app/public/',
            'disk'      => 'public',
        ]);
        

    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(NoteRequest::class);

        // CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         * 
         */
        CRUD::addField([ 'name' => 'name', 'label' => 'Name', 'type' => 'text' ]);
        CRUD::addField([ 'name' => 'college_name', 'label' => 'College name', 'type' => 'text' ]);
        CRUD::addField([ 'name' => 'course', 'label' => 'Course', 'type' => 'text' ]);
        CRUD::addField([ 'name' => 'semester', 'label' => 'Semester', 'type' => 'text' ]);
        CRUD::addField([ 'name' => 'files', 'type' => 'upload_multiple', 'class'=>'form-control','upload' => true],'both');
    }

    // protected function store($data){
    //     return;
    // }


    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {

        $this->setupCreateOperation();
    }
}
