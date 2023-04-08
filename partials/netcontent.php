<!-- Tabela Net Content -->

<div class="cells">
    <div class="titulo">
        Tabela de Peso Neto
    </div>
    <label for="pais" class="rotulo"> Selecione o país:</label>
    <div class="entrada">
        <select name="pais" id="pais" value="MC" class="form-control">
            <option value="MC" selected>Mercosul (AR, BR, UY, PY)</option>
            <option value="PE">Peru</option>
            <option value="BO">Bolívia</option>
            <option value="EC">Equador</option>
            <option value="CL">Chile</option>
            <option value="CO">Colômbia</option>
            <option value="CAM">A.Central (CR, ES, GT, HN, NI, PA)</option>
            <option value="RD">República Dominicana</option>
            <option value="PR">Porto Rico</option>
            <option value="IC">Ilhas Cayman</option>
            <option value="MX">México</option>
        </select>
    </div>
    <div class="desc">
        <p id="descricao">
        </p>
    </div>

    <div class="entrada_normal">
        <label for="altFOP3" class="input-group-text input-group-prepend">
            Altura FOP (mm):
        </label>
        <input type="text" class="form-control" id="altFOP3" name="altFOP3">
    </div>

    <div class="entrada_normal">
        <label for="largFOP3" class="input-group-text input-group-prepend">
            Largura FOP (mm):
        </label>
        <input type="text" class="form-control" name="largFOP3" id="largFOP3">
    </div>

    <div class="entrada_normal ">
        <label for="peso" class="input-group-text input-group-prepend">
            Peso (em g):
        </label>
        <input type="text" class="form-control" id="peso" value="">
    </div>

    <div class="input-group ">
        <div class="linha_resposta">
            <div class="col-7 align-self-center">
                <label for="resultmm1"> Tam. min (mm):</label>
            </div>
            <div class="col-3 align-self-center">
                <input type="text" class="form-control" id="resultmm1" value="">
            </div>
            <div class="col-2 align-self-center pl-5">
                <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png"
                    alt="Botão de copiar resultado para a Área de colagem" class="icon"
                    onclick="copyToClipboard(document.getElementById('resultmm1').value+' mm')">
            </div>
        </div>
    </div>
    <script type="text/javascript" src="partials/functions/Sort_lib.js"></script>
    <script type="text/javascript" src="partials/functions/CopyToClipboard_lib.js"></script>
    <script type="text/javascript" src="partials/functions/PesoNeto_lib.js"></script>
    <script>
        
        sort("pais");
        $("#pais").val("MC");
        $(document).ready(() => {
            $('#largFOP3').keyup(() => {
                $("#peso").val("");
                $("#largFOP").val($("#largFOP3").val());
                $("#largFOP1").val($("#largFOP3").val());
                $("#largFOP2").val($("#largFOP3").val());
                resultado_mm();
            })
            $('#altFOP3').keyup(() => {
                $("#peso").val("");
                $("#altFOP").val($("#altFOP3").val());
                $("#altFOP1").val($("#altFOP3").val());
                $("#altFOP2").val($("#altFOP3").val());
                resultado_mm();
            })
            $('#pais').change(() => resultado_mm())
            $("#peso").keyup(() => {
                $("#altFOP3").val();
                $("#largFOP3").val();
                resultado_mm();
            })
        })

        function resultado_mm() {
            var result_mm = pesoNeto($("#altFOP3").val().replace(',', '.'),
                    $("#largFOP3").val().replace(',', '.'),
                    $("#peso").val().replace(',', '.'),
                    $("#pais").val());
            console.log("result mm: " + result_mm[0] + " texto: " +result_mm[1]);
            $("#resultmm1").val(result_mm[0]);
            document.getElementById("descricao").innerHTML = result_mm[1];
        }
    </script>
</div>