<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ТЕСТ ЧЕТЫРЕ");
?>

<?php // Обработка csv файла. Приведение номеров к единому стандарту. Для WhatsApp-рассылки. ?>

<?php

/*

// Номера из дисконтных карт 26.01.2023

$res_file = fopen('excel_files/discont_phones_reault.csv', 'w');
if (($handle = fopen("excel_files/discont_phones.csv", "r")) !== FALSE) {
    while ($data = fgetcsv($handle, 1000, ";")) {
        
        if ($data[0] && $data[2]) {
            $data[0] = trim($data[0]);
            $data[0] = str_replace("  ", " ", $data[0]);
            $data[0] = str_replace("   ", " ", $data[0]);
            
            $data[2] = trim($data[2]);
            $data[2] = str_replace("  ", " ", $data[2]);
            $data[2] = str_replace("   ", " ", $data[2]);
            
            $data[2] = explode(",", $data[2]);
            
            foreach ($data[2] as $key => $val) {
                if (stripos($val, ";") == true) {
                    $val = explode(";", $val);
                    foreach ($val as $key => $val2) {
                        $val2 = preg_replace("/[^0-9]/", "", $val2);
                        $arPhones[$data[0]][] = $val2;
                    }
                } else {
                    $val = preg_replace("/[^0-9]/", "", $val);
                    $arPhones[$data[0]][] = $val;
                }
            }

        }
    }
    
    
    foreach ($arPhones as $key => $val) {
        foreach ($val as $val2) {
            if (mb_strlen($val2) == 11) {
                if ($val2[0] == 8) {
                    $val2[0] = 7;
                    $arResult[$key][] = $val2;
                }
            } elseif (mb_strlen($val2) == 10) {
                if ($val2[0] == 9) {
                    $val2 = "7" . $val2;
                    $arResult[$key][] = $val2;
                }
            }
        }
    }
    
    foreach ($arResult as $key => $val) {
        $arResult[$key] = array_unique($arResult[$key]);
    }
    
    foreach ($arResult as $key => $val) {
        foreach ($val as $key2 => $val2) {
            $arWrite[$key][$key2][] = $val2;
            $arWrite[$key][$key2][] = $key;
        }
    }

    foreach ($arWrite as $key => $val) {
        
        foreach ($val as $val2) {
            //pprint ($val2);
        }
        
        //fputcsv($res_file, $val);
    }
}

*/

/////////////////////////////////////////////////////////

