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
                    <li class="breadcrumb-item active">{{ __('layout_master.departments') }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="col-xxl-4 col-xl-12">
                <div class="card info-card customers-card">

                    <div class="card-body">
                        <h5 class="card-title">{{ __('layout_department.list') }} <span>| {{ __('layout_master.this_year') }}</span></h5>

                        <a href="{{ route('departments.create') }}" style="float: right; margin-top: -45px; font-size: 35px;">
                            <i class="bi bi-plus-square-fill"></i>
                        </a>
                        <span style="color: red;">{{ session('auth_msg') }}</span>
                        <span style="color: red;">{{ session('delete_msg') }}</span>
                        <span style="color: rgb(8, 207, 91);">{{ session('update_msg') }}</span>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('layout_department.code') }}</th>
                                    <th scope="col">{{ __('layout_department.name') }}</th>
                                    <th scope="col">{{ __('layout_master.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $key => $department)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>
                                            {{ $department->code }}
                                        </td>
                                        <td>
                                            <a  href="{{ route('departments.show', ['department' => $department->id]) }}">
                                                {{ $department->name }}
                                            </a>
                                        </td>
                                        <td style="width:210px; ">
                                            <a href="{{ route('departments.update', ['department' => $department->id]) }}" type="button" class="btn btn-success">{{ __('layout_master.update') }}</a>
                                            <button class="btn btn-danger" style="width:95px" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $department->id }}">
                                                {{ __('layout_master.delete') }}
                                            </button>
                                        </td>
                                    </tr>
                                    <form action="{{ route('departments.destroy', ['department' => $department->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal fade" id="exampleModal{{ $department->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('layout_master.remove') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ __('layout_department.delete') }} <b>{{ $department->code }}</b>
                                                        {{ __('layout_department.name') }}
                                                        <b>{{ $department->name }}</b>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit"
                                                            class="btn btn-danger w-100px">{{ __('layout_master.remove') }}</button>
                                                        <button type="button" class="btn btn-secondary w-100px"
                                                            data-bs-dismiss="modal">{{ __('layout_master.close') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $departments->links() }}
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
