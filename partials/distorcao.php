  <!-- calc distorçao -->
  <script type="text/javascript" src="./partials/library.js"></script>
  <div class="col-md-4 cells p-3 ">
      <div class="titulo mt-0 rounded-2">
          Distorção de Cilindro
      </div>
      <div class="input-group mb-3">
          <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Cilindro:</span>
          </div>
          <input type="text" class="form-control" id="cilindro" value="0">
      </div>

      <div class="input-group mb-3">
          <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Altura da arte:</span>
          </div>
          <input type="text" class="form-control" id="arteA" value="0">
      </div>
      <div>
          <div class="row ml-3 px-3">
              Número de repetições
          </div>
          <div class="container-flex mb-3 pr-3">
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
          <div class="row bg-light py-2">
              <div class="col-5 align-self-center">
                  Escala (%):
              </div>
              <div class="col-5 align-self-center">
                  <input type="text" class="form-control" id="distorc" value="0">
              </div>
              <div class="col-2 align-self-center pl-5">
                  <img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-clipboard-512.png" alt="" class="icon" onclick="copyToClipboard(document.getElementById('distorc').value+'%')">
              </div>
          </div>
      </div>

      <script>
          $(document).ready(function() {
              $('#cilindro').keyup(function() { //calculate scale
                  $("#distorc").val(distorC($("#arteA"), $("#cilindro"), $("input[type='radio'][name='repetition']:checked").val()));
              })
              $('#arteA').keyup(function() { //calculate scale
                  $("#distorc").val(distorC($("#arteA"), $("#cilindro"), $("input[type='radio'][name='repetition']:checked").val()));
              })

          })
      </script>
  </div>