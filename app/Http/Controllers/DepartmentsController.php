<?php
namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\DepartmentRequest;
use App\Models\User;

class DepartmentsController extends Controller
{

    private $department;

    public function __construct(Department $department){
        $this->department = $department;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.department.list', [
            'tittle' => 'List Department',
            'departments' => Department::paginate(config('constants.paginates')),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Gate::allows('isAdmin')){
            return view('admin.pages.department.create', [
                'tittle' => 'Create Department',
            ]);
        }
        else{
            Session::flash('auth_msg', __('message.permission'));
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $this->department->create($request->validated());
        Session::flash('update_msg', __('message.success'));
        return redirect()->route('departments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        $users = $department->users()->paginate(config('constants.paginates'));
        return view('admin.pages.department.detail',[
            'tittle' => $department->name . " Detail",
            'department' => $department,
            'users' => $users,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        if(Gate::allows('isAdmin')){
            return view('admin.pages.department.update', [
                'tittle' => 'Update Department',
                'department' => $department,
            ]);
        }
        else{
            Session::flash('auth_msg', __('message.permission'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request)
    {
        $this->department->where('id', $request->department)->update($request->validated());
        Session::flash('update_msg', __('layout_department.update_success', ['name' => $request->name]));

        return redirect()->route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        if(Gate::allows('isAdmin')){
            $department->delete();
            Session::flash('delete_msg', __('layout_department.delete_success',['name' => $department->name]));
            return redirect()->route('departments.index');
        }
        else{
            Session::flash('auth_msg', __('message.permission'));
            return redirect()->back();
        }
    }

    /**
     * Load department add user form
     */
    public function loadAddUserForm(Department $department){
        if(Gate::allows('isAdmin')){
            return view('admin.pages.department.departmentAddUser', [
                'tittle' => "Add user",
                'department' => $department,
                'users' => User::where('department_id', '<>', $department->id)->get(),
            ]);
        }
        else{
            Session::flash('auth_msg', __('message.permission'));
            return redirect()->back();
        }
    }

    /**
     * Add user to the department
     */
    public function addUserForDepartment(Request $request){
        if($request->user_id == '' || empty(User::find($request->user_id))){
            Session::flash('warn_msg', "Please choose a valid user");
            return redirect()->back();
        }
        else{
            if(User::find($request->user_id)->department_id == $request->department){
                Session::flash('warn_msg', "User already in department");
                return redirect()->back();
            }
            else{
                User::where('id', $request->user_id)->update([
                    'department_id' => $request->department,
                ]);
                Session::flash('success_msg', "Add user successfully");

                return redirect()->route('departments.show', ['department' => $request->department]);
            }
        }
    }
}
