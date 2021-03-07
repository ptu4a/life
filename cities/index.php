<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Города");
?>

<? $APPLICATION->IncludeComponent(
	"life:cities.list",
	".default",
	Array(
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>