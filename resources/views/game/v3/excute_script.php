
<script src="{{asset('js/libs/three.min.js')}}"></script>
<script src="{{ asset('js/libs/Detector.js')}}"></script>
<script src="{{ asset('js/libs/stats.min.js')}}"></script>
<script src="{{ asset('js/libs/cannon.min.js')}}"></script>
<script src="{{ asset('js/game/game.js')}}"></script>
<script>
    let game, joystick;
    game = new Game();
    joystick = new JoyStick({
        game:game,
        onMove: game.joystickCallback
    });


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
