@extends('admin.layouts.master')
@section('tittle')
    {{ $tittle }}
@endsection

@section('content')
    <main id="main" class="main">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                {{ session('success') }}
                {{ session()->forget('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="pagetitle">
            <h1>{{ __('layout_user.profile_detail') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="\dashboard">{{ __('layout_master.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('layout_master.users') }}</li>
                    <li class="breadcrumb-item active">{{ $tittle }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <div class="mb-2">
                                <span class="badge rounded-pill bg-warning text-dark">{{ $user->levels }}</span>
                                <span class="badge rounded-pill bg-primary">{{ $user->roles }}</span>
                                @switch($user->status)
                                    @case('Left')
                                        <span class="badge rounded-pill bg-danger">Left</span>
                                    @break

                                    @case('Inactive')
                                        <span class="badge rounded-pill bg-secondary">Inactive</span>
                                    @break

                                    @case('Active')
                                        <span class="badge rounded-pill bg-success">Active</span>

                                        @default
                                            <span class="badge rounded-pill bg-success"></span>
                                    @endswitch
                                </div>
                                <img src="{{ Vite::asset('resources/assets/img/profile-img.jpg') }}" alt="Profile"
                                    class="rounded-circle">
                                <h2>{{ $user->fullname }}</h2>
                                <h3>{{ $user->types }}</h3>
                            </div>
                        </div>
                        <div class="bottom">
                            <a class="btn btn-success"
                                href="{{ route('certifications.addUser', $user) }}">{{ __('layout_user.add_certification') }}</i></a>
                        </div>
                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <h5 class="user_detail-tittle">{{ __('layout_user.list_certification') }}</h5>
                                <ul class="list-group list-group-flush">
                                    @forelse($certifications as $certification)
                                        <li class="list-group-item">{{ $certification->name }}</li>
                                    @empty
                                        <li class="list-group-item">{{ __('layout_user.none_certification') }}</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="detail_update-btn">
                                <a type="button" href="#" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                        <h5 class="user_detail-tittle">{{ __('layout_user.profile_detail') }}</h5>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">{{ __('layout_user.name') }}</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->fullname }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{ __('layout_user.code') }}</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->code }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{ __('layout_master.departments') }}</div>
                                            <div class="col-lg-9 col-md-8">{{ $department }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{ __('layout_user.birthday') }}</div>
                                            <div class="col-lg-9 col-md-8">
                                                {{ date_format(date_create($user->day_of_birth), 'd-m-Y') }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{ __('layout_user.address') }}</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->address }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{ __('layout_user.phone') }}</div>
                                            <div class="col-lg-9 col-md-8">({{ $user->area_code }}) {{ $user->phone_number }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Email</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{ __('layout_user.note') }}</div>
                                            <div class="col-lg-9 col-md-8 text_justify">{{ $user->note }}</div>
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
