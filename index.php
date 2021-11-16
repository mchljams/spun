<?php require_once __DIR__ . '/vendor/autoload.php'; ?>

<?php 

$str = "{This is a|A} {string|text|message|statement} that {includes|contains|holds} {choices|options} {you |}{can|may} {spin|alternate}.";

$spinner = new Mchljams\Spun\Spinner($str);

$result = $spinner->spin();


echo $result;
echo "\n";
?>
