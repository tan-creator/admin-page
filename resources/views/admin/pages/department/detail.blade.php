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
                    <li class="breadcrumb-item active">{{ $department->name }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <span style="color: red;">{{ session('auth_msg') }}</span>

        <section class="section dashboard">
            <div class="col-xxl-4 col-xl-12">

                <div class="card info-card customers-card">

                    <div class="card-body">
                        <h5 class="card-title">{{ $department->name }}<span> | {{ __('layout_master.this_year') }}</span></h5>

                        <div class="filter">
                            <span style="font-size: 15px; margin-right: 15px; color: blue">
                                {{ __('layout_department.code') }} : {{ $department->code}}
                            </span>
                        </div>
                        <a  href="{{ route('departments.add-user', ['department' => $department->id]) }}" style="float:right" class="btn btn-primary">
                            {{ __('layout_department.add_user') }}
                        </a>
                        <span style="color: rgb(12, 175, 204)">{{ session('success_msg') }}</span>

                        <p style="font-size: 15px;">{{ __('layout_department.note') }} : {{ $department->note}}</p>
                        <span style="font-size: 15px;">{{ __('layout_master.member') }}</span>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('layout_user.code') }}</th>
                                    <th scope="col">{{ __('layout_user.name') }}</th>
                                    <th scope="col">{{ __('layout_user.role') }}</th>
                                    <th scope="col">{{ __('layout_user.type') }}</th>
                                    <th scope="col">{{ __('layout_user.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>
                                            {{ $user->code }}
                                        </td>
                                        <td>
                                            <a style="display:flex;" href="{{ route('users.show', ['user' => $user->id]) }}">
                                                {{ $user->fullname }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $user->roles }}
                                        </td>
                                        <td>
                                            {{ $user->types }}
                                        </td>
                                        <td>
                                            @if($user->status == "Left")
                                                <span class="badge rounded-pill bg-danger">{{ $user->status }}</span>
                                            @else
                                                @if($user->status == "Active")
                                                    <span class="badge rounded-pill bg-success">{{ $user->status }}</span>
                                                @else
                                                    <span class="badge rounded-pill bg-warning text-dark">{{ $user->status }}</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->render() }}
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
