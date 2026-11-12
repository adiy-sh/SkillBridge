<x-landing-layout title="SkillBridge — High-Velocity Talent Intelligence">
    {{-- Navigation Bar --}}
    @include('landing.partials.nav')

    {{-- Main Canvas --}}
    <main class="flex-grow w-full relative grid-lines">
        {{-- Hero Section --}}
        @include('landing.partials.hero')

        {{-- Features & Capabilities Section --}}
        @include('landing.partials.features')

        {{-- Interactive Match Demo Section --}}
        @include('landing.partials.demo')

        {{-- Call To Action Section --}}
        @include('landing.partials.cta')
    </main>

    {{-- Footer --}}
    @include('landing.partials.footer')
</x-landing-layout>
