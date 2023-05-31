@extends('admin.layouts.master')
@section('tittle')
{{ $tittle }}
@endsection

@section('content')
<main id="main" class="main">
    @if (session('failed'))
    <div class="alert alert-danger">
        {{ session('failed') }}
    </div>
    @endif
    <div class="pagetitle">
        <h1>{{ __('layout_master.my_profile') }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="\dashboard">{{ __('layout_master.home') }}</a></li>
                <li class="breadcrumb-item active"><a href="\users">{{ __('layout_master.users') }}</a></li>
                <li class="breadcrumb-item active">{{ $tittle }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="div_box">
        <h2 class="bottom text_center">{{ __('layout_certification.add_user') }}</h2>
        <form action="" method="post">
            <div class="form-group">
                <label class="bottom">{{ __('layout_user.name') }}</label>
                <input class="form-control" value="{{$user->fullname}}" readonly>
            </div>
            <div class="form-group">
                <label class="bottom">{{ __('layout_user.code') }}</label>
                <input class="form-control" value="{{$user->code}}" readonly>
            </div>
            <div class="form-group">
                <label class="bottom">{{ __('layout_certification.select') }}</label>
                <select require name="certification_id" id="certification_id" class="form-select"
                    aria-label="Default select example">
                    <option selected value="0">{{ __('layout_certification.list') }}</option>
                    @foreach($certifications as $key => $certification)
                    <option value="{{$certification->id}}">{{$certification->name}}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="user_id" value="{{$user->id}}">

            <div>
                <button type="submit" class="btn btn-primary bottom"
                    style="margin: 10px; margin-left:200px">{{ __('layout_master.submit') }}</button>
            </div>
        </form>
    </div>
</main>
@endsection
