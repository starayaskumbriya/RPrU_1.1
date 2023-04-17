<?php include_once 'accessCheck.php'; ?>

<html>
<head>
    <meta charset="UTF-8">
</head>
<body>


    <form id="topicAndNumber" action="accessCheck.php" method="post"> 
        
        <div class="wrapper" id="wrapper1">
            <input type="button" class="button" id="button1" onclick="uncover(this);">
            <p class="topicName">радиоприемные устройства</p>
            <div class="topic" id="topic1"></div>
        </div>

        <div class="wrapper" id="wrapper2">
            <input type="button" class="button" id="button2" onclick="uncover(this);">
            <p class="topicName">согласующиеся цепи</p>
            <div class="topic" id="topic2"></div>
        </div>

        <div class="wrapper" id="wrapper3">
            <input type="button" class="button" id="button3" onclick="uncover(this);">
            <p class="topicName">усилители радиосигналов</p>
            <div class="topic" id="topic3"></div>
        </div>
    
        <div class="wrapper" id="wrapper4">
            <input type="button" class="button" id="button4" onclick="uncover(this);">
            <p class="topicName">преобразователи частоты</p>
            <div class="topic" id="topic4"></div>
        </div>

        <div class="wrapper" id="wrapper5">
            <input type="button" class="button" id="button5" onclick="uncover(this);">
            <p class="topicName">детекторы</p>
            <div class="topic" id="topic5"></div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------- -->
        <div class="wrapper" id="wrapper6">
            <input type="button" class="button" id="button6" onclick="uncover(this);">
            <p class="topicName">ФиГСвЦРС</p>
            <div class="topic" id="topic6"></div>
        </div>
<!-- -------------------------------------------------------------------------------------------------------------------- -->
        <div class="wrapper" id="randomWrapper">
            
        </div>

    </form> 




    <script>
        let numberAttempts = 3;   //popitki tut
        let topicAndNumberArr = [];

        function testNumber(number) {
            topicAndNumberArr.push(number.id);
        }



        function generateButton(amountButton, topicNumber, topicName, value) {
            let sqlTablePhp = '<?= (json_encode($row)) ?>';
            let testsNotPassed = 0;

            for(let i = 1; i < amountButton + 1; i++) {               

                let sqlTableJs = JSON.parse(sqlTablePhp)[topicName + i];
                let markForInnerHTML = [];
                if(sqlTableJs === null) {
                    sqlTableJs = 0;
                    testsNotPassed++;  //тут считаем количество тестов которые осталось пройти по признаку проходился ли тест когда либо
                }
                else {

                    let markArr = sqlTableJs.split(";"), markSum = 0;
                    for(let i = 0; i < markArr.length - 1; i++) markSum += Number(markArr[i]);
                        
                    let bestMark = Math.max.apply(null, markArr);
                    let mediumMark = markSum / (markArr.length - 1); 
                    
                    markForInnerHTML.push(parseInt(bestMark * 100) / 100, parseInt(mediumMark * 100) / 100);


                    sqlTableJs = sqlTableJs.replace(/[^;]/g, '').length;
                }


                let buttonWrapper = document.createElement("div");
                buttonWrapper.id = "buttonWrapper" + i;
                let button = document.createElement("input");
                button.style.cssText = "display: inline-block; margin-bottom: 5px; margin-left: 5%; border: 0px; padding-left: 0px; background: none; text-decoration: underline; cursor: pointer;"
                button.id = topicName + i;
                button.value = value+ " "+ i;
                button.type = "submit";
                button.addEventListener("click", function() {
                    testNumber(this);
                });

          
                
                let restOfAttempts = document.createElement("div");
                restOfAttempts.id = topicName + i;
                restOfAttempts.style.cssText = "display: inline-block; margin-left: 5%";
                restOfAttempts.innerHTML = "осталось попыток " + (numberAttempts - sqlTableJs);

                


                let topic = document.getElementById("topic"+ topicNumber +"");
                topic.appendChild(buttonWrapper).appendChild(button);
                buttonWrapper.appendChild(restOfAttempts);



                if(sqlTableJs !== 0) {
                    let bestMarkWrapper = document.createElement("div"), mediumMarkWrapper = document.createElement("div");

                    bestMarkWrapper.style.cssText = "display: inline-block; margin-left: 5%";
                    bestMarkWrapper.innerHTML = "лучшая оценка " + markForInnerHTML[0];
                    buttonWrapper.appendChild(bestMarkWrapper), 
                    
                    mediumMarkWrapper.style.cssText = "display: inline-block; margin-left: 5%";
                    mediumMarkWrapper.innerHTML = "средняя оценка " + markForInnerHTML[1];
                    buttonWrapper.appendChild(mediumMarkWrapper);
                    
                }



                if(sqlTableJs === 3) {          //после какой попытки давать студенту ответ
                    let openedAnswer = document.createElement("a");
                    openedAnswer.href = "img/answers/" + topicName + "/" + topicName + i + "_right.png";
                    openedAnswer.style.cssText = "display: inline-block; margin-left: 5%; color: red; text-decoration: none;";
                    openedAnswer.innerHTML = "посмотреть правильный ответ";
                    buttonWrapper.appendChild(openedAnswer);
                }



                
            }  
            
            
            let topicWrapper = document.getElementById("wrapper"+ topicNumber +"");
            let testsNotPassedWrapper = document.createElement("div");
            testsNotPassedWrapper.id = "testsNotPassedWrapper"+ topicNumber +"";
            testsNotPassedWrapper.style.cssText = "display: inline-block; margin-left: 25%;"
            testsNotPassedWrapper.innerHTML = "осталось пройти тестов: " + testsNotPassed;
            topicWrapper.appendChild(testsNotPassedWrapper);

        }



        function randomTestAppend() {
            window.onload = function() {
                randomButton.style.cssText += "border: 0px; padding-left: 0px; background: none; cursor: pointer; position: absolute;"
                // randomButton.style.left = (document.getElementsByClassName("topicName")[0].getBoundingClientRect().left);
                // document.getElementById("randomWrapper").height = document.getElementsByClassName("button")[0].clientHeight;
                
            }
         
            

            let randomButton = document.createElement("input");
            
            randomButton.value = "random test(случайный тест)";
            randomButton.type = "submit";
            
            randomButton.addEventListener("click", function() {
                topicAndNumberArr.push(randomTest());
            });
            document.getElementById("randomWrapper").appendChild(randomButton);
        }
        randomTestAppend();










        function uncover(numberButton) { 
            let id = numberButton.id.replace(/[a-zа-яё]/gi, '');
            let elementId = "topic" + id;
            if(window.getComputedStyle(document.getElementById(elementId)).display === "none") {
                document.getElementById(elementId).style.display="block";
                document.getElementById("testsNotPassedWrapper"+ id +"").style.display="none";
            }
            else {
                document.getElementById(elementId).style.display="none";
                document.getElementById("testsNotPassedWrapper"+ id +"").style.display="inline-block";
            }
        }



        async function SendtopicAndNumber(element) {

            element.preventDefault();
            let topicAndNumber = new FormData(document.getElementById('topicAndNumber'));
            let topicAndNumberJSON = JSON.stringify(topicAndNumberArr);
            topicAndNumber.append('topicAndNumberJSON', topicAndNumberJSON);

            const replaceArr = new Map([
                ['RPrU', 1],
                ['VC', 2],
                ['URS', 3],
                ['PCH', 4],
                ['detector', 5],
//----------------------------------------------------------------------------------------------------------------
                ['FiGSvCRS', 6]
//----------------------------------------------------------------------------------------------------------------
                // ['random', 7]
            ]);


            try {
                const response = await fetch('accessCheck.php', {
                    method: 'POST',
                    body: topicAndNumber
                });
                let json = await response.json();
                //document.getElementById("restOfAttempts").value = numberAttempts - json[1];
                
                if(json[1] < numberAttempts) {
                    let type = json[0].replace(/[^a-zа-яё]/gi, '');
                    let testLocation = "tests/main.php?"+ json[0] +"";   
                    if(type === "RPrU") location.href = testLocation;
                    if(type === "VC") location.href = testLocation;
                    if(type === "URS") location.href = testLocation;
                    if(type === "PCH") location.href = testLocation;
                    if(type === "detector") location.href = testLocation;
//----------------------------------------------------------------------------------------------------------------
                    if(type === "FiGSvCRS") location.href = testLocation;
//----------------------------------------------------------------------------------------------------------------
                    if(type === "random") randomTest();
                }
                else {
                    alert("попытки кончились");
                    location.reload();
                }

               
            } 
            catch (error) {
                console.error('Ошибка:', error);
            }
        } 
        topicAndNumber.onsubmit = SendtopicAndNumber;


        generateButton(11, 1, "RPrU", "РПрУ");
        generateButton(14, 2, "VC", "ВЦ");
        generateButton(34, 3, "URS", "УРС");
        generateButton(15, 4, "PCH", "ПЧ");
        generateButton(19, 5, "detector", "Детектор");
