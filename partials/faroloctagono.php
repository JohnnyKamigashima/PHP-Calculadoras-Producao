<html>

<!-- calculadora Farol Octagono-->
<script type="text/javascript" src="./partials/library.js"></script>
<div class="cells p-3">
    <div class="titulo">
        Tamanho do Farol Octagono <img src="./images/altoenoctagono.png" class="icon">
    </div>
    <div class="entrada_normal">
        <select name="pais" id="pais5" value="PE" class="form-control">
            <option value="PE">Peru</option>
            <option value="CH">Chile</option>
            <option value="UY">Uruguay</option>
            <option value="MX">México</option>
        </select>
    </div>
    <div class="entrada_normal">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">
                Altura FOP (mm):
            </span>
        </div>
        <input type="text" class="form-control" id="altFOP5" value="">
    </div>

    <div class="entrada_normal">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">
                Largura FOP (mm):
            </span>
        </div>
        <input type="text" class="form-control" id="largFOP5" value="">
    </div>

    <div class="linha_resposta">
        <div class="col-7 align-self-center">
            A largura do Farol <br> deve ser de:
        </div>
        <div class="col-3 align-self-center">
            <input type="text" class="form-control" id="largF5" value="0" style="height:66px; margin:auto">
        </div>

        <div class="col-2 align-self-center pl-5">
            <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png" alt="" class="icon" onclick="copyToClipboard(document.getElementById('largF5').value+' mm')">
        </div>
        <div class="col align-self-center">
            <p id="descricao_farol">
            </p>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#altFOP5').change(function() {
                $("#largF5").val(faroloctagono($("#altFOP5"), $("#largFOP5"), $("#areaFOP5"), $("#pais5")));
            })
            $('#largFOP5').change(function() {
                $("#largF5").val(faroloctagono($("#altFOP5"), $("#largFOP5"), $("#areaFOP5"), $("#pais5")));
            })
            $('#areaFOP5').change(function() {
                $("#largF5").val(faroloctagono($("#altFOP5"), $("#largFOP5"), $("#areaFOP5"), $("#pais5")));
            })
            $('#cilindroYes').change(function() {
                $("#largF5").val(faroloctagono($("#altFOP5"), $("#largFOP5"), $("#areaFOP5"), $("#pais5")));
            })
            $('#cilindroNo').change(function() {
                $("#largF5").val(faroloctagono($("#altFOP5"), $("#largFOP5"), $("#areaFOP5"), $("#pais5")));
            })
        });

        function faroloctagono(alt, larg, area, pais) {
            let menorX = Math.sqrt(
                    (0.15 * mmarea2cm(parseFloat(alt.val() * larg.val()))) / 4680
                ),
                MX = [
                    [5, menorX, 65, 72, "SECRETARÌA DE SALUD", 3.07],
                    [30, 0.016, 65, 72, "SECRETARÌA DE SALUD", 3.07],
                    [60, 0.023, 65, 72, "SECRETARÌA DE SALUD", 3.07],
                    [100, 0.031, 65, 72, "SECRETARÌA DE SALUD", 3.07],
                    [200, 0.039, 65, 72, "SECRETARÌA DE SALUD", 3.07],
                    [300, 0.047, 65, 72, "SECRETARÌA DE SALUD", 3.07],
                    [301, 0.055, 65, 72, "SECRETARÌA DE SALUD", 3.07],
                ],
                PE = [
                    [
                        50,
                        0.1,
                        30,
                        30,
                        "Não é necessário estar na embalagem mas é obrigatório na caixa externa.<br>EVITAR SU CONSUMO EXCESIVO",
                        2,
                    ],
                    [100, 0.067, 30, 30, "EVITAR SU CONSUMO EXCESIVO", 2],
                    [200, 0.083, 30, 30, "EVITAR SU CONSUMO EXCESIVO", 2],
                    [201, 0.1, 30, 30, "EVITAR SU CONSUMO EXCESIVO", 2],
                ],
                UY = [
                    [30, 0, 0, 0, "Não é necessário ter, deverá estar na caixa externa", 0],
                    [60, 1.5, 1, 1, ""],
                    [100, 2, 1, 1, ""],
                    [200, 2.5, 1, 1, ""],
                    [300, 3, 1, 1, ""],
                    [301, 3.5, 1, 1, ""],
                ],
                CH = [
                    [
                        30,
                        0.12,
                        0,
                        0,
                        "Não é necessário ter, deverá estar na caixa externa",
                        1,
                    ],
                    [60, 1.5, 1, 1, "Pode estar em outra face da embalagem <br>MINSAL", 0.08],
                    [100, 2, 1, 1, "Ministerio de Salud", 0.06],
                    [200, 2.5, 1, 1, "Ministerio de Salud", 0.048],
                    [300, 3, 1, 1, "Ministerio de Salud", 0.04],
                    [301, 3.5, 1, 1, "Ministerio de Salud", 0.034],
                ];
            alt = mm2cm(parseFloat(alt.val()));
            larg = mm2cm(parseFloat(larg.val()));
            area = mmarea2cm(parseFloat(area.val()));
            pais = pais.val();
            let areaFOP5 = alt * larg;
            console.log("altura: " + alt + " largura: " + larg);
            console.log("Area = " + areaFOP5);
            console.log("menorx = " + menorX);
            if (pais == "MX") {
                document.getElementById("descricao_farol").innerHTML =
                    MX[verifica_octagono(MX, areaFOP5)][4] +
                    " altura mínima de " +
                    cm2mm(
                        MX[verifica_octagono(MX, areaFOP5)][5] *
                        MX[verifica_octagono(MX, areaFOP5)][1]
                    ).toFixed(2) +
                    " mm";
                console.log(
                    MX[verificaoctagono(MX, areaFOP5)][4] +
                    " altura mínima de " +
                    cm2mm(
                        MX[verificaoctagono(MX, areaFOP5)][5] *
                        MX[verificaoctagono(MX, areaFOP5)][1]
                    ) +
                    " mm"
                );
                return cm2mm(
                    MX[verificaoctagono(MX, areaFOP5)][1] *
                    MX[verificaoctagono(MX, areaFOP5)][2]
                ).toFixed(2);
            } else if (pais == "PE") {
                document.getElementById("descricao_farol").innerHTML =
                    PE[verificaoctagono(PE, areaFOP5)][4] +
                    " altura mínima de " +
                    cm2mm(
                        PE[verificaoctagono(PE, areaFOP5)][5] *
                        PE[verificaoctagono(PE, areaFOP5)][1]
                    ).toFixed(2) +
                    " mm";
                return cm2mm(
                    PE[verificaoctagono(PE, areaFOP5)][1] *
                    PE[verificaoctagono(PE, areaFOP5)][2]
                ).toFixed(2);
            } else if (pais == "UY") {
                document.getElementById("descricao_farol").innerHTML =
                    UY[verificaoctagono(UY, areaFOP5)][4];
                return cm2mm(
                    UY[verificaoctagono(UY, areaFOP5)][1] *
                    UY[verificaoctagono(UY, areaFOP5)][2]
                ).toFixed(2);
            } else if (pais == "CH") {
                document.getElementById("descricao_farol").innerHTML =
                    CH[verificaoctagono(CH, areaFOP5)][4] +
                    " altura mínima de " +
                    cm2mm(
                        CH[verificaoctagono(CH, areaFOP5)][5] *
                        CH[verificaoctagono(CH, areaFOP5)][1]
                    ).toFixed(2) +
                    " mm";
                return cm2mm(
                    CH[verificaoctagono(CH, areaFOP5)][1] *
                    CH[verificaoctagono(CH, areaFOP5)][2]
                ).toFixed(2);
            }
        }
    </script>
</div>

</html>