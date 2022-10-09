<!-- Calculadora Px2mm -->

<div class="cells">
    <div class="titulo">
        Pixel para mm
    </div>

    <div class="entrada_normal">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">
                Resolução (dpi):
            </span>
        </div>
        <input type="text" class="form-control" id="resolucao" value="300">
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">
                Milimetros:
            </span>
        </div>
        <input type="text" class="form-control" id="mm" value="0.015">
        <div class="input-group-append">
            <span class="input-group-text">
                <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png" alt="" class="icon" onclick="copyToClipboard(document.getElementById('mm').value+' mm')">
            </span>
        </div>
    </div>

    <div class="input-group ">
        <div class="input-group-prepend">
            <span class="input-group-text">
                Pixeis:
            </span>
        </div>
        <input type="text" class="form-control" id="pixel" value="">
        <div class="input-group-append">
            <span class="input-group-text">
                <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png" alt="" class="icon" onclick="copyToClipboard(document.getElementById('pixel').value+' px')">
            </span>
        </div>
    </div>
    <script type="text/javascript" src="./partials/functions/px2mm.function.js"></script>
    <script type="text/javascript" src="./partials/functions/mm2px.function.js"></script>
    <script>
        $(document).ready(() => {
            $('#mm').keyup(() => $("#pixel").val(mm2px($("#resolucao").val(), $("#mm").val())))
            $('#pixel').keyup(() => $("#mm").val(px2mm($("#resolucao").val(), $("#pixel").val())))
        })
    </script>
</div>