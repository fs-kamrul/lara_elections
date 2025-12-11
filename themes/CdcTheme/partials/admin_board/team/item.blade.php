<div class="w-full sm:w-1/2 lg:w-1/3 max-w-xs rounded-23 overflow-hidden shadow-sm">
    <div class="h-80 lg:h-96 w-full bg-center bg-cover rounded-23" style="
                              background-image: linear-gradient(0deg, #000000cc 0%, #00000000 100%),
                              url({{ getImageUrl($team->photo,'adminboard/adminteam') }});
                          ">
    </div>
    <div class="mt-6 text-center">
        <h6 class="text-lg font-semibold text-primary-dark">
            <a href="{{ $team->url }}">{{ $team->name }}</a>
        </h6>
        <p class="mt-2 text-base font-normal text-p-color">
            {{ $team->designation }}
        </p>
        <div class="mt-5">
            <a href="mailto:{{ $team->email }}" target="_blank"
               class="mb-2 block text-xs lg:text-sm font-normal text-primary-dark hover:text-primary-blue transition">
                <i class="ri-mail-send-fill mr-2 text-primary-blue"></i>
                {{ $team->email }}</a>

            <a href="tel:{{ $team->phone }}" target="_blank"
               class="block text-xs lg:text-sm font-normal text-primary-dark hover:text-primary-blue transition">
                <i class="ri-phone-fill mr-2 text-primary-blue"></i>{{ $team->phone }}</a>
        </div>
    </div>
</div>

