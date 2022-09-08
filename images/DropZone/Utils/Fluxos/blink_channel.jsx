// Blink channel v 0.1

#target Photoshop

var docRef = app.activeDocument,
vezesNr = 5,
error=false,
channel = prompt("Qual canal?)",1); // Pede quan canal a piscar
if (channel==null){var error=true;}
if (channel>docRef.channels.length || channel==0) {
  error = true;
}
//var tempoNr = prompt("Qual intervalo? (em s)",1);                          
//if (tempoNr==null){return;}
if (error == false){
  //alert(error);
  if (channel.length > 2) {channelNr=getChanNr(docRef, channel)}
  else {channelNr =Number(channel)-1;}
  //alert(channelNr);
  if (channelNr !=false) {
    app.togglePalettes();
    for (x=0;x<=vezesNr;x++){
      docRef.channels[channelNr].visible=false
      app.refresh();                  // perde performance mas deixa o usuario ver o que aconteceu
      //wait(tempoNr*1000)
      docRef.channels[channelNr].visible=true
      app.refresh();                  // perde performance mas deixa o usuario ver o que aconteceu
    }
    app.togglePalettes();
  }
  
  
}

function getChanNr(docRef,channel){
  var Ncanais = docRef.channels.length,
  channelUp = channel.toUpperCase();
  
  for (var y = 0; y < Ncanais; y++) {
    var upperName = docRef.channels[y].name.toUpperCase(),
    channelRef = docRef.channels[y],
    found=false;
    
    if (upperName.indexOf(channelUp) != -1) {found=true;break;}      
    else {found=false}
  }
  if (found==true) {return y;}
  else {return false}
  
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
