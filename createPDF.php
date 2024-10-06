<h2>Bills Without PDFs</h2>
<?php echo_r($billsWithoutPDF); ?>
<table>
    <thead>
        <tr>
            <th>Bill Number</th>
            <th>Year</th>
            <th>Date Created</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($billsWithoutPDF as $bill): ?>
        <tr>
            <td><?= htmlspecialchars($bill->bill_number) ?></td>
            <td><?= htmlspecialchars($bill->year) ?></td>
            <td><?= htmlspecialchars($bill->date_created) ?></td>
            <td><a href="/bill/bills/generatePDF/<?= $bill->id ?>">Make PDF</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
