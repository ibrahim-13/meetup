<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AttendeeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AttendeeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AttendeeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Attendee');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/attendee');
        $this->crud->setEntityNameStrings('attendee', 'attendees');

        $this->crud->enableExportButtons();
    }

    protected function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'id',
                'type' => 'text',
                'label' => '# ID'
            ],
            [
                'name' => 'name',
                'type' => 'text',
                'label' => 'Name',
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhere('name', 'like', '%'.$searchTerm.'%');
                }
            ],
            [
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email',
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhere('email', 'like', '%'.$searchTerm.'%');
                }
            ],
            [
                'name' => 'mobile',
                'type' => 'phone',
                'label' => 'Mobile',
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhere('mobile', 'like', '%'.$searchTerm.'%');
                }
            ],
            [
                'name' => 'tshirt',
                'type' => 'text',
                'label' => 'T-Shirt',
            ],
            [
                'name' => 'is_paid',
                'type' => 'radio',
                'label' => 'Is Paid?',
                'options' => [
                    0 => 'No',
                    1 => 'Yes'
                ]
            ],
            [
                'name' => 'profession',
                'type' => 'text',
                'label' => 'Profession',
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhere('profession', 'like', '%'.$searchTerm.'%');
                }
            ],
            [
                'name' => 'social_profile_url',
                'type' => 'text',
                'label' => 'Social Profile Url'
            ],
        ]);

        $this->setupFilter();
    }

    protected function setupFilter()
    {
        // simple filter
        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'is_paid',
            'label'=> 'Is Paid?'
        ],
        false,
        function() {
             $this->crud->addClause('where', 'is_paid', '=', 1);
        });
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(AttendeeRequest::class);

        $this->crud->addFields([
            [
                'name' => 'name',
                'type' => 'text',
                'label' => 'Name'
            ],
            [
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email'
            ],
            [
                'name' => 'mobile',
                'type' => 'text',
                'label' => 'Mobile'
            ],
            [
                'name' => 'profession',
                'type' => 'text',
                'label' => 'Profession'
            ],
            [
                'name' => 'social_profile_url',
                'type' => 'text',
                'label' => 'Social Profile Url'
            ],
            [   // select2_from_array
                'name' => 'tshirt',
                'label' => "T-Shirt",
                'type' => 'select2_from_array',
                'options' => trans('t_shirt'),
                'allows_null' => false,
                'store_in' => 'misc'
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ],
            [
                'name' => 'is_paid',
                'type' => 'checkbox',
                'label' => 'Is Paid?'
            ]
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }
}
