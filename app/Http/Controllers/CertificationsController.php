<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\User;
use App\Models\CertificationUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CertificateRequest;

class CertificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.certification.list', [
            'tittle' => "Certification List",
            'certifications' => Certification::paginate(config('constants.paginates'))
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!(Gate::denies('isAdmin') && Gate::denies('isDM'))) {
            return view('admin.pages.certification.add', [
                'tittle' => "Add Certification"
            ]);
        }
        session()->flash('failed', __('message.permission'));
        return redirect()->route('certifications.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CertificateRequest $request)
    {
        Certification::create($request->all());
        session()->flash('success', __('message.success'));
        return redirect()->route('certifications.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Certification $certification)
    {
        return   view('admin.pages.certification.detail', [
            'tittle' => "Certification Detail",
            'certification' => $certification,
            'users' => $certification->users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certification $certification)
    {
        if (!(Gate::denies('isAdmin') && Gate::denies('isDM'))) {
            return view('admin.pages.certification.edit', [
                'tittle' => "Certification Edit",
                'certification' => $certification
            ]);
        }
        session()->flash('failed', __('message.permission'));
        return redirect()->route('certifications.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certification $certification)
    {
        if ($certification->name !== $request->name) {
            $request->validate(['name' => 'required|unique:certifications|max:255']);
        }
        $certification->fill($request->all());
        $certification->save();
        session()->flash('success', __('message.success'));
        return redirect()->route('certifications.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (!(Gate::denies('isAdmin') && Gate::denies('isDM'))) {
            Certification::find($request->id)->delete();
            session()->flash('success', __('message.success'));
            return redirect()->route('certifications.index');
        }
        session()->flash('failed', __('message.permission'));
        return redirect()->route('certifications.index');
    }
    public function loadUserFormAdd(User $user)
    {
        if ((Gate::allows('isAdmin') || Gate::allows('isDM'))) {
            return view('admin.pages.certification.userAddCert', [
                'tittle' => "Add Certification For User",
                'user' => $user,
                'certifications' => Certification::all()
            ]);
        }
        session()->flash('failed', __('message.permission'));
        return redirect()->route('users.show', $user->id);
    }
    public function addCertificationForUser(Request $request)
    {
        if ($request->certification_id) {
            if (User::find($request->user_id)->certifications()->where('id', $request->certification_id)->exists()) {
                session()->flash('success', __('message.exists'));
                return redirect()->route('certifications.addUser', $request->user_id);
            } else {
                CertificationUser::create($request->all());
                session()->flash('success', __('message.success'));
                return redirect()->route('users.show', $request->user_id);
            }
        }
        session()->flash('failed', __('message.missing_data'));
        return redirect()->route('certifications.addUser', $request->user_id);
    }
}
