<!-- INTERACTIVE DEMO PANEL (Alpine.js Powered Match Simulator) -->
<section class="max-w-7xl mx-auto px-6 py-12" id="match-score">
    <div class="bg-[#111111] border border-[#1F1F1F] rounded-2xl p-8 md:p-12 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
        <!-- Left Side: Conceptual & Description -->
        <div class="space-y-6">
            <div class="inline-flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-[#19C2C2]"></span>
                <span class="font-mono text-xs font-bold text-[#19C2C2] tracking-wider uppercase">LIVE PREVIEW</span>
            </div>
            <h2 class="font-headline-lg text-headline-lg text-white">
                Match Score Preview
            </h2>
            <p class="font-body-lg text-body-lg text-[#9CA3AF]">
                Our multi-parameter scoring engine calculates real-time alignment between complex project scopes and verified engineering capabilities.
            </p>
            <div class="space-y-3 pt-2">
                <div class="flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-[#19C2C2]"></span>
                    <span class="font-body-md text-body-md text-white font-medium">Skills and proficiency weighting</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-[#19C2C2]"></span>
                    <span class="font-body-md text-body-md text-white font-medium">Experience and availability calibration</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-[#19C2C2]"></span>
                    <span class="font-body-md text-body-md text-white font-medium">Budget fit and milestone preferences</span>
                </div>
            </div>
        </div>

        <!-- Right Side: Mock Freelancer Match Card with Alpine.js Simulation -->
        <div 
            x-data="{
                score: 92,
                skillOverlap: 96,
                availability: 90,
                rateAlignment: 92,
                animating: false,
                simulateMatch() {
                    if (this.animating) return;
                    this.animating = true;
                    let step = 0;
                    const interval = setInterval(() => {
                        this.score = Math.floor(Math.random() * 15) + 84;
                        this.skillOverlap = Math.floor(Math.random() * 10) + 89;
                        this.availability = Math.floor(Math.random() * 16) + 82;
                        this.rateAlignment = Math.floor(Math.random() * 12) + 87;
                        step++;
                        if (step > 8) {
                            clearInterval(interval);
                            this.score = 95;
                            this.skillOverlap = 98;
                            this.availability = 94;
                            this.rateAlignment = 96;
                            this.animating = false;
                        }
                    }, 80);
                }
            }"
            class="bg-[#0A0A0A] border border-[#222222] rounded-xl p-6 sm:p-7 shadow-inner relative"
        >
            <!-- Top Row: Avatar + Info + Score Badge -->
            <div class="flex items-start justify-between gap-4 pb-6 border-b border-[#1E1E1E]">
                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 rounded-full bg-[#1A1A1A] border border-[#333333] flex items-center justify-center text-white font-headline-sm font-bold relative">
                        AV
                        <span class="absolute bottom-0 right-0 w-3.5 h-3.5 rounded-full bg-[#19C2C2] border-2 border-[#0A0A0A]"></span>
                    </div>
                    <div>
                        <h4 class="font-headline-sm text-headline-sm text-white font-semibold">Alex Vance</h4>
                        <p class="font-body-sm text-body-sm text-[#9CA3AF]">Principal Distributed Systems Engineer</p>
                    </div>
                </div>
                <!-- Radial/Score Badge -->
                <div class="bg-[#19C2C2]/10 border border-[#19C2C2]/30 rounded-xl px-3.5 py-2 text-center glow-teal transition-all duration-300">
                    <div class="font-headline-sm text-headline-sm text-[#19C2C2] font-bold tracking-tight" x-text="score + '%'">92%</div>
                    <div class="font-mono text-[9px] text-[#19C2C2] uppercase tracking-wider font-semibold">Optimal Compatibility</div>
                </div>
            </div>

            <!-- Tag Chips -->
            <div class="py-5 flex flex-wrap gap-2 border-b border-[#1E1E1E]">
                <span class="bg-[#1C1C1C] border border-[#2E2E2E] text-xs text-gray-300 px-2.5 py-1 rounded-md font-mono">Rust</span>
                <span class="bg-[#1C1C1C] border border-[#2E2E2E] text-xs text-gray-300 px-2.5 py-1 rounded-md font-mono">Distributed Consensus</span>
                <span class="bg-[#1C1C1C] border border-[#2E2E2E] text-xs text-gray-300 px-2.5 py-1 rounded-md font-mono">gRPC</span>
                <span class="bg-[#1C1C1C] border border-[#2E2E2E] text-xs text-gray-300 px-2.5 py-1 rounded-md font-mono">Kafka</span>
            </div>

            <!-- Progress Breakdown Bars -->
            <div class="py-5 space-y-3.5">
                <div>
                    <div class="flex justify-between text-xs font-mono mb-1">
                        <span class="text-[#9CA3AF]">Skill Overlap</span>
                        <span class="text-white font-semibold" x-text="skillOverlap + '%'">96%</span>
                    </div>
                    <div class="w-full bg-[#1A1A1A] h-1.5 rounded-full overflow-hidden">
                        <div class="bg-[#19C2C2] h-full rounded-full transition-all duration-300" :style="'width: ' + skillOverlap + '%'"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs font-mono mb-1">
                        <span class="text-[#9CA3AF]">Availability</span>
                        <span class="text-white font-semibold" x-text="availability + '%'">90%</span>
                    </div>
                    <div class="w-full bg-[#1A1A1A] h-1.5 rounded-full overflow-hidden">
                        <div class="bg-[#19C2C2] h-full rounded-full transition-all duration-300" :style="'width: ' + availability + '%'"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs font-mono mb-1">
                        <span class="text-[#9CA3AF]">Rate Alignment</span>
                        <span class="text-white font-semibold" x-text="rateAlignment + '%'">92%</span>
                    </div>
                    <div class="w-full bg-[#1A1A1A] h-1.5 rounded-full overflow-hidden">
                        <div class="bg-[#FF4D1F] h-full rounded-full transition-all duration-300" :style="'width: ' + rateAlignment + '%'"></div>
                    </div>
                </div>
            </div>

            <!-- Action Button at Bottom -->
            <button 
                type="button"
                @click="simulateMatch()"
                :disabled="animating"
                class="w-full bg-[#19C2C2] hover:bg-[#15a8a8] text-black font-label-md text-label-md font-semibold py-2.5 px-4 rounded-lg flex items-center justify-center gap-2 transition-all active:scale-[0.98] disabled:opacity-75 disabled:cursor-wait"
            >
                <span class="material-symbols-outlined text-sm transition-transform duration-500" :class="{ 'animate-spin': animating }" data-icon="sync">sync</span>
                <span x-text="animating ? 'Calculating Score...' : 'Simulate Match'">Simulate Match</span>
            </button>
        </div>
    </div>
</section>
