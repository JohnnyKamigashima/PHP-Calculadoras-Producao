function mm2px(resolucao, mm) {
    return isNaN(Math.ceil((resolucao.val() / 25.4) * mm.val())) ? 0 : Math.ceil((resolucao.val() / 25.4) * mm.val());
}

function px2mm(resolucao, px) {
    return isNaN((px.val() / (resolucao.val() / 25.4))) ? 0 : (px.val() / (resolucao.val() / 25.4)).toFixed(2);
}
function escalaPlano(medA, medR) {
    return isNaN(((medR.val() * 100) / medA.val())) ? 0 : ((medR.val() * 100) / medA.val()).toFixed(2);
}

function distorC(medA, medR, rep) {
    return isNaN(((medR.val() * 100) / (medA.val() * rep))) ? 0 : ((medR.val() * 100) / (medA.val() * rep)).toFixed(3);
}

function handleClick(myRadio) {
    $("#distorc").val(distorC($("#arteA"), $("#cilindro"), $("input[type='radio'][name='repetition']:checked").val()));

}

function altoEm(altura, largura, area, nutrientes, tipo) {

    let larguraFinal = 0,
        areaPDP = Number(area.val());

    altura = Number(altura.val());
    largura = Number(largura.val());
    area = Number(area.val());
    nutrientes = Number(nutrientes.val());
    tipo = tipo.val();

    if (area == 0) {
        areaPDP = altura * largura;
        console.log(areaPDP);
    }

    if ((altura > 0 && largura > 0 && nutrientes != undefined && tipo != undefined) || (areaPDP > 0)) {

        $("#areaPDP").val(altura * largura);
        if (areaPDP < 10000) {
            var areaNutri1 = areaPDP * 0.035,
                areaNutri2 = areaPDP * 0.0525,
                areaNutri3 = areaPDP * 0.07;
        }
        else {
            var areaNutri1 = areaPDP * 0.02,
                areaNutri2 = areaPDP * 0.03,
                areaNutri3 = areaPDP * 0.04;
        }

        if (tipo == "--" && nutrientes == 1) {
            larguraFinal = ladoGrid(areaNutri1, 2) * 2;
        }
        else if (tipo == "I" && nutrientes == 1) {
            larguraFinal = ladoGrid(areaNutri1, 2);
        }
        else if (tipo == "--" && nutrientes == 2) {
            larguraFinal = ladoGrid(areaNutri2, 3) * 3;
        }
        else if (tipo == "I" && nutrientes == 2) {
            larguraFinal = ladoGrid(areaNutri2, 3);
        }
        else if (tipo == "L" && nutrientes == 2) {
            larguraFinal = ladoGrid(areaNutri2, 3) * 2;
        }
        else if (tipo == "p" && nutrientes == 2) {
            larguraFinal = ladoGrid(areaNutri2, 3) * 2;
        }
        else if (tipo == "q" && nutrientes == 2) {
            larguraFinal = ladoGrid(areaNutri2, 3) * 2;
        }
        else if (tipo == "0" && nutrientes == 3) {
            larguraFinal = ladoGrid(areaNutri3, 4) * 2;
        }
        else if (tipo == "I" && nutrientes == 3) {
            larguraFinal = ladoGrid(areaNutri3, 4);
        }
        else if (tipo == "--" && nutrientes == 3) {
            larguraFinal = ladoGrid(areaNutri3, 4) * 4;
        }
        else if (tipo == "q" && nutrientes == 3) {
            larguraFinal = ladoGrid(areaNutri3, 4) * 2;
        }
        else if (tipo == "L" && nutrientes == 3) {
            larguraFinal = ladoGrid(areaNutri3, 4) * 3;
        }
        else {
            larguraFinal = 0;
        }

        larguraFinal = larguraFinal.toFixed(2);
        return larguraFinal
    }
}

function ladoGrid(area, blocos) {
    return (Math.sqrt((area / blocos) / 126)) * 18;
}

