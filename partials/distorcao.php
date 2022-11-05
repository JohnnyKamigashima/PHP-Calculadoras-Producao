  <!-- calc distorçao -->

  <div class="cells">
      <div class="titulo">
          Distorção de Cilindro
      </div>
      <div class="entrada_normal">
          <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Cilindro:</span>
          </div>
          <input type="text" class="form-control" id="cilindro" value="0">
      </div>

      <div class="entrada_normal">
          <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Altura da arte:</span>
          </div>
          <input type="text" class="form-control" id="arteA" value="0">
      </div>
      <div>
          <div class="row m-auto p-0">
              Número de repetições
          </div>
          <div class="container-flex p-0">
              <div class="form-check form-check-inline">
                  <input class="form-check-input" onclick="handleClick(this);" type="radio" name="repetition" id="repeat1" value=1>
                  <label class="form-check-label" for="repeat1">1</label>
              </div>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" onclick="handleClick(this);" type="radio" name="repetition" id="repeat2" value=2>
                  <label class="form-check-label" for="repeat2">2</label>
              </div>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" onclick="handleClick(this);" type="radio" name="repetition" id="repeat3" value=3>
                  <label class="form-check-label" for="repeat3">3</label>
              </div>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" onclick="handleClick(this);" type="radio" name="repetition" id="repeat4" value=4>
                  <label class="form-check-label" for="repeat4">4</label>
              </div>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" onclick="handleClick(this);" type="radio" name="repetition" id="repeat5" value=5>
                  <label class="form-check-label" for="repeat5">5</label>
              </div>
          </div>
      </div>

      <div class="input-group">
          <div class="linha_resposta">
              <div class="col-5 align-self-center">
                  Escala (%):
              </div>
              <div class="col-5 align-self-center">
                  <input type="text" class="form-control" id="distorc" value="0">
              </div>
              <div class="col-2 align-self-center pl-5">
                  <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png" alt="" class="icon" onclick="clip_distor.copyToClipboard(document.getElementById('distorc').value+'%')">
              </div>
          </div>
      </div>
      <script type="text/javascript" src="./partials/functions/distorC_lib.js"></script>
      <script type="text/javascript" src="./partials/functions/copytoclipboard_lib.js"></script>
      <script>
          clip_distor = new Clipboard
          $(document).ready(() => {
              $('#cilindro').keyup(() => atualizaDistorc())
              $('#arteA').keyup(() => atualizaDistorc())
          })

          function atualizaDistorc() {
              calc_atualiza = new Distorcao
              $("#distorc").val(calc_atualiza.distorC(
                  $("#arteA").val(),
                  $("#cilindro").val(),
                  $("input[type='radio'][name='repetition']:checked").val()
              ));
          }

          function handleClick(myRadio) {
              calc_handle = new Distorcao
              $("#distorc").val(
                  calc_handle.distorC(
                      $("#arteA").val(),
                      $("#cilindro").val(),
                      $("input[type='radio'][name='repetition']:checked").val()
                  ));
          }
      </script>
  </div>