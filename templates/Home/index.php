<style>
    .win {
        background-color: green;
        color: #FFFFFF;
    }

    .lose {
        background-color: red;
        color: #FFFFFF;
    }

    th,
    td {
        text-align: center;
    }

    input.form-control {
        max-width: 300px;
        border-radius: 5px;
    }

    img {
        max-width: 50px;
        max-height: 50px;
    }
</style>


<form method="post">
    <input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken') ?>">



    <div class="matches index content">
        <div class="row mb-2">
            <h3 class="col-md-3 col-12"><?= __('Matches') ?></h3>
            <div class="d-flex col-md-9 col-12 justify-content-end">
                <button id="prevDay" class="btn btn-outline-secondary">&lt;</button>
                <input type="date" id="datePicker" name="data" class="form-control mx-2" value="<?= $data ?>">
                <button id="nextDay" class="btn btn-outline-secondary">&gt;</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?= __('Id') ?></th>
                        <th><?= __('Date') ?></th>
                        <th><?= __('Status') ?></th>
                        <th><?= __('Competitie') ?></th>
                        <th><?= __('Home Team') ?></th>
                        <th><?= __('Score') ?></th>
                        <th><?= __('Away Team') ?></th>
                        <th><?= __('Peste 0.5') ?></th>
                        <th><?= __('Peste 1.5') ?></th>
                        <th><?= __('Peste 2.5') ?></th>
                        <th><?= __('Peste 0.5 prima repriza') ?></th>
                        <th><?= __('GG') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($matches as $match) : ?>
                        <tr>
                            <td><?= h($match['id']) ?></td>
                            <td><?= date("Y-m-d H:i:s", strtotime($match['utcDate'] . " +3 hours")) ?></td>
                            <td><?= h($match['status']) ?></td>
                            <td>
                                <?= $match['competitions']['name'] ?>
                            </td>
                            <td>
                                <img src="<?= $match['homeLogo'] ?>" />
                                <?= $match['homeName'] ?>
                            </td>
                            <td><?= h($match['scores']['full_time_home']) ?> - <?= h($match['scores']['full_time_away']) ?></td>
                            <td>
                                <img src="<?= $match['awayLogo'] ?>" />
                                <?= $match['awayName'] ?>
                            </td>
                            <td class="<?= ($match['scores']['full_time_home'] + $match['scores']['full_time_away']) > 0 ? 'win' : (!empty($match['scores']['full_time_home']) || !empty($match['scores']['full_time_away'] || $match['scores']['full_time_home'] !== null || $match['scores']['full_time_away'] !== null) ? 'lose' : ''); ?>"><?= !empty($match['Prediction']['over0']) ? intval($match['Prediction']['over0']) . "%" : "-" ?></td>
                            <td class="<?= ($match['scores']['full_time_home'] + $match['scores']['full_time_away']) > 1 ? 'win' : (!empty($match['scores']['full_time_home']) || !empty($match['scores']['full_time_away'] || $match['scores']['full_time_home'] !== null || $match['scores']['full_time_away'] !== null) ? 'lose' : ''); ?>"><?= !empty($match['Prediction']['over1']) ? intval($match['Prediction']['over1']) . "%" : "-" ?></td>
                            <td class="<?= ($match['scores']['full_time_home'] + $match['scores']['full_time_away']) > 2 ? 'win' : (!empty($match['scores']['full_time_home']) || !empty($match['scores']['full_time_away'] || $match['scores']['full_time_home'] !== null || $match['scores']['full_time_away'] !== null) ? 'lose' : ''); ?>"><?= !empty($match['Prediction']['over1']) ? intval($match['Prediction']['over1']) . "%" : "-" ?></td>
                            <td class="<?= ($match['scores']['half_time_home'] + $match['scores']['half_time_away']) > 0 ? 'win' : (!empty($match['scores']['half_time_home']) || !empty($match['scores']['half_time_away'] || $match['scores']['half_time_home'] !== null || $match['scores']['half_time_away'] !== null) ? 'lose' : ''); ?>"><?= !empty($match['Prediction']['over0FirstHalf']) ? intval($match['Prediction']['over0FirstHalf']) . "%" : "-" ?></td>
                            <td class="<?= ($match['scores']['full_time_home'] > 0 && $match['scores']['full_time_away'] > 0) ? 'win' : (!empty($match['scores']['full_time_home']) || !empty($match['scores']['full_time_away'] || $match['scores']['full_time_home'] !== null || $match['scores']['full_time_away'] !== null) ? 'lose' : ''); ?>"><?= !empty($match['Prediction']['gg']) ? intval($match['Prediction']['gg']) . "%" : "-" ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</form>

