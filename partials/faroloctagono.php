<!-- calculadora Farol Octagono-->
<script src="./js/library.js"></script>
<div class="cells">
    <div class="titulo">
        Tamanho do Farol Octagono <img src="./images/altoenoctagono.png" class="icon" >
    </div>
    <div class="entrada mb-3">
         <select name="pais" id="pais5" value="PE" class="form-control">
             <option value="PE">Peru</option>
             <option value="CH">Chile</option>
             <option value="UY">Uruguay</option>
             <option value="MX">México</option>
         </select>
     </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">
                Altura FOP (mm):
            </span>
        </div>
        <input type="text" class="form-control" id="altFOP5" value="">
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">
                Largura FOP (mm):
            </span>
        </div>
        <input type="text" class="form-control" id="largFOP5" value="">
    </div>

    <!-- <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">
                Area FOP (mm2):
            </span>
        </div>
        <input type="text" class="form-control" id="areaFOP5" value="">
    </div> -->

    <!-- <div class="input-group mb-3 align-items-center">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">
                Cilindrico:
            </span>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="cilindroYes1" name="cilindro" value="true" style="margin-left: 15px;">
            <label class="form-check-label" for="inlineCheckbox1">Sim</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="cilindroNo1" name="cilindro" value="false" checked>
            <label class="form-check-label" for="inlineCheckbox2">Não</label>
        </div>
    </div> -->
   
    <div class="input-group mb-3">
        <div class="row bg-light py-2">
            <div class="col-7 align-self-center">
                A largura do Farol <br> deve ser de:
            </div>
            <div class="col-3 align-self-center">
                <input type="text" class="form-control" id="largF5" value="0" style="height:66px; margin:auto">
            </div>
          
            <div class="col-2 align-self-center pl-5">
                <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png" alt="" class="icon" onclick="copyToClipboard(document.getElementById('largF5').value+' mm')">
            </div>
            <div class="col align-self-center">
            <p id="descricao_farol">
         </p>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#altFOP5').change(function() {
                $("#largF5").val(farol_octagono($("#altFOP5"), $("#largFOP5"), $("#areaFOP5"), $("#pais5")));
                $("#altFOP").val($("#altFOP5").val());
                $("#altFOP1").val($("#altFOP5").val());
                $("#altFOP2").val($("#altFOP5").val());
                $("#altFOP3").val($("#altFOP5").val());
            })
            $('#largFOP5').change(function() {
                $("#largF5").val(farol_octagono($("#altFOP5"), $("#largFOP5"), $("#areaFOP5"), $("#pais5")));
                $("#largFOP").val($("#largFOP5").val());
                $("#largFOP1").val($("#largFOP5").val());
                $("#largFOP2").val($("#largFOP5").val());
                $("#largFOP3").val($("#largFOP5").val());
            })
            $('#areaFOP5').change(function() {
                $("#largF5").val(farol_octagono($("#altFOP5"), $("#largFOP5"), $("#areaFOP5"), $("#pais5")));
            })
            $('#cilindroYes').change(function() {
                $("#largF5").val(farol_octagono($("#altFOP5"), $("#largFOP5"), $("#areaFOP5"), $("#pais5")));
            })
            $('#cilindroNo').change(function() {
                $("#largF5").val(farol_octagono($("#altFOP5"), $("#largFOP5"), $("#areaFOP5"), $("#pais5")));
            })
        });
    </script>
</div>