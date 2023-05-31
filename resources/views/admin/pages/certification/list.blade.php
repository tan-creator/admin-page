@extends('admin.layouts.master')
@section('tittle')
{{$tittle}}
@endsection

@section('content')
<main id="main" class="main">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif (session('failed'))
    <div class="alert alert-danger">
        {{ session('failed') }}
    </div>
    @endif
    <div class="pagetitle">
        <h1>{{ __('layout_master.certifications') }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">{{ __('layout_master.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('layout_certification.list') }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div>
        <a href="{{route('certifications.create')}}" class="add_cer"><i class="bi bi-plus-square"></i></a>
    </div>
    <div>
        <h2 class="bottom text_center"> {{ __('layout_certification.list') }}</h2>

        <table class="table table-bordered text_center">
            <thead>
                <tr>
                    <th scope="col" class="width10">#</th>
                    <th scope="col">{{ __('layout_certification.name') }}</th>
                    <th scope="col">{{ __('layout_certification.note') }}</th>
                    <th scope="col" class="width10">{{ __('layout_master.detail') }}</th>
                    <th scope="col" class="width10">{{ __('layout_master.update') }}</th>
                    <th scope="col" class="width10">{{ __('layout_master.delete') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($certifications as $key => $certification)
                <tr>
                    <th scope="row">{{ $loop->index }}</th>

                    <td> {{ $certification->name }} </td>

                    <td>{{ $certification->note }}</td>

                    <td>
                        <a class="btn btn-success" href="{{ route('certifications.show', $certification->id) }}"><i
                                class="bi bi-eye"></i></a>
                    </td>

                    <td>
                        <a class="btn btn-success" href="{{ route('certifications.edit', $certification->id) }}"><i
                                class="bi bi-pencil"></i></a>
                    </td>
                    <td>
                        <button class="btn btn-danger" id="btndelete" onclick="submit('{{$certification->id}}')">
                            <i class="bi bi-trash"></i></button>
                        <form action="/certifications" method="POST" id="form">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" id='id'>
                        </form>
                    </td>
                </tr>
                @endforeach
                {{$certifications->links()}}
            </tbody>
        </table>
    </div>
</main>
@endsection
<script>
function submit(id) {
    if (confirm("{{ __('layout_certification.delete') }}")) {
        document.getElementById('id').value = id;
        document.getElementById('form').submit();
    } else {
        location.reload();
    }
}
</script>
