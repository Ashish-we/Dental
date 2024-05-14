@extends('adminlte::page')


@section('title', 'Edit '.$title)


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit {{$title}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form repeater" id="form" action="{{route($route.'update',$item->id)}}" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            @method('PUT')
                            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{$error}}
                            </div>
                            @endforeach
                            @endif
                            @yield('form_content')

                        </div>

                        <div class="card-footer">
                            <button type="submit" id="button_submit" class="btn btn-primary">Submit</button>
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

@section('css')
@stack('styles')
@stop
@section('js')
@yield('ext_js')
@stack('scripts')
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

{{-- <script>
        jQuery(document).ready(function () {
            $('#summernote').summernote({
                height: 400,
                callbacks: {
                    onImageUpload: function (files) {
                        for (let i = 0; i < files.length; i++) {
                            $.upload(files[i]);
                        }
                    },
                    onMediaDelete: function (target) {
                        const src = $(target[0]).attr('src');
                        const imageId = $(target[0]).attr('data-id');

                        deleteFile(imageId);
                    }
                },
            });
            $('#summernote1').summernote({
                height: 400,
                callbacks: {
                    onImageUpload: function (files) {
                        for (let i = 0; i < files.length; i++) {
                            $.upload(files[i]);
                        }
                    },
                    onMediaDelete: function (target) {
                        const src = $(target[0]).attr('src');
                        const imageId = $(target[0]).attr('data-id');

                        deleteFile(imageId);
                    }
                },
            });

            $.upload = function (file) {
                let out = new FormData();
                out.append("_token", "{{ csrf_token() }}")
out.append('file', file, file.name);

$.ajax({
headers: {
"X-CSRFToken": '{{csrf_field()}}'
},
method: 'POST',
url: '{{route('uploader.store')}}',
contentType: false,
cache: false,
processData: false,
data: out,
success: function (data) {
if (data['status']) {
var url = data['data']['url'];
var id = data['data']['id'];

$('#summernote').summernote('insertImage', url, function ($image) {
$image.attr('data-id', id);
});
} else {
showFailedMessage()
}
},
error: function (jqXHR, textStatus, errorThrown) {
console.error(textStatus + " " + errorThrown);
showFailedMessage()
}
});
}

function deleteFile(id) {
var url = '{{ route('uploader.destroy', ":id") }}';
url = url.replace(':id', id);

$.ajax({
method: 'POST',
dataType: 'JSON',
url: url,
data: {
'id': id,
'_token': '{{ csrf_token() }}',
'_method': 'DELETE',
},
success: function (data) {

},

error: function (jqXHR, textStatus, errorThrown) {
showFailedMessage()
}
});
}
});

</script> --}}
@endsection