function farolEq(largura, altura, area) {

    let Naltura = Number(altura.val()),
        Nlargura = Number(largura.val()),
        Narea = Number(area.val()),
        Nareacm = 0,
        Nalturasemaforo = 0,
        Ntier = 0,
        Nresultado = 0,
        Nareasemaforo = 0;
    cilindro = $("input[type='radio']:checked").val()

    if (Nlargura > 0 && Naltura > 0) {
        Narea = Nlargura * Naltura;
        $("#areaPDP1").val(Narea);
    }

    if (Narea > 0) {
        if (cilindro == "true") {
            Narea = Narea * 0.4;
        }
        else {
            Narea = Narea;
        }

        Nareacm = Narea / 100;

        if (Nareacm > 19.5 && Nareacm < 32) {
            Ntier = 1;
            Nareasemaforo = 6.25;
        }
        else if (Nareacm > 32 && Nareacm < 161) {
            Ntier = 2;
            Nareasemaforo = Nareacm * 0.2;
        }
        else {
            Ntier = 3;
            Nareasemaforo = Nareacm * 0.15;
        }
        Nresultado = Math.sqrt(Nareasemaforo);
        Nresultado = Nresultado * 10;
        Nresultado = Nresultado.toFixed(2);

        return Nresultado;
    }
}

function pt2mm(pt, mm) {

    if (pt == 0) {
        return (2.835 * mm.val()).toFixed(2);
    }
    else {
        return (pt.val() / 2.835).toFixed(2);
    }


}

function Transgenico(altPDP, largPDP) {

    let Nlargura = largPDP.val(),
        Naltura = altPDP.val();

    if (Nlargura > 0 && Naltura > 0) {
        let Narea = (Nlargura * Naltura) * 0.004;
        Nresult = (Math.sqrt(4 * Narea / Math.sqrt(3)));
        if (Nresult < 5) {
            return 5;
        }
        else {
            return Nresult.toFixed(2);
        }


    }
}


function pesoNeto(alt, larg, peso, pais) {

    let PE_NET = BO_NET = CAM_NET = RD_NET = [[1, 1]],
        IC_NET = [[1, 1.6]],
        EC_NET = [
            [50, 2],
            [200, 3],
            [1000, 4],
            [1001, 6]
        ],
        EC_FOP = [
            [3200, 1.6],
            [16100, 3.2],
            [64500, 4.8],
            [258100, 6.2],
            [258200, 12.7]
        ],
        CO_NET = [
            [200, 3],
            [1000, 4],
            [1001, 6]
        ],
        CO_FOP = [
            [1600, 2],
            [10000, 3],
            [22500, 4],
            [40000, 5],
            [62500, 7],
            [90000, 9],
            [90100, 10]
        ],
        PR_FOP = [
            [3225.8, 1.59],
            [16129, 3.17],
            [64516, 4.76],
            [258064, 6.35],
            [258065, 12.7]
        ],
        MC_NET = [
            [50, 2],
            [200, 3],
            [1000, 4],
            [1001, 6]
        ],
        MC_FOP = [
            [4000, 2],
            [17000, 3],
            [65000, 4.5],
            [260000, 6],
            [260001, 10]
        ],
        MX_NET = [
            [3200, 1.5],
            [16100, 3],
            [64500, 4.5],
            [258000, 6],
            [258001, 12]
        ],
        MX_FOP = [
            [50, 1.5],
            [200, 2],
            [750, 3],
            [1000, 4.5],
            [5000, 5],
            [5001, 6]
        ];

    alt = alt.val();
    larg = larg.val();
    peso = peso.val();
    pais = pais.val();

    let areaFOP = alt * larg;

    console.log(areaFOP);

    if (pais == 'PE' || pais == 'BO' || pais == 'CAM' || pais == 'RD') {
        document.getElementById("descricao").innerHTML = "Tamanho do conteúdo independente.";
        return PE_NET[0][1];
    }
    else if (pais == 'EC') {
        document.getElementById("descricao").innerHTML = "Tamanho do conteúdo pode ser baseado no peso ou no tamanho do FOP.";
        return (areaFOP > 0 ? verifica(EC_FOP, areaFOP) : verifica(EC_NET, peso));
    }
    else if (pais == 'CL') {
        document.getElementById("descricao").innerHTML = "Tamanho do conteúdo baseado na altura do FOP.";
        return (alt / 36 >= 2 ? alt / 36 : 2);
    }
    else if (pais == 'CO') {
        document.getElementById("descricao").innerHTML = "Tamanho do conteúdo pode ser baseado no peso ou no tamanho do FOP.";
        return (areaFOP > 0 ? verifica(CO_FOP, areaFOP) : verifica(CO_NET, peso));
    }
    else if (pais == 'PR') {
        document.getElementById("descricao").innerHTML = "Tamanho do conteúdo baseado na área do FOP.";
        return (areaFOP != 0 ? verifica(PR_FOP, areaFOP) : 0);
    }
    else if (pais == 'IC') {
        document.getElementById("descricao").innerHTML = "Tamanho do conteúdo independente.";
        return IC_NET[0][0];
    }
    else if (pais == 'MC') {
        document.getElementById("descricao").innerHTML = "Tamanho do conteúdo pode ser baseado no peso ou no tamanho do FOP.";
        return (areaFOP > 0 ? verifica(MC_FOP, areaFOP) : verifica(MC_NET, peso));
    }
    else if (pais == 'MX') {
        document.getElementById("descricao").innerHTML = "Tamanho do conteúdo pode ser baseado no peso ou no tamanho do FOP.";
        return (areaFOP > 0 ? verifica(MX_FOP, areaFOP) : verifica(MX_NET, peso));
    }


}

