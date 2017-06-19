var first = true,
    lastKey = 0,
    isFloat = false,
    display = $('#result');

$(document).keydown(function (e) {
    switch (e.which) {
        default:
            console.log(e.which);
            break;
        case 8:
        case 46:
            $('#btn-delete').click();
            break;
        case 13:
            $('#btn-enter').click();
            break;
        case 27:
            $('#btn-clear').click();
            break;
        case 42:
        case 106:
            $('#btn-multiply').click();
            break;
        case 43:
        case 107:
            $('#btn-add').click();
            break;
        case 45:
        case 109:
            $('#btn-subtract').click();
            break;
        case 47:
        case 111:
            $('#btn-divide').click();
            break;
        case 48:
        case 96:
            $('#btn-0').click();
            break;
        case 49:
        case 97:
            $('#btn-1').click();
            break;
        case 50:
        case 98:
            $('#btn-2').click();
            break;
        case 51:
        case 99:
            $('#btn-3').click();
            break;
        case 52:
        case 100:
            $('#btn-4').click();
            break;
        case 53:
        case 101:
            $('#btn-5').click();
            break;
        case 54:
        case 102:
            $('#btn-6').click();
            break;
        case 55:
        case 103:
            $('#btn-7').click();
            break;
        case 56:
        case 104:
            $('#btn-8').click();
            break;
        case 57:
        case 105:
            $('#btn-9').click();
            break;
        case 110:
        case 190:
            $('#btn-dot').click();
            break;
    }
});

$('#btn-clear').click(function () {
    clear();
});

$('#btn-delete').click(function () {
    deleteOne();
});

$('#btn-dot').click(function () {
    press('.');
});

$('#btn-add').click(function () {
   press('+');
});

$('#btn-subtract').click(function () {
    press('-');
});

$('#btn-divide').click(function () {
    press('/');
});

$('#btn-multiply').click(function () {
    press('*');
});

$('#btn-0').click(function () {
    press(0);
});

$('#btn-1').click(function () {
    press(1);
});

$('#btn-2').click(function () {
    press(2);
});

$('#btn-3').click(function () {
    press(3);
});

$('#btn-4').click(function () {
    press(4);
});

$('#btn-5').click(function () {
    press(5);
});

$('#btn-6').click(function () {
    press(6);
});

$('#btn-7').click(function () {
    press(7);
});

$('#btn-8').click(function () {
    press(8);
});

$('#btn-9').click(function () {
    press(9);
});

function clear() {
    first = true;
    isFloat = false;
    lastKey = 0;
    display.val(0);
}

function deleteOne() {
    var val = display.val();
    if (val == '0')
        return;

    if (val.length == 1)
        return clear();

    // Check if penultimate character is a space, if so we need to remove that too.
    var end = val.length - 1;
    if (/\s/.test(val[val.length - 2])) {
        end--;
    }
    val = val.substr(0, end);

    display.val(val);
}

function isNumber(test) {
    return $.isNumeric(test) || test === '.'
}

function press(key) {
    var val = key;

    if (first) {
        if (!isNumber(key)) {
            val = display.val() + " " + key;
        }
        display.val(val);
        lastKey = key;
        first = false;
        return;
    }

    if ((isNumber(key) && !isNumber(lastKey)) || ( !isNumber(key) && isNumber(lastKey))) {
        val = " " + key;
        isFloat = false;
    }

    if (key === ".") {
        if (isFloat)
            return;

        isFloat = true;
    }

    display.val(display.val() + val);
    lastKey = key;
}
