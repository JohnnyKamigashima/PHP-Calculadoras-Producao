<!-- Calculadora Px2mm -->
<div class="cells">
    <div class="titulo">
        Pixel para mm
    </div>

    <div class="input-group mb-3">
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


    <div class="input-group mb-3">
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

    <script>
        $(document).ready(function() {
            $('#mm').keyup(function() { //calculate when Milimetros is filled
                $("#pixel").val(mm2px($("#resolucao"), $("#mm")));
            })
            $('#pixel').keyup(function() { //Calculate when Pixels is filled
                $("#mm").val(px2mm($("#resolucao"), $("#pixel")));
            })
        })
    </script>
</div>