function farol_octagono(alt, larg, area, pais) {

    let menorX = Math.sqrt((0.15 * (mmarea2cm(parseFloat(alt.val() * larg.val())))) / 4680),
        MX = [
            [5, menorX, 65, 72, "SECRETARÌA DE SALUD", 3.07],
            [30, 0.016, 65, 72, "SECRETARÌA DE SALUD", 3.07],
            [60, 0.023, 65, 72, "SECRETARÌA DE SALUD", 3.07],
            [100, 0.031, 65, 72, "SECRETARÌA DE SALUD", 3.07],
            [200, 0.039, 65, 72, "SECRETARÌA DE SALUD", 3.07],
            [300, 0.047, 65, 72, "SECRETARÌA DE SALUD", 3.07],
            [301, 0.055, 65, 72, "SECRETARÌA DE SALUD", 3.07]
        ],
        PE = [
            [50, 0.1, 30, 30, "Não é necessário estar na embalagem mas é obrigatório na caixa externa.<br>EVITAR SU CONSUMO EXCESIVO", 2],
            [100, 0.067, 30, 30, "EVITAR SU CONSUMO EXCESIVO", 2],
            [200, 0.083, 30, 30, "EVITAR SU CONSUMO EXCESIVO", 2],
            [201, 0.1, 30, 30, "EVITAR SU CONSUMO EXCESIVO", 2]
        ],
        UY = [
            [30, 0, 0, 0, "Não é necessário ter, deverá estar na caixa externa", 0],
            [60, 1.5, 1, 1, ""],
            [100, 2, 1, 1, ""],
            [200, 2.5, 1, 1, ""],
            [300, 3, 1, 1, ""],
            [301, 3.5, 1, 1, ""]
        ],
        CH = [
            [30, .12, 0, 0, "Não é necessário ter, deverá estar na caixa externa", 1],
            [60, 1.5, 1, 1, "Pode estar em outra face da embalagem <br>MINSAL", .08],
            [100, 2, 1, 1, "Ministerio de Salud", .06],
            [200, 2.5, 1, 1, "Ministerio de Salud", .048],
            [300, 3, 1, 1, "Ministerio de Salud", .04],
            [301, 3.5, 1, 1, "Ministerio de Salud", .034]
        ];

    alt = mm2cm(parseFloat(alt.val()));
    larg = mm2cm(parseFloat(larg.val()));
    area = mmarea2cm(parseFloat(area.val()));
    pais = pais.val();

    let areaFOP5 = alt * larg;

    console.log("altura: " + alt + " largura: " + larg);
    console.log("Area = " + areaFOP5);
    console.log("menorx = " + menorX);
    if (pais == 'MX') {
        document.getElementById("descricao_farol").innerHTML = MX[verifica_octagono(MX, areaFOP5)][4] + " altura mínima de " + cm2mm(MX[verifica_octagono(MX, areaFOP5)][5] * MX[verifica_octagono(MX, areaFOP5)][1]).toFixed(2) + " mm";
        console.log(MX[verifica_octagono(MX, areaFOP5)][4] + " altura mínima de " + cm2mm(MX[verifica_octagono(MX, areaFOP5)][5] * MX[verifica_octagono(MX, areaFOP5)][1]) + " mm");
        return cm2mm(MX[verifica_octagono(MX, areaFOP5)][1] * MX[verifica_octagono(MX, areaFOP5)][2]).toFixed(2);

    }
    else if (pais == 'PE') {
        document.getElementById("descricao_farol").innerHTML = PE[verifica_octagono(PE, areaFOP5)][4] + " altura mínima de " + cm2mm(PE[verifica_octagono(PE, areaFOP5)][5] * PE[verifica_octagono(PE, areaFOP5)][1]).toFixed(2) + " mm";
        return cm2mm(PE[verifica_octagono(PE, areaFOP5)][1] * PE[verifica_octagono(PE, areaFOP5)][2]).toFixed(2);
    }
    else if (pais == 'UY') {
        document.getElementById("descricao_farol").innerHTML = UY[verifica_octagono(UY, areaFOP5)][4] ;
        return cm2mm(UY[verifica_octagono(UY, areaFOP5)][1] * UY[verifica_octagono(UY, areaFOP5)][2]).toFixed(2);

    }
    else if (pais == 'CH') {
        document.getElementById("descricao_farol").innerHTML = CH[verifica_octagono(CH, areaFOP5)][4] + " altura mínima de " + cm2mm(CH[verifica_octagono(CH, areaFOP5)][5] * CH[verifica_octagono(CH, areaFOP5)][1]).toFixed(2) + " mm";
        return cm2mm(CH[verifica_octagono(CH, areaFOP5)][1] * CH[verifica_octagono(CH, areaFOP5)][2]).toFixed(2);
    }


}

