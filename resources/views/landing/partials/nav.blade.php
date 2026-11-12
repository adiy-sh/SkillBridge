<!-- TOP NAVIGATION BAR (Shared Component: TopNavBar with Alpine.js Mobile Support) -->
<header x-data="{ mobileMenuOpen: false }" class="docked full-width top-0 sticky z-50 bg-surface-container-lowest/80 backdrop-blur-md border-b border-outline-variant/30">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between w-full">
        <!-- Brand Logo / Wordmark -->
        <a class="flex items-center gap-3 active:scale-[0.98] transition-transform duration-100" href="{{ route('home') }}">
            <div class="w-8 h-8 rounded-lg bg-[#FF4D1F] flex items-center justify-center text-white glow-orange">
                <span class="material-symbols-outlined text-lg" data-icon="hub">hub</span>
            </div>
            <span class="font-headline-md text-headline-md font-bold tracking-tight text-on-surface">SkillBridge</span>
        </a>

        <!-- Desktop Navigation Links -->
        <nav class="hidden md:flex items-center gap-8">
            <a class="text-primary font-label-md text-label-md hover:text-primary transition-colors duration-150" href="#features">Features</a>
            <a class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors duration-150" href="#match-score">Match Score</a>
            <a class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors duration-150" href="#talent-network">Talent Network</a>
            <a class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors duration-150" href="#enterprise">Enterprise</a>
        </nav>

        <!-- Trailing Action Cluster (Desktop) -->
        <div class="hidden md:flex items-center gap-4">
            <a class="text-on-surface-variant hover:text-primary font-label-md text-label-md transition-colors duration-150 px-2 py-1" href="{{ route('login') }}">
                Log In
            </a>
            <a class="bg-[#FF4D1F] hover:bg-[#E03E14] text-white font-label-md text-label-md font-semibold px-5 py-2.5 rounded-lg active:scale-[0.98] transition-all duration-150 glow-orange flex items-center gap-1.5" href="{{ route('register') }}">
                <span>Sign Up</span>
                <span class="material-symbols-outlined text-sm" data-icon="arrow_forward">arrow_forward</span>
            </a>
        </div>

        <!-- Mobile Hamburger Button -->
        <div class="flex items-center md:hidden">
            <button 
                type="button" 
                @click="mobileMenuOpen = !mobileMenuOpen" 
                class="text-on-surface-variant hover:text-white p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FF4D1F]"
                aria-label="Toggle Navigation Menu"
            >
                <span class="material-symbols-outlined text-2xl" x-show="!mobileMenuOpen" data-icon="menu">menu</span>
                <span class="material-symbols-outlined text-2xl" x-show="mobileMenuOpen" style="display: none;" data-icon="close">close</span>
            </button>
        </div>
    </div>

    <!-- Mobile Dropdown Navigation Menu -->
    <div 
        x-show="mobileMenuOpen" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="md:hidden bg-[#111111] border-b border-[#262626] px-6 py-5 space-y-4"
        style="display: none;"
    >
        <nav class="flex flex-col space-y-3">
            <a @click="mobileMenuOpen = false" class="text-primary font-label-md text-label-md hover:text-primary transition-colors py-1" href="#features">Features</a>
            <a @click="mobileMenuOpen = false" class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors py-1" href="#match-score">Match Score</a>
            <a @click="mobileMenuOpen = false" class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors py-1" href="#talent-network">Talent Network</a>
            <a @click="mobileMenuOpen = false" class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors py-1" href="#enterprise">Enterprise</a>
        </nav>
        <div class="pt-4 border-t border-[#262626] flex flex-col gap-3">
            <a class="text-center text-on-surface-variant hover:text-primary font-label-md text-label-md transition-colors py-2" href="{{ route('login') }}">
                Log In
            </a>
            <a class="bg-[#FF4D1F] hover:bg-[#E03E14] text-white font-label-md text-label-md font-semibold px-5 py-2.5 rounded-lg active:scale-[0.98] transition-all duration-150 glow-orange flex items-center justify-center gap-1.5" href="{{ route('register') }}">
                <span>Sign Up</span>
                <span class="material-symbols-outlined text-sm" data-icon="arrow_forward">arrow_forward</span>
            </a>
        </div>
    </div>
</header>
