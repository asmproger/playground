<?php
/**
 * Created by PhpStorm.
 * User: sovkutsan
 * Date: 6/7/18
 * Time: 3:01 PM
 */
/*
 * Муравей Лэнгдона
 * Имеет направление движения
 *
 * нужно поле, каждая клетка имеет статус 1 иил 0
 * нужен муравей (направление текущее, координаты на поле)
 *
 * сначала инициализируем поле - массив двумерный, нули и единцы, случайным образом
 * затем случайные координаты муравья и случайное направление (для упрощения - центр поля, смотрит вверх)
 * у муравья 4 направления: лево-право-верх-низ. это можно условно обозначить цифрами, 1-4
 * то есть муравей - массив, состоит из 3 элементов: х, у и направление
 *
 * итого в начале имеем два массива.
 *
 * отрисовка - как и жизнь, табличкой. сначала отрисовать поле, в процессе уложить муравья (просто точка иного цвета)
 * положение и направление муравья хранить в отдельной переменной
 *
 * следующий шаг - отправляем текущее поле и муравья, два массива
 * на сервере обсчитываем новое поле исходя из муравья, и обновляем самого муравья
 *
 * отрисовываем
 *
 * повторить до бесконености
 */
include '../functions.php';

function initWorld(&$world, &$ant, $size)
{
    if (!is_array($world) || empty($world)) {
        $world = array();
    }
    if (!is_array($ant) || empty($ant)) {
        $ant = array(
            'x' => 15,
            'y' => 15,
            'd' => mt_rand(1, 4)
        );
    }

    for ($i = 0; $i < $size; $i++) {
        $world[$i] = array();
        for ($j = 0; $j < $size; $j++) {
            $world[$i][$j] = mt_rand(0, 1);
        }
    }
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


function getNewAnt($ant, $d)
{
    $newAnt = [];
    $current = $ant['d'] + $d;

    if ($current < 1) {
        $current = 4;
    } elseif ($current > 4) {
        $current = 1;
    }
    $newAnt = [
        'x' => $ant['x'],
        'y' => $ant['y'],
        'd' => $current
    ];
    $newAnt['d'] = $current;

    switch ($newAnt['d']) {
        case 1:
            $newAnt['x'] += 1;
            break;
        case 2:
            $newAnt['y'] += 1;
            break;
        case 3:
            $newAnt['x'] -= 1;
            break;
        case 4:
            $newAnt['y'] -= 1;
            break;
    }

    return $newAnt;
}

function iterateWorld(&$world, &$a, $size)
{
    $d = 1;
    if (!$world[$a['x']][$a['y']]) {
        $d *= -1;
    }
    $world[$a['x']][$a['y']] = !$world[$a['x']][$a['y']];
    $a = getNewAnt($a, $d);
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {

    $state = isset($_REQUEST['state']) ? $_REQUEST['state'] : array();
    $a = isset($_REQUEST['ant']) ? $_REQUEST['ant'] : array();

    $result = array();

    if (empty($state)) {
        initWorld($result, $a, $n);
    } else {
        iterateWorld($state, $a, $n);
    }

    $response = array(
        'state' => $state,
        'ant' => $a
    );

    echo json_encode($response);
    die;
}

$n = 30;
$ant = [];
$world = [];

initWorld($world, $ant, $n);

?>

<html>
<head>
    <title>Langton Ant</title>
    <script
            src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
            crossorigin="anonymous"></script>
    <style>
        .world {
            border: 1px solid green;
        }

        .cell {
            width: 15px;
            height: 15px;

            border-right: 1px solid lightgray;
            border-top: 1px solid lightgray;
        }

        tr:first-child .cell {
            border-top: none;
        }

        .cell:last-child {
            border-right: none;
        }

        .cell.filled {
            background: lightblue;
        }

        .field {
            float: left;
            margin-right: 10px;
        }

        .cell.ant {
            background: red !important;
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
                            <td class="cell
                            <?php echo ($ant['x'] == $i && $ant['y'] == $j) ? 'ant  ' : ''; ?>
                            <?php echo ($world[$i][$j]) ? 'filled' : ''; ?>">

                            </td>
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

    function setWorldState(response) {
        var cells = $('.world td');
        ant = response.ant;
        cells.removeClass('filled');
        cells.removeClass('ant');
        var size = parseInt(<?php echo $n; ?>);

        var cntr = 0;
        for (var i = 0; i < size; i++) {
            for (var j = 0; j < size; j++) {
                var cell = $(cells[cntr]);
                if (response.state[i][j] > 0) {
                    cell.addClass('filled')
                }
                if (i === parseInt(ant.x) && j === parseInt(ant.y)) {
                    cell.addClass('ant');
                }
                cntr++;
            }
        }

        return response.state;
    }

    function step() {
        var state = getWorldState();
        $.ajax({
            url: 'http://playground.local/ant/',
            type: 'post',
            dataType: 'json',
            data: {
                ant: ant,
                state: state
            },
            success: function (response) {
                setWorldState(response);
                var str = 'Step ' + totalCntr;
                $('.steps-list').append($('<li>' + str + '</li>'));

                totalCntr++;

                if (auto) {
                    setTimeout(function () {
                        step();
                    }, 500);
                }
            }
        });
    }

    var totalCntr = 1, auto = false, ant = {};
    $(document).ready(function () {
        ant = {
            x: parseInt('<?php echo $ant["x"]; ?>'),
            y: parseInt('<?php echo $ant["y"]; ?>'),
            d: parseInt('<?php echo $ant["d"]; ?>')
        };
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
