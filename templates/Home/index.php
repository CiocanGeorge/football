<style>
    .win {
        background-color: green;
        color: #FFFFFF;
    }

    .lose {
        background-color: red;
        color: #FFFFFF;
    }

    th, td {
        text-align: center;
        vertical-align: middle;
    }

    input.form-control {
        max-width: 300px;
        border-radius: 5px;
    }

    img {
        max-width: 50px;
        max-height: 50px;
    }

    /* Media queries for mobile devices */
    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }

        th, td {
            display: inline-block;
            width: auto;
            vertical-align: middle;
        }

        thead {
            display: none;
        }

        tbody {
            display: block;
        }

        tr {
            display: block;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            padding: 10px;
        }

        td::before {
            content: attr(data-label);
            font-weight: bold;
            display: inline-block;
            width: 150px;
            text-align: left;
        }

        .matches.index .d-flex {
            flex-direction: column;
            align-items: flex-start;
        }

        .matches.index .d-flex button {
            margin: 5px 0;
        }

        .matches.index .d-flex input {
            margin: 5px 0;
            width: 100%;
        }
    }
</style>



<form method="post" action="/home/index">
    <input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken') ?>">



    <div class="matches index content">
        <div class="d-flex align-items-center my-3 justify-content-between">
            <h3 class="mr-3"><?= __('Matches') ?></h3>
            <div class="d-flex">
                <button id="prevDay" class="btn btn-outline-secondary">&lt;</button>
                <input type="date" id="datePicker" name="data" class="form-control mx-2" value="<?= $data?>">
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
                            <td><?= date("Y-m-d H:i:s",strtotime($match['utcDate']." +3 hours")) ?></td>
                            <td><?= h($match['status']) ?></td>
                            <td>
                                <img src="<?= $match['homeLogo'] ?>"/>
                                <?= $match['homeName'] ?>
                            </td>
                            <td><?= h($match['scores']['full_time_home']) ?> - <?= h($match['scores']['full_time_away']) ?></td>
                            <td>
                                <img src="<?= $match['awayLogo'] ?>"/>
                                <?= $match['awayName'] ?>
                            </td>
                            <td class="<?= ($match['scores']['full_time_home'] + $match['scores']['full_time_away']) > 0 ? 'win' : (!empty($match['scores']['full_time_home']) || !empty($match['scores']['full_time_away'] || $match['scores']['full_time_home'] !== null || $match['scores']['full_time_away'] !== null) ? 'lose' : ''); ?>"><?= !empty($match['Prediction']['over0']) ? intval($match['Prediction']['over0'])."%" : "-" ?></td>
                            <td class="<?= ($match['scores']['full_time_home'] + $match['scores']['full_time_away']) > 1 ? 'win' : (!empty($match['scores']['full_time_home']) || !empty($match['scores']['full_time_away'] || $match['scores']['full_time_home'] !== null || $match['scores']['full_time_away'] !== null) ? 'lose' : ''); ?>"><?= !empty($match['Prediction']['over1']) ? intval($match['Prediction']['over1'])."%" : "-" ?></td>
                            <td class="<?= ($match['scores']['full_time_home'] + $match['scores']['full_time_away']) > 2 ? 'win' : (!empty($match['scores']['full_time_home']) || !empty($match['scores']['full_time_away'] || $match['scores']['full_time_home'] !== null || $match['scores']['full_time_away'] !== null) ? 'lose' : ''); ?>"><?= !empty($match['Prediction']['over1']) ? intval($match['Prediction']['over1'])."%" : "-" ?></td>
                            <td class="<?= ($match['scores']['half_time_home'] + $match['scores']['half_time_away']) > 0 ? 'win' : (!empty($match['scores']['half_time_home']) || !empty($match['scores']['half_time_away'] || $match['scores']['half_time_home'] !== null || $match['scores']['half_time_away'] !== null) ? 'lose' : ''); ?>"><?= !empty($match['Prediction']['over0FirstHalf']) ? intval($match['Prediction']['over0FirstHalf'])."%" : "-" ?></td>
                            <td class="<?= ($match['scores']['full_time_home'] > 0 && $match['scores']['full_time_away'] > 0) ? 'win' : (!empty($match['scores']['full_time_home']) || !empty($match['scores']['full_time_away'] || $match['scores']['full_time_home'] !== null || $match['scores']['full_time_away'] !== null) ? 'lose' : ''); ?>"><?= !empty($match['Prediction']['gg']) ? intval($match['Prediction']['gg'])."%" : "-" ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const datePicker = document.getElementById('datePicker');
        const prevDay = document.getElementById('prevDay');
        const nextDay = document.getElementById('nextDay');
        const matchesTableBody = document.getElementById('matchesTableBody');

        // // Set the date input to today's date
        // const today = new Date().toISOString().split('T')[0];
        // datePicker.value = today;

        // Function to change date by a specified number of days
        const changeDate = (days) => {
            const currentDate = new Date(datePicker.value);
            currentDate.setDate(currentDate.getDate() + days);
            const newDate = currentDate.toISOString().split('T')[0];
            datePicker.value = newDate;
            // fetchData(newDate);
        };

        // Event listeners for the buttons
        prevDay.addEventListener('click', () => changeDate(-1));
        nextDay.addEventListener('click', () => changeDate(1));

        // Event listener for the date picker
        datePicker.addEventListener('change', (event) => {
            // fetchData(event.target.value);
        });

        // Function to fetch data for a specific date using jQuery POST
        const fetchData = (date) => {
            const matchesTableBody = $('#matchesTableBody'); // Assuming you have a table body element with id="matchesTableBody"

            // Make Ajax request using jQuery
            $.post('/home/index', {
                    method: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-Token': $('input[name=_csrfToken]').val() // Trimite token-ul CSRF în capul cererii
                    },
                    date: date
                })
                .done(function(data) {
                    matchesTableBody.empty(); // Clear existing table data
                    $.each(data.matches, function(index, match) {
                        const row = `
                    <tr>
                        <td>${match.Matches.utcDate}</td>
                        <td>${match.Matches.status}</td>
                        <td>${match.Matches.homeName}</td>
                        <td>${match.scores.full_time_home} - ${match.scores.full_time_away}</td>
                        <td>${match.Matches.awayName}</td>
                        <td class="${(match.scores.full_time_home + match.scores.full_time_away) > 0 ? 'win' : (!empty(match.scores.full_time_home) ? 'lose' : '')}">${!empty(match.Predictions.over0) ? match.Predictions.over0 : '-'}</td>
                    </tr>
                `;
                        matchesTableBody.append(row);
                    });
                })
                .fail(function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                    matchesTableBody.html('<tr><td colspan="6">Error fetching data</td></tr>');
                });
        };





    });
</script>