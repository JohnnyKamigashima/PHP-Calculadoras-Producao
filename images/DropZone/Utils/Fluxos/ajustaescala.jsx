#target Photoshop

ajustaEscala();
allChannelsVisible();

function ajustaEscala(){
    var milimetro=10; //relaçao pixel polegada
    var resolucao = app.activeDocument.resolution;
    var relacao = resolucao/2.54;

    app.activeDocument.measurementScale.pixelLength = Math.round(relacao);
    app.activeDocument.measurementScale.logicalLength = milimetro;
    app.activeDocument.measurementScale.logicalUnits = "mm";

  }

  function allChannelsVisible() {
    var docRef = app.activeDocument;

    for (var i = 0; i < docRef.channels.length; i++) {
        docRef.channels[i].visible = true;
    }
}