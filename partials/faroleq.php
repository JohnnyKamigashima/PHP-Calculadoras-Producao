<!-- calculadora Farol EQ-->

<div class="cells">
    <div class="titulo">
        Tamanho do Farol do Equador <img src="./images/farolequador.png" alt="Ícone do farol do Equador" class="icon">
    </div>

    <div class="entrada_normal">
        <div class="input-group-prepend">
            <label for="altura_farol_eq" class="input-group-text" >
                Altura FOP (mm):
            </label>
        </div>
        <input type="text" class="form-control" id="altura_farol_eq" value="">
    </div>

    <div class="entrada_normal">
        <div class="input-group-prepend">
            <label for="largura_farol_eq" class="input-group-text" >
                Largura FOP (mm):
            </label>
        </div>
        <input type="text" class="form-control" id="largura_farol_eq" value="">
    </div>

    <div class="entrada_normal">
        <div class="input-group-prepend">
            <label for="area_farol_eq" class="input-group-text" >
                Area FOP (mm2):
            </label>
        </div>
        <input type="text" class="form-control" id="area_farol_eq" value="">
    </div>

    <div class="entrada_normal align-items-center">
        <div class="input-group-prepend">
            <label for="cilindro" class="input-group-text" >
                Cilindrico:
            </label>
        </div>
        <div class="form-check form-check-inline m-3">
            <input class="form-check-input" type="radio" id="cilindroYes" name="cilindro" value="true">
            <label class="form-check-label" for="cilindroYes">Sim</label>
        </div>
        <div class="form-check form-check-inline m-3">
            <input class="form-check-input" type="radio" id="cilindroNo" name="cilindro" value="false" checked>
            <label class="form-check-label" for="cilindroNo">Não</label>
        </div>
    </div>
    <div class="linha_resposta">
        <div class="col-7 align-self-center">
          <label for="largura_final"> A largura do Farol <br> deve ser de:</label>
        </div>
        <div class="col-3 align-self-center">
            <input type="text" class="form-control" id="largura_final" value="0" style="height:66px; margin:auto">
        </div>
        <div class="col-2 align-self-center pl-5">
            <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png" alt="Botão de copiar resultado para a Área de colagem" class="icon" onclick="clip_equador.copyToClipboard(document.getElementById('largura_final').value+' mm')">
        </div>
    </div>
    <script src="./partials/functions/faroleq_lib.js"></script>
    <script src="./partials/functions/copytoclipboard_lib.js"></script>
    <script>
        clip_equador = new Clipboard

        $(document).ready(() => {

            $('#altura_farol_eq').change(() => {
                areaFop1();
                largF1();
            })
            $('#largura_farol_eq').change(() => {
                areaFop1();
                largF1();
            })
            $('#area_farol_eq').change(() => largF1())
            $('#cilindroYes').change(() => largF1())
            $('#cilindroNo').change(() => largF1())
        })

        function areaFop1() {
            $("#area_farol_eq").val(
                $("#altura_farol_eq").val() * $("#largura_farol_eq").val()
            );
        }

        function largF1() {
            calc_farol = new Equador
            var cilindro = $("input[type='radio']:checked").val();
            $("#largura_final").val(
                calc_farol.farolEq($("#largura_farol_eq").val(),
                    $("#altura_farol_eq").val(),
                    $("#area_farol_eq").val(),
                    cilindro)
            );
        }
    </script>
</div>