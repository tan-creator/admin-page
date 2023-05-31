@extends('admin.layouts.master')
@section('tittle')
    {{$tittle}}
@endsection

@section('content')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ __('layout_master.projects') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('layout_master.home') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('projects.index') }}">{{ __('layout_master.projects') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('projects.show', ['project' => $project->id]) }}">{{ $project->name }}</a></li>
                    <li class="breadcrumb-item active">{{ __('layout_project.add_user') }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @elseif (session('exists'))
        <div class="alert alert-danger">
            {{ session('exists') }}
        </div>
        @endif

        <section class="section dashboard">
            <div class="col-xxl-4 col-xl-12">
                <div class="card info-card customers-card">

                    <div class="card-body">
                        <h5 class="card-title">{{ __('layout_master.projects') }}</h5>
                    </div>

                    <form method="post" class="row g-3" style="padding:20px;">
                        @csrf
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">{{ __('layout_user.code') }}</th>
                                    <th scope="col">{{ __('layout_user.name') }}</th>
                                    <th scope="col">{{ __('layout_user.role') }}</th>
                                    <th scope="col">{{ __('layout_user.type') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="user_{{ $user->id }}" value="{{ $user->id }}">
                                            </div>
                                        </th>
                                        <td>
                                            {{ $user->code }}
                                        </td>
                                        <td>
                                            {{ $user->fullname }}
                                        </td>
                                        <td>
                                            {{ $user->roles }}
                                        </td>
                                        <td>
                                            {{ $user->types }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->render() }}
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">{{ __('layout_master.submit') }}</button>
                        </div>
                    </form><!-- End No Labels Form -->

                </div>
            </div>
        </section>
    </main>
@endsection