/*

// 09.01.2023

$fp = fopen('excel_files/phone_numbers_new.csv', 'w');
$fp_exp = fopen('excel_files/phone_numbers_exception.csv', 'w');

$arPhones = array();

if (($handle = fopen("excel_files/phone_numbers.csv", "r")) !== FALSE) {
    while ($data = fgetcsv($handle, 1000, ";")) {
        
        $data[0] = trim($data[0]);
        $data[0] = str_replace("  ", " ", $data[0]);
        $data[0] = str_replace("   ", " ", $data[0]);
        
        $arCheck[$data[0]][1] = $data[1];
        $arCheck[$data[0]][2] = $data[2];
        
        if ($data[1] || $data[2]) {
            
            $data[1] = trim($data[1]);
            $data[2] = trim($data[2]);
            
            $data[1] = str_replace("  ", " ", $data[1]);
            $data[1] = str_replace("   ", " ", $data[1]);

            $data[2] = str_replace("  ", " ", $data[2]);
            $data[2] = str_replace("   ", " ", $data[2]);
           
            $data[1] = explode(",", $data[1]);
            
            foreach ($data[1] as $key => $val) {
                if (stripos($val, ";") == true) {
                    $val = explode(";", $val);
                    foreach ($val as $key => $val2) {
                        $arPhones[$data[0]]["PHONE"][] = preg_replace("/[^0-9]/", "", $val2);
                    }
                } elseif (stripos($val, "¶") == true) {
                    $val = explode("¶", $val);
                    foreach ($val as $key => $val2) {
                        $arPhones[$data[0]]["PHONE"][] = preg_replace("/[^0-9]/", "", $val2);
                    }
                } elseif (stripos($val, "/") == true) {
                    $val = explode("/", $val);
                    foreach ($val as $key => $val2) {
                        $arPhones[$data[0]]["PHONE"][] = preg_replace("/[^0-9]/", "", $val2);
                    }
                } else {
                    $arPhones[$data[0]]["PHONE"][] = preg_replace("/[^0-9]/", "", $val);
                }
            }
            if ($data[2]) {
                if (stripos($data[2], ",") == true) {
                    $data[2] = explode(",", $data[2]);
                    foreach ($data[2] as $key => $val) {
                        $number = preg_replace("/[^0-9]/", "", $val);
                        if ($number) {
                            $arPhones[$data[0]]["WA"][] = $number;
                        }
                    }
                } else {
                    $number = preg_replace("/[^0-9]/", "", $data[2]);
                    if ($number) {
                        $arPhones[$data[0]]["WA"][] = $number;
                    }
                }
            }
                            
        }
    }
    
    foreach ($arPhones as $key => $val) {
        
        if ($val["WA"]) {
            foreach ($val["WA"] as $wa_key => $wa_val) {
                if (mb_strlen($wa_val) == 11) {
                    if ($wa_val[1] == 9) {
                        if ($wa_val[0] == 8) {
                            $wa_val[0] = 7;
                        }
                        $arResult[$key] = $wa_val;
                    }
                }
            }
        }
        
        if (!$arResult[$key]) {
            if ($val["PHONE"]) {
                foreach ($val["PHONE"] as $wa_key => $wa_val) {
                    if (mb_strlen($wa_val) == 11) {
                        if ($wa_val[1] == 9) {
                            if ($wa_val[0] == 8) {
                                $wa_val[0] = 7;
                            }
                            $arResult[$key] = $wa_val;
                        }
                    }
                    if (mb_strlen($wa_val) == 10) {
                        if ($wa_val[0] == 9) {
                            $wa_val = "7" . $wa_val;
                            $arResult[$key] = $wa_val;
                        }
                    }
                }
            }
        }
        
    }

    
    foreach ($arCheck as $key => $val) {
        $arException[$key][0] = $key;
        $arException[$key][1] = $val[1];
        $arException[$key][2] = $val[2];
    }
    
    foreach ($arResult as $key => $val) {
        $arWrite[$key][0] = $key;
        $arWrite[$key][1] = $val;
        unset ($arException[$key]);
    }
    
    
    foreach ($arWrite as $key => $val) {
        fputcsv($fp, $val);
    }
    
    foreach ($arException as $key => $val) {
        fputcsv($fp_exp, $val);
    }
    
    fclose($handle);
}
*/

/////////////////////////////////////////////////////////

/*

// 10.01.2023

mb_internal_encoding("UTF-8");

$fp = fopen('excel_files/numbers_10.01.2023_result.csv', 'w');

$arResult = array();

if (($handle = fopen("excel_files/numbers_10.01.2023.csv", "r")) !== FALSE) {
    while ($data = fgetcsv($handle, 1000, ";")) {
        
        $data[1] = trim($data[1]);
        $data[1] = str_replace("  ", " ", $data[1]);
        $data[1] = str_replace("   ", " ", $data[1]);
        $data[1] = str_replace("    ", " ", $data[1]);
        $data[1] = str_replace("\n\r", " ", $data[1]);
        $data[1] = str_replace("\n", " ", $data[1]);
        $data[1] = str_replace("\r", " ", $data[1]);

        $phones = explode (",", $data[0]);
        
        foreach ($phones as $key => $val) {
            
            $val = trim($val);
            $val = preg_replace("/[^0-9]/", "", $val);
            
            if (mb_strlen($val) == 11 && $val[0] == 8) {
                $val[0] = "7";
            } elseif (mb_strlen($val) == 10) {
                $val = "7" . $val;
            }
            
            if ($val[1] == 9) {
                $arResult[$val][0] = $val;
                $arResult[$val][1] = $data[1];
            }
        }
    }
    
    pprint ($arResult);
    
    foreach ($arResult as $key => $val) {
        fputcsv($fp, $val);
    }
    
}

*/

?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>