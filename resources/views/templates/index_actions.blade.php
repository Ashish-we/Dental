@if ($isShow)
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