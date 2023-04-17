function rpru(X, Y, sizeCell, numberCellSize, widthTable, tablePosition, testNumber, exercise, changeArr) {

    function createBlock() {
        document.getElementById("exercise").append(exercise);

        let mainField = document.getElementById("mainField");
        mainField.style.cssText = 'width: '+ ((X * sizeCell) - 2) + "px" +'; height: '+ ((Y * sizeCell) - 2) + "px" +'; border: 4px solid black; display: inline-block;';
        
        for(let numberY = 0; numberY < Y; numberY++) {
            for(let numberX = 0; numberX < X; numberX++) {
                let elementNumber = numberY * X + numberX + 1;
                mainField.innerHTML += '<div class="block'+ elementNumber + '" id="block'+ elementNumber + '"> <h'+ numberCellSize +' id="h2_'+ elementNumber + '" class="blockNumberSize">'+ elementNumber +'</h'+ numberCellSize +'>  </div>';
                document.getElementById('block'+ elementNumber + '').style.cssText = 'height: '+ sizeCell +'px; width: '+ sizeCell +'px; position: absolute; left: '+ (10 + parseInt(numberX * sizeCell)) + "px" +'; border: 1px dashed black;'; 
                document.getElementById('h2_'+ elementNumber + '').style.cssText = "margin-left: 20%; margin-top: 30%;";
            }
        }


        document.getElementById("exercise").style.cssText += "max-width: "+ (X * sizeCell + 4) +"px; background-color: rgb(219, 217, 217); margin-bottom: 7.5px;"; 
        exerciseTextSize()


        window.onload = function() {
            margin();
            let windowStateArr = [];
            windowStateArr.push(document.body.clientHeight > document.body.clientWidth);
            window.addEventListener('resize', function() {

                windowStateArr.push(document.body.clientHeight > document.body.clientWidth);
                exerciseTextSize()
                if(windowStateArr.length > 2) windowStateArr.shift();
                if(windowStateArr[0] !== windowStateArr[1]) margin();
            });  
        }
    }
    createBlock();



    document.getElementById("pullupButton").addEventListener("click", minPageWidth);

    function minPageWidth() {
        // console.log(X * sizeCell, widthTable)
        document.body.style.minWidth = X * sizeCell + 20 + document.getElementById("pulloutMenu").clientWidth;
        console.log(window.matchMedia('(prefers-color-scheme)'))
    }
    minPageWidth();


    
    function tableWidth() {
        widthTable = X * sizeCell
    }
    tableWidth()



    function exerciseTextSize() {
        // if(document.body.clientHeight > document.body.clientWidth) document.getElementById("exercise").style.fontSize = "10px";
        // else document.getElementById("exercise").style.fontSize = "";
    }















    function margin() {

        let marginTop = document.getElementById("mainField").getBoundingClientRect().top;
        
        for(let numberY = 0; numberY < Y; numberY++) {
            for(let numberX = 0; numberX < X; numberX++) {
                let elementNumber = numberY * X + numberX + 1;
                document.getElementById('block'+ elementNumber + '').style.cssText += 'top: '+ (marginTop + 2 + parseInt(numberY * sizeCell)) + "px" +';'; 
            }
        }
    
        let table = document.getElementById('schemaElementTable');
        
    
        if(tablePosition === "bottom") {
            table.style.cssText += 'top: '+ (marginTop + Y * sizeCell + 10) + ';';
            document.getElementById("starRate").style.cssText = "position: absolute; top: "+ (marginTop + Y * sizeCell + 12 + table.offsetHeight) +"px";
        }
        else {
            table.style.cssText += 'left: '+ (X * sizeCell + 20) + '; top: '+ marginTop +'';
            document.getElementById("starRate").style.cssText = "position: absolute; top: "+ (marginTop + 2 + table.offsetHeight) +"px; left: "+ (X * sizeCell + 20) +"";
        }
    }


    




    let selectedElementCopy = 0;
    function DragAndDrop(thisElement, e) {

        e.preventDefault();
 
        
        let selectedElement = document.getElementById(thisElement.id);
        selectedElementCopy = selectedElement.cloneNode(true);

        selectedElementCopy.addEventListener("touchstart", function() {
            DragAndDrop(this, window.event);   //тут менял
        });
        
        selectedElement.style.cssText = "position: absolute; zIndex: 1000;";
        document.body.append(selectedElement);

    

        moveAt();
        function moveAt() { 
            selectedElement.style.left = window.event.targetTouches[0].pageX - selectedElement.offsetWidth / 2 + 'px';
            selectedElement.style.top = window.event.targetTouches[0].pageY - selectedElement.offsetHeight / 2 + 'px'; 
        }

        function onMouseMove() {
            moveAt(window.event.targetTouches[0].pageX, window.event.targetTouches[0].pageY);
        }
        
        document.addEventListener('touchmove', onMouseMove) ;

        selectedElement.ontouchend = function(event) {

            document.removeEventListener('touchmove', onMouseMove);
            
            selectedElementCopy.ontouchend = null;
            selectedElement.ontouchend = null;


            let xCordinate = Math.round((window.event.changedTouches[0].pageX - mainField.offsetLeft + sizeCell / 2) / sizeCell);   //sizeCell добавлял
            let yCordinate = Math.round((window.event.changedTouches[0].pageY - mainField.offsetTop + sizeCell / 2) / sizeCell);
            let calculateCordinate = (yCordinate - 1) * X + xCordinate;


            let checkClassName;
            if(calculateCordinate <= X * Y) checkClassName = document.getElementById("block"+ calculateCordinate+ "").className.replace(/[^a-z]/gi, ''); //возможно надо переименовать потом
            
            if(xCordinate <= X && xCordinate > 0 && yCordinate <= Y && yCordinate > 0 && selectedElement.id.replace(/[^a-z]/gi, '') === "number" && checkClassName !== "otherElementClass") {   
  


                document.getElementById("block" + calculateCordinate.toString()).appendChild(selectedElement);
                selectedElement.style.cssText = "position: absolute; left: 0; top: 0;";

                let newID = (selectedElement.id + "_" + calculateCordinate.toString()).split("_");
                selectedElement.id = newID[0] + "_" + newID[newID.length - 1];
            
                document.getElementById("h2_" + calculateCordinate.toString()).style.cssText= "position: relative; left: 10px";

                let blockChild = document.querySelectorAll('div#block' + calculateCordinate.toString() + ' > div');
                if(blockChild.length > 1) blockChild[0].remove();

            }

            else if(xCordinate <= X && xCordinate > 0 && yCordinate <= Y && yCordinate > 0 && selectedElement.id.replace(/[^a-z]/gi, '') === "otherElementNumber" && checkClassName === "otherElementClass") { 

                for(let i = 0; i < changeArr.length; i++) {
                    let condition;
                    if(changeArr[i].length === 2) condition = calculateCordinate === changeArr[i][0] || calculateCordinate === changeArr[i][1];
                    else condition = calculateCordinate === changeArr[i][0] || calculateCordinate === changeArr[i][1] || calculateCordinate === changeArr[i][2] || calculateCordinate === changeArr[i][3];
                
                    if(condition) {
                        let firstBlockFromChangeArr = document.getElementById("block"+ changeArr[i][0] +"");
                        firstBlockFromChangeArr.appendChild(selectedElement);
                        firstBlockFromChangeArr.style.cssText += "width:"+ selectedElement.children[0].width +"; height:"+ selectedElement.children[0].width +";";
                        console.log(selectedElement.children[0].width, selectedElement.children[0].height)
                        for(let j = 1; j < changeArr[i].length; j++) document.getElementById("block"+ changeArr[i][j] +"").style.zIndex = "-1";
                        
                        
                        selectedElement.style.cssText = "position: absolute; left: 0; top: 0;";
    
                        selectedElement.id += "_"+ changeArr[i][0] +"";
    
                        let blockChild = document.querySelectorAll("div#block"+ changeArr[i][0] +" > div");
                        if(blockChild.length > 1) blockChild[0].remove();
                    }
                    // else thisElement.remove();
                }

                // else thisElement.remove();

                
            }

        else thisElement.remove(); 

        };
        copyElement(amountImg1x1, amountOtherImg);







        selectedElement.ondragstart = function() {
            return false;
        };

        selectedElementCopy.ondragstart = function() {    //решение pochti))
            return false;
        };
  
    }


    function copyElement(amountImg1x1, amountOtherImg) {
        // let tableLength = document.querySelectorAll("div.schemaElementTable > div.element1x1").length;
        
        for(let i = 1; i < parseInt(amountImg1x1) + 1; i++) {
            if(document.getElementById("table"+ i +"").querySelector("#number"+ i +"") === null) {
                document.getElementById("table"+ i +"").appendChild(selectedElementCopy);
            }
        }

        for(let i = 1; i < parseInt(amountOtherImg) + 1; i++) {
            if(document.getElementById("otherTable"+ i +"").querySelector("#otherElementNumber"+ i +"") === null) {
                document.getElementById("otherTable"+ i +"").appendChild(selectedElementCopy);
            }
        }
    }


    







    function numberFilesInFolders(amountImg1x1, amountOtherImg) {

        for(let i = 1; i < parseInt(amountImg1x1) + 1; i++) {
            let img1x1 = document.createElement("img");
            let div1x1 = document.createElement("div");
            let table1x1 = document.createElement("div");

 
            if(topicName === 'RPrU') {
                if(topicNumber === 11) img1x1.src = "img/img_RPrU11/element"+ i +".png";
                else img1x1.src = "img/img_RPrU1-10/element"+ i +".png";
            }

            // if(topicName === 'RPrU' && topicNumber >= 0 && topicNumber < 11) img1x1.src = "img/img_RPrU1-10/element"+ i +".png";
            // if(topicName === 'RPrU' && topicNumber === 11) img1x1.src = "img/img_RPrU11/element"+ i +".png";
            if(topicName === 'VC' && topicNumber >= 0 && topicNumber <= 14) img1x1.src = "img/img_VC1-14/element"+ i +".png"; //тут глянуть условия(последние два не нужны)

            if(topicName === 'URS' && topicNumber >= 0 && topicNumber <= 34) img1x1.src = "img/img_URS1-34/element"+ i +".png";  //тут глянуть условия(последние два не нужны)

            if(topicName === 'PCH') {
                if(topicNumber === 15) img1x1.src = "img/img_PCH15/element"+ i +".png";
                if([4, 5, 6, 8, 13, 14].includes(topicNumber)) img1x1.src = "img/img_PCH4-6,8,13,14/element"+ i +".png";
                if(topicNumber === 7 || topicNumber === 10) img1x1.src = "img/img_PCH7,10/element"+ i +".png";
                if([1, 2, 3, 9, 11, 12].includes(topicNumber)) img1x1.src = "img/img_PCH1-3,9,11,12/element"+ i +".png";
            }

            if(topicName === 'detector') {
                if(topicNumber > 0 && topicNumber <= 6) img1x1.src = "img/img_detector1-6/element"+ i +".png";
                else img1x1.src = "img/img_detector7-19/element"+ i +".png";
            }

//---------------------------------------------------------------------------------------------------------------------------------------------------
            if(topicName === "FiGSvCRS") img1x1.src = "img/img_FiGSvCRS1-10/element"+ i +".png";
//---------------------------------------------------------------------------------------------------------------------------------------------------




            img1x1.style.cssText="width: "+ sizeCell +"px; height: "+ sizeCell +"px;" 
            div1x1.id = "number"+ i +"";
            // div1x1.style.cssText = "display: inline-block;"; // вроде не нужно 

            div1x1.addEventListener("touchstart", function() {
                DragAndDrop(this, window.event);    //тут менял
            });

            table1x1.id = "table"+ i +"";
            // table1x1.className = "element1x1"; теперь тоже не нужно
            table1x1.style.cssText = "display: inline; float: left; margin: 5px 5px 5px 5px;";
            let schemaElementTable = document.getElementById("schemaElementTable");
            schemaElementTable.appendChild(table1x1).appendChild(div1x1).appendChild(img1x1);
            schemaElementTable.style.cssText="width: "+ widthTable +"px; height: auto; position: absolute; border: 4px solid black; background-color: rgb(194, 234, 247);";
        } 

    


        for(let i = 1; i < parseInt(amountOtherImg) + 1; i++) {
            let otherImg = document.createElement("img");
            let otherDiv = document.createElement("div");
            let otherTable = document.createElement("div");






            if(topicName === 'URS' && topicNumber >= 0 && topicNumber <= 34) otherImg.src = "img/img_URS1-34/otherElement"+ i +".png";    //тут глянуть условия(последние два не нужны)
            if(topicName === 'PCH') {
                if(topicNumber === 15) otherImg.src = "img/img_PCH15/otherElement"+ i +".png";
                if([1, 2, 3, 9, 11, 12].includes(topicNumber)) otherImg.src = "img/img_PCH1-3,9,11,12/otherElement"+ i +".png";
            }
//---------------------------------------------------------------------------------------------------------------------------------------------------
            if(topicName === "FiGSvCRS") otherImg.src = "img/img_FiGSvCRS1-10/otherElement"+ i +".png";
//---------------------------------------------------------------------------------------------------------------------------------------------------

            otherImg.onload = function() {
                let attitudeSize = otherImg.width / otherImg.height;
                 
                if(attitudeSize > 1) otherImg.style.cssText = "width: "+ 2 *sizeCell +"px; height: "+ sizeCell +"px;";
                if(attitudeSize < 1) otherImg.style.cssText = "width: "+ sizeCell +"px; height: "+ sizeCell * 2 +"px;";
                if(attitudeSize === 1) otherImg.style.cssText = "width: "+ sizeCell * 2 +"px; height: "+ sizeCell * 2 +"px;";

                otherDiv.id = "otherElementNumber"+ i +"";
                
                otherDiv.addEventListener("touchstart", function() {
                    DragAndDrop(this, window.event);    //тут менял
                });

                otherTable.id = "otherTable"+ i +"";
                // otherTable.className = "otherTable";   теперь тоже не нужно
                otherTable.style.cssText = "display: inline-block; margin: 5px 5px 5px 5px;"
                document.getElementById("schemaElementTable").appendChild(otherTable).appendChild(otherDiv).appendChild(otherImg);

            }
        }
    }
    numberFilesInFolders(amountImg1x1, amountOtherImg);




    function elementMore1x1(changeArr) {
       
        if(changeArr.length > 0) {
            for(let i = 0; i < changeArr.length; i++) {

                if(changeArr[i].length === 2 && changeArr[i][0] !== changeArr[i][1] - 1) {
                    let elem1 = document.getElementById("block"+ changeArr[i][0] +"");
                    let elem2 = document.getElementById("block"+ changeArr[i][1] +"");
                    elem1.style.cssText += "border-bottom-width: 0px;";   
                    elem2.style.cssText += "border-top-width: 0px;";
                    elem1.className = "otherElementClass";
                    elem2.className = "otherElementClass";  
    
                    document.getElementById("h2_"+ changeArr[i][0] +"").style.cssText = "display: none;";
                    document.getElementById("h2_"+ changeArr[i][1] +"").style.cssText = "display: none;";
                
                }
                else if ((changeArr[i].length === 2 && changeArr[i][0] === changeArr[i][1] - 1)) {
                    let elem1 = document.getElementById("block"+ changeArr[i][0] +"");  
                    let elem2 = document.getElementById("block"+ changeArr[i][1] +"");
                    elem1.style.cssText += "border-right-width: 0px;"; 
                    elem2.style.cssText += "border-left-width: 0px;"; 
                    elem1.className = "otherElementClass";
                    elem2.className = "otherElementClass";
    
                    document.getElementById("h2_"+ changeArr[i][0] +"").style.cssText = "display: none;";
                    document.getElementById("h2_"+ changeArr[i][1] +"").style.cssText = "display: none;";
    
                }
                else {
                    let elem1 = document.getElementById("block"+ changeArr[i][0] +"");   
                    let elem2 = document.getElementById("block"+ changeArr[i][1] +"");
                    let elem3 = document.getElementById("block"+ changeArr[i][2] +"");   
                    let elem4 = document.getElementById("block"+ changeArr[i][3] +"");
                    elem1.style.cssText += "border-bottom-width: 0px; border-right-width: 0px;";
                    elem2.style.cssText += "border-bottom-width: 0px; border-left-width: 0px;";
                    elem3.style.cssText += "border-top-width: 0px; border-right-width: 0px;";
                    elem4.style.cssText += "border-top-width: 0px; border-left-width: 0px;";
                    elem1.className = "otherElementClass";                 //переписать тут через фор и в других местах
                    elem2.className = "otherElementClass";
                    elem3.className = "otherElementClass";
                    elem4.className = "otherElementClass";
    
                    document.getElementById("h2_"+ changeArr[i][0] +"").style.cssText = "display: none;";
                    document.getElementById("h2_"+ changeArr[i][1] +"").style.cssText = "display: none;";
                    document.getElementById("h2_"+ changeArr[i][2] +"").style.cssText = "display: none;";
                    document.getElementById("h2_"+ changeArr[i][3] +"").style.cssText = "display: none;";
    
                }
            }
        }
    }

    elementMore1x1(changeArr);
    






    










    let answerObj = [];

    function userAnswer() {
    
        let numberOfCells = document.querySelectorAll("div.mainField > div").length;
        for(let i = 1; i < numberOfCells + 1; i++) {
            let cellContent = document.querySelectorAll("div#"+ document.querySelectorAll("div.mainField > div")[i - 1].id +" > div");
            if(cellContent.length > 0) {
                let stringOfValidValues = cellContent[0].id.split("_")[0].replace(/[a-zа-яё]/gi, '');
                answerObj.push(stringOfValidValues);
            }
            else {
                let blankImage = document.createElement("img");
                blankImage.src = "img/general_img/elementEmpty.png";
                blankImage.id = "tytZanyato"; 
                blankImage.style.cssText = "position: absolute; z-index: -1000;";

                if(document.getElementById('h2_'+ i + '') !== null) {
                    document.getElementById('h2_'+ i + '').remove();
                    document.getElementById("block"+ i +"").appendChild(blankImage);
                }
            }

            let emptyCell = document.querySelectorAll("div."+ document.querySelectorAll("div.mainField > div")[i - 1].id +" > #tytZanyato");
            if(emptyCell.length > 0) answerObj.push("");      
        }
    }

    

    // function schemaValidation(good, bad) {}


    async function SendFormSecond(element) {
        userAnswer();
        element.preventDefault();
        let objToServer = new FormData(document.getElementById('form'));
        let answerJSON = JSON.stringify([answerObj, testNumber]);
        objToServer.append('answerJSON', answerJSON);

        try {
            timerRemove();
            const response = await fetch('php/form.php', {
                method: 'POST',
                body: objToServer
            });
            let json = await response.json();
           
            if(json[4] >= 3) {
                alert("попытки кончились");
                location.href = '../choiseTestPage.php';
            }
            else {
                // schemaValidation(json[1], json[2]);
                marking(json[3]);
                // console.log(json[0])
            }
            console.log(json[5])
              
        } 
        catch (error) {
            console.error('Ошибка:', error);
        }
    }
    form.onsubmit = SendFormSecond;





    function marking(markFromPHP) {
        let markToDisplay = document.createElement("div");
        let starRatePosition = document.getElementById("starRate").getBoundingClientRect();
        markToDisplay.style.cssText = "position: absolute; left: "+ (starRatePosition.left + 505) +"px; top: "+ (starRatePosition.top - 5) +"px";  
        markToDisplay.id = "mark";
        document.body.append(markToDisplay);
        let markValue = document.createElement("h1");
        markValue.append(""+ parseInt(markFromPHP * 100) / 100 +"/10");
        document.getElementById("mark").appendChild(markValue);
        document.getElementById("starRate").setAttribute("width", 500);
        document.getElementById("fillingPercentX").setAttribute("x", ""+ markFromPHP * 10+ "%");
    }







    let time = 5999;
        
    const timer = async () => { 
             
        let seconds = time;
        let delay = 1; 

        let timerWrapper = document.getElementById("timer");
        timerWrapper.style.cssText="position: absolute; top: 7.5px; right: 15px; width: 100px; height: 30px;";

        for(let i = 0; i <= time; i++) { 
            await new Promise(res => setTimeout(() => {
                delay = 1000;
                let minutes =  Math.floor(seconds / 60);
                if(seconds % 60 < 10) timerWrapper.innerHTML = ""+ minutes +":0"+ seconds % 60 +"";
                else timerWrapper.innerHTML = ""+ minutes +":"+ seconds % 60 +"";
                    
                if(seconds === 0 && time !== -1) {
                    let button = document.getElementById("schemaValidation");
                    button.click();
                }
                if(seconds < 60 && seconds >= 10) timerWrapper.style.color = "orange";
                if(seconds < 10) timerWrapper.style.color = "red";
                timerWrapper.style.fontSize = "40";
                seconds -= 1;
                res();  
            }, delay));
        }
    };
    timer();  //  наверное можно оптимальнее переписать
        

        
    function timerRemove() {
        document.getElementById("schemaValidation").remove();
        document.getElementById("timer").remove(); 
        document.getElementById("pulloutMenu").remove();
        time = -1;
    }



    
}