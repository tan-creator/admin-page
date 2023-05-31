@extends('admin.layouts.master')
@section('tittle')
{{ $tittle }}
@endsection

@section('content')
<form method="post" action="/projects/{{$project->id}}">
    @csrf
    @method('PATCH')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ $tittle }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="\dashboard">{{ __('layout_master.home') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('projects.index')}}">{{ __('layout_master.projects') }}</a> / {{ __('layout_master.update') }}
                    </li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="col-xxl-4 col-md-12">
                <div class="card info-card">
                    <div class="filter d-flex">
                        <div class="d-flex justify-content-end me-3">
                            <a href="{{route('projects.index')}}" class="btn btn-secondary user_form-btn">{{ __('layout_master.back') }}</a>
                        </div>
                        <div class="d-flex justify-content-end me-3">
                            <button type="submit" class="btn btn-primary user_form-btn">{{ __('layout_master.update') }} </button>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('layout_master.projects') }} <span>|{{ __('layout_master.update') }}</span></h5>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">{{ __('layout_project.name') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="{{$project->name}}">
                                @error('name')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">{{ __('layout_project.customer_name') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="customer_name"
                                    value="{{$project->customer_name}}">
                                @error('customer_name')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">{{ __('layout_project.man_month') }}</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="mm" value="{{$project->mm}}"
                                    step="0.001">
                                @error('mm')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-10 row">
                            <div class="col-sm-6">
                                <label class="col-form-label">{{ __('layout_project.status') }}</label>
                                <select class="form-select" name="status" aria-label="Default select example">
                                    <option value="{{$project->status}}" selected>{{$project->status}}</option>
                                    <option value="On-going">Coming</option>
                                    <option value="On-going">On-going</option>
                                    <option value="Closed">Closed</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Other">Other</option>
                                </select>
                                @error('status')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label class="col-form-label">{{ __('layout_project.type') }}</label>
                                <select class="form-select" name="types" aria-label="Default select example">
                                    <option value="{{$project->types}}" selected>{{$project->types}}</option>
                                    <option value="Fixed Price">Fixed Price</option>
                                    <option value="Body Shopping">Body Shopping</option>
                                    <option value="Other">Other</option>
                                </select>
                                @error('types')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-10 row">
                            <div class="col-sm-6">
                                <label class="col-form-label">{{ __('layout_project.date_begin') }}</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="begin_date"
                                        value="{{date('Y-m-d', strtotime(str_replace('/', '-', $project->begin_date)))}}">
                                    @error('begin_date')
                                    <div class="invalidate">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label">{{ __('layout_project.date_finish') }}</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="finish_date"
                                        value="{{date('Y-m-d', strtotime(str_replace('/', '-', $project->finish_date)))}}">

                                    @error('finish_date')
                                    <div class="invalidate">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 10px;">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">{{ __('layout_project.note') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="note" placeholder="note"
                                        value="{{$project->note}}">
                                    @error('note')
                                    <div class="invalidate">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</form>
@endsection
