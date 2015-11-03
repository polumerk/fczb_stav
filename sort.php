<?php

require(__DIR__ . '/vendor/autoload.php');


$params = array_merge(
    require(__DIR__ . '/config.php')
);

$db = new MysqliDb ($params['db_config']);

$sount = 0;
$i = 0;
$Error = '';


$neworderarray['0'] = "";
$neworderarray= array_merge($neworderarray,$_POST['neworder']);
unset($neworderarray['0']);

//loop through the list of ids and update your db

foreach($neworderarray as $order=>$id){    

 $data = Array (
    'sort' => $order,
);
$db->where ('id', $id);
if ($db->update ('sob', $data))
  { $count++; }
else
  { $Error = $Error.''.$db->getLastError(); }

$i++;
}

if($count!=$i)
{ echo $Error; }
else { 


$sob = dbObject::table('sob')->get();
$db->orderBy("sort","asc");
$sob = sob::get();

foreach ($sob as $s) {
    $m[]=round($s->kef,2);
}

echo '1-2 :' . round($m['0']*$m['1'],2) .'<br />';

echo '3-4 :' . round($m['2']*$m['3'],2) .'<br />';

echo '1-3 :' . round($m['0']*$m['2'],2) .'<br />';

echo '2-3 :' . round($m['1']*$m['2'],2) .'<br />';

}