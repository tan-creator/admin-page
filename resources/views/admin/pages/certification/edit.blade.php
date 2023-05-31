@extends('admin.layouts.master')
@section('tittle')
{{$tittle}}
@endsection

@section('content')
<main id="main" class="main">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach
        </ul>
    </div>
    @endif
    <div class="pagetitle">
        <h1>{{ __('layout_master.certifications') }} </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">{{ __('layout_master.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('layout_master.update') }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="div_box">
        <h2 class="bottom text_center">{{ __('layout_certification.edit') }}</h2>
        <form action="/certifications/{{$certification->id}}" method="post">
            @method('PATCH')
            <div class="form-group">
                <label class="bottom">{{ __('layout_certification.name') }}</label>
                <input name="name" type="text" class="form-control" value="{{$certification->name}}">
            </div>
            <div class="form-group">
                <label class="bottom">{{ __('layout_certification.note') }}</label>
                <input name="note" type="text" class="form-control" value="{{$certification->note}}">
            </div>
            <div class="form-group">
                <label class="bottom">{{ __('layout_certification.granted') }}</label>
                <input name="granted" type="text" class="form-control" value="{{$certification->granted}}">
            </div>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div>
                <button type="submit" class="btn btn-primary bottom" style="margin: 10px; margin-left:200px">{{ __('layout_master.submit') }}</button>
            </div>
        </form>
    </div>
</main>
@endsection
