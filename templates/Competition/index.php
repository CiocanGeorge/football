<!-- Exemplu de fișier index.ctp pentru afișarea competițiilor salvate -->

<h1>Competiții salvate în baza de date</h1>

<table>
    <tr>
        <th>Nume</th>
        <th>Sezon</th>
        <th>Zonă</th>
        <th>Tip</th>
    </tr>
    <?php foreach ($competitions as $competition): ?>
    <tr>
        <td><?= h($competition->name) ?></td>
        <td><?= h($competition->current_season->start_date->format('Y-m-d')) ?> - <?= h($competition->current_season->end_date->format('Y-m-d')) ?></td>
        <td><?= h($competition->area->name) ?></td>
        <td><?= h($competition->type) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
