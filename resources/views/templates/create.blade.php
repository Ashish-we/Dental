@extends('adminlte::page')

@section('title', 'Add ' . $title)


@section('css')
<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
{{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('css')
@stack('styles')
@stop

@section('content')
@yield('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Create {{ $title }}</h3>

                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form repeater" id="form" name="myForm" action="{{ route($route . 'store') }}" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                            @endforeach
                            @endif
                            <input name="add_more" type="hidden" id="add-more" value="{{ false }}">
                            @yield('form_content')

                        </div>
                        <div class="card-footer">
                            <button type="submit" id="button_submit" class="button_submit btn btn-primary">Submit
                            </button>
                            @if (isset($addMoreButton))
                            <button type="submit" id="button_submit_add" class="button_submit btn btn-primary">
                                Submit & Add new
                            </button>
                            @endif
                            <a href="javascript:history.back();" class="btn btn-default float-right">Cancel</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->

            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection


{{-- <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> --}}

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/jquery.validate.min.js"></script>

<script>
    function capitalInput(input) {
        var words = input.value.split(' ');
        for (var i = 0; i < words.length; i++) {
            var innerWords = words[i].split(/(['"])/);
            for (var j = 0; j < innerWords.length; j++) {
                if (innerWords[j] !== "'" && innerWords[j] !== '"') {
                    innerWords[j] = innerWords[j].charAt(0).toUpperCase() + innerWords[j].substring(1);
                }
            }
            words[i] = innerWords.join("");
        }
        input.value = words.join(' ');
    }
</script>
@section('js')


@stack('scripts')

@endsection