function cm2mm(valor) {
    if (typeof valor == "number") {
        return valor * 10;
    }

}
function mm2cm(valor) {
    if (typeof valor == "number") {
        return valor / 10;
    }

}
function cmarea2mm(valor) {
    if (typeof valor == "number") {
        return valor * 100;
    }

}
function mmarea2cm(valor) {
    if (typeof valor == "number") {
        return valor / 100;
    }

}






function verifica_octagono(array, valor) {
    for (x = 0; x <= array.length - 1; x++) {


        if (x < array.length - 1) {
            if (valor <= array[x][0] && x == 0) {
                return x;
            } else if (x > 0 && array[x - 1][0] < valor && valor <= array[x][0]) {
                return x;
            }
        } else {
            return x;
        }
    }
}

function verifica(array, valor) {
    for (x = 0; x <= array.length - 1; x++) {

        console.log(valor, array[x][0]);

        if (x < array.length - 1) {
            if (valor <= array[x][0] && x == 0) {
                return array[x][1];
            } else if (x > 0 && array[x - 1][0] < valor && valor <= array[x][0]) {
                return array[x][1];
            }
        } else {
            return array[x][1];
        }
    }
}

function copyToClipboard(text) {
    var dummy = document.createElement('textarea');
    text = text.replace('.', ',');
    // = avoid breaking orgain page when copying more words
    // cant copy when adding below this code
    // dummy.style.display = 'none'
    document.body.appendChild(dummy);
    //Be careful if you use texarea. letAttribute('value', value), which works with "input" does not work with "textarea". – Eduard
    dummy.value = text;
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);
}
function sort(elementid) {
    // WARN: won't handle OPTGROUPs!
    var sel = document.getElementById(elementid)
    // convert OPTIONs NodeList to an Array
    // - keep in mind that we're using the original OPTION objects
    var ary = (function (nl) {
        var a = []
        for (var i = 0, len = nl.length; i < len; i++) a.push(nl.item(i))
        return a
    })(sel.options)
    // sort OPTIONs Array
    ary.sort(function (a, b) {
        // sort by "value"? (numeric comparison)
        // NOTE: please remember what ".value" means for OPTION objects
        //return a.value - b.value
        // or by "label"? (lexicographic comparison) - case sensitive
        //return a.text < b.text ? -1 : a.text > b.text ? 1 : 0;
        // or by "label"? (lexicographic comparison) - case insensitive
        var aText = a.text.toLowerCase()
        var bText = b.text.toLowerCase()
        return aText < bText ? -1 : aText > bText ? 1 : 0
    })
    // remove all OPTIONs from SELECT (don't worry, the original
    // OPTION objects are still referenced in "ary") ;-)
    for (var i = 0, len = ary.length; i < len; i++) sel.remove(ary[i].index)
    // (re)add re-ordered OPTIONs to SELECT
    for (var i = 0, len = ary.length; i < len; i++) sel.add(ary[i], null)
}

function sortList(elementid) {
    var list, i, switching, b, shouldSwitch;
    list = document.getElementById(elementid);
    switching = true;
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        // Start by saying: no switching is done:
        switching = false;
        b = list.getElementsByTagName("LI");
        // Loop through all list items:
        for (i = 0; i < (b.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Check if the next item should
            switch place with the current item: */
            if (b[i].innerHTML.toLowerCase() > b[i + 1].innerHTML.toLowerCase()) {
                /* If next item is alphabetically lower than current item,
                mark as a switch and break the loop: */
                shouldSwitch = true;
                break;
            }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark the switch as done: */
            b[i].parentNode.insertBefore(b[i + 1], b[i]);
            switching = true;
        }
    }
}