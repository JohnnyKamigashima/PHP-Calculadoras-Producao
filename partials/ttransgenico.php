 <!-- calculadora T Transgenico -->
 <script type="text/javascript" src="./partials/library.js"></script>
  <div class="cells">
     <div class="titulo">
         Calculo do Triângulo de Transgênico
     </div>

     <div class="entrada_normal ">
         <div class="input-group-prepend">
             <span class="input-group-text" id="inputGroup-sizing-default">
                 Altura FOP (mm):
             </span>
         </div>
         <input type="text" class="form-control" id="altFOP2" value="">
     </div>

     <div class="entrada_normal">
         <div class="input-group-prepend">
             <span class="input-group-text" id="inputGroup-sizing-default">
                 Largura FOP (mm):
             </span>
         </div>
         <input type="text" class="form-control" id="largFOP2" value="">
     </div>

     <div class="input-group ">
         <div class="linha_resposta">
             <div class="col-7 align-self-center">
                 A largura mínima do <br>triângulo de transg. <br>deve ser (mm):
             </div>
             <div class="col-3 align-self-center">
                 <input type="text" class="form-control" id="largT1" value="0">
             </div>
             <div class="col-2 align-self-center pl-5"><img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png" alt="" class="icon" onclick="copyToClipboard(document.getElementById('largT1').value+' mm')">
             </div>
         </div>

     </div>

     <script>
         $(document).ready(function() {
             $('#altFOP2').keyup(function() { //calculate points
                 $("#altFOP").val($("#altFOP2").val());
                 $("#altFOP1").val($("#altFOP2").val());
                 $("#altFOP3").val($("#altFOP2").val());
                 $("#largT1").val(Transgenico($("#altFOP2"), $("#largFOP2")));
             })

             $('#largFOP2').keyup(function() { //calculate points
                 $("#largFOP").val($("#largFOP2").val());
                 $("#largFOP1").val($("#largFOP2").val());
                 $("#largFOP3").val($("#largFOP2").val());
                 $("#largT1").val(Transgenico($("#altFOP2"), $("#largFOP2")));

             })

         })
     </script>
 </div>