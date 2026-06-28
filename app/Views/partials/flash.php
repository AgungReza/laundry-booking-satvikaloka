<?php if (session()->getFlashdata('success')): ?>
    <div class="mb-4 rounded-xl bg-green-50 p-4 text-sm text-green-700 border border-green-100"><?= esc(session()->getFlashdata('success')) ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="mb-4 rounded-xl bg-red-50 p-4 text-sm text-red-700 border border-red-100"><?= esc(session()->getFlashdata('error')) ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('errors')): ?>
    <div class="mb-4 rounded-xl bg-red-50 p-4 text-sm text-red-700 border border-red-100">
        <ul class="list-disc pl-5">
            <?php foreach (session()->getFlashdata('errors') as $err): ?>
                <li><?= esc($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
