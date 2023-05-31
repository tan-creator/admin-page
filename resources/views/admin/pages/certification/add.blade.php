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
                <li class="breadcrumb-item active">{{ __('layout_certification.add') }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="div_box">
        <h2 class="bottom text_center">{{ __('layout_certification.add') }}</h2>
        <form action="{{route('certifications.index')}}" method="post">
            <div class="form-group">
                <label class="bottom">{{ __('layout_certification.name') }}</label>
                <input name="name" type="text" class="form-control" placeholder="Enter name certification">
            </div>
            <div class="form-group">
                <label class="bottom">{{ __('layout_certification.note') }}</label>
                <input name="note" type="text" class="form-control" placeholder="Enter note for certification">
            </div>
            <div class="form-group">
                <label class="bottom">{{ __('layout_certification.granted') }}</label>
                <input name="granted" type="text" class="form-control" placeholder="Enter granted of certification">
            </div>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div>
                <button type="submit" class="btn btn-primary bottom"
                    style="margin: 10px; margin-left:200px">{{ __('layout_master.submit') }}</button>
            </div>
        </form>
    </div>
</main>
@endsection
