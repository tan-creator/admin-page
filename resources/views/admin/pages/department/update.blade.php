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
                    <li class="breadcrumb-item active">{{ __('layout_master.update') }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="col-xxl-4 col-xl-12">
                <div class="card info-card customers-card">

                    <div class="card-body">
                        <h5 class="card-title">{{ __('layout_department.update') }} {{ $department->name }}</h5>
                    </div>

                    <form method="post" class="row g-3" style="padding:20px;">
                        @csrf
                        @method('PATCH')
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="code"
                            placeholder="Ex:1000" name="code"
                            value="{{ !empty(old('code')) ? old('code') : $department->code  }}">

                            @error('code')
                                <div class="invalidate">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <input type="text" id="name" name="name"
                            value="{{ !empty(old('name')) ? old('name') : $department->name  }}"
                            placeholder="Ex:Marketting" class="form-control">

                            @error('name')
                                <div class="invalidate">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <input type="text" class="form-control"
                            name="note" value="{{ !empty(old('note')) ? old('note') : $department->note }}"
                            placeholder="Note" style="padding-bottom: 100px">

                            @error('note')
                                <div class="invalidate">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">{{ __('layout_master.submit') }}</button>
                        </div>
                    </form><!-- End No Labels Form -->

                </div>
            </div>
        </section>
    </main>
@endsection
