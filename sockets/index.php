<?php
/**
 * Created by PhpStorm.
 * User: sovkutsan
 * Date: 6/26/18
 * Time: 10:27 AM
 */
?>
<html>
<head>
    <title>Sockets</title>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
</head>
<body>
<button id="some-btn">Some btn</button>
<script>
    var webSocket = null;
    $(document).ready(function (e) {
        webSocket = new WebSocket('ws://127.0.0.1:1915');

        webSocket.onopen = function (event) {
            alert('onopen');
            webSocket.send("Hello Web Socket!");
        };

        webSocket.onmessage = function (event) {
            alert('onmessage, ' + event.data);
        };

        webSocket.onclose = function (event) {
            alert('onclose');
            console.log(event);
        };
    });
    $(document).on('click', '#some-btn', function (e) {
        if(webSocket === null) {
            return;
        }
        //webSocket.send(' TEST WTF ');
        //webSocket.send('Test');
        webSocket.send('\n' +
            'Строка формата состоит из нуля и более директив: обычных символов (за исключением %), которые копируются напрямую в результирующую строку, и описателей преобразований, каждый из которых заменяется на один из параметров. Это относится как к sprintf(), так и к printf().\n' +
            '\n' +
            'Каждый описатель преобразований состоит из знака процента (%), за которым следует один или более дополнительных элементов (в том порядке, в котором они здесь перечислены):\n' +
            '\n' +
            'Необязательный описатель знака, указывающий как знак (- или +) будет применен к числу. По умолчанию используется только знак минус, если число отрицательное. Этот описатель заставляет положительные числа также отображать знак плюс.\n' +
            'Необязательный описатель заполнения, который определяет, какой символ будет использоваться для дополнения результата до необходимой длины. Это может быть пробел или 0. По умолчанию используется пробел. Альтернативный символ может быть указан с помощью одинарной кавычки (\'). См. примеры ниже.\n' +
            'Необязательный описатель выравнивания, определяющий выравнивание влево или вправо. По умолчанию выравнивается вправо, символ - используется для выравнивания влево.\n' +
            'Необязательное число, описатель ширины, определяющий минимальное число символов, которое будет содержать результат этого преобразования.\n' +
            'Необязательный описатель точности, указанный в виде точки (.), после которой следует необязательная строка из десятичных чисел, определяющая, сколько десятичных разрядов отображать для чисел с плавающей точкой. При использовании со строками этот описатель выступает в роли обрезающей точки, устанавливающей максимальный лимит символов. Также между точкой и цифрой можно указать символ, используемый при дополнении числа.\n' +
            'Описатель типа, определяющий, как трактовать тип данных аргумента. Допустимые типы:\n' +
            '\n' +
            '% - символ процента. Аргумент не используется.\n' +
            'b - аргумент трактуется как целое и выводится в виде двоичного числа.\n' +
            'c - аргумент трактуется как целое и выводится в виде символа с соответствующим кодом ASCII.\n' +
            'd - аргумент трактуется как целое и выводится в виде десятичного числа со знаком.\n' +
            'e - аргумент трактуется как число в научной нотации (например, 1.2e+2). Описатель точности указывает на количество знаков после запятой, начиная с PHP 5.2.1. В более ранних версиях он обозначал количество значащих цифр (на один знак меньше).\n' +
            'E - аналогично %e, но использует заглавную букву (например, 1.2E+2).\n' +
            'f - аргумент трактуется как число с плавающей точкой и также выводится в зависимости от локали.\n' +
            'F - аргумент трактуется как число с плавающей точкой и также выводится, но без зависимости от локали. Доступно с PHP 5.0.3.\n' +
            'g - выбирает самую краткую запись из %e и %f.\n' +
            'G - выбирает самую краткую запись из %E и %f.\n' +
            'o - аргумент трактуется как целое и выводится в виде восьмеричного числа.\n' +
            's - аргумент трактуется как строка.\n' +
            'u - аргумент трактуется как целое и выводится в виде десятичного числа без знака.\n' +
            'x - аргумент трактуется как целое и выводится в виде шестнадцатеричного числа (в нижнем регистре).\n' +
            'X - аргумент трактуется как целое и выводится в виде шестнадцатеричного числа (в верхнем регистре).\n' +
            'Переменные будут преобразованы в соответвующий тип для спецификатора:'+
            'Строка формата состоит из нуля и более директив: обычных символов (за исключением %), которые копируются напрямую в результирующую строку, и описателей преобразований, каждый из которых заменяется на один из параметров. Это относится как к sprintf(), так и к printf().\n' +
            '\n' +
            'Каждый описатель преобразований состоит из знака процента (%), за которым следует один или более дополнительных элементов (в том порядке, в котором они здесь перечислены):\n' +
            '\n' +
            'Необязательный описатель знака, указывающий как знак (- или +) будет применен к числу. По умолчанию используется только знак минус, если число отрицательное. Этот описатель заставляет положительные числа также отображать знак плюс.\n' +
            'Необязательный описатель заполнения, который определяет, какой символ будет использоваться для дополнения результата до необходимой длины. Это может быть пробел или 0. По умолчанию используется пробел. Альтернативный символ может быть указан с помощью одинарной кавычки (\'). См. примеры ниже.\n' +
            'Необязательный описатель выравнивания, определяющий выравнивание влево или вправо. По умолчанию выравнивается вправо, символ - используется для выравнивания влево.\n' +
            'Необязательное число, описатель ширины, определяющий минимальное число символов, которое будет содержать результат этого преобразования.\n' +
            'Необязательный описатель точности, указанный в виде точки (.), после которой следует необязательная строка из десятичных чисел, определяющая, сколько десятичных разрядов отображать для чисел с плавающей точкой. При использовании со строками этот описатель выступает в роли обрезающей точки, устанавливающей максимальный лимит символов. Также между точкой и цифрой можно указать символ, используемый при дополнении числа.\n' +
            'Описатель типа, определяющий, как трактовать тип данных аргумента. Допустимые типы:\n' +
            '\n' +
            '% - символ процента. Аргумент не используется.\n' +
            'b - аргумент трактуется как целое и выводится в виде двоичного числа.\n' +
            'c - аргумент трактуется как целое и выводится в виде символа с соответствующим кодом ASCII.\n' +
            'd - аргумент трактуется как целое и выводится в виде десятичного числа со знаком.\n' +
            'e - аргумент трактуется как число в научной нотации (например, 1.2e+2). Описатель точности указывает на количество знаков после запятой, начиная с PHP 5.2.1. В более ранних версиях он обозначал количество значащих цифр (на один знак меньше).\n' +
            'E - аналогично %e, но использует заглавную букву (например, 1.2E+2).\n' +
            'f - аргумент трактуется как число с плавающей точкой и также выводится в зависимости от локали.\n' +
            'F - аргумент трактуется как число с плавающей точкой и также выводится, но без зависимости от локали. Доступно с PHP 5.0.3.\n' +
            'g - выбирает самую краткую запись из %e и %f.\n' +
            'G - выбирает самую краткую запись из %E и %f.\n' +
            'o - аргумент трактуется как целое и выводится в виде восьмеричного числа.\n' +
            's - аргумент трактуется как строка.\n' +
            'u - аргумент трактуется как целое и выводится в виде десятичного числа без знака.\n' +
            'x - аргумент трактуется как целое и выводится в виде шестнадцатеричного числа (в нижнем регистре).\n' +
            'X - аргумент трактуется как целое и выводится в виде шестнадцатеричного числа (в верхнем регистре).\n' +
            'Переменные будут преобразованы в соответвующий тип для спецификатора:'+
            'Строка формата состоит из нуля и более директив: обычных символов (за исключением %), которые копируются напрямую в результирующую строку, и описателей преобразований, каждый из которых заменяется на один из параметров. Это относится как к sprintf(), так и к printf().\n' +
            '\n' +
            'Каждый описатель преобразований состоит из знака процента (%), за которым следует один или более дополнительных элементов (в том порядке, в котором они здесь перечислены):\n' +
            '\n' +
            'Необязательный описатель знака, указывающий как знак (- или +) будет применен к числу. По умолчанию используется только знак минус, если число отрицательное. Этот описатель заставляет положительные числа также отображать знак плюс.\n' +
            'Необязательный описатель заполнения, который определяет, какой символ будет использоваться для дополнения результата до необходимой длины. Это может быть пробел или 0. По умолчанию используется пробел. Альтернативный символ может быть указан с помощью одинарной кавычки (\'). См. примеры ниже.\n' +
            'Необязательный описатель выравнивания, определяющий выравнивание влево или вправо. По умолчанию выравнивается вправо, символ - используется для выравнивания влево.\n' +
            'Необязательное число, описатель ширины, определяющий минимальное число символов, которое будет содержать результат этого преобразования.\n' +
            'Необязательный описатель точности, указанный в виде точки (.), после которой следует необязательная строка из десятичных чисел, определяющая, сколько десятичных разрядов отображать для чисел с плавающей точкой. При использовании со строками этот описатель выступает в роли обрезающей точки, устанавливающей максимальный лимит символов. Также между точкой и цифрой можно указать символ, используемый при дополнении числа.\n' +
            'Описатель типа, определяющий, как трактовать тип данных аргумента. Допустимые типы:\n' +
            '\n' +
            '% - символ процента. Аргумент не используется.\n' +
            'b - аргумент трактуется как целое и выводится в виде двоичного числа.\n' +
            'c - аргумент трактуется как целое и выводится в виде символа с соответствующим кодом ASCII.\n' +
            'd - аргумент трактуется как целое и выводится в виде десятичного числа со знаком.\n' +
            'e - аргумент трактуется как число в научной нотации (например, 1.2e+2). Описатель точности указывает на количество знаков после запятой, начиная с PHP 5.2.1. В более ранних версиях он обозначал количество значащих цифр (на один знак меньше).\n' +
            'E - аналогично %e, но использует заглавную букву (например, 1.2E+2).\n' +
            'f - аргумент трактуется как число с плавающей точкой и также выводится в зависимости от локали.\n' +
            'F - аргумент трактуется как число с плавающей точкой и также выводится, но без зависимости от локали. Доступно с PHP 5.0.3.\n' +
            'g - выбирает самую краткую запись из %e и %f.\n' +
            'G - выбирает самую краткую запись из %E и %f.\n' +
            'o - аргумент трактуется как целое и выводится в виде восьмеричного числа.\n' +
            's - аргумент трактуется как строка.\n' +
            'u - аргумент трактуется как целое и выводится в виде десятичного числа без знака.\n' +
            'x - аргумент трактуется как целое и выводится в виде шестнадцатеричного числа (в нижнем регистре).\n' +
            'X - аргумент трактуется как целое и выводится в виде шестнадцатеричного числа (в верхнем регистре).\n' +
            'Переменные будут преобразованы в соответвующий тип для спецификатора:');
        console.log(webSocket);
    });
</script>
</body>
</html>