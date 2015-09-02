<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Http\Requests\Employees\UserRequest;
use App\Models\User;
use App\Models\Position;

use Input;
use Auth;
use HTML;
use Image;

use Nayjest\Grids\Components\Base\RenderableRegistry;
use Nayjest\Grids\Components\ColumnHeadersRow;
use Nayjest\Grids\Components\ColumnsHider;
use Nayjest\Grids\Components\CsvExport;
use Nayjest\Grids\Components\ExcelExport;
use Nayjest\Grids\Components\Filters\DateRangePicker;
use Nayjest\Grids\Components\FiltersRow;
use Nayjest\Grids\Components\HtmlTag;
use Nayjest\Grids\Components\Laravel5\Pager;
use Nayjest\Grids\Components\OneCellRow;
use Nayjest\Grids\Components\RecordsPerPage;
use Nayjest\Grids\Components\RenderFunc;
use Nayjest\Grids\Components\ShowingRecords;
use Nayjest\Grids\Components\TFoot;
use Nayjest\Grids\Components\THead;
use Nayjest\Grids\Components\TotalsRow;
use Nayjest\Grids\DbalDataProvider;
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\IdFieldConfig;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\SelectFilterConfig;
use Nayjest\Grids\FilterConfig;
use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    public function index()
    {
    }

    /**
     * Build html list element of tree node
     *
     * @return string
     */
    public function renderNode($node) 
    {
        if( $node->isLeaf() ) 
        {
            return '<li>' 
                . '<span data-id="' . $node->id . '" class="glyphicon glyphicon-star"></span>'
                . $node->name . ' '
                . $node->patronymic . ' '
                . $node->id  . ' (' 
                . $node->position->text . ')'
                . '</li>';
        }
        else
        {
            $html = '<li>'
                . '<span data-id="' . $node->id . '" class="glyphicon glyphicon-user"></span>'
                . $node->name . ' '
                . $node->patronymic . ' '
                . $node->id  . ' ('
                . $node->position->text . ')'
                . '<ul>';

            foreach($node->children as $child)
                $html .= $this->renderNode($child);

            $html .= '</ul>'
                . '</li>';
        }

        return $html;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function hierarchy()
    {
        $usersHierarchy = User::getFullHierarchy();
        $usersHierarchyHTML = '';
        foreach ($usersHierarchy as $node) 
        {
            $usersHierarchyHTML = $this->renderNode($node);
        }
        
        $user = Auth::user();
        
        return view('pages\employees-hierarchy', [
            'usersHierarchyHTML' => $usersHierarchyHTML,
            'user' => $user
            ]);
    }

    public function grid()
    {
        $query = new EloquentDataProvider(User::getAllEmployeesQuery());

        $usersGrid = new Grid(
            (new GridConfig)
                ->setDataProvider($query)
                ->setName('employees_grid')
                ->setColumns([
                    (new FieldConfig)
                        ->setName('name')
                        ->setLabel('Имя')
                        ->setSortable(true)
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                    ,
                    (new FieldConfig)
                        ->setName('surname')
                        ->setLabel('Фамилия')
                        ->setSortable(true)
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                    ,
                    (new FieldConfig)
                        ->setName('patronymic')
                        ->setLabel('Отчество')
                        ->setSortable(true)
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                    ,
                    (new FieldConfig)
                        ->setName('email')
                        ->setLabel('Email')
                        ->setSortable(true)
                        ->setCallback(function ($val) {
                            $icon = '<span class="glyphicon glyphicon-envelope"></span>&nbsp;';
                            return
                                '<small>'
                                . $icon
                                . HTML::link("mailto:$val", $val)
                                . '</small>';
                        })
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                    ,
                    (new FieldConfig)
                        ->setName('salary')
                        ->setLabel('Оклад')
                        ->setSortable(true)
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                    ,
                    (new FieldConfig)
                        ->setName('position.text')
                        ->setLabel('Должность')
                        ->setSortable(true)
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                    ,
                    (new FieldConfig)
                        ->setName('hire_date')
                        ->setLabel('Приняли на работу')
                        ->setSortable(true)
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                    ,
                ])
            );
            
        return view('pages\employees-grid', [
            'usersGrid' => $usersGrid
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        $employee = User::find($id);

        return view('pages\employee-edit', [
            'user' => $employee
        ]);
    }

    public function postEdit(UserRequest $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->patronymic = $request->patronymic;
        $user->email = $request->email;

        if (Input::file('image')->isValid()) {
            $destinationPath = 'uploads'; 
            $imageFile = Input::file('image');
            $extension = $imageFile->getClientOriginalExtension();
            $fileName = $user->id . '.' . $extension; 
            $fileThumbnailName = $user->id. '_thumbnail.' . $extension;
            Image::make($imageFile)->fit(250, 250)->save($destinationPath . '/' . $fileThumbnailName);
            $imageFile->move($destinationPath, $fileName);
        }

        $user->save();
    }

    public function makeChildOf()
    {
        $data = Input::all();
        $childId = $data['childId'];
        $parentId = $data['parentId'];

        
        $childUser = User::find($childId);
        $parentUser = User::find($parentId);

        $childUser->makeChildOf($parentUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
