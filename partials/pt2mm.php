<!-- calc plano pt2mm -->

<div class="cells">
    <div class="titulo">
        Pontos para mm
    </div>

    <div class="entrada_normal">
        <div class="input-group-prepend">
            <span class="input-group-text">
                Pontos (pt):
            </span>
        </div>
        <input type="text" class="form-control" id="pt" value="">
        <div class="input-group-append">
            <span class="input-group-text">
                <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png" alt="" class="icon" onclick="copyToClipboard(document.getElementById('pt').value+' pt')">
            </span>
        </div>
    </div>

    <div class="input-group ">
        <div class="input-group-prepend">
            <span class="input-group-text">
                mm:
            </span>
        </div>
        <input type="text" class="form-control" id="resultmm" value="">
        <div class="input-group-append">
            <span class="input-group-text">
                <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png" alt="" class="icon" onclick="copyToClipboard(document.getElementById('resultmm').value+' mm')">
            </span>
        </div>
    </div>
    <script type="text/javascript" src="./partials/functions/pt2mm.function.js"></script>
    <script type="text/javascript" src="./partials/functions/mm2pt.function.js"></script>
    <script>
        $(document).ready(() => {
            $('#pt').keyup(() => $("#resultmm").val(pt2mm($("#pt").val())))
            $('#resultmm').keyup(() => $("#pt").val(mm2pt($("#resultmm").val())))
        })
    </script>
</div>