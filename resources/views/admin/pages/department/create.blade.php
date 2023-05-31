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
                    <li class="breadcrumb-item active">{{ __('layout_master.create') }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="col-xxl-4 col-xl-12">
                <div class="card info-card customers-card">

                    <div class="card-body">
                        <h5 class="card-title">{{ __('layout_department.add') }}</h5>
                    </div>

                    <form method="post" class="row g-3" style="padding:20px;">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingEmail" placeholder="Code" 
                                name="code" value="{{ old('code') }}">
                                <label for="floatingEmail">Code</label>
                            </div>
                            @error('code')
                                <div class="invalidate">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingPassword" placeholder="Name" 
                                name="name" value="{{ old('name') }}">
                                <label for="floatingPassword">Name</label>
                            </div>
                            @error('name')
                                <div class="invalidate">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Note" id="floatingTextarea" 
                                style="height: 100px;" name="note">{{ old('note') }}</textarea>
                                <label for="floatingTextarea">Note</label>
                            </div>
                        </div>
                        @error('note')
                            <div class="invalidate">{{ $message }}</div>
                        @enderror
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">{{ __('layout_master.submit') }}</button>
                        </div>
                    </form><!-- End No Labels Form -->

                </div>
            </div>
        </section>
    </main>
@endsection
