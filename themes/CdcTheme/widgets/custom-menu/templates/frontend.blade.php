<div class="w-full lg:w-2/5 box-border md:pl-8 lg:pl-0">
    <p class="mt-20   text-sm lg:text-base font-medium text-slate-400 md:mt-0">
        {{ $config['name'] }}
    </p>
    {!!
        Menus::generateMenu(['slug' => $config['menu_id'], 'view'    => 'menu_footer','options' => ['class' => 'mt-35']])
    !!}
</div>
