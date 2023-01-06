<!-- calc plano escala -->

<div class="cells">
    <div class="titulo">
        Escala de Plano
    </div>
    <div class="entrada_normal input-group-prepend">
        <label for="medR" class="input-group-text" >Medida real (cota):</label>
        <input type="text" class="form-control" id="medR" value="0">
    </div>

    <div class="entrada_normal input-group-prepend">
            <label for="medA" class="input-group-text" >Medida atual:</label>
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
                <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png" alt="Botão de copiar resultado para a Área de colagem" class="icon" onclick="clip_scala.copyToClipboard(document.getElementById('escalaC').value+'%')">
            </div>
        </div>
    </div>
    <script type="text/javascript" src="./partials/functions/escalaplano_lib.js"></script>
    <script type="text/javascript" src="./partials/functions/copytoclipboard_lib.js"></script>
    <script>
        clip_scala = new Clipboard
        $(document).ready(() => {
            $('#medA').keyup(() => calcula_escala())
            $('#medR').keyup(() => calcula_escala())
        })

        function calcula_escala() {
            calc_escala = new Escala_plano
            $("#escalaC").val(
                calc_escala.escalaPlano($("#medA").val(), $("#medR").val()));
        }
    </script>
</div>