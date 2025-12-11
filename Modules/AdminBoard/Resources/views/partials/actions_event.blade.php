{{--@if (Auth::user()->can('adminevent_show'))--}}
{{--    <a target="_blank" href="{{ route('adminevent_show', $item->id) }}" class="btn btn-icon btn-primary" data-bs-toggle="tooltip"--}}
{{--       data-bs-original-title="{{ trans('kamruldashboard::tables.view') }}"><i class="fa fa-eye"></i></a>--}}
{{--@endif--}}
@if (Auth::user()->can('adminevent_edit'))
    <a href="{{ route('adminevent.edit', $item->id) }}" class="btn btn-icon btn-sm btn-primary" data-bs-toggle="tooltip"
       data-bs-original-title="{{ trans('kamruldashboard::tables.edit') }}"><i class="fa fa-edit"></i></a>
@endif
@if (Auth::user()->can('adminevent_destroy'))
    <a href="#" class="btn btn-icon btn-sm btn-danger deleteDialog" data-bs-toggle="tooltip"
       data-section="{{ route('adminevent.destroy', $item->id) }}" role="button" data-bs-original-title="{{ trans('kamruldashboard::tables.delete_entry') }}" >
        <i class="fa fa-trash"></i>
    </a>
@endif
