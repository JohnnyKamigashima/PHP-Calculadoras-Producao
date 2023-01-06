<!-- calc_pt_mm plano pt2mm -->

<div class="cells">
    <div class="titulo">
        Pontos para mm
    </div>

    <div class="entrada_normal">
        <div class="input-group-prepend">
            <label for="pt" class="input-group-text">
                Pontos (pt):
            </label>
        </div>
        <input type="text" class="form-control" id="pt" value="">
        <div class="input-group-append">
            <span class="input-group-text">
                <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png" alt="Botão de copiar resultado para a Área de colagem" class="icon" onclick="clip_pt_mm.copyToClipboard(document.getElementById('pt').value+' pt')">
            </span>
        </div>
    </div>

    <div class="input-group ">
        <div class="input-group-prepend">
            <label for="resultmm" class="input-group-text">
                mm:
            </label>
        </div>
        <input type="text" class="form-control" id="resultmm" value="">
        <div class="input-group-append">
            <span class="input-group-text">
                <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png" alt="Botão de copiar resultado para a Área de colagem" class="icon" onclick="clip_pt_mm.copyToClipboard(document.getElementById('resultmm').value+' mm')">
            </span>
        </div>
    </div>
    <!-- <script type="text/javascript" src="./partials/functions/convert_mm_lib.js"></script> -->

    <script type="text/javascript" src="./partials/functions/convert_mm_lib.js"></script>
    <script type="text/javascript" src="./partials/functions/copytoclipboard_lib.js"></script>
    <script>
        clip_pt_mm = new Clipboard
        calc_pt_mm = new Convert_mm
        $(document).ready(() => {
            $('#pt').keyup(() => $("#resultmm").val(calc_pt_mm.pt2mm($("#pt").val())))
            $('#resultmm').keyup(() => $("#pt").val(calc_pt_mm.mm2pt($("#resultmm").val())))
        })
    </script>
</div>