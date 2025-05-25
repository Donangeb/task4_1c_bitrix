<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
if (!$USER->IsAdmin()) {
     LocalRedirect('/');
}

\Bitrix\Main\Loader::includeModule('iblock');
$row = 1;
$IBLOCK_ID = 1;

$el = new CIBlockElement;
$arProps = [];

$rsElement = CIBlockElement::getList([], ['IBLOCK_ID' => 37],
    false, false, ['ID', 'NAME']);
while ($ob = $rsElement->GetNextElement()) {
    $arFields = $ob->GetFields();
    $key = str_replace(['»', '«', '(', ')'], '', $arFields['NAME']);
    $key = strtolower($key);
    $arKey = explode(' ', $key);
    $key = '';
    foreach ($arKey as $part) {
        if (strlen($part) > 2) {
            $key .= trim($part) . ' ';
        }
    }
    $key = trim($key);
    $arProps['OFFICE'][$key] = $arFields['ID'];
}

$rsProp = CIBlockPropertyEnum::GetList(
    ["SORT" => "ASC", "VALUE" => "ASC"],
    ['IBLOCK_ID' => $IBLOCK_ID]
);
while ($arProp = $rsProp->Fetch()) {
    $key = trim($arProp['VALUE']);
    $arProps[$arProp['PROPERTY_CODE']][$key] = $arProp['ID'];
}

$rsElements = CIBlockElement::GetList([], ['IBLOCK_ID' => $IBLOCK_ID], false, false, ['ID']);
while ($element = $rsElements->GetNext()) {
    CIBlockElement::Delete($element['ID']);
}

if (($handle = fopen("clothes.csv", "r")) !== false) {
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        if ($row == 1) {
            $row++;
            continue;
        }
        $row++;
        $PROP['CML2_LINK'] = $data[1];
        $PROP['ARTNUMBER'] = $data[2];
        $PROP['COLOR_REF'] = $data[3];
        $PROP['SIZES_SHOES'] = $data[4];
        $PROP['SIZES_CLOTHES'] = $data[5];
        $PROP['MORE_PHOTO'] = $data[6];


        $arLoadProductArray = [
            "MODIFIED_BY" => $USER->GetID(),
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID" => $IBLOCK_ID,
            "PROPERTY_VALUES" => $PROP,
            "NAME" => $data[2],
            "CODE" => CUtil::translit($data[2], "ru"),
            "ACTIVE" => end($data) ? 'Y' : 'N',
        ];
        if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
            echo "Добавлен элемент с ID : " . $PRODUCT_ID . "<br>";
        } else {
            echo "Error: " . $el->LAST_ERROR . '<br>';
        }
    }
    fclose($handle);
}