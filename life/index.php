<?php
/**
 * Created by PhpStorm.
 * User: sovkutsan
 * Date: 6/7/18
 * Time: 3:01 PM
 */

$n = 20;

function initWorld(&$world, $size)
{
    if (!is_array($world) || empty($world)) {
        $world = array($size);
    }

    for ($i = 0; $i < $size; $i++) {
        for ($j = 0; $j < $size; $j++) {
            $world[$i][$j] = 0;
        }
    }

    for ($i = 0; $i < $size * 20; $i++) {
        $x = mt_rand(0, $size - 1);
        $y = mt_rand(0, $size - 1);
        $world[$x][$y] = mt_rand(0, 1);
    }
}

function iterateWorld(&$world, $size)
{
    $result = array($size, $size);
    for ($i = 0; $i < $size; $i++) {
        for ($j = 0; $j < $size; $j++) {
            $item = getStatus($world, $i, $j, $size);
            $result[$i][$j] = $item;
        }
    }

    return $result;
}

function getStatus(&$world, $i, $j, $size)
{
    /*if ($i > 0 && $j > 0) { // cell not on border
        $neighbors =
            $world[$i - 1][$j - 1] + $world[$i][$j - 1] + $world[$i + 1][$j - 1] +
            $world[$i - 1][$j] + $world[$i + 1][$j] +
            $world[$i - 1][$j + 1] + $world[$i][$j + 1] + $world[$i + 1][$j + 1];
    } else {
        $neighbors = 0;
    }*/

    $neighbors = getNeighbords($world, $i, $j, $size);

    if ($world[$i][$j]) { // alive cell
        $status = ($neighbors == 3 || $neighbors == 2);
    } else { // empty cell
        $status = ($neighbors >= 3);
    }

    return $status;
}

function getNeighbords(&$world, $i, $j, $size)
{
    $state = 0;
    for ($n = $i - 1; $n < $i + 1; $n++) {
        for ($m = $j - 1; $m < $j + 1; $m++) {
            if ($n < 0 || $j < 0 || $i >= $size || $j >= $size) {
                continue;
            }
            $state += (int) $world[$n][$m];
        }
    }

    return $state;
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {

    $state = isset($_REQUEST['state']) ? $_REQUEST['state'] : array();
    $result = array();
    if (empty($state)) {
        initWorld($result, $n);
    } else {
        $result = iterateWorld($state, $n);
    }

    $response = array(
        'state' => $result,
        'status' => true
    );

    echo json_encode($response);
    die;
}

$world = [$n, $n];

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
            <table class="world">

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
                state: state
            },
            success: function (response) {
                setWorldState(response.state);
                $('.steps-list').append($('<li>Step ' + totalCntr + '</li>'));
                totalCntr++;
                /*if (totalCntr >= 300) {
                    return;
                }
                setTimeout(function () {
                    step();
                }, 1000);*/
            }
        });
    }

    var totalCntr = 1;
    $(document).ready(function () {
        $('.next-step').click(function () {
            step();
        });
        //step();
    });
</script>

</body>
</html>
