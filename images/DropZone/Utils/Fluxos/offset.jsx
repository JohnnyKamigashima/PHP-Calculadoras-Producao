#target Photoshop

var docRef = app.activeDocument;

var offsetValue = prompt("Qual offset? (em mm)",0.15);
var offsetRes=docRef.resolution;
// var offsetRes = prompt("Qual resolução do arquivo? (em dpi)",2540);
if(offsetValue!=null){
  offsetValue=(((offsetValue/2)*100)*offsetRes)/2540;
  offsetValue=Math.ceil(offsetValue);
  //offsetValue=parseFloat(offsetValue/2)
  //offsetValue=offsetValue/offsetRes; //convert inches to mm ?

  for (var i = 0; i < docRef.channels.length; i++) {

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
allChannelsVisible();
};

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
