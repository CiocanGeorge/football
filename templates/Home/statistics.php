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




<div class="matches index content">


    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><?= __('Luna') ?></th>
                    <th><?= __('Tip') ?></th>
                    <th><?= __('Total meciuri (100)') ?></th>
                    <th><?= __('Jucate') ?></th>
                    <th><?= __('Castigate') ?></th>
                    <th><?= __('Rate') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $firstRow = false; ?>
                <?php foreach ($data as $index => $match) : ?>
                    <tr>
                        <?php $firstRow = false; ?>
                        <td rowspan="8"><?= $index ?></td>
                        <?php foreach ($match as $key => $mtc) : ?>
                            <?php if ($firstRow) : ?>
                    <tr>
                    <?php endif; ?>
                    <td><?= $key ?></td>
                    <td><?= $mtc['total'] ?></td>
                    <td><?= $mtc['played'] ?></td>
                    <td><?= $mtc['wins'] ?></td>
                    <td><?= $mtc['rate'] ?>%</td>
                    <?php if ($firstRow) : ?>
                    <tr>
                    <?php endif; ?>
                    <?php $firstRow = true; ?>
                <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>