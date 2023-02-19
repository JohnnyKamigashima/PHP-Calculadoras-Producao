<!-- calc plano escala -->

<div class="cells">
    <div class="titulo">
        Escala de Plano
    </div>
    <div class="entrada_normal input-group-prepend">
        <label for="medR" class="input-group-text">Medida real (cota):</label>
        <input type="text" class="form-control" id="medR" value="0">
    </div>

    <div class="entrada_normal input-group-prepend">
        <label for="medA" class="input-group-text">Medida atual:</label>
        <input type="text" class="form-control" id="medA" value="0">
    </div>

    <div class="input-group">
        <div class="linha_resposta">
            <div class="col-5 align-self-center">
                <label for="escalaC"> Escala (%):</label>
            </div>
            <div class="col-5 align-self-center">
                <input type="text" class="form-control" id="escalaC" value="0">
            </div>
            <div class="col-2 align-self-center pl-5">
                <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png"
                    alt="Botão de copiar resultado para a Área de colagem" class="icon"
                    onclick="copyToClipboard(document.getElementById('escalaC').value+'%')">
            </div>
        </div>
    </div>
    <script>
        const copyToClipboard = require("functions/CopyToClipboard_lib.js")
        $(document).ready(() => {
            $('#medA').keyup(() => calcula_escala())
            $('#medR').keyup(() => calcula_escala())
        })

        function calcula_escala() {
            const escalaPlano = require("functions/EscalaPlano_lib.js")
            $("#escalaC").val(
                escalaPlano($("#medA").val().replace(',', '.'), $("#medR").val().replace(',', '.')));
        }
    </script>
</div>