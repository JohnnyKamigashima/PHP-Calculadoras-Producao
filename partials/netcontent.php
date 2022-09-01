 <!-- Tabela Net Content -->
 <script type="text/javascript" src="./partials/library.js"></script>

 <div class="cells">
     <div class="titulo">
         Tabela de Peso Neto
     </div>
     <div class="rotulo">
         País:
     </div>
     <div class="entrada">
         <select name="pais" id="pais" value="MC" class="form-control">
             <option value="MC" selected>Mercosul (AR, BR, UY, PY)</option>
             <option value="PE">Peru</option>
             <option value="BO">Bolívia</option>
             <option value="EC">Equador</option>
             <option value="CL">Chile</option>
             <option value="CO">Colômbia</option>
             <option value="CAM">A.Central (CR, ES, GT, HN, NI, PA)</option>
             <option value="RD">República Dominicana</option>
             <option value="PR">Porto Rico</option>
             <option value="IC">Ilhas Cayman</option>
             <option value="MX">México</option>
         </select>
     </div>
     <div class="desc">
         <p id="descricao">
         </p>
     </div>

     <div class="entrada_normal">
         <div class="input-group-prepend">
             <span class="input-group-text" id="inputGroup-sizing-default">
                 Altura FOP (mm):
             </span>
         </div>
         <input type="text" class="form-control" id="altFOP3" name="altFOP3">
     </div>

     <div class="entrada_normal">
         <div class="input-group-prepend">
             <span class="input-group-text" id="inputGroup-sizing-default">
                 Largura FOP (mm):
             </span>
         </div>
         <input type="text" class="form-control" name="largFOP3" id="largFOP3">
     </div>

     <div class="entrada_normal">
         <div class="input-group-prepend">
             <span class="input-group-text" id="inputGroup-sizing-default">
                 Peso (em g):
             </span>
         </div>
         <input type="text" class="form-control" id="peso" value="">
     </div>

     <div class="input-group ">
         <div class="linha_resposta">
             <div class="col-7 align-self-center">
                 Tam. min (mm):
             </div>
             <div class="col-3 align-self-center">
                 <input type="text" class="form-control" id="resultmm1" value="">
             </div>
             <div class="col-2 align-self-center pl-5">
                 <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png" alt="" class="icon" onclick="copyToClipboard(document.getElementById('resultmm1').value+' mm')">
             </div>
         </div>
     </div>

     <script>
         sort("pais");
         $("#pais").val("MC");
         $(document).ready(function() {
             $('#largFOP3').keyup(function() {
                 $("#peso").val("");
                 $("#largFOP").val($("#largFOP3").val());
                 $("#largFOP1").val($("#largFOP3").val());
                 $("#largFOP2").val($("#largFOP3").val());
                 $("#resultmm1").val(pesoNeto($("#altFOP3"), $("#largFOP3"), $("#peso"), $("#pais")));
             })
             $('#altFOP3').keyup(function() {
                 $("#peso").val("");
                 $("#altFOP").val($("#altFOP3").val());
                 $("#altFOP1").val($("#altFOP3").val());
                 $("#altFOP2").val($("#altFOP3").val());
                 $("#resultmm1").val(pesoNeto($("#altFOP3"), $("#largFOP3"), $("#peso"), $("#pais")));
             })
             $('#pais').change(function() {
                 $("#resultmm1").val(pesoNeto($("#altFOP3"), $("#largFOP3"), $("#peso"), $("#pais")));
             })
             $("#peso").keyup(function() {
                 $("#altFOP3").val("");
                 $("#largFOP3").val("");
                 $("#resultmm1").val(pesoNeto($("#altFOP3"), $("#largFOP3"), $("#peso"), $("#pais")));
             })
         })
     </script>
 </div>