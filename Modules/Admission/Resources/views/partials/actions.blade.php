
{{--@if (Auth::user()->can('user_edit'))--}}
    <a href="{{ route('user.edit', $item->id) }}" class="btn btn-icon btn-primary" data-bs-toggle="tooltip"
       data-bs-original-title="{{ trans('kamruldashboard::users.view_user_profile') }}"><i class="fa fa-eye"></i></a>
{{--@endif--}}

{{--<a data-fancybox data-type="ajax" data-src="{{ route('simple-slider-item.edit', $item->id) }}" href="javascript:;"--}}
{{--   class="btn btn-info"><i class="fa fa-edit"></i> </a>--}}
{{--<a data-fancybox data-type="ajax" data-src="{{ route('simple-slider-item.destroy', $item->id) }}" href="javascript:;"--}}
{{--   class="btn btn-danger"><i class="fa fa-trash"></i> {{ trans('kamruldashboard::tables.delete_entry') }}</a>--}}
