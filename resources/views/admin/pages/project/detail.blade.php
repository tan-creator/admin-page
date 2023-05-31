@extends('admin.layouts.master')
@section('tittle')
{{ $tittle }}
@endsection

@section('content')
<main id="main" class="main">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif (session('failed'))
    <div class="alert alert-danger">
        {{ session('failed') }}
    </div>
    @endif
    <div class="pagetitle">
        <h1>{{ $tittle }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="\dashboard">{{ __('layout_master.home') }}</a></li>
                <li class="breadcrumb-item active"><a href="{{route('projects.index')}}">{{ __('layout_master.projects') }}</a></li>
                <li class="breadcrumb-item active">{{ __('layout_master.detail') }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif (session('failed'))
    <div class="alert alert-danger">
        {{ session('failed') }}
    </div>
    @elseif (session('closed'))
    <div class="alert alert-danger">
        {{ session('closed') }}
    </div>
    @endif

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column">
                        <div style="display: flex">
                            <h5 class="">{{ __('layout_project.list_user') }}</h5>
                            <a class="btn btn-primary" href="{{ route('project.add-user', ['project' => $project->id]) }}" style="margin-left: 60px; margin-top: -5px">{{ __('layout_project.add_user') }}</a>
                        </div>

                        <ul class="list-group list-group-flush align-items-center">
                            @forelse($users as $user)
                            <li class="list-group-item">
                                <a href="{{route('users.show',$user->id)}}">{{$user->fullname}}</a>
                            </li>
                            @empty
                            <li class="list-group-item">{{ __('layout_project.no_member') }}</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="detail_update-btn">
                        <a type="button" href="{{route('projects.edit',$project->id)}}" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="user_detail-tittle">{{ __('layout_project.detail') }}</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">{{ __('layout_project.name') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $project->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">{{ __('layout_project.customer_name') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $project->customer_name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('layout_project.type') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $project->types }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('layout_project.status') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $project->status }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('layout_project.date_begin') }}</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ date_format(date_create($project->begin_date), 'd-m-Y') }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('layout_project.date_finish') }}</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ date_format(date_create($project->finish_date), 'd-m-Y') }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('layout_project.note') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $project->note }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('layout_project.man_month') }}</div>
                                    <div class="col-lg-9 col-md-8"> {{ $project->mm  }} </div>
                                </div>

                            </div>
                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection
