function rpru(X, Y, sizeCell, numberCellSize, tablePosition, testNumber, exercise, changeArr) {
//звезды привязать к таблице

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


        document.getElementById("exercise").style.cssText += "background-color: rgb(219, 217, 217); margin-bottom: 7.5px;";
        

        
        
        
        window.onload = function() {
            margin();
            window.addEventListener('resize', function() {
                margin();
            });    
        }
    }
    createBlock();



















    let pulloutMenuWidth = document.getElementById("pulloutMenu").clientWidth;
    function margin() {
        
        let marginTop = document.getElementById("exercise").clientHeight + parseInt(window.getComputedStyle(document.getElementById("exercise")).marginTop);
        let table = document.getElementById('schemaElementTable');

        for(let numberY = 0; numberY < Y; numberY++) {
            for(let numberX = 0; numberX < X; numberX++) {
                let elementNumber = numberY * X + numberX + 1;
                document.getElementById('block'+ elementNumber + '').style.cssText += 'top: '+ (marginTop + parseInt(numberY * sizeCell) - 1) + "px" +';'; 
            }
        }
    

    
        if(tablePosition === "bottom") {
            table.style.cssText += 'top: '+ (marginTop + Y * sizeCell + 10) + ';';
            document.getElementById("starRate").style.cssText = "position: absolute; top: "+ (marginTop + Y * sizeCell + 12 + table.offsetHeight) +"px";

            if(document.body.clientWidth < X * sizeCell + pulloutMenuWidth + 30) document.getElementById("pulloutMenu").style.display = "none";
            else document.getElementById("pulloutMenu").style.display = "";

        }

        if(tablePosition === "right") {
            table.style.cssText += 'left: '+ (X * sizeCell + 20) + '; top: '+ (marginTop - 2.5) +'';
            document.getElementById("starRate").style.cssText = "position: absolute; top: "+ (marginTop + 2 + table.offsetHeight) +"px;";

            if(document.body.clientWidth < X * sizeCell + pulloutMenuWidth + 40 + table.clientWidth) document.getElementById("pulloutMenu").style.display = "none";
            else document.getElementById("pulloutMenu").style.display = "";
        }   
        
        if(tablePosition === "rightWidthScrollbar") {
            console.log(document.getElementById("mainField").getBoundingClientRect().top)
            table.style.cssText += 'left: '+ (X * sizeCell + 20) + '; top: '+ (marginTop - 2.5) +'';
            document.getElementById("starRate").style.cssText = "position: absolute; top: "+ (marginTop + 2 + table.offsetHeight) +"px;";

            if(document.body.clientWidth < X * sizeCell + pulloutMenuWidth + 40 + table.clientWidth) document.getElementById("pulloutMenu").style.display = "none";
            else document.getElementById("pulloutMenu").style.display = "";
        }
        
    }



    










    let selectedElementCopy = 0;
    function DragAndDrop(thisElement) {
        
        let selectedElement = document.getElementById(thisElement.id);
        selectedElementCopy = selectedElement.cloneNode(true);



        selectedElementCopy.addEventListener("mousedown", function() {
            if(event.button === 0) DragAndDrop(this);   //тут менял    
        });
        
        selectedElement.style.cssText = "position: absolute; zIndex: 1000;";
//-----------------------------------------------------------------------------------------------------------------------------------------
        let blockThatWasMoved = document.getElementById("block" + selectedElement.id.split("_")[1]);
        if(blockThatWasMoved !== null) {
            blockThatWasMoved.style.border = "1px dashed black";
            
            if(blockThatWasMoved.className === "otherElementClass") {
                for(let i = 0; i < changeArr.length; i++) {
                    for(let j = 0; j < changeArr[i].length; j++) {
                        // console.log(document.getElementById("block" + changeArr[i][j]).children);
                        if(document.getElementById("block" + changeArr[i][j]).children.length <= 1) {
                            // console.log("b")
                            document.getElementById("block" + changeArr[i][j]).style.border = "1px dashed black";
                        }
                    }
                }  
                elementMore1x1(changeArr);
            }
        }   //возвращаем бордюры элементам из которых убрали блок
//-----------------------------------------------------------------------------------------------------------------------------------------

        if(selectedElement.children[0].id === "otherImg") {
            
            for(let i = 0; i < changeArr.length; i++) {
                for(let j = 0; j < changeArr[i].length; j++) {
                    document.getElementById("block" + changeArr[i][j]).style.backgroundColor = "rgb(240, 165, 188, 0.5)";
                }
            }  

            let otherImg = selectedElement.children[0];
            let attitudeSize = otherImg.width / otherImg.height;  
            if(attitudeSize > 1) otherImg.style.cssText = "width: "+ (2 *sizeCell) +"px; height: "+ (sizeCell) +"px;";
            if(attitudeSize < 1) otherImg.style.cssText = "width: "+ (sizeCell) +"px; height: "+ (sizeCell * 2) +"px;";
            if(attitudeSize === 1) otherImg.style.cssText = "width: "+ (sizeCell * 2) +"px; height: "+ (sizeCell * 2) +"px;";
        }
        else selectedElement.children[0].style.cssText = "width: "+ (sizeCell) +"; height: "+ (sizeCell) +";";
  
        document.body.append(selectedElement);

    


        moveAt();
        function moveAt() {  
            selectedElement.style.left = window.event.pageX - selectedElement.offsetWidth / 2 + 'px';
            selectedElement.style.top = window.event.pageY - selectedElement.offsetHeight / 2 + 'px'; 
        }

        function onMouseMove(event) {
            moveAt(window.event.pageX, window.event.pageY);
        }
    
        document.addEventListener('mousemove', onMouseMove);
    
        selectedElement.onmouseup = function() {

            document.removeEventListener('mousemove', onMouseMove);
            
            selectedElementCopy.onmouseup = null;
            selectedElement.onmouseup = null;

            let xCordinate = Math.round((window.event.pageX - mainField.offsetLeft + sizeCell / 2) / sizeCell);   //sizeCell добавлял
            let yCordinate = Math.round((window.event.pageY - mainField.offsetTop + sizeCell / 2) / sizeCell);
            let calculateCordinate = (yCordinate - 1) * X + xCordinate;
            // console.log()


            let checkClassName;
            if(calculateCordinate <= X * Y) checkClassName = document.getElementById("block"+ calculateCordinate+ "").className.replace(/[^a-z]/gi, ''); //возможно надо переименовать потом
            
            // console.log(checkClassName)

            if(xCordinate <= X && xCordinate > 0 && yCordinate <= Y && yCordinate > 0 && selectedElement.id.replace(/[^a-z]/gi, '') === "number" && checkClassName !== "otherElementClass") {   

                document.getElementById("block" + calculateCordinate.toString()).appendChild(selectedElement);
//-----------------------------------------------------------------------------------------------------------------------------------
                document.getElementById("block" + calculateCordinate.toString()).style.border = "none";    //удаляем бордюры
//-----------------------------------------------------------------------------------------------------------------------------------
                selectedElement.style.cssText = "position: absolute; left: 0; top: 0;";
        //-----------------------------------------------------------------------------------------------------------------------------------
                //  меняем айди элемента если он перемещается в другую ячейку
                let newID = (selectedElement.id + "_" + calculateCordinate.toString()).split("_");
                selectedElement.id = newID[0] + "_" + newID[newID.length - 1];
        //-----------------------------------------------------------------------------------------------------------------------------------    
                document.getElementById("h2_" + calculateCordinate.toString()).style.cssText += "position: relative; margin-left: 20%; margin-top: 30%;";

                let blockChild = document.querySelectorAll('div#block' + calculateCordinate.toString() + ' > div');
                if(blockChild.length > 1) blockChild[0].remove();

            }

            else if(xCordinate <= X && xCordinate > 0 && yCordinate <= Y && yCordinate > 0 && selectedElement.id.replace(/[^a-z]/gi, '') === "otherElementNumber" && checkClassName === "otherElementClass") { 

                

                for(let i = 0; i < changeArr.length; i++) {
                    let condition;

                    if(changeArr[i].length === 2) condition = calculateCordinate === changeArr[i][0] || calculateCordinate === changeArr[i][1];
                    else condition = calculateCordinate === changeArr[i][0] || calculateCordinate === changeArr[i][1] || calculateCordinate === changeArr[i][2] || calculateCordinate === changeArr[i][3]; 
                    
                    for(let j = 0; j < changeArr[i].length; j++) document.getElementById("block" + changeArr[i][j]).style.cssText += "background-color: rgba(0, 0, 0, 0);";

                    if(condition) {

                        let firstBlockFromChangeArr = document.getElementById("block"+ changeArr[i][0] +"");
                //-----------------------------------------------------------------------------------------------------------------------------------         
                        if(changeArr[i].length === 4) {
                            if(selectedElement.clientHeight === selectedElement.clientWidth) {
                                firstBlockFromChangeArr.appendChild(selectedElement);
                                for(let j = 0; j < changeArr[i].length; j++) document.getElementById("block" + changeArr[i][j]).style.border = "none";
                                // console.log("a")
                            }
                            else {
                                selectedElement.remove();
                                for(let j = 0; j < changeArr[i].length; j++) {
                                    if(document.getElementById("block" + changeArr[i][j]).children.length === 0) {
                                        document.getElementById("block" + changeArr[i][j]).style.cssText += "border: 1px dashed black; background-color: rgba(0, 0, 0, 0);";
                                    }
                                }   
                                elementMore1x1(changeArr);
                                
                            }
                        }
                        if(changeArr[i].length === 2) {

                            if(changeArr[i][0] + 1 === changeArr[i][1] && selectedElement.clientHeight < selectedElement.clientWidth) {
                                firstBlockFromChangeArr.appendChild(selectedElement);
                                for(let j = 0; j < changeArr[i].length; j++) document.getElementById("block" + changeArr[i][j]).style.border = "none"; 
                            }
                            else if(changeArr[i][0] + 1 !== changeArr[i][1] && selectedElement.clientHeight > selectedElement.clientWidth) {
                                firstBlockFromChangeArr.appendChild(selectedElement);
                                for(let j = 0; j < changeArr[i].length; j++) document.getElementById("block" + changeArr[i][j]).style.border = "none";
                            }
                            else {
                                selectedElement.remove();
                                for(let j = 0; j < changeArr[i].length; j++) {
                                    if(document.getElementById("block" + changeArr[i][j]).children.length === 0) {
                                        document.getElementById("block" + changeArr[i][j]).style.cssText += "border: 1px dashed black; background-color: rgba(0, 0, 0, 0);";
                                    }
                                }
                                elementMore1x1(changeArr);
                            }
                        }
                //-----------------------------------------------------------------------------------------------------------------------------------         
                 
                        //-----------------------------------------------------------------------------------------------------------------------------------    
                        // firstBlockFromChangeArr.style.cssText += "width:"+ selectedElement.children[0].width +"; height:"+ selectedElement.children[0].width +";"; 
                        // не могу понять зачем тут была эта строчка
                        //-----------------------------------------------------------------------------------------------------------------------------------    


                        for(let j = 1; j < changeArr[i].length; j++) document.getElementById("block"+ changeArr[i][j] +"").style.zIndex = "-1";
                        selectedElement.style.cssText = "position: absolute; left: 0px; top: 0px;";
                        
                //-------------------------------------------------------------------------------------------------------------------------------
                //  меняем айди элемента если он перемещается в другую ячейку  
                        let newID = (selectedElement.id + "_" + changeArr[i][0]).split("_");
                        selectedElement.id = newID[0] + "_" + newID[newID.length - 1];
                //-------------------------------------------------------------------------------------------------------------------------------
    
                        let blockChild = document.querySelectorAll("div#block"+ changeArr[i][0] +" > div");
                        if(blockChild.length > 1) blockChild[0].remove();
                    }
                }                 
            }

        else {
            thisElement.remove();
            for(let i = 0; i < changeArr.length; i++) {
                for(let j = 0; j < changeArr[i].length; j++) document.getElementById("block" + changeArr[i][j]).style.cssText += "background-color: rgba(0, 0, 0, 0);";
            }
              
            
        }

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

            img1x1.id = "img1x1";
            img1x1.style.cssText="width: "+ (sizeCell - 10) +"px; height: "+ (sizeCell - 10) +"px;";

            div1x1.id = "number"+ i +""; 
            div1x1.addEventListener("mousedown", function() {
                if(event.button === 0) DragAndDrop(this);  
            });

            table1x1.id = "table"+ i +"";
            table1x1.style.cssText = "display: inline; float: left; margin: 5px 5px 5px 5px;";
            table1x1.className = "wrapperStyle";
            document.getElementById("schemaElementTable").appendChild(table1x1).appendChild(div1x1).appendChild(img1x1);
         
        } 

    

        

        for(let i = 1; i < parseInt(amountOtherImg) + 1; i++) {
            let otherImg = document.createElement("img");
            let otherDiv = document.createElement("div");
            let otherTable = document.createElement("div");
            otherTable.className = "wrapperStyle";

            if(topicName === 'URS' && topicNumber >= 0 && topicNumber <= 34) otherImg.src = "img/img_URS1-34/otherElement"+ i +".png";    //тут глянуть условия(последние два не нужны)
            if(topicName === 'PCH') {
                if(topicNumber === 15) otherImg.src = "img/img_PCH15/otherElement"+ i +".png";
                if([1, 2, 3, 9, 11, 12].includes(topicNumber)) otherImg.src = "img/img_PCH1-3,9,11,12/otherElement"+ i +".png";
            }
//---------------------------------------------------------------------------------------------------------------------------------------------------
            if(topicName === "FiGSvCRS") otherImg.src = "img/img_FiGSvCRS1-10/otherElement"+ i +".png";
//---------------------------------------------------------------------------------------------------------------------------------------------------
            otherImg.id = "otherImg";
            otherImg.onload = function() {
                let attitudeSize = otherImg.width / otherImg.height;
                 
                if(attitudeSize > 1) otherImg.style.cssText = "width: "+ (2 *sizeCell - 10) +"px; height: "+ (sizeCell - 10) +"px;";
                if(attitudeSize < 1) otherImg.style.cssText = "width: "+ (sizeCell - 10) +"px; height: "+ (sizeCell * 2 - 10) +"px;";
                if(attitudeSize === 1) otherImg.style.cssText = "width: "+ (sizeCell * 2 - 10) +"px; height: "+ (sizeCell * 2 - 10) +"px;";

                otherDiv.id = "otherElementNumber"+ i +"";
                otherDiv.addEventListener("mousedown", function() {
                    if(event.button === 0) DragAndDrop(this);    //тут менял
                });

                otherTable.id = "otherTable"+ i +"";
                otherTable.style.cssText = "display: inline; float: left; margin: 5px 5px 5px 5px;"
                document.getElementById("schemaElementTable").appendChild(otherTable).appendChild(otherDiv).appendChild(otherImg);
            }
        }
    }
    numberFilesInFolders(amountImg1x1, amountOtherImg);







    function tableSizes() {

        let tableWidth = 0, tableHeight = 0; 
        let schemaElementTable = document.getElementById("schemaElementTable");    

        if(tablePosition === "bottom") {
            tableWidth = X * sizeCell;
            tableHeight = "auto";
            document.getElementById("exercise").style.cssText += "max-width: "+ (X * sizeCell + 4) +"px;";  
        }

        if(tablePosition === "right") {
            tableWidth =  Math.ceil(amountImg1x1 / Y) * sizeCell; // под элементы больше чем 1 на 1 работать не будет
            tableHeight = Y * sizeCell;
            // console.log(Math.ceil(amountImg1x1 / Y))
            document.getElementById("exercise").style.cssText += "max-width: "+ (X * sizeCell + 20 + tableWidth) +"px;";
        }
      
        schemaElementTable.style.cssText += "width: "+ tableWidth +"; height: "+ (tableHeight - 2) +"; position: absolute; border: 4px solid black; background-color: rgb(194, 234, 247);";
            



        if(tablePosition === "rightWidthScrollbar") {

            let scrollBarWidth = parseInt(window.getComputedStyle(schemaElementTable, ':-webkit-scrollbar').width);
//---------------------------------------------------------------------------------------------------------------------------------------------------   
            schemaElementTable.style.cssText += "overflow-y: hidden;  height: "+ (Y * sizeCell - 2) +"; width: "+ (sizeCell * 4) +"";    
            document.getElementById("exercise").style.maxWidth= ""+ (X * sizeCell + 20 + sizeCell * 4) +"";

            schemaElementTable.addEventListener("mouseover", function() {
                schemaElementTable.style.cssText += "overflow-y: auto; width: "+ (sizeCell * 4 + scrollBarWidth) +"";
                // document.getElementById("exercise").style.maxWidth= ""+ (X * sizeCell + 20 + sizeCell * 4 + scrollBarWidth) +"";
                
                for(let i = 0; i < document.getElementsByClassName("wrapperStyle").length; i++) {
                    document.getElementsByClassName("wrapperStyle")[i].addEventListener("mousedown", function() {
                        schemaElementTable.style.cssText += "overflow-y: hidden; width: "+ sizeCell * 4 +"";
                        // document.getElementById("exercise").style.maxWidth= ""+ (X * sizeCell + 20 + sizeCell * 4) +"";
                    });   
                }
            });

            schemaElementTable.addEventListener("mouseout", function() {
                schemaElementTable.style.cssText += "overflow-y: hidden; width: "+ sizeCell * 4 +"";
                document.getElementById("exercise").style.maxWidth= ""+ (X * sizeCell + 20 + sizeCell * 4) +"";
            });
//---------------------------------------------------------------------------------------------------------------------------------------------------
            // schemaElementTable.style.cssText += "overflow-y: hidden; height: "+ (Y * sizeCell - 2) +"; width: "+ (sizeCell * 4 + scrollBarWidth) +"";
            // document.getElementById("exercise").style.maxWidth= ""+ (X * sizeCell + 20 + sizeCell * 4 + scrollBarWidth) +"";
            
            // schemaElementTable.addEventListener("mouseover", function() {
            //     schemaElementTable.style.cssText += "overflow-y: auto;";

            //     for(let i = 0; i < document.getElementsByClassName("wrapperStyle").length; i++) {
            //         document.getElementsByClassName("wrapperStyle")[i].addEventListener("mousedown", function() {
            //             schemaElementTable.style.cssText += "overflow-y: hidden;";
            //         });   
            //     }
            // });
            // schemaElementTable.addEventListener("mouseout", function() {
            //     schemaElementTable.style.cssText += "overflow-y: hidden;";
            // });
//---------------------------------------------------------------------------------------------------------------------------------------------------
        }
    }
    tableSizes();









