<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ env('APP_NAME', "Emulate Brain Activity") }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans|Kavivanar" rel="stylesheet">
    <style>
        body {
            font-family: Monospace;
            background-color: #000;
            color: #fff;
            margin: 0px;
            overflow: hidden;
        }
    </style>
</head>
<body>
<h4 style="position: absolute">{{ $prediction }}</h4>
<script src="{{ asset('js/libs/three.min.js') }}"></script>
<script src="{{ asset('js/libs/Detector.js') }}"></script>
<script src="{{ asset('js/libs/stats.min.js') }}"></script>
<script src="{{ asset('js/libs/cannon.min.js') }}"></script>
<script src="{{ asset('js/game/game.js') }}"></script>
<script>
    let predict = @json($prediction);
    let game, joystick;
    game = new Game();
    joystick = new JoyStick({
        game:game,
        onMove: game.joystickCallback
    });
    var i = 0;                  //  set your counter to 0
    function myLoop() {         //  create a loop function
        setTimeout(function() {   //  call a 3s setTimeout when the loop is called
            if (predict[i] == 0) {
                joystick.up(0.3);
            } else if (predict[i] == 1) {
                joystick.up(-0.3);
            } else if (predict[i] == 2) {
                joystick.move(-0.9992833697894283);
            } else if (predict[i] == 3) {
                joystick.move(0.9992833697894283);
            }
            i++;                    //  increment the counter
            if (i <= 4) {
                myLoop();             //  ..  again which will trigger another
            }else{
                joystick.stop()
            }
        }, 3000)
    }
    myLoop();
    joystick.stop()
    document.addEventListener('keypress', function(e){

        if(e.key == "d"){
            joystick.move(0.9992833697894283);
        }else if(e.key == "a"){
            joystick.move(-0.9992833697894283);
        }else if(e.key == "w"){
            joystick.up(0.3);
        }else if(e.key == "s"){
            joystick.up(-0.3);
        }else if(e.which == 32){
            joystick.stop();
        }
    })

</script>
</body>
</html>

