<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Exports\UsersExport;
use App\Imports\HandleSheets;
use App\Mail\UserDetailUpdate;
use App\Http\Requests\CSVRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    private $user;
    private $department;
    private $sheet;

    public function __construct(User $user, Department $department, HandleSheets $sheet)
    {
        $this->user = $user;
        $this->department = $department;
        $this->sheet = $sheet;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.users', [
            'tittle' => 'List users',
            'users' => $this->user->paginate(config('constants.paginates')),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'tittle' => 'Create users',
            'role' => 'none',
            'code' => $this->user->max('code') + 1,
            'departments' => $this->department->get(),
        ];

        if (Gate::allows('isAdmin')) {
            $data['role'] = 'DM';
            return view('admin.pages.userCreate', $data);
        } else if (Gate::allows('isDM')) {
            return view('admin.pages.userCreate', $data);
        }
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $this->user->create($request->except(['id']));

        return redirect()->route('users.index')->with('success', 'Created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.pages.userDetail', [
            'tittle' => 'User details',
            'user' => $user,
            'department' => empty($user->department_id) ? '' : $user->department->name,
            'certifications' => $user->certifications
        ]);
    }

    /**
     * check edit permission. 
     */
    private function canEdit(User $user)
    {
        $isAdminOrDM = Gate::allows('isAdmin') || Gate::allows('isDM');
        $isSelf = $user->id == Auth::id();

        return $isAdminOrDM || $isSelf;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (!$this->canEdit($user)) {
            return redirect()->back()->with('warning', 'You dont have permission to edit!');
        } // Check if user was not admin or DM and the id of field user want to edit different from user's id

        $adminId = $this->user->where('roles', 'Admin')->max('id');
        $isMyDetail = $user->id == Auth::id() ? 'inactive' : ''; // Check if user want to update his details, return inactive css class
        $data = [
            'tittle' => 'Update users',
            'user' => $user,
            'isMyDetail' => $isMyDetail,
            'departments' => $this->department->get(),
            'myDepartment' => empty($user->department_id)
                ? [
                    'id' => '',
                    'name' => 'Choose department!',
                ]
                : $user->department,
        ];

        if ($user->id === $adminId && Gate::denies('isAdmin')) {
            return redirect()->back();
        } // Check if user want to edit admin details but he/she is not admin

        return view('admin.pages.userUpdate', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $data = !$request->has('password')
            ? $request->validated()
            : $request->except(['password']);

        $user->update($data);

        $mailable = new UserDetailUpdate($data);
        Mail::to($data['email'])->send($mailable);

        return redirect()->route('users.show', ['user' => $user])->with('success', 'Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->deletePermission(collect($user->id));

        if (session('warning')) {
            return redirect()->route('users.index');
        }

        $user->destroy(collect($user->id));

        return redirect()->route('users.index')->with('success', 'Deleted successfully!');
    }

    /**
     * Remove multiple specified resource from storage.
     */
    public function multipleDestroy(Request $request)
    {
        $arrId = $request->collect()->except(['_token', '_method'])->keys();

        if (sizeof($arrId) == 0) {
            return redirect()->back()->with('warning', 'Nothing to delete!');
        }
        
        $this->deletePermission($arrId);

        if (session('warning')) {
            return redirect()->route('users.index');
        }
        
        $this->user->destroy($arrId);
        return redirect()->route('users.index')->with('success', 'Deleted successfully!');
    }

    public function deletePermission (Collection $arrayId) {
        $idAdDm = $this->user->whereIn('roles', ['Admin', 'DM'])->get('id');
        
        if (Gate::denies('isAdmin') && Gate::denies('isDM')) {
            return redirect()->back()->with('warning', 'You dont have permission to delete other user!');
        }

        if ($arrayId->search(Auth::id()) !== false) {
            return redirect()->back()->with('warning', 'You can not remove yourself!');
        }

        if (Gate::allows('isDM')) {
            foreach ($idAdDm as $value) {
                if ($arrayId->search($value->id) !== false) {
                    return redirect()->back()->with('warning', 'You can not remove admin or DM!');
                }
            }
        }
    }

    /**
     * Change password.
     */
    public function changePassword(PasswordRequest $request)
    {
        if ($request->newPass !== $request->confirmPassword) {
            return back()->withErrors([
                'confirmPassword' => 'The confirm password field must match new Password',
            ])->onlyInput('confirmPassword');
        }

        $this->user->find(Auth::id())->update($request->only('confirmPassword'));

        return redirect()->route('logout');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.csv');
    }

    /**
     * Show the form for import csv file
     */
    public function import()
    {
        return view('admin.pages.userImport', [
            'tittle' => 'Import User',
            'page' => 'Import',
        ]);
    }

    /**
     * Upload and store to database
     */
    public function upload(CSVRequest $request)
    {
        try {
            $this->sheet
                ->onlySheets('Users')
                ->import($request->file('file'), null, \Maatwebsite\Excel\Excel::XLSX);

            return redirect()->route('users.index');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->back()->with('failures', $failures);
        }
    }

    /**
     * Download csv template
     */
    public function template()
    {
        $file = public_path() . '/template.csv';
        return Response::download($file);
    }
}
