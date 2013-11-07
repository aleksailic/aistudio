var NUMBER_OF_BUTTONS=10;

$(document).ready(function(){
	// Declare these variables so you don't have
    // to type the full namespace
    var IOBoard = BO.IOBoard;
    var IOBoardEvent = BO.IOBoardEvent;
    var LED = BO.io.LED;
    var Button = BO.io.Button;
    var ButtonEvent = BO.io.ButtonEvent;
    // Set to true to print debug messages to console
    BO.enableDebugging = true; 
    var host = window.location.hostname;
    // if the file is opened locally, set the host to "localhost"
    if (window.location.protocol.indexOf("file:") === 0) {
        host = "localhost";
    }
    
    arduino = new IOBoard(host, 8887);
    arduino.addEventListener(IOBoardEvent.READY, arduinoReady);

    $("#btn0").jPlayer('play');
});
function arduinoReady(){
	var button_array=new Array();
    for (var i=0;i<NUMBER_OF_BUTTONS;i++){
        button_array[i]=new Btn(i);
    }
}
function Btn(id){
	this.id=id;
	this.pin=new BO.io.Button(arduino,arduino.getDigitalPin(this.id));
	this.pin.addEventListener(BO.io.ButtonEvent.PRESS,function(){
		btnPressed(id);
	});
}
function btnPressed(id){
	alert("pressed btn: "+id);
	//$("#btn0").jPlayer("play",0);
}

$(document).bind('keypress', function (e) {
    if (e.which >= 48 && e.which <=57){
    	var num=parseInt(e.which)-48;
    	btnPressed(num);
    }

});