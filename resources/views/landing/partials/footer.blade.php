<!-- FOOTER (Shared Component: Footer) -->
<footer class="w-full bg-surface-container-lowest border-t border-outline-variant/20">
    <div class="max-w-7xl mx-auto px-6 py-12 flex flex-col md:flex-row justify-between items-center gap-6 w-full">
        <!-- Left: Logo & Legal notice -->
        <div class="flex flex-col md:flex-row items-center gap-4 text-center md:text-left">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded bg-[#FF4D1F] flex items-center justify-center text-white">
                    <span class="material-symbols-outlined text-xs" data-icon="hub">hub</span>
                </div>
                <span class="font-headline-sm text-headline-sm font-bold text-on-surface">SkillBridge</span>
            </div>
            <p class="text-on-surface-variant/70 font-body-sm text-body-sm">
                © {{ date('Y') }} SkillBridge Inc. High-velocity engineering talent intelligence. All rights reserved.
            </p>
        </div>

        <!-- Center: Links -->
        <nav class="flex flex-wrap items-center justify-center gap-6">
            <a class="text-on-surface-variant/70 hover:text-secondary font-body-sm text-body-sm transition-colors duration-150" href="#">Documentation</a>
            <a class="text-on-surface-variant/70 hover:text-secondary font-body-sm text-body-sm transition-colors duration-150" href="#">Platform Security</a>
            <a class="text-on-surface-variant/70 hover:text-secondary font-body-sm text-body-sm transition-colors duration-150" href="#">Telemetry Engine</a>
            <a class="text-on-surface-variant/70 hover:text-secondary font-body-sm text-body-sm transition-colors duration-150" href="#">Privacy Policy</a>
            <a class="text-on-surface-variant/70 hover:text-secondary font-body-sm text-body-sm transition-colors duration-150" href="#">Terms of Service</a>
            <a class="text-on-surface-variant/70 hover:text-secondary font-body-sm text-body-sm transition-colors duration-150" href="#">Status</a>
        </nav>

        <!-- Right: Utility icons -->
        <div class="flex items-center gap-4 text-on-surface-variant/70">
            <span class="material-symbols-outlined text-lg hover:text-primary cursor-pointer transition-colors" data-icon="public">public</span>
            <span class="material-symbols-outlined text-lg hover:text-secondary cursor-pointer transition-colors" data-icon="verified_user">verified_user</span>
        </div>
    </div>
</footer>
