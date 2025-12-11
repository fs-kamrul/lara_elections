
<!-- Footer Start -->
<footer class="bg-background-footer pt-100 ">
    <button type="button" data-te-ripple-init data-te-ripple-color="light"
            class="!fixed bottom-5 right-5 hidden rounded-full bg-primary-blue w-10 h-10 text-white text-2xl shadow-md transition duration-150 ease-in-out hover:bg-text-highlight hover:shadow-lg focus:bg-p-color focus:shadow-lg focus:outline-none focus:ring-0 active:bg-p-color active:shadow-lg"
            id="btn-back-to-top">
        <i class="ri-arrow-up-s-line"></i>
    </button>
    <div
        class="mx-auto xl:max-w-container lg:max-w-lg-container xs:max-w-xs-container md:max-w-md-container px-4 lg:px-0">
        <div class="mb-60 md:flex">
{{--            <div class="w-full md:w-2/6 lg:w-2/5">--}}
                {!! dynamic_sidebar('footer_sidebar') !!}
{{--            </div>--}}
            <div class="w-full justify-between md:flex md:w-4/6 lg:w-3/5">
                {!! dynamic_sidebar('product_sidebar') !!}
            </div>
        </div>
        <hr class="w-full bg-white" />
        <div class="py-4 md:py-6 lg:py-10 md:flex justify-between">
            {!! dynamic_sidebar('top_footer_sidebar') !!}
        </div>
{{--            {!! dynamic_sidebar('top_footer_sidebar') !!}--}}
{{--            {!! dynamic_sidebar('footer_sidebar') !!}--}}
            {{--            {!! Menus::renderMenuLocation('footer-menu', [--}}
            {{--                'view'    => 'menu_footer',--}}
            {{--                'status'    => 'nav-item nav-link',--}}
            {{--                'options' => ['class' => ''],--}}
            {{--            ]) !!}--}}
{{--            <p>{{ theme_option('copyright') }}</p>--}}
{{--            {!! dynamic_sidebar('top_footer_sidebar') !!}--}}
    </div>
</footer>
<!-- Footer End -->

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>--}}
{!! Theme::footer() !!}

{!! Theme::place('footer') !!}
<script>
    var KamrulVariables = KamrulVariables || {};

    @if (Auth::check())
        KamrulVariables.languages = {
        tables: {!! json_encode(trans('table::lang'), JSON_HEX_APOS) !!},
        notices_msg: {!! json_encode(trans('kamruldashboard::notices'), JSON_HEX_APOS) !!},
        pagination: {!! json_encode(trans('pagination'), JSON_HEX_APOS) !!},
        system: {
            'character_remain': '{{ trans('kamruldashboard::forms.character_remain') }}'
        },
    };
    KamrulVariables.authorized = "{{ setting('membership_authorization_at') && now()->diffInDays(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', setting('membership_authorization_at'))) <= 7 ? 1 : 0 }}";
    @else
        KamrulVariables.languages = {
        notices_msg: {!! json_encode(trans('kamruldashboard::notices'), JSON_HEX_APOS) !!},
    };
    @endif
</script>
@if (session()->has('success_msg') || session()->has('error_msg') || (isset($errors) && $errors->count() > 0) || isset($error_msg))
    <script type="text/javascript">
        $(document).ready(function () {
            @if (session()->has('success_msg'))
            kamruldashboard.showSuccess('{{ session('success_msg') }}');
            @endif
            @if (session()->has('error_msg'))
            kamruldashboard.showError('{{ session('error_msg') }}');
            @endif
            @if (isset($error_msg))
            kamruldashboard.showError('{{ $error_msg }}');
            @endif
            @if (isset($errors))
            @foreach ($errors->all() as $error)
            kamruldashboard.showError('{{ $error }}');
            @endforeach
            @endif
        });
    </script>
    @endif


    </body>
</html>
