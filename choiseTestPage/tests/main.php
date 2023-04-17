<?php include_once 'php/amountImg.php'; ?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/general_img/capy6.png">
    <!-- <link rel="stylesheet" href="css/style.css"> -->

</head>
<body>
    <form id="form" action="index.php" method="post">
        <h3 id="exercise">Составить </h3>
        <div id="pulloutMenu" class="pulloutMenu">
            <button type="button" class="pullupButton" id="pullupButton" onclick="pulloutMenu();"></button>
            <div id="containerClosedMenu">
                <button type="submit" class="schemaValidation" id="schemaValidation">проверить схему</button>
                <button type="button" class="changePageMode" id="changePageModeId" onclick="changePageMode();"></button>
                <div id="timer"></div>
            </div>
            <div id="containerOpenMenu" class="containerOpenMenu">





                <ul>
                    <li>ссылки на литературу по теме</li>
                    <ul>
                    <li>бла бла</li>
                        <li>бла бла</li>
                        <li>бла бла</li>
                        <li>бла бла</li>
                        <li>бла бла</li>
                        <li>бла бла</li>
                        <li>бла бла</li>
                        <li>бла бла</li>
                    </ul> 
                    <li>
                        <a id="questionsAndSuggestions">вопросы и предложения</a>
                    </li>
        
                    <li>
                        <a id="bugReport">сообщить о баге</a>
                    </li>
                </ul> 




            </div>
        </div>
        <div class="mainField" id="mainField"></div>
        <div class="schemaElementTable" id="schemaElementTable"></div>
        
    </form>
    
    
    
    <style>
        .schemaValidation {
            height: 70px;
            width: 120px;
            position: absolute;
            border-radius: 5px; 
            font-size: 18px;
            font-weight: 600;
            right : 10px; 
            top: 60px;
        }
        .schemaValidation:hover {
            background-color: rgb(186, 184, 184);
        }

        * {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
 
        .pulloutMenu {
            position: fixed; 
            top: 0px; 
            right: 0px; 
            width: 140px; 
            height: 190px; 
            border: 2px solid black; 
            border-right-width: 0px; 
            border-top-width: 0px;     
        }
        .pullupButton {
            width: 30px;
            height: 30px;
            border-radius: 0 100% 0 0;
            border-bottom-width: 0;
            border-left-width: 0;
            position: absolute; 
            bottom: 0;
            background-image: url("img/general_img/openArrow.png"); 
        }

        .changePageMode {
            height: 50px;
            width: 50px;
            position: absolute;
            border-radius: 5px;
            right: 42.5px;
            top: 135px;
            border: none;
            background-size: cover;
            background-image: url("img/general_img/darkModeIcon.png"); 
        }

        .containerOpenMenu {
            display: none;
        }





        #schemaElementTable::-webkit-scrollbar {
            width: 10px;
        }

        #schemaElementTable::-webkit-scrollbar-track {
            background-color: rgb(194, 234, 247);
        }

        #schemaElementTable::-webkit-scrollbar-thumb {
            background-color: rgb(166, 166, 166);
            border-radius: 7.5px;
            border: 2px solid rgb(194, 234, 247);       
        }

        #schemaElementTable::-webkit-scrollbar-thumb:hover {
            background-color: rgb(190, 190, 190);     
        }







    </style>


    <svg id="starRate" class="starRate" width="0" height="50" >
        <defs>
            <mask id="perc">
                <rect x="0" y="0" width="100%" height="100%" fill="white" /> 
                <rect id="fillingPercentX" x="0" y="0" width="100%" height="100%" fill="black" />
            </mask>
            
            <symbol viewBox="0 0 32 32" id="star">
                <path d="M31.547 12a.848.848 0 00-.677-.577l-9.427-1.376-4.224-8.532a.847.847 0 00-1.516 0l-4.218 8.534-9.427 1.355a.847.847 0 00-.467 1.467l6.823 6.664-1.612 9.375a.847.847 0 001.23.893l8.428-4.434 8.432 4.432a.847.847 0 001.229-.894l-1.615-9.373 6.822-6.665a.845.845 0 00.214-.869z" />
            </symbol>
            <symbol viewBox="0 0 160 32" id="stars">
                <use xlink:href="#star" x="-144" y="0"></use>
                <use xlink:href="#star" x="-112" y="0"></use>
                <use xlink:href="#star" x="-80" y="0"></use>
                <use xlink:href="#star" x="-48" y="0"></use>
                <use xlink:href="#star" x="-16" y="0"></use>
                <use xlink:href="#star" x="16" y="0"></use>
                <use xlink:href="#star" x="48" y="0"></use>
                <use xlink:href="#star" x="80" y="0"></use>
                <use xlink:href="#star" x="112" y="0"></use>
                <use xlink:href="#star" x="144" y="0"></use>
            </symbol>
        </defs>
        
        <use xlink:href="#stars" fill="#ffbe00" stroke="black" mask="url(#perc)"></use> 
        <use xlink:href="#stars" fill="none" stroke="black"></use>
    </svg>

    <script type="text/javascript"> 
        // document.oncontextmenu = function(e) {return false};
        let amountImg1x1 = JSON.parse('<?= (json_encode($amountImg1x1)) ?>');
        let amountOtherImg = JSON.parse('<?= (json_encode($amountOtherImg)) ?>');
        let topicName = JSON.parse('<?= (json_encode($topicName)) ?>');
        let topicNumber = parseInt(JSON.parse('<?= (json_encode($topicNumber)) ?>'));
    </script>


    <script>
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
            document.write('<script src="js/mobileScript.js"></'+'script>');
        } 
        else document.write('<script src="js/script.js"></'+'script>');


        let testName = window.location.search.replace(/[?]/gi, '');

        document.getElementById("questionsAndSuggestions").href = "feedback/feedback.html?questionsAndSuggestions_"+ testName +"";
        document.getElementById("questionsAndSuggestions").style.textDecoration = "none";

        document.getElementById("bugReport").href = "feedback/feedback.html?bugReport_"+ testName +"";
        document.getElementById("bugReport").style.textDecoration = "none";







        
        let pulloutMenuFlag = 1;
        function pulloutMenu() {
            let pulloutMenu = document.getElementById("pulloutMenu");
            let pulloutButton = document.getElementById("pullupButton");
            if (pulloutMenuFlag === 1) {
                pulloutMenu.style.cssText += "width: 300px; height: 500px;";
                pulloutButton.style.cssText +=  "background-image: url('img/general_img/closeArrow.png');";

                document.getElementById("containerClosedMenu").style.display = "none";
                document.getElementById("containerOpenMenu").style.display = "block";

                pulloutMenuFlag = 2;
            }
            else {
                pulloutMenu.style.cssText += "width: 140px; height: 190px;";
                pulloutButton.style.cssText +=  "background-image: url('img/general_img/openArrow.png');";

                document.getElementById("containerClosedMenu").style.display = "";
                document.getElementById("containerOpenMenu").style.display = "none";

                pulloutMenuFlag = 1;
            } 
        }
        

        let changePageModeFlag = 1;
        function changePageMode() {
            let changePageModeButton = document.getElementById("changePageModeId");

            if (changePageModeFlag === 1) {
                document.body.style.backgroundColor = "rgb(32,33,36)";
                document.getElementById("exercise").style.color = "rgb(253,253,253)";
                document.getElementById("exercise").style.backgroundColor = "rgb(48, 46, 47)";
                document.getElementById("schemaElementTable").style.backgroundColor = "rgb(255, 117, 175)";
                document.getElementById("schemaElementTable").style.borderColor = "rgb(253,253,253)";
                document.getElementById("mainField").style.borderColor = "rgb(253,253,253)";
                document.getElementById("timer").style.color = "rgb(253,253,253)";
                document.getElementById("pulloutMenu").style.borderColor = "rgb(253,253,253)";
            
                for(let i = 0; i < document.getElementsByClassName("blockNumberSize").length; i++) {
                    document.getElementsByClassName("blockNumberSize")[i].style.color = "rgb(253,253,253)";
                    document.getElementById("block"+ parseInt(i + 1) +"").style.borderColor = "rgb(253,253,253)";
                }


                changePageModeButton.style.backgroundImage = 'url("img/general_img/lightModeIcon.png")';
                changePageModeFlag = 2;
            }
            else {
                document.body.style.backgroundColor = "";
                document.getElementById("exercise").style.color = "";
                document.getElementById("exercise").style.backgroundColor = "rgb(219, 217, 217)";
                document.getElementById("schemaElementTable").style.backgroundColor = "rgb(194, 234, 247)";
                document.getElementById("schemaElementTable").style.borderColor = "";
                document.getElementById("mainField").style.borderColor = "";
                document.getElementById("timer").style.color = "";
                document.getElementById("pulloutMenu").style.borderColor = "";

                for(let i = 0; i < document.getElementsByClassName("blockNumberSize").length; i++) {
                    document.getElementsByClassName("blockNumberSize")[i].style.color = "";
                    document.getElementById("block"+ parseInt(i + 1) +"").style.borderColor = "";
                }

                changePageModeButton.style.backgroundImage = 'url("img/general_img/darkModeIcon.png")';
                changePageModeFlag = 1;
            }
        }





        

        
      







    </script> 
   


    <script>
        // let numberPage = window.location.search.replace(/[^0-9]/g, '');
        if(topicNumber === 1 && topicName === "RPrU") rpru(6, 1, 75, 4, "bottom", "RPrU1", " функциональную схему детекторного РПрУ", []);
        if(topicNumber === 2 && topicName === "RPrU") rpru(11, 1, 75, 4, "bottom", "RPrU2", " функциональную схему РПрУ прямого усиления", []);
        if(topicNumber === 3 && topicName === "RPrU") rpru(11, 3, 75, 4, "bottom", "RPrU3", " функциональную схему регенеративного РПрУ", []);
        if(topicNumber === 4 && topicName === "RPrU") rpru(10, 5, 75, 4, "bottom", "RPrU4", " функциональную схему сверхрегенеративного РПрУ", []);
        if(topicNumber === 5 && topicName === "RPrU") rpru(10, 3, 75, 4, "bottom", "RPrU5", " функциональную схему РПрУ гетеродинного типа", []);
        if(topicNumber === 6 && topicName === "RPrU") rpru(10, 3, 75, 4, "bottom", "RPrU6", " функциональную схему рефлексного РПрУ", []);
        if(topicNumber === 7 && topicName === "RPrU") rpru(11, 3, 75, 4, "bottom", "RPrU7", " функциональную схему супергетеродинного РПрУ", []);
        if(topicNumber === 8 && topicName === "RPrU") rpru(13, 3, 75, 4, "bottom", "RPrU8", " функциональную схему инфрадинного РПрУ с ШП", []);
        if(topicNumber === 9 && topicName === "RPrU") rpru(13, 3, 75, 4, "bottom", "RPrU9", " функциональную схему инфрадинного РПрУ с ФП", []);
        if(topicNumber === 10 && topicName === "RPrU") rpru(12, 3, 75, 4, "bottom", "RPrU10", " функциональную схему РПрУ с синхронным прямым преобразованием", []);
        if(topicNumber === 11 && topicName === "RPrU") rpru(13, 5, 75, 4, "bottom", "RPrU11", " функциональную схему РПрУ с асинхронным прямым преобразованием", []);



        if(topicNumber === 1 && topicName === "VC") rpru(5, 5, 85, 4, "right", "VC1", " схему ВЦ 1 с внешнеёмкостным включением антенны и внутриёмкостным включением нагрузки", []);
        if(topicNumber === 2 && topicName === "VC") rpru(5, 5, 85, 4, "right", "VC2", " схему ВЦ 2 с повышенной избирательностью по ЗК с внешнеёмкостным включением антенны и внутриёмкостным включением нагрузки", []);
        if(topicNumber === 3 && topicName === "VC") rpru(5, 5, 85, 4, "right", "VC3", " схему ВЦ 3 с внешнеёмкостным включением антенны и автотрансформаторным включением нагрузки", []);
        if(topicNumber === 4 && topicName === "VC") rpru(5, 5, 85, 4, "right", "VC4", " схему ВЦ 4 с внешнеёмкостным включением антенны и трансформаторным включением нагрузки", []);
        if(topicNumber === 5 && topicName === "VC") rpru(6, 4, 85, 4, "right", "VC5", " схему ВЦ 5 с внутриёмкостным включением антенны и автотрансформаторным включением нагрузки", []);
        if(topicNumber === 6 && topicName === "VC") rpru(6, 4, 85, 4, "right", "VC6", " схему ВЦ 6 с внутриёмкостным включением антенны и внутриёмкостным включением нагрузки", []);
        if(topicNumber === 7 && topicName === "VC") rpru(5, 4, 85, 4, "right", "VC7", " схему ВЦ 7 с внутриёмкостным включением антенны и полным включением нагрузки", []);
        if(topicNumber === 8 && topicName === "VC") rpru(6, 4, 85, 4, "right", "VC8", " схему ВЦ 8 с автотрансформаторным включением антенны и трансформаторным включением нагрузки", []);
        if(topicNumber === 9 && topicName === "VC") rpru(6, 3, 85, 4, "bottom", "VC9", " схему ВЦ 9 с автотрансформаторным включением антенны и внутриемкостным включением нагрузки", []);
        if(topicNumber === 10 && topicName === "VC") rpru(5, 4, 85, 4, "right", "VC10", " схему ВЦ 10 с трансформаторным включением антенны и автотрансформаторным включением нагрузки", []);
        if(topicNumber === 11 && topicName === "VC") rpru(6, 3, 85, 4, "right", "VC11", " схему ВЦ 11 с трансформаторным включением антенны и внутриёмкостным включением нагрузки", []);
        if(topicNumber === 12 && topicName === "VC") rpru(5, 5, 85, 4, "right", "VC12", " схему ВЦ 12 с полным включением нагрузки", []);
        if(topicNumber === 13 && topicName === "VC") rpru(6, 5, 85, 4, "right", "VC13", " схему ВЦ 13 с автотрансформаторным включением нагрузки", []);
        if(topicNumber === 14 && topicName === "VC") rpru(7, 5, 85, 4, "right", "VC14", " схему ВЦ 14 с внутриёмкостным включением нагрузки", []);



        if(topicNumber === 1 && topicName === "URS") rpru(14, 8, 75, 4, "rightWidthScrollbar", "URS1", " принципиальную электрическую схему резонансного УРС на биполярном транзисторе с NPN структурой по схеме с ОБ и параллельным питанием. Входная согласующая цепь должна обеспечивать автотрансформаторную связь с источником сигнала и трансформаторную связь с транзистором. Выходная согласующая цепь должна обеспечивать автотрансформаторную связь с нагрузкой. Компоновка схемы с верхним размещение источника питания.  ", [[49, 63]]);
        if(topicNumber === 2 && topicName === "URS") rpru(13, 8, 75, 4, "rightWidthScrollbar", "URS2", " принципиальную электрическую схему резонансного УРС на биполярном транзисторе с NPN структурой по схеме с ОБ и параллельным питанием. Входная согласующая цепь должна обеспечивать автотрансформаторную связь с источником сигнала и трансформаторную связь с транзистором. Выходная согласующая цепь должна обеспечивать автотрансформаторную связь с нагрузкой. Компоновка схемы с верхним размещение источника питания.", [[46, 59]]);
        if(topicNumber === 3 && topicName === "URS") rpru(14, 8, 75, 4, "rightWidthScrollbar", "URS3", " принципиальную электрическую схему резонансного УРС на биполярном транзисторе с PNP структурой по схеме с ОЭ и последовательным питанием. Входная согласующая цепь должна обеспечивать трансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать трансформаторную связь с нагрузкой. Компоновка схемы с верхним размещением источника питания.", [[64, 65]]);
        if(topicNumber === 4 && topicName === "URS") rpru(14, 5, 75, 4, "bottom", "URS4", " принципиальную электрическую схему резонансного УРС на биполярном транзисторе с NPN структурой по схеме с ОБ и последовательным питанием. Входная согласующая цепь должна обеспечивать автотрансформаторную связь с источником сигнала и трансформаторную связь с транзистором. Выходная согласующая цепь должна обеспечивать автотрансформаторную связь с нагрузкой. Компоновка схемы с нижним размещением источника питания.", [[7, 21]]);
        if(topicNumber === 5 && topicName === "URS") rpru(14, 8, 75, 4, "rightWidthScrollbar", "URS5", " принципиальную электрическую схему резонансного УРС на биполярном транзисторе с NPN структурой по схеме с ОЭ и последовательным питанием. Входная согласующая цепь должна обеспечивать трансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать трансформаторную связь с нагрузкой. Компоновка схемы с верхним размещением источника питания.", [[64, 65]]);
        if(topicNumber === 6 && topicName === "URS") rpru(14, 7, 75, 4, "rightWidthScrollbar", "URS6", " принципиальную электрическую схему резонансного УРС на биполярном транзисторе с PNP структурой по схеме с ОЭ и параллельным питанием. Входная согласующая цепь должна обеспечивать трансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать трансформаторную связь с нагрузкой. Компоновка схемы с нижним размещением источника питания.", [[20, 21]]);
        if(topicNumber === 7 && topicName === "URS") rpru(14, 5, 75, 4, "bottom", "URS7", " принципиальную электрическую схему резонансного УРС на биполярном транзисторе с PNP структурой по схеме с ОБ и последовательным питанием. Входная согласующая цепь должна обеспечивать автотрансформаторную связь с источником сигнала и трансформаторную связь с транзистором. Выходная согласующая цепь должна обеспечивать автотрансформаторную связь с нагрузкой. Компоновка схемы с нижним размещением источника питания.", [[7, 21]]);
        if(topicNumber === 8 && topicName === "URS") rpru(13, 8, 75, 4, "rightWidthScrollbar", "URS8", " принципиальную электрическую схему резонансного УРС на биполярном транзисторе с NPN структурой по схеме с ОБ и последовательным питанием. Входная согласующая цепь должна обеспечивать автотрансформаторную связь с источником сигнала и трансформаторную связь с транзистором. Выходная согласующая цепь должна обеспечивать автотрансформаторную связь с нагрузкой. Компоновка схемы с верхним размещение источника питания.", [[46, 59]]);
        if(topicNumber === 9 && topicName === "URS") rpru(14, 7, 75, 4, "rightWidthScrollbar", "URS9", " принципиальную электрическую схему резонансного УРС на биполярном транзисторе с NPN структурой по схеме с ОЭ и параллельным питанием. Входная согласующая цепь должна обеспечивать трансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать трансформаторную связь с нагрузкой. Компоновка схемы с нижним размещением источника питания.", [[20, 21]]);
        if(topicNumber === 10 && topicName === "URS") rpru(14, 6, 75, 4, "rightWidthScrollbar", "URS10", " принципиальную электрическую схему каскодного резонансного УРС на биполярных транзисторах с PNP структурой и последовательным питанием. Входная и выходная согласующие цепи должны обеспечивать трансформаторную связь с источником сигнала и нагрузкой. Компоновка схемы с нижним размещением источника питания.", [[20, 21], [9, 23]]);
        if(topicNumber === 11 && topicName === "URS") rpru(14, 8, 75, 4, "rightWidthScrollbar", "URS11", " принципиальную электрическую схему резонансного УРС на биполярном транзисторе с NPN структурой по схеме с ОЭ и параллельным питанием. Входная согласующая цепь должна обеспечивать трансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать автотрансформаторную связь с нагрузкой. Компоновка схемы с верхним размещением источника питания.", [[64, 65]]);
        if(topicNumber === 12 && topicName === "URS") rpru(14, 6, 75, 4, "rightWidthScrollbar", "URS12", " принципиальную электрическую схему резонансного УРС на биполярном транзисторе с NPN структурой по схеме с ОБ и параллельным питанием. Входная согласующая цепь должна обеспечивать автотрансформаторную связь с источником сигнала и трансформаторную связь с транзистором. Выходная согласующая цепь должна обеспечивать автотрансформаторную связь с нагрузкой. Компоновка схемы с нижним размещением источника питания.", [[7, 21]]);
        if(topicNumber === 13 && topicName === "URS") rpru(14, 6, 75, 4, "rightWidthScrollbar", "URS13", " принципиальную электрическую схему каскодного резонансного УРС на биполярных транзисторах с NPN структурой и последовательным питанием. Входная и выходная согласующие цепи должны обеспечивать трансформаторную связь с источником сигнала и нагрузкой. Компоновка схемы с нижним размещением источника питания.", [[20, 21], [9, 23]]);
        if(topicNumber === 14 && topicName === "URS") rpru(12, 7, 75, 4, "rightWidthScrollbar", "URS14", " принципиальную электрическую схему резонансного УРС на биполярном транзисторе с PNP структурой по схеме с ОЭ и последовательным питанием. Входная согласующая цепь должна обеспечивать трансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать трансформаторную связь с нагрузкой. Компоновка схемы с нижним размещением источника питания.", [[18, 19]]);
        if(topicNumber === 15 && topicName === "URS") rpru(14, 6, 75, 4, "rightWidthScrollbar", "URS15", " принципиальную электрическую схему резонансного УРС на биполярном транзисторе с PNP структурой по схеме с ОБ и параллельным питанием. Входная согласующая цепь должна обеспечивать автотрансформаторную связь с источником сигнала и трансформаторную связь с транзистором. Выходная согласующая цепь должна обеспечивать автотрансформаторную связь с нагрузкой. Компоновка схемы с нижним размещением источника питания.", [[7, 21]]);
        if(topicNumber === 16 && topicName === "URS") rpru(12, 7, 75, 4, "rightWidthScrollbar", "URS16", " принципиальную электрическую схему резонансного УРС на биполярном транзисторе с NPN структурой по схеме с ОЭ и последовательным питанием. Входная согласующая цепь должна обеспечивать трансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать трансформаторную связь с нагрузкой. Компоновка схемы с нижним размещением источника питания.", [[18, 19]]);
        if(topicNumber === 17 && topicName === "URS") rpru(14, 8, 75, 4, "rightWidthScrollbar", "URS17", " принципиальную электрическую схему резонансного УРС на биполярном транзисторе с PNP структурой по схеме с ОЭ и параллельным питанием. Входная согласующая цепь должна обеспечивать трансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать автотрансформаторную связь с нагрузкой. Компоновка схемы с верхним размещением источника питания.", [[64, 65]]);
        if(topicNumber === 18 && topicName === "URS") rpru(14, 8, 75, 4, "rightWidthScrollbar", "URS18", " принципиальную электрическую схему резонансного УРC на биполярном транзисторе с PNP структурой по схеме с ОБ и параллельным питанием. Входная согласующая цепь должна обеспечивать автотрансформаторную связь с источником сигнала и трансформаторную связь с транзистором. Выходная согласующая цепь должна обеспечивать автотрансформаторную связь с нагрузкой. Компоновка схемы с верхним размещение источника питания.", [[49, 63]]);
        if(topicNumber === 19 && topicName === "URS") rpru(14, 8, 75, 4, "rightWidthScrollbar", "URS19", " принципиальную электрическую схему резонансного УРС на полевом транзисторе с N каналом по схеме с ОЗ и параллельным питанием. Входная согласующая цепь должна обеспечивать автотрансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать автотрансформаторную связь с нагрузкой. Компоновка схемы с верхним размещением источника питания.", [[49, 50, 63, 64]]);
        if(topicNumber === 20 && topicName === "URS") rpru(14, 8, 75, 4, "rightWidthScrollbar", "URS20", " принципиальную электрическую схему резонансного УРС на полевом транзисторе с P каналом по схеме с ОЗ и параллельным питанием. Входная согласующая цепь должна обеспечивать автотрансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать автотрансформаторную связь с нагрузкой. Компоновка схемы с верхним размещением источника питания.", [[49, 50, 63, 64]]);
        if(topicNumber === 21 && topicName === "URS") rpru(14, 7, 75, 4, "rightWidthScrollbar", "URS21", " принципиальную электрическую схему резонансного УРС на полевом транзисторе с N каналом по схеме с ОЗ и параллельным питанием. Входная согласующая цепь должна обеспечивать автотрансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать автотрансформаторную связь с нагрузкой. Компоновка схемы с нижним размещением источника питания.", [[21, 22, 35, 36]]);
        if(topicNumber === 22 && topicName === "URS") rpru(14, 7, 75, 4, "rightWidthScrollbar", "URS22", " принципиальную электрическую схему резонансного УРС на полевом транзисторе с P каналом по схеме с ОЗ и параллельным питанием. Входная согласующая цепь должна обеспечивать автотрансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать автотрансформаторную связь с нагрузкой. Компоновка схемы с нижним размещением источника питания.", [[21, 22, 35, 36]]);
        if(topicNumber === 23 && topicName === "URS") rpru(14, 8, 75, 4, "rightWidthScrollbar", "URS23", " принципиальную электрическую схему резонансного УРС на полевом транзисторе с N каналом по схеме с ОЗ и последовательным питанием. Входная согласующая цепь должна обеспечивать автотрансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать трансформаторную связь с нагрузкой. Компоновка схемы с верхним размещением источника питания.", [[49, 50, 63, 64]]);
        if(topicNumber === 24 && topicName === "URS") rpru(14, 8, 75, 4, "rightWidthScrollbar", "URS24", " принципиальную электрическую схему резонансного УРС на полевом транзисторе с P каналом по схеме с ОЗ и последовательным питанием. Входная согласующая цепь должна обеспечивать автотрансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать трансформаторную связь с нагрузкой. Компоновка схемы с верхним размещением источника питания.", [[49, 50, 63, 64]]);
        if(topicNumber === 25 && topicName === "URS") rpru(13, 7, 75, 4, "rightWidthScrollbar", "URS25", " принципиальную электрическую схему резонансного УРС на полевом транзисторе с N каналом по схеме с ОЗ и последовательным питанием. Входная согласующая цепь должна обеспечивать автотрансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать трансформаторную связь с нагрузкой. Компоновка схемы с нижним размещением источника питания.", [[20, 21, 33, 34]]);
        if(topicNumber === 26 && topicName === "URS") rpru(13, 7, 75, 4, "rightWidthScrollbar", "URS26", " принципиальную электрическую схему резонансного УРС на полевом транзисторе с P каналом по схеме с ОЗ и последовательным питанием. Входная согласующая цепь должна обеспечивать автотрансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать трансформаторную связь с нагрузкой. Компоновка схемы с нижним размещением источника питания.", [[20, 21, 33, 34]]);
        if(topicNumber === 27 && topicName === "URS") rpru(14, 6, 75, 4, "rightWidthScrollbar", "URS27", " принципиальную электрическую схему резонансного УРС на полевом транзисторе с N каналом по схеме с ОИ и параллельным питанием. Входная согласующая цепь должна обеспечивать трансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать автотрансформаторную связь с нагрузкой. Компоновка схемы с нижним размещением источника питания.", [[20, 21, 34, 35]]);
        if(topicNumber === 28 && topicName === "URS") rpru(14, 6, 75, 4, "rightWidthScrollbar", "URS28", " принципиальную электрическую схему резонансного УРС на полевом транзисторе с P каналом по схеме с ОИ и параллельным питанием. Входная согласующая цепь должна обеспечивать трансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать автотрансформаторную связь с нагрузкой. Компоновка схемы с нижним размещением источника питания.", [[20, 21, 34, 35]]);
        if(topicNumber === 29 && topicName === "URS") rpru(11, 8, 75, 4, "rightWidthScrollbar", "URS29", " принципиальную электрическую схему резонансного УРС на полевом транзисторе с N каналом по схеме с ОИ и последовательным питанием. Входная согласующая цепь должна обеспечивать трансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать автотрансформаторную связь с нагрузкой. Компоновка схемы с верхним размещением источника питания.", [[39, 40, 50, 51]]);
        if(topicNumber === 30 && topicName === "URS") rpru(11, 8, 75, 4, "rightWidthScrollbar", "URS30", " принципиальную электрическую схему резонансного УРС на полевом транзисторе с P каналом по схеме с ОИ и последовательным питанием. Входная согласующая цепь должна обеспечивать трансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать автотрансформаторную связь с нагрузкой. Компоновка схемы с верхним размещением источника питания.", [[39, 40, 50, 51]]);
        if(topicNumber === 31 && topicName === "URS") rpru(13, 8, 75, 4, "rightWidthScrollbar", "URS31", " принципиальную электрическую схему резонансного УРС на полевом транзисторе с N каналом по схеме с ОИ и параллельным питанием. Входная согласующая цепь должна обеспечивать трансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать трансформаторную связь с нагрузкой. Компоновка схемы с верхним размещением источника питания.", [[45, 46, 58, 59]]);
        if(topicNumber === 32 && topicName === "URS") rpru(13, 8, 75, 4, "rightWidthScrollbar", "URS32", " принципиальную электрическую схему резонансного УРС на полевом транзисторе с P каналом по схеме с ОИ и параллельным питанием. Входная согласующая цепь должна обеспечивать трансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать трансформаторную связь с нагрузкой. Компоновка схемы с верхним размещением источника питания.", [[45, 46, 58, 59]]);
        if(topicNumber === 33 && topicName === "URS") rpru(12, 6, 75, 4, "rightWidthScrollbar", "URS33", " принципиальную электрическую схему резонансного УРС на полевом транзисторе с N каналом по схеме с ОИ и последовательным питанием. Входная согласующая цепь должна обеспечивать трансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать трансформаторную связь с нагрузкой. Компоновка схемы с нижним размещением источника питания.", [[18, 19, 30, 31]]);
        if(topicNumber === 34 && topicName === "URS") rpru(12, 6, 75, 4, "rightWidthScrollbar", "URS34", " принципиальную электрическую схему резонансного УРС на полевом транзисторе с P каналом по схеме с ОИ и последовательным питанием. Входная согласующая цепь должна обеспечивать трансформаторную связь с источником сигнала. Выходная согласующая цепь должна обеспечивать трансформаторную связь с нагрузкой. Компоновка схемы с нижним размещением источника питания.", [[18, 19, 30, 31]]);



        if(topicNumber === 1 && topicName === "PCH") rpru(12, 8, 75, 4, "bottom", "PCH1", " схему кольцевого диодного ПЧ", []);
        if(topicNumber === 2 && topicName === "PCH") rpru(10, 8, 75, 4, "rightWidthScrollbar", "PCH2", " схему ПЧ на полевом транзисторе с n каналом", [[35, 36, 45, 46]]);
        if(topicNumber === 3 && topicName === "PCH") rpru(10, 8, 75, 4, "rightWidthScrollbar", "PCH3", " схему ПЧ на полевом транзисторе с p каналом", [[35, 36, 45, 46]]);
        if(topicNumber === 4 && topicName === "PCH") rpru(10, 7, 75, 4, "right", "PCH4", " схему ПЧ с подавлением зеркального канала по структуре Хартли с фазовращателями на 90 градусов", []);
        if(topicNumber === 5 && topicName === "PCH") rpru(10, 7, 75, 4, "bottom", "PCH5", " схему ПЧ с подавлением зеркального канала по структуре Хартли с фазовращателями на 45 градусов", []);
        if(topicNumber === 6 && topicName === "PCH") rpru(12, 7, 75, 4, "bottom", "PCH6", " схему ПЧ с подавлением зеркального канала по структуре Уивера", []);
        if(topicNumber === 7 && topicName === "PCH") rpru(12, 8, 75, 4, "bottom", "PCH7", " схему ПЧ с полифазным фильтром", []);
        if(topicNumber === 8 && topicName === "PCH") rpru(10, 7, 75, 4, "bottom", "PCH8", " схему ФАПЧ Костаса", []);
        if(topicNumber === 9 && topicName === "PCH") rpru(6, 6, 75, 4, "rightWidthScrollbar", "PCH9", " схему RC формирователя квадратур", []);
        if(topicNumber === 10 && topicName === "PCH") rpru(9, 8, 75, 4, "bottom", "PCH10", " схему комплексного перемножителя сигналов", []);
        if(topicNumber === 11 && topicName === "PCH") rpru(12, 5, 75, 4, "bottom", "PCH11", " схему однотактного диодного ПЧ", []);
        if(topicNumber === 12 && topicName === "PCH") rpru(11, 6, 75, 4, "rightWidthScrollbar", "PCH12", " схему двухтактного балансного диодного ПЧ", []);
        if(topicNumber === 13 && topicName === "PCH") rpru(7, 7, 75, 4, "right", "PCH13", " схему формирователя квадратур на ПЧ с фазовращателями на 45 градусов", []);
        if(topicNumber === 14 && topicName === "PCH") rpru(7, 7, 75, 4, "right", "PCH14", " схему формирователя квадратур на ПЧ с фазовращателями на 90 градусов", []);
        if(topicNumber === 15 && topicName === "PCH") rpru(14, 8, 75, 4, "bottom", "PCH15", " схему формирователя квадратур на элементах И-НЕ", [[4, 5, 18, 19], [7, 8, 21, 22], [11, 12, 25, 26], [77, 78, 91, 92], [81, 82, 95, 96], [88, 89, 102, 103]]);



        if(topicNumber === 1 && topicName === "detector") rpru(12, 3, 75, 4, "bottom", "detector1", " ", []);
        if(topicNumber === 2 && topicName === "detector") rpru(10, 3, 75, 4, "bottom", "detector2", " ", []);
        if(topicNumber === 3 && topicName === "detector") rpru(10, 3, 75, 4, "bottom", "detector3", " ", []);
        if(topicNumber === 4 && topicName === "detector") rpru(12, 3, 75, 4, "bottom", "detector4", " ", []);
        if(topicNumber === 5 && topicName === "detector") rpru(9, 3, 75, 4, "bottom", "detector5", " ", []);
        if(topicNumber === 6 && topicName === "detector") rpru(13, 1, 75, 4, "bottom", "detector6", " ", []);

        if(topicNumber === 7 && topicName === "detector") rpru(11, 8, 75, 4, "rightWidthScrollbar", "detector7", " схему диодного балансного ФД", []);
        if(topicNumber === 8 && topicName === "detector") rpru(14, 8, 75, 4, "bottom", "detector8", " схему кольцевого диодного ФД", []);
        if(topicNumber === 9 && topicName === "detector") rpru(14, 6, 75, 4, "bottom", "detector9", " схему дробного детектора", []);
        if(topicNumber === 10 && topicName === "detector") rpru(14, 3, 75, 4, "bottom", "detector10", " схему диодного детектора с разделённой нагрузкой", []);
        if(topicNumber === 11 && topicName === "detector") rpru(12, 5, 75, 4, "bottom", "detector11", " схему диодного детектора с удвоением частоты", []);
        if(topicNumber === 12 && topicName === "detector") rpru(11, 6, 75, 4, "bottom", "detector12", " схему диодного детектора с удвоением напряжения", []);
        if(topicNumber === 13 && topicName === "detector") rpru(7, 7, 75, 4, "bottom", "detector13", " схему параллельного диодного детектора", []);
        if(topicNumber === 14 && topicName === "detector") rpru(7, 7, 75, 4, "right", "detector14", " схему последовательного диодного детектора", []);
        if(topicNumber === 15 && topicName === "detector") rpru(14, 8, 75, 4, "bottom", "detector15", " схему АМ детектора с ОУ", []);







        if(topicNumber === 1 && topicName === "FiGSvCRS") rpru(9, 8, 75, 4, "rightWidthScrollbar", "FiGSvCRS1", " pch 1 ", [[10, 11, 19, 20]]);
        if(topicNumber === 2 && topicName === "FiGSvCRS") rpru(7, 10, 75, 4, "rightWidthScrollbar", "FiGSvCRS2", " pch 2 ", [[22, 23]]);
        if(topicNumber === 3 && topicName === "FiGSvCRS") rpru(10, 7, 75, 4, "rightWidthScrollbar", "FiGSvCRS3", " pch 3 ", [[36, 37]]);
        if(topicNumber === 4 && topicName === "FiGSvCRS") rpru(11, 3, 75, 4, "bottom", "FiGSvCRS4", " pch 4 ", []);
        if(topicNumber === 5 && topicName === "FiGSvCRS") rpru(10, 6, 75, 4, "rightWidthScrollbar", "FiGSvCRS5", " pch 5 ", [[26, 27]]);
        if(topicNumber === 6 && topicName === "FiGSvCRS") rpru(8, 10, 75, 4, "rightWidthScrollbar", "FiGSvCRS6", " pch 6 ", [[10, 11]]);
        if(topicNumber === 7 && topicName === "FiGSvCRS") rpru(12, 7, 75, 4, "rightWidthScrollbar", "FiGSvCRS7", " pch 7 ", [[55, 56]]);
        if(topicNumber === 8 && topicName === "FiGSvCRS") rpru(16, 7, 75, 4, "rightWidthScrollbar", "FiGSvCRS8", " pch 8 ", [[20, 21], [23, 24]]);
        if(topicNumber === 9 && topicName === "FiGSvCRS") rpru(15, 9, 75, 4, "rightWidthScrollbar", "FiGSvCRS9", " pch 9 ", [[39, 40], [99, 100]]);
        if(topicNumber === 10 && topicName === "FiGSvCRS") rpru(15, 11, 75, 4, "rightWidthScrollbar", "FiGSvCRS10", " pch 10 ", [[36, 37], [126, 127]]);
           //(X, Y, sizeCell, numberCellSize, widthTable, leftTable, topTable, leftStarRate, topStarRate leftButton, topButton, testNumber, exercise)
        // rpru(13, 3,    60,          4,            915,       10,        250,       10,           400,        780,       400,        1,      " детекторного РПрУ");
    </script>


</body>
</html>