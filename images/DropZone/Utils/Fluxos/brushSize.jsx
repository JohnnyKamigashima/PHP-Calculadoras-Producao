#target Photoshop
var docRef = app.activeDocument,
    docResolution = docRef.resolution,
    nResol = docResolution / 25.4,
    Nmedida = prompt("Qual tamanho? (em mm)",0.15);  // pede as variaveis

if (getTool() != 'pencilTool') {
    setTool('pencilTool');
}
setCurrentBrushSize((nResol*Nmedida));




// https://forums.adobe.com/thread/579195
function getTool(){  
    var ref = new ActionReference();   
    ref.putEnumerated( charIDToTypeID("capp"), charIDToTypeID("Ordn"), charIDToTypeID("Trgt") );   
    var cTool = typeIDToStringID(executeActionGet(ref).getEnumerationType(stringIDToTypeID('tool')));  
    return cTool;  
}

// https://www.ps-scripts.com/viewtopic.php?f=68&t=11342&p=152772
function setTool(tool) {
    var desc9 = new ActionDescriptor();
    var ref7 = new ActionReference();
    ref7.putClass( app.stringIDToTypeID(tool) );
    desc9.putReference( app.charIDToTypeID('null'), ref7 );
    executeAction( app.charIDToTypeID('slct'), desc9, DialogModes.NO );
}
// Tool names (use quoted strings, e.g. 'moveTool')
// moveTool
// marqueeRectTool
// marqueeEllipTool
// marqueeSingleRowTool
// marqueeSingleColumnTool
// lassoTool
// polySelTool
// magneticLassoTool
// quickSelectTool
// magicWandTool
// cropTool
// sliceTool
// sliceSelectTool
// spotHealingBrushTool
// magicStampTool
// patchSelection
// redEyeTool
// paintbrushTool
// pencilTool
// colorReplacementBrushTool
// cloneStampTool
// patternStampTool
// historyBrushTool
// artBrushTool
// eraserTool
// backgroundEraserTool
// magicEraserTool
// gradientTool
// bucketTool
// blurTool
// sharpenTool
// smudgeTool
// dodgeTool
// burnInTool
// saturationTool
// penTool
// freeformPenTool
// addKnotTool
// deleteKnotTool
// convertKnotTool
// typeCreateOrEditTool
// typeVerticalCreateOrEditTool
// typeCreateMaskTool
// typeVerticalCreateMaskTool
// pathComponentSelectTool
// directSelectTool
// rectangleTool
// roundedRectangleTool
// ellipseTool
// polygonTool
// lineTool
// customShapeTool
// textAnnotTool
// soundAnnotTool
// eyedropperTool
// colorSamplerTool
// rulerTool
// handTool
// zoomTool

function setCurrentBrushSize(_size) {

    var desc1 = new ActionDescriptor();
    var ref1 = new ActionReference();

    ref1.putEnumerated(charIDToTypeID('Brsh'), charIDToTypeID('Ordn'), charIDToTypeID('Trgt'));
    desc1.putReference(charIDToTypeID('null'), ref1);

    var desc2 = new ActionDescriptor();

    desc2.putUnitDouble(stringIDToTypeID("masterDiameter"), charIDToTypeID('#Pxl'), _size);
    desc1.putObject(charIDToTypeID('T   '), charIDToTypeID('Brsh'), desc2);
    executeAction(charIDToTypeID('setd'), desc1, DialogModes.NO);
}