<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php if (! empty($transactions))
                    $income = 0;
                $expenses = 0;
                foreach ($transactions as $transaction) {
                    echo '<tr>';
                    echo '<td>' . date('M j, Y', strtotime($transaction['t_date'])) . '</td>';
                    echo '<td>';
                    if ($transaction['t_check']) {
                        echo    $transaction['t_check'];
                    } else echo '';
                    echo '</td>';
                    echo '<td>' . $transaction['t_description'] . '</td>';
                    echo '<td ';
                    if($transaction['t_amount'] < 0) {
                        echo 'style="color: red">';
                        echo '-$';
                    } else {
                        echo '>$';
                    }
                    echo abs($transaction['t_amount']) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <?php
                    $income = 0;
                    $expenses = 0;
                    foreach ($transactions as $transaction) {
                        if ($transaction['t_amount'] < 0) {
                            $expenses += (float)$transaction['t_amount'];
                        } else {
                            $income += (float)$transaction['t_amount'];
                        }
                    }
                    echo '<td> $';
                    echo $income;
                    echo '</td></tr>';
                    echo '<tr>';
                    echo '<th colspan="3">Total Expense:</th>';
                    echo '<td>-$' . (abs ($expenses)) . '</td></tr>';

                    echo '<tr>';
                    echo '<th colspan="3">Net Total:</th>';
                    echo '<td> $' . $income + $expenses . '</td>';
                    ?>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
