@if ($isShow) <!-- !isset($hideShow), !isset($hideEdit) ||, !isset($hideDelete) ||   -->
@if(isset($modalShow))
<button type="button" class="btn btn-sm btn-clean btn-icon btn-hover-primary order-modal" data-id="{{$id ?: $item->id}}" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-eye"></i></button>
@else
<a href="{{route($route.'show',$id??$item->id)}}" class="btn btn-sm btn-clean btn-icon btn-hover-primary"><i class="fa fa-eye"></i></a>
@endif
@endif

@if ($isEdit)
<a href="{{route($route.'edit',$id??$item->id)}}" class="btn btn-sm btn-clean btn-icon btn-hover-info"><i class="fa fa-pencil-alt"></i></a>
@endif

@if (isset($showReceipt))
<a href="{{route('receipt.index',$id??$item->id)}}" target="_blank" class="btn btn-sm btn-clean btn-icon btn-hover-info"><i class="fa fa-receipt"></i></a>
@endif


@if ($isDelete)
<form id="delete-form" class="d-inline" action="{{ route($route.'destroy',$id??$item->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <input type="hidden" name="revert" value="no">
    <button class="btn btn-sm btn-clean btn-icon btn-hover-danger delete-btn offerTrashBtn"><i class="fa fa-trash"></i></button>
</form>
@endif
@foreach($actions??[] as $action)
{!! $action !!}
@endforeach








{{-- <div class="container" style="display:flex">


    <div class="row">
     
        <div class="col-4 m-1">
            <a href="{{ route('appointments.show', $id) }}" class="show btn btn-primary btn-sm">
<i class="fas fa-eye"></i></a>

</div>

<div class="col-4 m-1">
    <a href="{{ route('appointments.edit', $id) }}" class="edit btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
</div>

@if (!isset($hideDelete))
<div class="col-4 m-1">

    <form action="{{ route('appointments.destroy', $id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button class="delete btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i></button>

    </form>

</div>
@endif





</div> --}}