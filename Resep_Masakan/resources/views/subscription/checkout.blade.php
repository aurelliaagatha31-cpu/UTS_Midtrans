<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Selesaikan Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100 p-0 relative">
                <!-- Decorative Top Border -->
                <div class="h-4 w-full bg-gradient-to-r from-amber-400 via-orange-500 to-red-500"></div>
                
                <div class="p-8 sm:p-12 text-center">
                    <div class="w-20 h-20 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                        <i data-lucide="receipt" class="w-10 h-10 text-orange-500"></i>
                    </div>
                    
                    <h3 class="text-3xl font-extrabold text-gray-900 mb-2 font-serif">Ringkasan Pesanan</h3>
                    <p class="text-gray-500 mb-8">Silakan selesaikan pembayaran untuk mengaktifkan paket Premium Anda.</p>
                    
                    <div class="bg-gray-50 rounded-2xl p-6 mb-8 border border-gray-100 text-left">
                        <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">Order ID</span>
                            <span class="font-bold text-gray-900 font-mono text-sm bg-white px-3 py-1 rounded shadow-sm">{{ $transaction->id }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">Paket</span>
                            <span class="font-bold text-gray-900">DapurKita Premium (30 Hari)</span>
                        </div>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-gray-800 font-bold text-lg">Total Pembayaran</span>
                            <span class="font-extrabold text-2xl text-orange-600">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button id="pay-button" class="w-full bg-gradient-to-r from-gray-900 to-gray-800 hover:from-black hover:to-gray-900 text-white font-bold py-4 px-6 rounded-xl shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95 flex items-center justify-center gap-3 text-lg">
                        <i data-lucide="credit-card" class="w-6 h-6"></i> Pilih Metode Pembayaran
                    </button>
                    
                    <p class="mt-6 text-gray-400 text-xs flex items-center justify-center gap-1">
                        <i data-lucide="lock" class="w-3 h-3"></i> Pembayaran aman diproses oleh Midtrans
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Midtrans Snap JS -->
    <script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            // SnapToken acquired from previous step
            snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) {
                    alert("Pembayaran berhasil!");
                    window.location.href = "{{ route('home') }}";
                },
                onPending: function (result) {
                    alert("Menunggu pembayaran Anda!");
                    window.location.href = "{{ route('home') }}";
                },
                onError: function (result) {
                    alert("Pembayaran gagal!");
                }
            });
        };
    </script>
</x-app-layout>