//-----------------------------------------------------------------------------------------------------------------------
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
//----------------------------------------------------------------------------------------------------------------------- 






    










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
                blankImage.id = "occupiedСell"; 

                blankImage.style.cssText = "position: absolute; left: 0; top: 0; width: "+ (sizeCell) +"px; height: "+ (sizeCell) +"px;";  //тут убрал z-index = -1000

                if(document.getElementById('h2_'+ i + '') !== null) {
                    document.getElementById('h2_'+ i + '').remove();
                    document.getElementById("block"+ i +"").appendChild(blankImage);
                    document.getElementById("block"+ i +"").style.border = "none";
                }
                
            }
            

            let emptyCell = document.querySelectorAll("div."+ document.querySelectorAll("div.mainField > div")[i - 1].id +" > #occupiedСell");
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
            // console.log(json[5])
              
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





    function help() {
        let pressedKey = new Set();
        // console.log(testNumber.replace(/[0-9]/gi, ''))
        let answer = document.createElement("img");
        let topHelp = document.getElementById("mainField").getBoundingClientRect().top;
        let leftHelp = document.getElementById("mainField").getBoundingClientRect().left;
        let widthHelp = document.getElementById("mainField").getBoundingClientRect().width;
        let heightHelp = document.getElementById("mainField").getBoundingClientRect().height;
        answer.style.cssText = "display: none; position: absolute; left: "+ (leftHelp) +"; top: "+ (topHelp) +"; width: "+ widthHelp +"; height: "+ heightHelp +"; opacity: 0.3;"
        answer.src = "../img/answers/"+ testNumber.replace(/[0-9]/gi, '') +"/"+ testNumber +"_right.png";
        document.body.append(answer);
  
        document.addEventListener('keydown', function(event) {
            pressedKey.add(event.code);
            let rightKeyArr = ["KeyP", "KeyL"]
            for (let code of rightKeyArr) if (!pressedKey.has(code) || pressedKey.size !== rightKeyArr.length) return;
            answer.style.display = "";
        });
  
        document.addEventListener('keyup', function(event) {
            answer.style.display = "none"
            pressedKey.delete(event.code);
        });
      }

    help();







    
}