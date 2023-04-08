<!-- calc_alto_emuladora AltoEm -->
<div class="cells">
    <div class="titulo">
        Alto Em (Farol Brasil) <img src="./images/altoembr.png" alt="Ícone alto Em frontal do Brasil" class="icon">
    </div>

    <div class="entrada_normal">
        <div class="input-group-prepend">
            <label for="altFOP" class="input-group-text">
                Altura FOP (mm):
            </label>
        </div>
        <input type="text" class="form-control" id="altFOP" value="">
    </div>

    <div class="entrada_normal">
        <div class="input-group-prepend">
            <label for="largFOP" class="input-group-text">
                Largura FOP (mm):
            </label>
        </div>
        <input type="text" class="form-control" id="largFOP" value="">
    </div>

    <div class="entrada_normal">
        <div class="input-group-prepend">
            <label for="areaFOP" class="input-group-text">
                Area FOP (mm2):
            </label>
        </div>
        <input type="text" class="form-control" id="areaFOP" value="">
    </div>

    <div class="entrada_normal input-group-prepend">
        <label for="nutrientes" class="input-group-text">
            Nutrientes:
        </label>
        <select name="nutrientes" id="nutrientes" class="form-control" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>

    </div>

    <div class="entrada_normal input-group-prepend">
        <label for="tipo" class="input-group-text">
            Organização/icones:
        </label>
        <select name="tipo" id="tipo" class="form-control">
            <option value="I">|</option>
            <option value="--">--</option>
            <option value="0">[ ]</option>
            <option value="L">L</option>
            <option value="q">˥</option>
            <option value="r">r</option>
        </select>

    </div>
    <div class="linha_resposta">
        <div class="col-7 align-self-center">
            <label for="altoemA"> A área do alto EM deve ser de:</label>
        </div>
        <div class="col-3 align-self-center">
            <input type="text" class="form-control" id="altoemA" value="0" style="height:66px; margin:auto">
        </div>
        <div class="col-2 align-self-center pl-5">
            <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png"
                alt="Botão de copiar resultado para a Área de colagem" class="icon"
                onclick="copyToClipboard(document.getElementById('altoemA').value+' mm2')">
        </div>
    </div>
    <div class="linha_resposta">
        <div class="col-7 align-self-center">
            <label for="largF"> A largura mínima de<br>ALTO EM deve ser:</label>
        </div>
        <div class="col-3 align-self-center">
            <input type="text" class="form-control" id="largF" value="0" style="height:66px; margin:auto">
        </div>
        <div class="col-2 align-self-center pl-5">
            <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png"
                alt="Botão de copiar resultado para a Área de colagem" class="icon"
                onclick="copyToClipboard(document.getElementById('largF').value+' mm')">
        </div>
    </div>
    <div class="input-group ">
        <div class="linha_resposta">
            <div class="col-7 align-self-center">
                <label for="largMx"> A largura máxima de<br>ALTO EM deve ser:</label>
            </div>
            <div class="col-3 align-self-center">
                <input type="text" class="form-control" id="largMx" value="0" style="height:66px; margin:auto">
            </div>
            <div class="col-2 align-self-center pl-5">
                <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png"
                    alt="Botão de copiar resultado para a Área de colagem" class="icon"
                    onclick="copyToClipboard(document.getElementById('largMx').value+' mm')">
            </div>
        </div>
    </div>
    <script src="partials/functions/CopyToClipboard_lib.js"></script>
    <script src="partials/functions/AltoEm_lib.js"></script>
    <script>
        $(document).ready(() => {
            $('#altFOP').change(() => {
                areaFop();
                largF();
                largMx();

            })
            $('#largFOP').change(() => {
                areaFop();
                largF();
                largMx();

            })
            $('#areaFOP').change(() => {
                largF();
                largMx();
            })
            $('#nutrientes').change(() => {
                largF();
                largMx();
            })
            $('#tipo').change(() => {
                largF();
                largMx();
            })
        })

        function largF() {
            let result = altoEm($("#altFOP").val(),
                    $("#largFOP").val(),
                    $("#areaFOP").val(),
                    $("#nutrientes").val(),
                    $("#tipo").val());
            $("#largF").val(result[0]);
            $("#altoemA").val(result[2]);
        }

        function areaFop() {
            $("#areaFOP").val($("#altFOP").val() * $("#largFOP").val());
        }

        function largMx() {
             let result = altoEm($("#altFOP").val(),
                    $("#largFOP").val(),
                    $("#areaFOP").val(),
                    $("#nutrientes").val(),
                    $("#tipo").val());
            $("#largMx").val(result[1]);
            $("#altoemA").val(result[2]);
        }
    </script>
</div>