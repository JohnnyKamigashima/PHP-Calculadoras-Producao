<!-- calculadora AltoEm -->
<div class="cells">
    <div class="titulo">
        Alto Em
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">
                Altura FOP (mm):
            </span>
        </div>
        <input type="text" class="form-control" id="altFOP" value="">
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">
                Largura FOP (mm):
            </span>
        </div>
        <input type="text" class="form-control" id="largFOP" value="">
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">
                Area FOP (mm2):
            </span>
        </div>
        <input type="text" class="form-control" id="areaFOP" value="">
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">
                Nutrientes:
            </span>
        </div>
        <select name="nutrientes" id="nutrientes" class="form-control" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>

    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">
                Organização/icones:
            </span>
        </div>
        <select name="tipo" id="tipo" class="form-control">
            <option value="I">|</option>
            <option value="--">--</option>
            <option value="0">[ ]</option>
            <option value="L">L</option>
            <option value="q">˥</option>
            <option value="p">r</option>
        </select>

    </div>
    <div class="input-group mb-3">
        <div class="row bg-light py-2">
            <div class="col-7 align-self-center">
                A largura de<br>ALTO EM deve ser:
            </div>
            <div class="col-3 align-self-center">
                <input type="text" class="form-control" id="largF" value="0" style="height:66px; margin:auto">
            </div>
            <div class="col-2 align-self-center pl-5">
                <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png" alt="" class="icon" onclick="copyToClipboard(document.getElementById('largF').value+' mm')">
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#altFOP').change(function() {
                $("#largF").val(altoEm($("#altFOP"), $("#largFOP"), $("#areaFOP"), $("#nutrientes"), $("#tipo")));
                $("#altFOP1").val($("#altFOP").val());
                $("#altFOP2").val($("#altFOP").val());
                $("#altFOP3").val($("#altFOP").val());
            })
            $('#largFOP').change(function() {
                $("#largF").val(altoEm($("#altFOP"), $("#largFOP"), $("#areaFOP"), $("#nutrientes"), $("#tipo")));
                $("#largFOP1").val($("#largFOP").val());
                $("#largFOP2").val($("#largFOP").val());
                $("#largFOP3").val($("#largFOP").val());
            })
            $('#areaFOP').change(function() {
                $("#largF").val(altoEm($("#altFOP"), $("#largFOP"), $("#areaFOP"), $("#nutrientes"), $("#tipo")));
            })
            $('#nutrientes').change(function() {
                $("#largF").val(altoEm($("#altFOP"), $("#largFOP"), $("#areaFOP"), $("#nutrientes"), $("#tipo")));
            })
            $('#tipo').change(function() {
                $("#largF").val(altoEm($("#altFOP"), $("#largFOP"), $("#areaFOP"), $("#nutrientes"), $("#tipo")));
            })
        })
    </script>
</div>