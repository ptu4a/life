<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this->addExternalJS("/local/js/script.js");?>

<?if (count($arResult["ITEMS"]) > 0):?>
	<?=$arResult["NAV_STRING"]?>
	<br><br>
	
	<table class="table">
		<tr><th>Город</th><th>Область, край</th><th>Федеральный субъект</th><th></th></tr>
		
		<?foreach($arResult["ITEMS"] as $arItem):?>	
			<?
			//получаем ссылки для редактирования и удаления элемента
			$arButtons = CIBlock::GetPanelButtons(
				$arItem["IBLOCK_ID"],
				$arItem["ID"],
				0,
				array("SECTION_BUTTONS"=>false, "SESSID"=>false)
			);
			$arItem["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
			$arItem["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
			 
			//добавляем действия (экшены) для управления элементом
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			
			<?
			$city = $arItem["NAME"];
			$obl = $arItem["PROPERTY_OBL_VALUE"];
			$region = $arItem["PROPERTY_REGION_VALUE"];
			?>
			
			<tr id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<td><?=$city?></td><td><?=$obl?></td><td><?=$region?></td>
				<td><a href="" class="city_del" data-id="<?=$arItem['ID']?>">Удалить</a></td>
			</tr>
		
		<?endforeach;?>
		
	</table>
	<br>
	<?=$arResult["NAV_STRING"]?>
<?endif?>