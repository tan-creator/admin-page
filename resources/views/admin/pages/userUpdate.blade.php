@extends('admin.layouts.master')
@section('tittle')
    {{ $tittle }}
@endsection

@section('content')
    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="post">
        @csrf
        @method('PUT')
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>{{ __('layout_master.update') }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="\dashboard">{{ __('layout_master.home') }}</a></li>
                        <li class="breadcrumb-item active"><a href="\users">{{ __('layout_master.users') }}</a> / {{ __('layout_master.update') }}</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section dashboard">
                <div class="col-xxl-4 col-md-12">
                    <div class="card info-card">
                        <div class="filter d-flex">
                            <div class="d-flex justify-content-end me-3">
                                <a href="\users" class="btn btn-secondary user_form-btn">{{ __('layout_master.back') }}</a>
                            </div>
                            <div class="d-flex justify-content-end me-3">
                                <button type="submit" class="btn btn-primary user_form-btn">{{ __('layout_master.update') }}</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ __('layout_master.users') }} <span>| {{ __('layout_master.update') }}</span></h5>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="email"
                                        placeholder="Ex: Example@gmail.com"
                                        value="@if (old('email')) {{ old('email') }}@elseif (isset($user)){{ $user->email }}@endif">
                                    @error('email')
                                        <div class="invalidate">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 {{ $isMyDetail }}">
                                <label for="inputPassword" class="col-sm-2 col-form-label">{{ __('layout_user.password') }}</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                    @error('password')
                                        <div class="invalidate">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">{{ __('layout_user.name') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="fullname"
                                        placeholder="Ex: Nguyễn Văn A"
                                        value="@if (old('fullname')) {{ old('fullname') }}@else{{ $user->fullname }}@endif">
                                    @error('fullname')
                                        <div class="invalidate">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">{{ __('layout_user.phone') }}</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <select class="form-select area_code-input" aria-label="Default select example"
                                            name="area_code">
                                            <option value="{{ $user->area_code }}" selected>{{ $user->area_code }}</option>
                                            <option value="+84">+84</option>
                                            <option value="+1">+1</option>
                                            <option value="+7">+7</option>
                                            <option value="+49">+49</option>
                                            <option value="+81">+81</option>
                                        </select>
                                        <input type="text" class="form-control phone_input" name="phone_number"
                                            placeholder="Ex: 123456789"
                                            value="@if (old('phone_number')) {{ old('phone_number') }}@else{{ $user->phone_number }}@endif">
                                    </div>
                                    @error('area_code')
                                        <div class="invalidate">{{ $message }}</div>
                                    @enderror
                                    @error('phone_number')
                                        <div class="invalidate">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">{{ __('layout_user.birthday') }}</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="day_of_birth"
                                        value="{{ $user->day_of_birth }}">
                                    @error('day_of_birth')
                                        <div class="invalidate">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">{{ __('layout_user.address') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="address"
                                        placeholder="Ex: 01 Nguyễn Văn Linh, P Hòa Cường Bắc, TP Đà Nẵng"
                                        value="@if (old('address')) {{ old('address') }}@else{{ $user->address }}@endif">
                                    @error('address')
                                        <div class="invalidate">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10 row">
                                    <div class="col-sm-4">
                                        <label for="inputNumber" class="col-form-label">{{ __('layout_user.code') }}</label>
                                        <div class="">
                                            <input type="number" class="form-control" placeholder="Ex: 12"
                                                value="@if (old('code')){{ old('code') }}@else{{ $user->code }}@endif"
                                                name="code">
                                            @error('code')
                                                <div class="invalidate">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="col-form-label">{{ __('layout_master.departments') }}</label>
                                        <select class="form-select" name="department_id"
                                            aria-label="Default select example">
                                            <option value="{{ $myDepartment['id'] }}" selected>{{ $myDepartment['name'] }}</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <div class="invalidate">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="col-form-label">{{ __('layout_user.roles') }}</label>
                                        <select class="form-select" name="roles" aria-label="Default select example">
                                            <option value="{{ $user->roles }}" selected>{{ $user->roles }}</option>
                                            <option value="Admin">Admin</option>
                                            <option value="DM">DM</option>
                                            <option value="Members">Members</option>
                                            <option value="PM">PM</option>
                                            <option value="Sub-DM">Sub-DM</option>
                                            <option value="TL">TL</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        @error('roles')
                                            <div class="invalidate">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10 row">
                                    <div class="col-sm-4">
                                        <label class="col-form-label">{{ __('layout_user.level') }}</label>
                                        <select class="form-select" name="levels" aria-label="Default select example">
                                            <option value="{{ $user->levels }}" selected>{{ $user->levels }}</option>
                                            <option value="Level 1">Level 1</option>
                                            <option value="Level 2">Level 2</option>
                                            <option value="Level 3">Level 3</option>
                                            <option value="Level 4">Level 4</option>
                                            <option value="Level 5">Level 5</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        @error('levels')
                                            <div class="invalidate">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="col-form-label">{{ __('layout_user.status') }}</label>
                                        <select class="form-select" name="status" aria-label="Default select example">
                                            <option value="{{ $user->status }}" selected>{{ $user->status }}</option>
                                            <option value="Inactive">Inactive</option>
                                            <option value="Active">Active</option>
                                            <option value="Left">Left</option>
                                        </select>
                                        @error('status')
                                            <div class="invalidate">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="col-sm-10 col-form-label">{{ __('layout_user.type') }}</label>
                                        <select class="form-select" name="types" aria-label="Default select example">
                                            <option value="{{ $user->types }}" selected>{{ $user->types }}</option>
                                            <option value="Onsite">Onsite</option>
                                            <option value="Intern">Intern</option>
                                            <option value="Fresher">Fresher</option>
                                            <option value="Apprenticeship">Apprenticeship</option>
                                            <option value="Probationary">Probationary</option>
                                            <option value="Official">Official</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        @error('types')
                                            <div class="invalidate">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">{{ __('layout_user.note') }}</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control h-100px" name="note">
                                        @if (old('note'))
                                            {{ old('note') }}
                                        @else
                                            {{ $user->notes }}
                                        @endif
                                    </textarea>
                                    @error('note')
                                        <div class="invalidate">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </form>
@endsection