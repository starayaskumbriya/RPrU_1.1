<?php


session_start();
$topicName = preg_replace('/[^a-zа-я]/ui', '', json_encode($_SESSION['session2']));
$topicNumber = preg_replace('/[^0-9]/ui', '', json_encode($_SESSION['session2']));

$img1x1 = [];
$otherImg = [];



if($topicName == 'RPrU') {
    
    if($topicNumber == 11) {
        for($i = 0; $i < 100; $i++) {
            if(file_exists('img/img_'.$topicName.'11/element'.$i.'.png')) array_push($img1x1, $i);
        }
    }
    else {
        for($i = 0; $i < 100; $i++) {
            if(file_exists('img/img_'.$topicName.'1-10/element'.$i.'.png')) array_push($img1x1, $i);
        }
    }
}




if($topicName == 'VC' && $topicNumber >= 0 && $topicNumber <= 14) {
    for($i = 0; $i < 100; $i++) {
        if(file_exists('img/img_'.$topicName.'1-14/element'.$i.'.png')) array_push($img1x1, $i);
    }
}




if($topicName == 'URS' && $topicNumber >= 0 && $topicNumber <= 34) {
    for($i = 0; $i < 100; $i++) {
        if(file_exists('img/img_'.$topicName.'1-34/element'.$i.'.png')) array_push($img1x1, $i);
    }

    for($i = 0; $i < 100; $i++) {
        if(file_exists('img/img_'.$topicName.'1-34/otherElement'.$i.'.png')) array_push($otherImg, $i);
    }
}



if($topicName == 'PCH') {

    if($topicNumber == 15) {
        for($i = 0; $i < 100; $i++) {
            if(file_exists('img/img_'.$topicName.'15/element'.$i.'.png')) array_push($img1x1, $i);
        }
    
        for($i = 0; $i < 100; $i++) {
            if(file_exists('img/img_'.$topicName.'15/otherElement'.$i.'.png')) array_push($otherImg, $i);
        }
    }

    if(in_array($topicNumber, [4, 5, 6, 8, 13, 14])) {
        for($i = 0; $i < 100; $i++) {
            if(file_exists('img/img_'.$topicName.'4-6,8,13,14/element'.$i.'.png')) array_push($img1x1, $i);
        }
    }

    if($topicNumber == 7 || $topicNumber == 10) {
        for($i = 0; $i < 100; $i++) {
            if(file_exists('img/img_'.$topicName.'7,10/element'.$i.'.png')) array_push($img1x1, $i);
        }
    }

    if(in_array($topicNumber, [1, 2, 3, 9, 11, 12])) {
        for($i = 0; $i < 100; $i++) {
            if(file_exists('img/img_'.$topicName.'1-3,9,11,12/element'.$i.'.png')) array_push($img1x1, $i);
        }
        
        for($i = 0; $i < 100; $i++) {
            if(file_exists('img/img_'.$topicName.'1-3,9,11,12/otherElement'.$i.'.png')) array_push($otherImg, $i);
        }
    }

}



if($topicName == 'detector') {
    if($topicNumber > 0 && $topicNumber <= 6) {
        for($i = 0; $i < 100; $i++) {
            if(file_exists('img/img_'.$topicName.'1-6/element'.$i.'.png')) array_push($img1x1, $i);
        }
    }
    else {
        for($i = 0; $i < 100; $i++) {
            if(file_exists('img/img_'.$topicName.'7-19/element'.$i.'.png')) array_push($img1x1, $i);
        }
    }
}



// -----------------------------------------------------------------------------------------------
if($topicName == 'FiGSvCRS') {
    for($i = 0; $i < 100; $i++) {
        if(file_exists('img/img_'.$topicName.'1-10/element'.$i.'.png')) array_push($img1x1, $i);
    }
    
    for($i = 0; $i < 100; $i++) {
        if(file_exists('img/img_'.$topicName.'1-10/otherElement'.$i.'.png')) array_push($otherImg, $i);
    }
}
// -----------------------------------------------------------------------------------------------



$amountImg1x1 = count($img1x1);
$amountOtherImg = count($otherImg);


?> 