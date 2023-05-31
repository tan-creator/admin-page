<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Models\Projects;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Models\UserProject;

class ProjectsController extends Controller
{
    private $project;
    public function __construct(Projects $project)
    {
        $this->project = $project;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.project.list', [
            'tittle' => 'List Project',
            'projects' => Projects::paginate(config('constants.paginates'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::allows('isAdmin') || Gate::allows('isDM')) {
            return view('admin.pages.project.add', [
                'tittle' => 'Add Project'
            ]);
        }
        session()->flash('failed', __('message.permission'));
        return redirect()->route('projects.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        Projects::create($request->all());
        session()->flash('success', __('message.success'));
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Projects $project)
    {
        return view(
            'admin.pages.project.detail',
            [
                'tittle' => 'Detail Project',
                'project' => $project,
                'users' => $project->users()->get(),
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projects $project)
    {
        if (Gate::allows('isAdmin') || Gate::allows('isDM')) {
            return view(
                'admin.pages.project.edit',
                [
                    'tittle' => 'Edit Project',
                    'project' => $project
                ]
            );
        }
        session()->flash('failed', __('message.permission'));
        return redirect()->route('projects.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Projects $project)
    {
        $project->fill($request->all());
        $project->save();
        session()->flash('success', __('message.success'));
        return redirect()->route('projects.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (Gate::allows('isAdmin') || Gate::allows('isDM')) {
            Projects::find($request->id)->delete();
            session()->flash('success', __('message.success'));
            return redirect()->route('projects.index');
        }
        session()->flash('failed', __('message.permission'));
        return redirect()->route('projects.index');
    }

    public function loadAddUserForm(Projects $project)
    {
        if ($project->status == 'Closed' || $project->finish_date < date('Y-m-d h:i:s')) {
            session()->flash('closed', __('message.project_closed'));
            return back();
        }

        if (Gate::allows('isAdmin') || Gate::allows('isDM')) {
            return view(
                'admin.pages.project.projectAddUser',
                [
                    'tittle' => 'Add user',
                    'project' => $project,
                    'users' => User::whereNotIn('id', function ($query) use ($project) {
                        $query->select('user_id')->from('user_project')->where('project_id', $project->id);
                    })->paginate(config('constants.paginates')),
                ]
            );
        } else {
            session()->flash('failed', __('message.permission'));
            return redirect()->route('projects.show', ['project' => $project->id]);
        }
    }

    public function addUserToProject(Request $request)
    {
        $id = collect($request->all())
            ->filter(function($value, $key){
                return strpos($key, 'user_') === 0;
            })
            ->all();

        if(empty($id)){
            session()->flash('exists', __('Please choose a user'));
            return redirect()->back();
        }

        if(count($id) === count(User::whereIn('id', $id)->get()->toArray())){
            Projects::find($request->project_id)->users()->detach($id);
            Projects::find($request->project_id)->users()->attach($id);
            session()->flash('success', __('message.success'));
            return redirect()->route('project.add-user', ['project' => $request->project_id]);
        }
        else{
            session()->flash('exists', __('Please choose a valid user'));
            return redirect()->back();
        }
    }
}
