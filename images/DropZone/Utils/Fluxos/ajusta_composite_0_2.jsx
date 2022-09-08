//Ajusta Composite Version 0.3
#target photoshop

var docRef = app.activeDocument,
    Ncanais = docRef.channels.length,
    firstWhite = false,
    firstSubstrato = 0,
    guides=0,
    fgColor = new SolidColor;
        fgColor.cmyk.cyan = 0;
        fgColor.cmyk.magenta = 0;
        fgColor.cmyk.yellow = 0;
        fgColor.cmyk.black = 100;

docRef.changeMode(ChangeMode.MULTICHANNEL);

for (var y = 0; y < Ncanais; y++) {
    var upperName = docRef.channels[y].name.toUpperCase(),
        channelRef = docRef.channels[y];
        
    //alert(y+"/"+Ncanais+" "+upperName);
    
    if (upperName.indexOf("SUBSTRATO") != -1) {channelRef.remove();}
    else if (upperName.indexOf("VARNISH") != -1 || upperName.indexOf("PRIMER") != -1) { ChnlMove(channelRef.name, Ncanais);} //Push white to last Channel}
    else if (upperName.indexOf("DIE") != -1 || upperName.indexOf("TECH") != -1 || upperName.indexOf("GUIDE") != -1 || upperName.indexOf("DIMEN") != -1) {
        if (guides<=2) {
            changeColor(channelRef.name, 0, 0, 0, 20, 0); 
            ChnlMove(channelRef.name, Ncanais);
            y--;
            guides++;}        
        }
    else if ((upperName.indexOf("WHITE") != -1 ||upperName.indexOf("BLANCO") != -1 ||upperName.indexOf("BRANCO") != -1) && firstWhite ==false) {
        ChnlMove(channelRef.name, 1); //Push white to first Channel
        changeColor(channelRef.name, 0, 0, 0, 0, 100); //Change white to white
        if (firstSubstrato < 1) {
            newChannel("SUBSTRATO"); //Create gray substrate
            ChnlMove("SUBSTRATO", 1); //Move substrate to first
            firstSubstrato ++;
        }

        //firstWhite = true;
    }
    Ncanais = docRef.channels.length;
}
changeColor("Black", 0, 0, 0, 80, 0); //Set black to 80%
newRuler("Regua de medicao");
ajustaEscala();
app.foregroundColor = fgColor;
allChannelsVisible();

function changeColor(channelName, cyan, magenta, yellow, black, opacity) {
    var newChannel = app.activeDocument.channels.getByName(channelName),
        newColor = new SolidColor;
    newColor.cmyk.cyan = cyan;
    newColor.cmyk.magenta = magenta;
    newColor.cmyk.yellow = yellow;
    newColor.cmyk.black = black;
    newChannel.color = newColor;
    newChannel.opacity = opacity;
}

function newChannel(chanName) {
    var docc = app.activeDocument;
    var nc = docc.channels.add();
    nc.kind = ChannelType.SPOTCOLOR;
    nc.opacity = 0;
    var newColor = new SolidColor;
    newColor.gray.gray = 60;
    nc.color = newColor;
    nc.name = chanName;
    docc.selection.fill(newColor);
}

function newRuler(chanName) {
    var docc = app.activeDocument,
    nc = docc.channels.add();
    white = new SolidColor,
    newColor = new SolidColor;
    
    white.gray.gray = 0;
    nc.kind = ChannelType.SPOTCOLOR;
    nc.opacity = 33;
        
    newColor.cmyk.cyan = 100;
    newColor.cmyk.magenta = 10;
    newColor.cmyk.yellow = 70;
    newColor.cmyk.black = 0;
    nc.color = newColor;
    nc.name = chanName;
    docc.selection.fill(white);
}

function ChnlMove(channel, index) {
    var docRef = app.activeDocument;
    theChannels = new Array(docRef.channels.getByName(channel)); //select current channel
    docRef.activeChannels = theChannels;

    var idmove = charIDToTypeID("move");
    var desc7 = new ActionDescriptor();
    var idnull = charIDToTypeID("null");
    var ref1 = new ActionReference();
    var idChnl = charIDToTypeID("Chnl");
    var idOrdn = charIDToTypeID("Ordn");
    var idTrgt = charIDToTypeID("Trgt");

    ref1.putEnumerated(idChnl, idOrdn, idTrgt);
    desc7.putReference(idnull, ref1);
    var idT = charIDToTypeID("T   ");
    var ref2 = new ActionReference();
    var idChnl = charIDToTypeID("Chnl");

    ref2.putIndex(idChnl, index);
    desc7.putReference(idT, ref2);
    executeAction(idmove, desc7, DialogModes.NO);
}

function allChannelsVisible() {
    var docRef = app.activeDocument;

    for (var i = 0; i < docRef.channels.length; i++) {
        docRef.channels[i].visible = true;
    }
}

function ajustaEscala(){
    var milimetro=10; //relaçao pixel polegada
    var resolucao = app.activeDocument.resolution;
    var relacao = resolucao/2.54;
    
    app.activeDocument.measurementScale.pixelLength = Math.round(relacao);
    app.activeDocument.measurementScale.logicalLength = milimetro;
    app.activeDocument.measurementScale.logicalUnits = "mm";
    
}