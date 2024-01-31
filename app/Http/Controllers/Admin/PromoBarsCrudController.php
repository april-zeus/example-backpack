<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PromoBarsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PromoBarsCrudController extends CrudController
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
        CRUD::setModel(\App\Models\PromoBars::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/promo-bars');
        CRUD::setEntityNameStrings('promo bars', 'promo bars');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        Crud::addColumn([
            'name' => 'name',
            'type' => 'text',
            'orderable' => false,
        ]);
        Crud::addColumn([
            'label' => 'Region',
            'name' => 'region',
            'type' => 'enum',
            'orderable' => false,
            'searchLogic' => 'text',
        ]);
        Crud::addColumn([
            'label' => 'Visibility',
            'name' => 'is_visible',
            'type' => 'boolean',
        ]);

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    public function update()
    {
        dd(request());
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {

        CRUD::addField([
            'label' => 'Visible',
            'type' => 'switch',
            'name' => 'is_visible',
        ]);

        CRUD::addField([
            'label' => 'Name',
            'type' => 'text',
            'name' => 'name',
            'wrapper' => [
                'class' => 'form-group col-md-6',
            ],
        ]);

        CRUD::addField([
            'name' => 'slides',
            'label' => 'Slides',
            'type' => 'repeatable',
            'subfields' => [
                [
                    'name' => 'title',
                    'label' => 'Slide title',
                    'type' => 'text',
                ],
                [
                    'name' => 'primary_button_text',
                    'label' => 'Primary button text',
                    'type' => 'text',
                ],
                [
                    'name' => 'primary_button_url',
                    'label' => 'Primary button URL',
                    'type' => 'text',
                ],
                [
                    'name' => 'is_endless',
                    'label' => 'Endless',
                    'type' => 'switch',
                    'wrapper' => [
                        'class' => 'form-group col-md-2',
                    ],
                ],
                [
                    'name' => 'start_date,end_date',
                    'type' => 'date_range',
                    'label' => 'Date',
                    'wsapper' => ['class' => 'form-group col-md-4'],
                ],
            ],
            'new_item_label' => 'New slide',
            'reorder' => true,
        ]);
    }

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
