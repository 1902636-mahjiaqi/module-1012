 <?php
    include_once "factory/usersClass.php";
    include_once "factory/usersInterface.php";
    include_once "_dbconn.php";

    session_start();
    if (!isset($_SESSION['sessionToken'])) {
      session_unset();
      $_SESSION = array();
      session_destroy();
      header('Location:index.php');
    }

    else {
      if($_SESSION['sessionToken']->getUserType() == "1") {
        header("Location:profDashboard.php");
      }
      else if ($_SESSION['sessionToken']->getUserType() == "0") {
        header("Location:adminDashboard.php");
      }
    }

    if (isset($_SESSSION['status'])) {
      if ($_SESSION['status'] - time() < 1800) {
        $_SESSION['status'] = time();
      }
      else {
        unset_session();
        $_SESSION = array();
        session_destroy();
        header('Location:index.php');
      }
    }

    $user = $_SESSION['sessionToken']->getUser();

    $sql = "SELECT coins FROM game WHERE AccID = $user";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $coins = $row['coins'];

  ?>
<!DOCTYPE html>
<html lang="en">
  <?php include "interface/head/head.php"; ?>
  <?php include "interface/header/header.php"; ?>
  <script>
    function updateData(coins, buildings) {
      $.ajax({
        type: 'POST',
        url: '_updateData.php',
        data: {coinsFromAjax: coins, buildingsData: buildings, ID: <?php echo $user ?>},
        success: function(result){
          alert(result);
        }
      })
    }


  </script>
  <body class="bg-dark">
      <div class="container-fluid">
        <!-- student nav bar here -->
        <?php include "interface/header/stud_nav.php" ?>

        <div class="row justify-content-center">
        <div class="col jumbotron bg-white">
          <!-- header -->
          <div class="d-flex justify-content-between p-3">
            <h5>Sky City</h5>
          </div>
          <div id="sky-city">
            <link rel="stylesheet" href="interface/skycity/css/main.css">

            <section id="main">
              <div id="tools"></div>
              <div id="area">
                <canvas id="score"></canvas>
                <canvas id="bg"></canvas>
                <canvas id="fg"></canvas>
              </div>
            </section>
            <script>
              const $a = _ => document.querySelector(_)
              const $c = _ => document.createElement(_)

              let canvas, bg, fg, cf, ntiles, tileWidth, tileHeight, map, tools, tool, activeTool, isPlacing, score, text, ctx



              /* texture from https://opengameart.org/content/isometric-landscape */
              const texture = new Image()
              texture.src = "interface/skycity/textures/01_130x66_130x230.png"
              texture.onload = _ => init()

              const init = () => {
                tool = [0,0]

                map = [
                  [[0,0],[0,1],[0,2],[0,3],[0,4],[0,5],[0,6]],
                  [[1,0],[1,1],[1,2],[1,3],[1,4],[1,5],[1,6]],
                  [[2,0],[2,1],[2,2],[2,3],[2,4],[2,5],[2,6]],
                  [[3,0],[3,1],[3,2],[3,3],[3,4],[3,5],[3,6]],
                  [[4,0],[4,1],[4,2],[4,3],[4,4],[4,5],[4,6]],
                  [[5,0],[5,1],[5,2],[5,3],[5,4],[5,5],[5,6]],
                  [[6,0],[6,1],[6,2],[6,3],[6,4],[6,5],[6,6]]
                ]

                canvas = $a("#bg")
                canvas.width = 910
                canvas.height = 666
                w = 910
                h = 462
                texWidth = 12
                texHeight = 6

                bg = canvas.getContext("2d")
                ntiles = 7
                tileWidth = 128
                tileHeight = 64
                score = 0
                bg.translate(w/2,tileHeight*2)

                loadHashState(document.location.hash.substring(1))


                // coin value here
                var c = document.getElementById("score");
                ctx = c.getContext("2d");
                coin = <?php echo $coins ?>;
                
                ctx.font = "30px arial";
                ctx.fillText("Current Coin: " + coin, 0, 30); // insert coin here
                

                drawMap()

                fg = $a('#fg')
                fg.width = canvas.width
                fg.height = canvas.height
                cf = fg.getContext('2d')
                cf.translate(w/2,tileHeight*2)
                fg.addEventListener('mousemove', viz)
                fg.addEventListener('contextmenu', e => e.preventDefault())
                fg.addEventListener('mouseup', unclick)
                //fg.addEventListener('mousedown', click)
                fg.addEventListener('touchend', click)
                fg.addEventListener('pointerup', click)


                tools = $a('#tools')

                let toolCount = 0
                for(let i = 0; i < texHeight; i++){
                  for(let j = 0; j < texWidth; j++){
                    const div = $c('div');
                    div.id = `tool_${toolCount++}`
                    div.style.display = "block"
                    /* width of 132 instead of 130  = 130 image + 2 border = 132 */
                    div.style.backgroundPosition = `-${j*130+2}px -${i*230}px`
                    div.addEventListener('click', e => {
                      tool = [i,j]
                      if (activeTool)
                        $a(`#${activeTool}`).classList.remove('selected')	
                      activeTool = e.target.id
                      $a(`#${activeTool}`).classList.add('selected')
                    })
                    tools.appendChild( div )
                  }
                }

              }


              // From https://stackoverflow.com/a/36046727
              const ToBase64 = u8 => {
                return btoa(String.fromCharCode.apply(null, u8))
              }

              const FromBase64 = str => {
                return atob(str).split('').map( c => c.charCodeAt(0) )
              }

              const updateHashState = () => {
                let c = 0
                const u8 = new Uint8Array(ntiles*ntiles)
                for(let i = 0; i < ntiles; i++){
                  for(let j = 0; j < ntiles; j++){
                    u8[c++] = map[i][j][0]*texWidth + map[i][j][1]
                  }
                }
                const state = ToBase64(u8)
                history.replaceState(undefined, undefined, `#${state}`)
                updateData(coin, `#${state}`)
                //console.log(`#${state}`)
              }

              const loadHashState = state => {
                const u8 = FromBase64(state)
                let c = 0
                for(let i = 0; i < ntiles; i++) {
                  for(let j = 0; j < ntiles; j++) {
                    const t = u8[c++] || 0
                    const x = Math.trunc(t / texWidth)
                    const y = Math.trunc(t % texWidth)
                    map[i][j] = [x,y]
                  }
                }
              }

              const click = e => {
                if (confirm("Purchase Buildings?")) {
                  coin = coin - 20; // this will minus 2

                  if (coin >= 0 && coin <= coin) {
                  
                    const pos = getPosition(e)
                    if (pos.x >= 0 && pos.x < ntiles && pos.y >= 0 && pos.y < ntiles) {

                      map[pos.x][pos.y][0] = (e.which === 3) ? 0 : tool[0]
                      map[pos.x][pos.y][1] = (e.which === 3) ? 0 : tool[1]
                      isPlacing = true

                      ctx.fillStyle = '#fff';
                      ctx.fillRect(0, 0, canvas.width, canvas.height);
                      ctx.fillStyle = '#000';
                      ctx.fillText("Current Coin: " + coin, 0, 30); // insert coin here
                      
                      drawMap()
                      cf.clearRect(-w, -h, w * 2, h * 2)
                    }
                    updateHashState();
                  }

                  else {
                    alert("Not enough coins");
                  }
                }
              }

              const unclick = () => {
                if (isPlacing)
                  isPlacing = false
              }

              const drawMap = () =>{
                bg.clearRect(-w,-h,w*2,h*2)
                for(let i = 0; i < ntiles; i++){
                  for(let j = 0; j < ntiles; j++){
                    drawImageTile(bg,i,j,map[i][j][0],map[i][j][1])
                  }
                }
              }

              const drawTile = (c,x,y,color) => {
                c.save()
                c.translate((y-x) * tileWidth/2,(x+y)*tileHeight/2)
                c.beginPath()
                c.moveTo(0,0)
                c.lineTo(tileWidth/2,tileHeight/2)
                c.lineTo(0,tileHeight)
                c.lineTo(-tileWidth/2,tileHeight/2)
                c.closePath()
                c.fillStyle = color
                c.fill()
                c.restore()
              }

              const drawImageTile = (c,x,y,i,j) => {
                c.save()
                c.translate((y-x) * tileWidth/2,(x+y)*tileHeight/2)
                j *= 130
                i *= 230
                c.drawImage(texture,j,i,130,230,-65,-130,130,230)
                c.restore()
              }

              const getPosition = e => {
                const _y =  (e.offsetY - tileHeight * 2) / tileHeight,
                      _x =  e.offsetX / tileWidth - ntiles / 2
                x = Math.floor(_y-_x)
                y = Math.floor(_x+_y)
                return {x,y}
              }

              const viz = (e) =>{
                if (isPlacing)
                  click(e)
                const pos = getPosition(e)
                cf.clearRect(-w,-h,w*2,h*2)
                if( pos.x >= 0 && pos.x < ntiles && pos.y >= 0 && pos.y < ntiles)
                  drawTile(cf,pos.x,pos.y,'rgba(0,0,0,0.2)')
              }

            </script>
          </div>
          </div>
        </div>
      </div>
  </body>
   
</html>