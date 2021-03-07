<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$cacheTime = 36000000;
		
// параметры навигации
$arNav = array(
	"nPageSize" => 20,
	"bDescPageNumbering" => false,
	"bShowAll" => false,
);
$arNavigation = CDBResult::GetNavParams($arNav);

if ($this->StartResultCache($cacheTime, $arNavigation)) {
	
	if (!CModule::IncludeModule("iblock")) {
		$this->AbortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}
	
	// получаем инфоблок
	$rsIBlock = CIBlock::GetList(array(), array(
		"ACTIVE" => "Y",
		"ID" => 4,
	));
	
	if ($arIBlock = $rsIBlock->GetNext()) {
		// сортировка
		$arSort = array(
			"NAME" => "ASC",
			"ID" => "DESC",
		);
		
		// фильтр
		$arFilter = array (
			"IBLOCK_ID" => $arIBlock["ID"],
			"IBLOCK_LID" => SITE_ID,
			"ACTIVE" => "Y",
		);
		
		// выборка
		
		$arSelect = array(
			"ID",
			"NAME",
			"PROPERTY_REGION",
			"PROPERTY_OBL",
		);
		
		// список элементов
		$rsCities = CIBlockElement::GetList($arSort, $arFilter, false, $arNav, $arSelect);
		while ($arCity = $rsCities->Fetch()) {
			$arResult["ITEMS"][] = $arCity;
		}
		
		// навигация в выдаче
		$arResult["NAV_STRING"] = $rsCities->GetPageNavStringEx($navComponentObject, "Города", ".default", false);
		$arResult["NAV_CACHED_DATA"] = $navComponentObject->GetTemplateCachedData();
		$arResult["NAV_RESULT"] = $rsCities;
		
		// для встроенного кеширования
		$this->SetResultCacheKeys(array(
			"ID",
			"IBLOCK_TYPE_ID",
			"LIST_PAGE_URL",
			"NAV_CACHED_DATA",
			"NAME",
			"ITEMS",
		));
		
		$this->IncludeComponentTemplate();
	}
	else
	{
		$this->AbortResultCache();
		ShowError(GetMessage("T_NEWS_NEWS_NA"));
		@define("ERROR_404", "Y");
		CHTTP::SetStatus("404 Not Found");
	}
}

if(isset($arResult["ID"])) {

	$this->SetTemplateCachedData($arResult["NAV_CACHED_DATA"]);
	return $arResult["ITEMS"];
}
?> 