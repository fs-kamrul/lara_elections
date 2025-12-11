<div class="w-full md:w-2/6 lg:w-2/5">
    <div class="h-auto w-92">
        <img src="{{ getImageUrlById(theme_option('logo_color'), 'shortcodes') }}"
             alt="{{ theme_option('site_title') }}" class="block w-full"/>
    </div>
    @if (theme_option('address'))
        <div class="mt-6 max-w-323">
            <p class="text-xs lg:text-sm font-normal leading-loose tracking-wide text-white">
                {{ theme_option('address') }}
            </p>
        </div>
    @endif
    <div class="mt-51">
        @if (theme_option('address'))
            <a href="mailto:cdc@daffodilvarsity.edu.bd" target="_blank"
               class="mb-28 block   text-xs lg:text-sm font-normal text-white transition duration-200 hover:text-text-highlight"><i
                    class="ri-mail-send-fill mr-4"></i>
                {{ theme_option('site_email') }}</a>
        @endif
        @if (theme_option('address'))
            <a href="tel:+8801847334707" target="_blank"
               class="mb-28 block   text-xs lg:text-sm font-normal text-white transition duration-200 hover:text-text-highlight"><i
                    class="ri-phone-fill mr-4"></i> {{ theme_option('site_phone') }}</a>
        @endif
    </div>
</div>

