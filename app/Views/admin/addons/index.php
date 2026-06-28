<div class="mb-4">
    <a href="/admin/addons/create" class="px-4 py-2 rounded-xl bg-blue-600 text-white">Tambah Add On</a>
</div>

<div class="bg-white rounded-2xl border overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-slate-100">
            <tr>
                <th class="p-3 text-left">Nama</th>
                <th class="p-3 text-left">Deskripsi</th>
                <th class="p-3 text-right">Harga</th>
                <th class="p-3 text-center">Stok</th>
                <th class="p-3 text-center">Status</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($addons as $a): ?>
            <tr class="border-t">
                <td class="p-3 font-semibold"><?= esc($a['name']) ?></td>
                <td class="p-3 text-slate-600"><?= esc($a['description'] ?: '-') ?></td>
                <td class="p-3 text-right">Rp<?= number_format($a['price'], 0, ',', '.') ?></td>
                <td class="p-3 text-center">
                    <?= (int) $a['stock_enabled'] === 1 ? esc((string) $a['stock_qty']) : 'Tidak dibatasi' ?>
                </td>
                <td class="p-3 text-center">
                    <?= (int) $a['is_active'] === 1 ? '<span class="text-green-600 font-semibold">Aktif</span>' : '<span class="text-red-600 font-semibold">Nonaktif</span>' ?>
                </td>
                <td class="p-3 text-center space-x-2">
                    <a class="text-blue-600" href="/admin/addons/<?= $a['id'] ?>/edit">Edit</a>
                    <form method="post" action="/admin/addons/<?= $a['id'] ?>/delete" class="inline" onsubmit="return confirm('Hapus add on ini?')">
                        <?= csrf_field() ?>
                        <button class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($addons)): ?>
            <tr><td colspan="6" class="p-6 text-center text-slate-500">Belum ada add on.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
