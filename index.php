<?php 

header('Content-type: text/html; charset=utf-8');

require(__DIR__ . '/vendor/autoload.php');


$params = array_merge(
    require(__DIR__ . '/config.php')
);

$fmt = datefmt_create(
    'ru_RU',
    IntlDateFormatter::SHORT,
    IntlDateFormatter::SHORT,
    'UTC',
    IntlDateFormatter::GREGORIAN
);

$db = new MysqliDb ($params['db_config']);

echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>';
echo '<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">';
echo '<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>';



/*

action block's

*/


if(isset($_GET['bank']) and $_GET['bank']!=null)
{
echo "<a href='#' onclick='history.back()'>Вернуться назад</a> <br />"; 

$db->where ("bank_id", $_GET['bank']);
$provodki = $db->get("provodki");
echo '<table class="td-prov"><tbody><tr><td>Дата</td><td>Коментарий</td><td>Сумма</td></tr></tbody>';
if ($db->count > 0)
    foreach ($provodki as $prov) { 
        $date = datefmt_format($fmt, $prov['date']);
        echo "<tr><td>{$date}</td><td>{$prov['com']}</td><td>{$prov['sum']}</td>";
    }

echo '</table>';
    $db->where ("bank_id", $_GET['bank']);
    $sum = $db->getValue("provodki", "sum(sum)");
    echo "Итого: {$sum} <br />";
    die;
} //end if(isset($_GET['bank']) and $_GET['bank']!=null)



if (isset($_GET['edit_sob'])) {
    echo "<a href='{$_SERVER["HTTP_REFERER"]}'>Вернуться назад</a> <br />"; 

    echo "
        <script type='text/javascript'>
            $(function(){
                // откуда берем данные сформы
                $('#edit_sob').submit(function(e){
                    //отменяем стандартное действие при отправке формы
                    e.preventDefault();
                    //берем из формы метод передачи данных
                    var m_method=$(this).attr('method');
                    //получаем адрес скрипта на сервере, куда нужно отправить форму
                    var m_action=$(this).attr('action');
                    //получаем данные, введенные пользователем в формате input1=value1&input2=value2...,
                    //то есть в стандартном формате передачи данных формы
                    var m_data=$(this).serialize();
                    $.ajax({
                        type: m_method,
                        url: m_action,
                        data: m_data,
                        success: function(result){
                            // где показываем результат
                            $('#sob_result').html(result);
                        }
                    });
                });
            });
        </script>    
        ";

    echo '
                <form action="up_sob.php" method="POST" id="edit_sob">
                <fieldset>
                <legend>Изменение событий</legend>';

    $sob = dbObject::table('sob')->get();
    $db->orderBy("sort","asc");
    $sob = sob::get();
    //var_dump($sob);
    foreach ($sob as $s) {

        echo "<label for='name'>Событие {$s->sort}:</label><input type='text' id='com_{$s->id}' name='sob[{$s->id}][com]' value='{$s->com}' size='10'><input type='text' id='kef_{$s->id}' name='sob[{$s->id}][kef]' value='".round($s->kef,2)."' size='3'> <br />";

    }                        


    echo '      <input type="submit" value="Изменить">
                </fieldset>
                </form>
                <div id="sob_result"></div>

        ';

    die;
}

/*

action block's

*/



$bank = dbObject::table('bank')->get();
$bank = bank::get();

foreach ($bank as $b) {
    echo "<a href='?bank={$b->id}'>{$b->name} ({$b->name_vlad})</a>";

    $db->where ("bank_id", $b->id);
    $sum = $db->getValue ("provodki", "sum(sum)");
    echo "Баланс: {$sum} <br />";

}


$sob = dbObject::table('sob')->get();
$db->orderBy("sort","asc");
$sob = sob::get();

echo '<div id="sortable">';

foreach ($sob as $s) {

    echo "<div id='{$s->id}''>Событие: {$s->com} Кэф: ".round($s->kef,2)."</div>";

}

echo '</div>';

echo "<a href='?edit_sob=1'>Изменить события</a>";

/*
echo '
<form method="post" action="stav.php"> 
    <div id="sortable">
	<div id="sort_1">A: <input type="text" name="A" size="10" maxlength="10" value="'.$_POST["A"].'"></div> <br />
	<div id="sort_2">B: <input type="text" name="B" size="10" maxlength="10" value="'.$_POST["B"].'"></div> <br />
	<div id="sort_3">C: <input type="text" name="C" size="10" maxlength="10" value="'.$_POST["C"].'"></div> <br />
	<div id="sort_4">D: <input type="text" name="D" size="10" maxlength="10" value="'.$_POST["D"].'"></div> <br />
    </div>
	<input type="submit" value="Показать варинаты">
</form>
    <div id="info" class="ui-widget">
        <div>ID элемента: <span id="itemId">не определено</span></div>
        <div>Позиция: <span id="pos">не определено</span></div>
    </div>

';
*/

echo "
  <script>
$(function() {
    
    $('#sortable').sortable({

        update: function () {

                var neworder = new Array();

                $('#sortable div').each(function() {    

                    //get the id
                    var id  = $(this).attr('id');
                    //push the object into the array
                    neworder.push(id);

                });

                $.post('sort.php',{'neworder': neworder},function(data){ $('#var').html(data);});

            }
    });
    
});
  </script>
 ";

function factorial ($n)
{
    if($n <= 1) 
    {
        return 1;
    }
    else 
    {
        return $n * factorial($n - 1);
    }
};

$q = factorial(4);

$w = factorial(2);

//echo $q/($w*$w); //кол-во комбинаций

echo '<div id="var">';

$sob = dbObject::table('sob')->get();
$db->orderBy("sort","asc");
$sob = sob::get();

foreach ($sob as $s) {
    $m[]= round($s->kef,2);
}




echo '1-2 :' . round($m['0']*$m['1'],2) .'<br />';

echo '3-4 :' . round($m['2']*$m['3'],2) .'<br />';

echo '1-3 :' . round($m['0']*$m['2'],2) .'<br />';

echo '2-3 :' . round($m['1']*$m['2'],2) .'<br />';


echo '</div>';


 ?>