//----------------------------------------------------------------------------------------------------------------
        generateButton(10, 6, "FiGSvCRS", "ФиГСвЦРС");
//----------------------------------------------------------------------------------------------------------------

        

        function randomTest() {
            const testArr = new Map ([
                [1, ['RPrU', 11]],
                [2, ['VC', 14]],
                [3, ['URS', 34]],
                [4, ['PCH', 15]],
                [5, ['detector', 19]],
//----------------------------------------------------------------------------------------------------------------
                [6, ['FiGSvCRS', 10]]
//----------------------------------------------------------------------------------------------------------------
            ]);
            let randomTestFromTestArr = testArr.get(Math.floor(Math.random() * testArr.size) + 1);
            let thisTestName = randomTestFromTestArr[0];
            let thisTestNumber = Math.floor(Math.random() * randomTestFromTestArr[1]) + 1
            console.log(thisTestName, thisTestNumber);
            // location.href ="tests/main.php?" + thisTestName + thisTestNumber;
            return thisTestName + thisTestNumber;


        }
        // randomTest()

    </script>














    <style>
        .wrapper {
            width: 100%;
            min-height: 5%;
            margin-bottom: 5px;
            border-bottom: 1px solid;
        }
        
        .button {
            display: inline-block;
            height: 50px;
            width: 50px;
            background: url("img/down.png");
            background-size: 50%;
            background-position: center;
            background-repeat: no-repeat;
            border: none;
        }
        .button:hover {
            /* border-radius: 50%; */
            background-color: lightgray;
        }

        .topicName {
            position: absolute;
            display: inline-block;
            margin-left: 1%;
        }

        .topic {
            display: none;
        }
    </style>

</body>
</html>