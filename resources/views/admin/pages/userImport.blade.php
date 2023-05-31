@extends('admin.layouts.master')
@section('tittle')
    {{ $tittle }}
@endsection

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ __('layout_master.users') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="\dashboard">{{ __('layout_master.home') }}</a></li>
                        <li class="breadcrumb-item active"><a href="\users">{{ __('layout_master.users') }}</a> / {{ $page }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="col-xxl-4 col-md-12">
                <div class="card info-card">
                    <div class="filter">
                        <form action="{{ route('users.template') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-success me-3">
                                <i class="bi bi-download me-1"></i>
                                {{ __('layout_master.csv_template') }}
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ __('layout_master.users') }} <span>| {{ __('layout_master.csv_import') }}</span></h5>
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <input type="file" class="form-control" id="inputGroupFile04"
                                    aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="file"
                                    value="{{ old('file') }}">
                                <button class="btn btn-outline-primary" type="submit" id="inputGroupFileAddon04">
                                    <i class="bi bi-upload"></i>
                                    {{ __('layout_master.upload') }}
                                </button>
                            </div>
                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if(Session::has('failures'))
                                @foreach (Session::get('failures') as $failure)
                                    <div class="invalidate">{{ $failure->errors()[0] }}.</div>
                                @endforeach
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
