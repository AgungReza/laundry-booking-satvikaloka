<div class="grid md:grid-cols-4 gap-4">
    <?php foreach ([['Total Mesin',$totalMachines],['Booking Aktif',$activeBookings],['Payment Pending',$pendingPayments],['Customer',$customers]] as $card): ?>
        <div class="bg-white rounded-2xl p-5 shadow-sm border">
            <p class="text-sm text-slate-500"><?= esc($card[0]) ?></p>
            <p class="text-3xl font-bold mt-2"><?= esc($card[1]) ?></p>
        </div>
    <?php endforeach; ?>
</div>
