<!-- calc plano escala -->
<script type="text/javascript" src="./partials/library.js"></script>
<div class="col-md-4 cells p-3">
    <div class="titulo rounded mt-0">
        Escala de Plano
    </div>
    <div class="input-group mb-3 pt-2">
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

    <div class="input-group ">
        <div class="row bg-light py-2">
            <div class="col-5 align-self-center">
                Escala (%):
            </div>
            <div class="col-5 align-self-center">
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