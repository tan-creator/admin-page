@extends('admin.layouts.master')
@section('tittle')
{{$tittle}}
@endsection

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{ __('layout_master.certifications') }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">{{ __('layout_master.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('layout_master.detail') }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section profile">
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="detail_update-btn">
                        <a type="button" href="{{route('certifications.edit',$certification->id)}}"
                            class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h4 class="bottom text_center">{{ __('layout_certification.detail') }}</h4>
                                <h3 class="bottom text_center" style="font-weight: bold;">{{ $certification->name}}</h3>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">ID</div>
                                    <div class="col-lg-9 col-md-8">{{ $certification->id }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">{{ __('layout_certification.name') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $certification->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">{{ __('layout_certification.granted') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $certification->granted }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">{{ __('layout_certification.note') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $certification->note }}</div>
                                </div>
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column">
                        <div style="display: flex">
                            <h4 class="bottom text_center" style="font-weight: bold;">
                                {{ __('layout_certification.list_user') }}
                            </h4>
                        </div>
                        <ul class="list-group list-group-flush align-items-center">
                            @forelse($users as $user)
                            <li class="list-group-item">
                                <a href="{{route('users.show',$user->id)}}">{{$user->fullname}}</a>
                            </li>
                            @empty
                            <li class="list-group-item">{{ __('layout_certification.no_member') }}</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <div>
        <a href="{{route('certifications.index')}}"
            class="btn btn-outline-dark float-right">{{ __('layout_master.back') }}</a>
    </div>
</main>
@endsection
