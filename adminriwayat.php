<?php include_once('navadmin.php'); ?>
<?php include_once('db.php'); ?>

<main class="max-w-screen-xl mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold text-[#D2691E] mb-8 text-center">Riwayat Transaksi</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-[#F4D03F] text-[#4A4A4A]">
                    <th class="px-6 py-3 text-left">No</th>
                    <th class="px-6 py-3 text-left">Nama Produk</th>
                    <th class="px-6 py-3 text-left">Jumlah</th>
                    <th class="px-6 py-3 text-left">Total Harga</th>
                    <th class="px-6 py-3 text-left">Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT o.quantity, o.total_price, p.product_name, o.transaction_date 
                            FROM orders o 
                            JOIN products p ON o.product_id = p.product_id 
                            WHERE o.status_check_id = 1 
                            ORDER BY o.transaction_date DESC";
                $result = mysqli_query($conn, $query);
                $no = 1;

                if ($result && mysqli_num_rows($result) > 0):
                    while ($row = mysqli_fetch_assoc($result)):
                ?>
                        <tr class="<?= $no % 2 == 0 ? 'bg-gray-100' : 'bg-white' ?>">
                            <td class="px-6 py-4"><?= $no++ ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($row['product_name']) ?></td>
                            <td class="px-6 py-4"><?= $row['quantity'] ?></td>
                            <td class="px-6 py-4">Rp<?= number_format($row['total_price'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4"><?= date('d-m-Y H:i:s', strtotime($row['transaction_date'])) ?></td>
                        </tr>
                <?php
                    endwhile;
                else:
                    echo "<tr><td colspan='5' class='text-center px-6 py-4'>Tidak ada riwayat transaksi.</td></tr>";
                endif;
                ?>
            </tbody>
        </table>
    </div>

