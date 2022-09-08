//Cria layer com preview imitando flexo
#target photoshop
function flexoprintpreview(docRef,activeChannel,layerName){
var Ncanais = docRef.channels.length,
    curveArray = new Array(Array(25,0), Array(98,56),Array(243,158), Array(251,195),Array(255,255)),
    layerRef = docRef.artLayers.getByName(layerName);

    newChannel = activeChannel[0].duplicate(docRef);
    newChannel.name = "FlexoPrintPreview";
    layerRef.adjustCurves(curveArray);
    layerRef.adjustCurves(curveArray);
}


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

function wait(ms) {
    var d = new Date();
    var d2 = null;
    do { d2 = new Date(); }
    while(d2-d < ms);
}
function wait(ms) {
    var d = new Date();
    var d2 = null;
    do { d2 = new Date(); }
    while(d2-d < ms);
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

function allChannelsInvisible() {
    var docRef = app.activeDocument;

    for (var i = 1; i < docRef.channels.length; i++) {
        docRef.channels[i].visible = false;

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

function warn(str, del)
    {
    try {
        var msg = new Window("palette", "", undefined, {resizeable: false, minimizeButton:false, maximizeButton: false, closeButton: false, closeOnKey: false} );
        msg.margins = [0, 10, 0, 10];
        msg.orientation = "column";
        msg.alignChildren = "center";
        msg.txt = msg.add("statictext", undefined, str);
        msg.txt.justify = "center";
        msg.onShow = function()
            {
            var min_len = 132;
            var off = 2;
            var xx = 60 +2*off;
            msg.layout.layout(true);
            var txt_width = msg.txt.size.width;
            msg.txt.bounds[0] = off;
            msg.txt.bounds[2] = txt_width + xx - 2*off;
            if (msg.txt.bounds[2] < min_len) msg.txt.bounds[2] = min_len;
            msg.layout.layout(true);
            }
        msg.show();

        if (del == undefined) del = 1000;
        if (del)
            $.sleep(del);
        else
            return msg;

        msg.close();
        msg = null;
        }
    catch (e) { alert(e); throw(e); }
    }

function scriptAlert(alertTitle, alertString1, alertString2) {
    var alertWindow = new Window("dialog", undefined, undefined, {resizeable: false});
        alertWindow.text = alertTitle;
        alertWindow.preferredSize.width = 200;
        alertWindow.preferredSize.height = 10;
        alertWindow.orientation = "column";
        alertWindow.alignChildren = ["center", "top"];
        alertWindow.spacing = 25;
        alertWindow.margins = 20;
        alertWindow.frameLocation = [50,50];
        alertWindow.opacity = 0.5;
    var alertText = alertWindow.add("group");
        alertText.orientation = "column";

        alertText.alignChildren = ["left", "center"];
        alertText.spacing = 0;
        alertText.alignment = ["left", "top"];
         alertStringSize1 = alertText.add("statictext", undefined, alertString1, {name: "alertText", multiline: true});
         alertStringSize1.graphics.font = ScriptUI.newFont ("dialog", "BOLD", 13);
        // alertStringSize2 = alertText.add("statictext", undefined, alertString2, {name: "alertText", multiline: true});
        // alertStringSize2.graphics.font = "dialog:13";
    var okButton = alertWindow.add("button", undefined, undefined, {name: "okButton"});
        okButton.text = "OK";
        okButton.alignment = ["center", "top"];
        okButton.graphics.font = "dialog:13";

    alertWindow.show();
}