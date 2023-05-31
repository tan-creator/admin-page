@extends('admin.layouts.master')
@section('tittle')
    {{$tittle}}
@endsection

@section('content')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ __('layout_master.departments') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('layout_master.home') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('departments.index') }}">{{ __('layout_master.departments') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('departments.show', ['department' => $department->id]) }}">{{ $department->name }}</a></li>
                    <li class="breadcrumb-item active">{{ __('layout_department.add_user') }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <span style="color: rgb(240, 165, 25)">{{ session('warn_msg') }}</span>

        <section class="section dashboard">
            <div class="col-xxl-4 col-xl-12">
                <div class="card info-card customers-card">

                    <div class="card-body">
                        <h5 class="card-title">{{ __('layout_master.departments') }}</h5>
                    </div>

                    <form method="post" class="row g-3" style="padding:20px;">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('layout_master.select') }}</label>
                            <div class="col-sm-10">
                                <select name="user_id" class="form-select" aria-label="Default select example">
                                    <option value="" selected>{{ __('layout_department.select_one') }}</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="department" value="{{ $department->id }}">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">{{ __('layout_master.submit') }}</button>
                        </div>
                    </form><!-- End No Labels Form -->

                </div>
            </div>
        </section>
    </main>
@endsection
