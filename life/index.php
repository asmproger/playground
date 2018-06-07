<?php
/**
 * Created by PhpStorm.
 * User: sovkutsan
 * Date: 6/7/18
 * Time: 3:01 PM
 */

include '../functions.php';

$n = 20;

function initWorld(&$world, $size)
{
    if (!is_array($world) || empty($world)) {
        $world = array();
    }

    for ($i = 0; $i < $size; $i++) {
        $world[$i] = array();
        for ($j = 0; $j < $size; $j++) {
            $world[$i][$j] = 0;
        }
    }

    // test 0
    /*$world[5][5] = 1;
    $world[5][6] = 1;
    $world[5][7] = 1;
    $world[5][8] = 1;
    $world[5][9] = 1;

    $world[7][5] = 1;
    $world[8][6] = 1;
    $world[9][7] = 1;
    $world[10][8] = 1;
    $world[11][9] = 1;

    $world[7][5] = 1;
    $world[8][5] = 1;
    $world[9][5] = 1;
    $world[10][5] = 1;
    $world[11][5] = 1;*/

    // test 1
    /*$world[5][5] = 1;
    $world[6][5] = 1;
    $world[7][6] = 1;*/

    // test 2
    /*$world[5][8] = 1;
    $world[4][9] = 1;
    $world[5][10] = 1;*/

    // test 3
    /*$world[5][0] = 1;
    $world[4][1] = 1;
    $world[3][2] = 1;*/

    // test 4
    /*$world[1][1] = 1;
    $world[2][1] = 1;
    $world[1][2] = 1;*/

    // test 5
    /*$world[5][6] = 1;
    $world[5][7] = 1;
    $world[5][8] = 1;*/

    // test 6
    /*$world[5][5] = 1;
    $world[5][6] = 1;
    $world[5][7] = 1;
    $world[5][8] = 1;*/

    // test 7
    $world[5][5] = 1;
    $world[5][6] = 1;
    $world[5][7] = 1;
    $world[4][7] = 1;
    $world[3][6] = 1;


    // random
    /*for ($i = 0; $i < $size * 4; $i++) {
        $x = mt_rand(0, $size - 1);
        $y = mt_rand(0, $size - 1);
        $world[$x][$y] = 1;
    }*/
}

function iterateWorld(&$world, $size)
{
    $result = [];
    for ($i = 0; $i < $size; $i++) {
        $result[$i] = [];
        for ($j = 0; $j < $size; $j++) {
            $item = getStatus($world, $i, $j, $size);
            $result[$i][$j] = $item;
        }
    }

    return $result;
}

function getStatus(&$world, $i, $j, $size)
{
    $neighbors = getNeighbords($world, $i, $j, $size);

    if ($world[$i][$j]) { // alive cell
        $status = ($neighbors == 3 || $neighbors == 2);
    } else { // empty cell
        $status = ($neighbors === 3);
    }

    return $status;
}

function getNeighbords(&$world, $i, $j, $size)
{
    $state = 0;

    for ($n = $i - 1; $n <= $i + 1; $n++) {
        for ($m = $j - 1; $m <= $j + 1; $m++) {
            if (
                    $n < 0 || $j < 0 ||
                    $i >= $size || $j >= $size ||
                    ($n == $i && $j == $m)
            ) {
                continue;
            }

            $state += (int)$world[$n][$m];
        }
    }

    return $state;
}

function checkResult(&$world, $size)
{

    $result = 0;
    for ($i = 0; $i < $size; $i++) {
        for ($j = 0; $j < $size; $j++) {
            $result += (int)$world[$i][$j];
        }
    }

    return $result;
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {

    $state = isset($_REQUEST['state']) ? $_REQUEST['state'] : array();
    $apocalypse = isset($_REQUEST['apocalypse']) ? boolval($_REQUEST['apocalypse']) : false;
    $result = array();

    if ( empty($state) || $apocalypse) {
        initWorld($result, $n);
    } else {
        $result = iterateWorld($state, $n);
    }

    $checkResult = checkResult($result, $n);

    $response = array(
        'state' => $result,
        'alives' => $checkResult
    );

    echo json_encode($response);
    die;
}

$world = [];

initWorld($world, $n);

?>

<html>
<head>
    <title>Life is life</title>
    <script
            src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
            crossorigin="anonymous"></script>
    <style>
        .world {
            border: 1px solid green;
        }

        .cell {
            width: 10px;
            height: 10px;
        }

        .cell.filled {
            background: lightblue;
        }

        .field {
            float: left;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<?php if (!empty($world)): ?>

    <div>
        <div class="field">
            <table class="world" cellpadding="0" cellspacing="0">
                <?php for ($i = 0; $i < $n; $i++): ?>
                    <tr>
                        <?php for ($j = 0; $j < $n; $j++): ?>
                            <td class="cell <?php echo ($world[$i][$j]) ? 'filled' : ''; ?>"></td>
                        <?php endfor; ?>
                    </tr>
                <?php endfor; ?>
            </table>
        </div>
        <div class="field">
            <button type="button" class="next-step">Step</button>
            <button type="button" class="auto-mode">Start</button>
            <ul class="steps-list">
                <li>Init state</li>
            </ul>
        </div>
        <div style="clear: both;"></div>
    </div>


<?php endif; ?>

<script>
    function getWorldState() {
        var cells = $('.world td');
        var state = [];
        var size = parseInt(<?php echo $n; ?>);

        var cntr = 0;
        for (var i = 0; i < size; i++) {
            state[i] = [];
            for (var j = 0; j < size; j++) {
                var cell = $(cells[cntr]);
                state[i][j] = Number(cell.hasClass('filled'));
                cntr++;
            }
        }

        return state;
    }

    function setWorldState(state) {
        var cells = $('.world td');
        cells.removeClass('filled');
        var size = parseInt(<?php echo $n; ?>);

        var cntr = 0;
        for (var i = 0; i < size; i++) {
            for (var j = 0; j < size; j++) {
                var cell = $(cells[cntr]);
                if (state[i][j] > 0) {
                    cell.addClass('filled')
                }
                cntr++;
            }
        }

        return state;
    }

    function step() {
        var state = getWorldState();
        $.ajax({
            url: 'http://playground.local/life/',
            type: 'post',
            dataType: 'json',
            data: {
                state: state,
                apocalypse: apocalypse * 1
            },
            success: function (response) {
                setWorldState(response.state);
                if (apocalypse) {
                    apocalypse = false;
                    $('.steps-list').html($('<li>Init state</li>'));
                }
                var str = '';
                if (response.alives > 0) {
                    str = 'Step ' + totalCntr + ', alives - ' + response.alives;
                } else {
                    apocalypse = true;
                    auto = false;
                    str = 'APOCALYPSE';
                }
                $('.steps-list').append($('<li>' + str + '</li>'));

                totalCntr++;

                if (auto && response.alives > 0) {
                    setTimeout(function () {
                        step();
                    }, 1000);
                }
            }
        });
    }

    var totalCntr = 1, auto = false, apocalypse = false;
    $(document).ready(function () {
        $('.next-step').click(function () {
            step();
        });
        $('.auto-mode').click(function () {
            auto = !auto;
            $(this).text(auto ? 'Stop' : 'Start');
            step();
        });
        //step();
    });
</script>

</body>
</html>
