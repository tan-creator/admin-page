@extends('admin.layouts.master')
@section('tittle')
    {{ $tittle }}
@endsection

@section('content')
    <main id="main" class="main">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                {{session('success')}}
                {{session()->forget('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-1"></i>
                {{session('warning')}}
                {{session()->forget('warning')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="pagetitle">
            <h1>{{ __('layout_master.users') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="\dashboard">{{ __('layout_master.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('layout_master.users') }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="col-xxl-4 col-md-12">
                <div class="card info-card revenue-card">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>{{ __('layout_user.controller') }}</h6>
                            </li>

                            <li><a class="dropdown-item"
                                    href="{{ route('users.create') }}">{{ __('layout_user.add_user') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('users.import') }}">Import csv</a></li>
                            <li><a class="dropdown-item" href="{{ route('users.export') }}">Export csv</a></li>
                        </ul>
                    </div>

                    <form action="{{ route('users.deletes') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="card-body">
                            <h5 class="card-title">{{ __('layout_master.users') }} <span>|
                                    {{ __('layout_user.list') }}</span></h5>
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                            <div class="d-flex align-items-center">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">#</th>
                                            <th scope="col">{{ __('layout_user.code') }}</th>
                                            <th scope="col">{{ __('layout_user.name') }}</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input id="{{ $user->id }}" class="form-check-input user-check" type="checkbox"
                                                            name="{{ $user->id }}" id="flexCheckDefault">
                                                    </div>
                                                </th>
                                                <th scope="row">{{ ++$key }}</th>
                                                <td>{{ $user->code }}</td>
                                                <td>{{ $user->fullname }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>({{ $user->area_code }}){{ $user->phone_number }}</td>
                                                <td style="width: 176px;">
                                                    <a class="btn btn-outline-info user_list_btn"
                                                        href="{{ route('users.show', ['user' => $user->id]) }}">
                                                        <i class="bi bi-person-vcard"></i>
                                                    </a>
                                                    <a class="btn btn-outline-success user_list_btn"
                                                        href="{{ route('users.edit', ['user' => $user->id]) }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-outline-danger user_list_btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal{{ $user->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <form action="{{ route('users.destroy', ['user' => $user->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    {{ __('layout_user.remove') }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{ __('layout_user.remove_confirm') }}
                                                                <b>{{ $user->code }}</b>
                                                                {{ __('layout_user.name') }}
                                                                <b>{{ $user->fullname }}</b>
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
                            </div>
                            <div>
                                {{ $users->links() }}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
