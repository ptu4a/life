<? 
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

if (!CModule::IncludeModule("iblock")) {
	echo GetMessage("IBLOCK_MODULE_NOT_INSTALLED");
	return;
}

$ID = intval(htmlspecialchars($_POST["ID"]));

if ($ID) {
	if (CIBlockElement::Delete($ID))
	   echo 'Удален элемент '.$ID;
	else
	   echo 'Ошибка удаления элемента '.$ID;
}

?>