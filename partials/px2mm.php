<!-- Calculadora Px2mm -->

<div class="cells">
    <div class="titulo">
        Pixel para mm
    </div>

    <div class="entrada_normal">
        <div class="input-group-prepend">
            <label for="resolucao" class="input-group-text">
                Resolução (dpi):
            </label>
        </div>
        <input type="text" class="form-control" id="resolucao" value="300">
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label for="mm" class="input-group-text">
                Milimetros:
            </label>
        </div>
        <input type="text" class="form-control" id="mm" value="0.015">
        <div class="input-group-append">
            <span class="input-group-text">
                <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png"
                    alt="Botão de copiar resultado para a Área de colagem" class="icon"
                    onclick="copyToClipboard(document.getElementById('mm').value+' mm')">
            </span>
        </div>
    </div>

    <div class="input-group ">
        <div class="input-group-prepend">
            <label for="pixel" class="input-group-text">
                Pixeis:
            </label>
        </div>
        <input type="text" class="form-control" id="pixel" value="">
        <div class="input-group-append">
            <span class="input-group-text">
                <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png"
                    alt="Botão de copiar resultado para a Área de colagem" class="icon"
                    onclick="copyToClipboard(document.getElementById('pixel').value+' px')">
            </span>
        </div>
    </div>
    <script>

        const copyToClipboard = require("functions/CopyToClipboard_lib.js")
        const mm2px = require("functions/Mm2px_lib.js")
        const px2mm = require("functions/Px2mm_lib.js")
        $(document).ready(() => {

            $('#mm').keyup(() => $("#pixel").val(mm2px($("#resolucao").val(), $("#mm").val().replace(',', '.'))))
            $('#pixel').keyup(() => $("#mm").val(px2mm($("#resolucao").val(), $("#pixel").val())))
        })
    </script>
</div>