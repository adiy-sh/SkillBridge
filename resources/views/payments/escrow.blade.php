<x-app-layout>
    <div class="py-12" x-data="{ confirmingRelease: false, confirmingRefund: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Milestone Escrow Dashboard</h2>

                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="border-t border-b border-gray-200 py-4 my-4 grid grid-cols-3 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Milestone Title</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $milestone->title }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Milestone Status</p>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full mt-1
                            {{ $milestone->status === 'released' ? 'bg-green-100 text-green-800' : ($milestone->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($milestone->status) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Amount</p>
                        <p class="text-lg font-semibold text-gray-900">${{ number_format($milestone->amount, 2) }}</p>
                    </div>
                </div>

                <div class="mt-6 flex space-x-4">
                    @if($milestone->status === 'pending')
                        <form action="{{ route('milestones.fund', $milestone->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="amount" value="{{ $milestone->amount }}">
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm font-medium">
                                Fund Milestone (${{ number_format($milestone->amount, 2) }})
                            </button>
                        </form>
                    @elseif($milestone->status === 'funded' || $milestone->status === 'completed')
                        <button @click="confirmingRelease = true" class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700 text-sm font-medium">
                            Approve & Release Funds
                        </button>

                        <button @click="confirmingRefund = true" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 text-sm font-medium">
                            Refund Escrow
                        </button>
                    @else
                        <p class="text-sm font-semibold text-gray-600">This escrow milestone has been settled ({{ ucfirst($milestone->status) }}).</p>
                    @endif
                </div>

                <!-- Release Confirmation Modal -->
                <div x-show="confirmingRelease" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center" style="display: none;">
                    <div class="bg-white p-6 rounded-lg max-w-md w-full shadow-xl">
                        <h3 class="text-lg font-medium text-gray-900">Confirm Fund Release</h3>
                        <p class="mt-2 text-sm text-gray-500">Are you sure you want to release escrow funds for this milestone? (Note: Milestone must be marked as 'Completed').</p>
                        <div class="mt-4 flex justify-end space-x-3">
                            <button @click="confirmingRelease = false" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-300">Cancel</button>
                            <form action="{{ route('milestones.release', $milestone->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-emerald-700">Yes, Release</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Refund Confirmation Modal -->
                <div x-show="confirmingRefund" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center" style="display: none;">
                    <div class="bg-white p-6 rounded-lg max-w-md w-full shadow-xl">
                        <h3 class="text-lg font-medium text-gray-900">Confirm Escrow Refund</h3>
                        <p class="mt-2 text-sm text-gray-500">Are you sure you want to refund the escrow funds back to the client?</p>
                        <div class="mt-4 flex justify-end space-x-3">
                            <button @click="confirmingRefund = false" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-300">Cancel</button>
                            <form action="{{ route('milestones.refund', $milestone->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-red-700">Yes, Refund</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>