<!-- HERO SECTION -->
<section class="max-w-7xl mx-auto px-6 pt-16 pb-12 text-center flex flex-col items-center">
    <!-- Skill-Based Matching Pill Badge -->
    <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-[#111111] border border-[#262626] mb-8">
        <span class="w-2 h-2 rounded-full bg-[#19C2C2] animate-pulse"></span>
        <span class="text-label-sm font-label-sm text-[#19C2C2] uppercase tracking-wider">SKILL-BASED MATCHING</span>
    </div>

    <!-- Display Headline -->
    <h1 class="font-display-xl text-display-xl max-w-4xl text-white tracking-tight mb-6">
        Hire for <span class="text-[#FF4D1F]">Skills</span>, Not Guesswork.
    </h1>

    <!-- Subtext -->
    <p class="font-body-lg text-body-lg text-[#9CA3AF] max-w-2xl mx-auto mb-10">
        Connect clients directly with verified engineering and design talent. Intelligent matching algorithms that evaluate real proficiency, portfolio evidence, and availability.
    </p>

    <!-- Action Button Group -->
    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 w-full max-w-md mb-14">
        <a class="w-full sm:w-auto bg-[#FF4D1F] hover:bg-[#ff3805] text-white font-label-md text-label-md px-7 py-3.5 rounded-xl transition-all duration-150 shadow-lg shadow-[#FF4D1F]/20 flex items-center justify-center gap-2 glow-orange active:scale-[0.98]" href="#">
            <span>Find Freelancers</span>
            <span class="material-symbols-outlined text-base" data-icon="east">east</span>
        </a>
        <a class="w-full sm:w-auto bg-[#161616] border border-[#262626] hover:border-[#383838] text-white font-label-md text-label-md px-7 py-3.5 rounded-xl transition-all duration-150 flex items-center justify-center gap-2 active:scale-[0.98]" href="#">
            <span class="material-symbols-outlined text-base text-[#19C2C2]" data-icon="search">search</span>
            <span>Browse Projects</span>
        </a>
    </div>

    <!-- HERO VISUAL CARD (Telemetry Network Map) -->
    <div class="w-full max-w-6xl rounded-2xl p-1 bg-gradient-to-b from-[#262626] to-[#141414] border border-[#1F1F1F] shadow-2xl relative group">
        <div class="relative w-full rounded-2xl overflow-hidden bg-[#0A0A0A] border border-[#222222]">
            <!-- Local asset image reference -->
            <img 
                alt="SkillBridge Global Telemetry Map showing interconnected engineering nodes and match scores across distributed networks" 
                class="w-full h-auto object-cover max-h-[560px] opacity-95 transition-opacity duration-300 group-hover:opacity-100" 
                src="{{ asset('images/landing/hero-telemetry-map.png') }}"
            />

            <!-- Floating Caption Overlay in bottom-left -->
            <div class="absolute bottom-6 left-6 z-10 bg-[#0E0E0E]/90 backdrop-blur-md border border-[#262626] px-5 py-4 rounded-xl flex flex-col items-start gap-1 shadow-lg">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#19C2C2]"></span>
                    <span class="font-label-sm text-label-sm tracking-widest text-[#19C2C2] uppercase">SMART MATCHING</span>
                </div>
                <h2 class="font-headline-sm text-headline-sm text-white">Skill-Based Matching Engine</h2>
            </div>

            <!-- Subtle Corner Grid Tech Decal -->
            <div class="absolute top-4 right-4 hidden md:flex items-center gap-2 bg-[#111111]/80 backdrop-blur-sm border border-[#222222] px-3 py-1.5 rounded-lg font-mono text-[11px] text-[#9CA3AF]">
                <span class="text-[#FF4D1F]">LATENCY: 18ms</span>
                <span class="text-[#555]">•</span>
                <span class="text-[#19C2C2]">NODES ACTIVE: 48,219</span>
            </div>
        </div>
    </div>
</section>
