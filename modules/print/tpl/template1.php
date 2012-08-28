<?

$dir = $_SERVER['DOCUMENT_ROOT'];
require_once $dir . '/libs/phprtflite/lib/PHPRtfLite.php';

// register PHPRtfLite class loader
PHPRtfLite::registerAutoloader();

$rtf = new PHPRtfLite();
$sect = $rtf->addSection();
$testext = 'Для генерации ключей, можно воспользоваться инструментом ssh-keygen, который идет в комплекте с git (описание этого способа можно почитать тут). Мы же будем использовать PuTTY (а точнее небольшую программку puttygen, входящую в его состав). PuTTY — это такой клиент для удаленного доступа, в том числе и с использованием SSH.';

$sect->writeText($testext, new PHPRtfLite_Font(12), new PHPRtfLite_ParFormat(PHPRtfLite_ParFormat::TEXT_ALIGN_CENTER));

$genFileName = date('U').'.rtf';
// save rtf document
$rtf->sendRtf($dir . '/files/reports/' .$genFileName);
die();
?>