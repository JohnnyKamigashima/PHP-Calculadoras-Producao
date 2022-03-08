<!-- calc plano pt2mm -->
<div class="col-md-4 cells">
    <div class="titulo">
        Pontos para mm
    </div>

    <div class="input-group mb-3">
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


    <div class="input-group mb-3">
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

    <script>
        $(document).ready(function() {
            $('#pt').keyup(function() { //calculate points
                $("#resultmm").val(pt2mm($("#pt"), 0));
            })
            $('#resultmm').keyup(function() { //calculate mm
                $("#pt").val(pt2mm(0, $("#resultmm")));
            })

        })
    </script>
</div>