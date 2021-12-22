// Offset Script version 2.0

#target Photoshop

var docRef = app.activeDocument;
var secondRunVar = docRef.info.instructions.split(","); // e joga no vetor

app.preferences.numberofHistoryStates = docRef.channels.length+3;

if (typeof(secondRunVar[1])=="undefined"){  //verifica se é primeira rodada
    firstRun(docRef);
}
else {
     runOffset(docRef,secondRunVar[0],secondRunVar[1],secondRunVar[2]);
}
ajustaEscala();

function firstRun(docRef)
{
    var docName = docRef.name;

    /* gera novo nome do arquivo se for salvar

    var nameLength = docName.length;                        // comprimento do nome do arquivo
    var nameLengthNoExt = nameLength-4;                     // menos a extensao
    var docNameNoExt = docName.substr(0,nameLengthNoExt);   // nome do arquivo menos a extensao
    var docPath = docRef.path.fsName;                       // caminho do arquivo atual

    docNameNoExt=docNameNoExt+"_Offset";                    // Novo nome do arq
    */

    var docResolution = docRef.resolution;
    var offsetValue = prompt("Qual offset? (em mm)",0.15);  // pede as variaveis
    if (offsetValue==null){return;}

    var idealResolution = prompt("Qual resolução de visualização? (ideal Performance: 300 - Qualidade: 800 dpi)",600);                              // Para resultados mais rapidos é melhor trabalhar com menos resolução (600-800 dpi recomendavel)
    if (idealResolution==null){return;}

    var firstRunVar = offsetValue;
    var rerunValue = prompt("Rodar quantas vezes?",4);
    if (rerunValue==null){return;}

    var timeValue = prompt("Com quanto de intervalo? (em segundos)",0);
    if (timeValue==null){return;}

    var firstRunVar = offsetValue+","+rerunValue+","+timeValue          // salva offset, rerun, wait time

    var newDoc = docRef.duplicate();                        // Duplica arquivo atual
    newDoc.name

    //newDoc.saveAs(new File(docPath+"/"+docNameNoExt+".psd")); // Salva novo arquivo

    newDoc.flatten();

    if (docResolution > idealResolution){                            // Resize document se maior que o ideal
        newDoc.resizeImage("100%","100%",idealResolution);}

    newDoc.info.instructions = firstRunVar;                 // grava variaveis do first run

    return true;
}

function runOffset(docRef,offsetValue,rerunValue,timeValue){

    var offsetRes=docRef.resolution;
    var snapshot=docRef.historyStates.getByName("File Info");

if(offsetValue!=null){
  offsetValue=(((offsetValue/2)*100)*offsetRes)/2540;
  offsetValue=Math.ceil(offsetValue*0.66);

for (var reruns=0; reruns<rerunValue;reruns++){ // roda automaticamente n vezes



    for (var i = 0; i < docRef.channels.length; i++) {//aplica a magica

    //set random values for Horizontal and vertical
    var randOffV = getRandomInt(-offsetValue,offsetValue),
    randOffH = getRandomInt(-offsetValue,offsetValue),
    unitType="pixels";

    randOffH= randOffH+" "+unitType;
    randOffV=randOffV+" "+unitType;

    refLayer = docRef.artLayers.getByName("Background");
    theChannels = new Array(docRef.channels[i]); //select current channel
    docRef.activeChannels=theChannels;

    refLayer.applyOffset(randOffH,randOffV,OffsetUndefinedAreas.SETTOBACKGROUND); //filter current layer of current document using offset filter

    }

allChannelsVisible();           // senao ele mostra somente o ultimo canal que ele offsetou
app.refresh();                  // perde performance mas deixa o usuario ver o que aconteceu
wait(timeValue*1000);
docRef.activeHistoryState = snapshot;   // le o historico original
}

docRef.activeHistoryState = snapshot;   // volta a estaca 0
}
    return true;
}


function getRandomInt(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min)) + min; //The maximum is exclusive and the minimum is inclusive
}
function wait(ms) {
    var d = new Date();
    var d2 = null;
    do { d2 = new Date(); }
    while(d2-d < ms);
}
function allChannelsVisible (){
  var docRef = app.activeDocument;
  for (var i = 0; i < docRef.channels.length; i++) {
    docRef.channels[i].visible=true;
  }
}


function ajustaEscala(){
  var milimetro=10; //relaçao pixel polegada
  var resolucao = app.activeDocument.resolution;
  var relacao = (resolucao/25.4)*milimetro;

  app.activeDocument.measurementScale.pixelLength = relacao;
  app.activeDocument.measurementScale.logicalLength = milimetro;
  app.activeDocument.measurementScale.logicalUnits = "mm";

}


/*  Testes

docRef.layerComps.add("Original","Original file before offset",true,true,true);

var inputState = docRef.layerComps.add("Original","Original file before offset",true,true,true);
var inputState = docRef.layerComps.apply();
localStorage["firstRunVar"] =  JSON.stringify(firstRunVar); // no JSON available

var secondRunVar = JSON.parse(localStorage["firstRunVar"])
*/
