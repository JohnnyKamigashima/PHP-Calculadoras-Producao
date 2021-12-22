<!-- calc plano escala -->
<div class="cells">
    <div class="titulo">
        Escala de Plano
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Medida real (cota):</span>
        </div>
        <input type="text" class="form-control" id="medR" value="0">
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Medida atual:</span>
        </div>
        <input type="text" class="form-control" id="medA" value="0">
    </div>

    <div class="input-group mb-3">
        <div class="row bg-light py-2">
            <div class="col-7 align-self-center">
                Escala (%):
            </div>
            <div class="col-3 align-self-center">
                <input type="text" class="form-control" id="escalaC" value="0">
            </div>
            <div class="col-2 align-self-center pl-5">
                <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png" alt="" class="icon" onclick="copyToClipboard(document.getElementById('escalaC').value+'%')">
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#medA').keyup(function() { //calculate scale
                $("#escalaC").val(escalaPlano($("#medA"), $("#medR")));
            })
            $('#medR').keyup(function() { //calculate scale
                $("#escalaC").val(escalaPlano($("#medA"), $("#medR")));
            })
        })
    </script>
</div>