var NUMBER_OF_BUTTONS=10;

$(document).ready(function(){
	//---Arduino setup:---
    // Set to true to print debug messages to console
    BO.enableDebugging = true; 
    var host = window.location.hostname;
    // if the file is opened locally, set the host to "localhost"
    if (window.location.protocol.indexOf("file:") === 0) {
        host = "localhost";
    }
    
    arduino = new BO.IOBoard(host, 8887);
    arduino.addEventListener(BO.IOBoardEvent.READY, arduinoReady);
    //---------------------/
    record = new record(); //start new instance of record object

    stream_timeout= setTimeout(function(){ //when the page loads fadeOut the stream
    	$("#stream").fadeOut();
    },5000);
    
    //set defaults
    setStorage('theme',null,false);
    setStorage('bindings','96,97,98,99,100,101,102,103,104,105',false);
    setStorage('toggle',0,false);
    setStorage('volume',100,false);

    if(checkStorage('theme')==null){
    	streamOutput('You do not have a theme selected',false);
    }

    setSelect(); //Match theme select list with the list in theme admin

    initPlayers(checkStorage('theme')); //initialize the players

    if( parseInt( checkStorage("toggle") ) ){
    	document.getElementById('toggle').checked=true;	
    }else{
    	document.getElementById('toggle').checked=false;	
    }
    
});
function arduinoReady(){
	button_array=new Array(); //initialize array which will hold button objects
    for (var i=0;i<NUMBER_OF_BUTTONS;i++){
        button_array[i]=new Btn(i); //initialize buttons
    }

    var on_led = new BO.io.LED(arduino,arduino.getDigitalPin(12)); //GREEB 
    on_led.on();
    window.addEventListener("beforeunload", function(e){
	   on_led.off();
	}, false);
    rec_led = new BO.io.LED(arduino,arduino.getDigitalPin(13)); //RED LED on pin 13

    potentiometer = new BO.io.Potentiometer(arduino,arduino.getAnalogPin(4));
    potentiometer.setRange(0.1,1); //My potentiometer is a little off, so i need to adjust it
    potentiometer.addEventListener(BO.io.PotEvent.CHANGE,function(){
    	changeGlobalVolume(parseInt(potentiometer.value*100));
    });

}
function Btn(id){
	this.id=id; //set the id
	this.pin=new BO.io.Button(arduino,arduino.getDigitalPin(this.id+2),BO.io.Button.INTERNAL_PULL_UP); //we need to add 2 to the id cause arduino uno's pins 0 and 1 are for serial communication.
	this.pin.addEventListener(BO.io.ButtonEvent.PRESS,function(){
		btnPressed(id); //call btnPressed function whenever physical button is pressed
	});
	this.pin.addEventListener(BO.io.ButtonEvent.RELEASE,function(){
		btnReleased(id); //call btnReleased function whenever physical button is released
	});
}

function changeGlobalVolume(num){
	var prev=parseInt(checkStorage('volume'));
	if(Math.abs(num-prev)>1){ //Check if values differ for a more than 1 percent
		setStorage('volume',num,true);
		for(var id=0;id<NUMBER_OF_BUTTONS;id++){
			$("#btn"+id).jPlayer("volume",num/100);
		} 
	}
}
function initPlayers(theme){
	var jplayer_id_handlers = new Array();
	for(var id=0;id<NUMBER_OF_BUTTONS;id++){
		$("#btn"+id).jPlayer("destroy");
		jplayer_id_handlers[id]= new CirclePlayer("#btn"+id,
		{
			oga: 'themes/'+theme+'/'+id+'.ogg'
		}, {
			cssSelectorAncestor: "#cp_container_"+id
		});

		$("#btn" + id).jPlayer("load");
	}
}
function btnPressed(id){
	$("#btn" + id).jPlayer("play",0); //play the sound
	$("#btn" + id).jPlayer("loop",true); //set sound looping to true
	
	if(record.recording){ //if recording
		record.add(id,1,new Date()); //add new point in the recording array
	}
}
function btnReleased(id){
	if(checkStorage('toggle')==0){ //depending on the toggle, when the button is relesed either stop the sound or don't do anything
		$("#btn" + id).jPlayer("stop");
	}
	
	if(record.recording){ //if recording
		record.add(id,0,new Date()); //add new point in the recording array 
	}
}


function record(){
	this.start=function(){
		this.recording=true;
		this.recData.length=0; //reset recording data
		this.prevTime=new Date(); //reset the time
		rec_led.blink(1000);
	};
	this.stop=function(){
		this.recording=false;
		this.prevTime=null;
		console.log(this.recData); //output recorded data to console
		console.log(JSON.stringify(this.recData));
		rec_led.stopBlinking();
	};

	this.add=function(id,state,time){
		var values={
			time : ( time.getTime() - this.prevTime.getTime() ), //time difference in miliseconds
			state : state,
			id : id
		};
		this.recData.push(values);
		this.prevTime=time;
	};
	this.play=function(num){
		var array = this.recData;
		var that=this;

		if(num<array.length && this.paused==false){
			setTimeout(function(){
				if(array[num].state==1){
					btnPressed(array[num].id);
				}else{
					btnReleased(array[num].id);
				}
				that.play(num+1);
			},array[num].time);
		}else{
			$("#play").text("PLAY");
			this.paused=false;
			return 0;
		}
	};
	this.export=function(){
		return JSON.stringify(this.recData); //return recorded data in a string format
	};
	this.import=function(){	//import json data
		var data=prompt("Add your JSON data","");
		if (data!=null)
		{
			this.recData=JSON.parse(data);
		}
		
	}
	this.pause=function(){
		this.paused=true;
	};
	this.paused=false;
	this.recording=false;
	this.prevTime=null;
	this.recData=new Array();
}
function setStorage(property,value,override){
	if(typeof(override)=="undefined"){
		override=false;
	}
	if(typeof(Storage)!=="undefined"){//check if localStorage is supported
		if(typeof(localStorage[property])=='undefined'){ //property not set
			localStorage[property]=value;
			streamOutput(property+' set to: '+value,true);
			console.log('localStorage: '+property+' set to: '+value);
		}else{//property set
			if(override){
				localStorage[property]=value;
				streamOutput(property+' set to: '+value,true);
				console.log('localStorage: '+property+' set to: '+value);
			}
		}
	}else{
		window['global_'+property]=value;
		console.log('global: '+property+' set to: '+value);
		streamOutput("You have an old browser which doesn't support WebStorage. Consider downloading Google Chrome or Mozilla Firefox.",false);
	}
}
function checkStorage(property){
	if(typeof(Storage)!=="undefined"){//check if localStorage is supported
		if(typeof(localStorage[property])=='undefined'){ //property not set
			return null;
		}else{
			return localStorage[property];
		}
	}else{
		return window['global_'+property];
	}
	
}




firedArr = new Array(false,false,false,false,false,false,false,false,false,false); //button pressed array
$(document).keydown(function (e) {
	var bind_arr = checkStorage('bindings').split(','); //parse localstorage's binding data to array
	for (var i=0;i<bind_arr.length;i++){
		if(e.which==bind_arr[i]){
			if(firedArr[i]==false){
				btnPressed(i);
				firedArr[i]=true;
			}
			break;
		}
	}  
});
$(document).keyup(function (e) {
	var bind_arr = checkStorage('bindings').split(',');
	for (var i=0;i<bind_arr.length;i++){
		if(e.which==bind_arr[i]){
			btnReleased(i);
			firedArr[i]=false;
			break;
		}
	}
});

$(document).ready(function(){
	$("#record").click(function(){
		if($(this).hasClass('clicked')){
			$(this).removeClass('clicked');
			record.stop();
		}else{
			$(this).addClass('clicked');
			record.start();
		}
	});
	$("#play").click(function(){
		if(record.recData.length != 0){
			if($(this).text()=="PLAY"){
				record.play(0);
				$(this).text("STOP");
			}else{
				record.pause();
				$(this).text("PLAY");
			}
		}else{
			alert("You need to load or record something first");
		}
	});
	$("#load").click(function(){
		record.import();
	});
	$("#save").click(function(){
		prompt("Press CTRL+C to copy",record.export());
	});
	$("#key_bindings").click(function(){
		var binds = prompt("Change bindings using the sheet given. Seperate with commas (,) and dont use spaces");
		if(binds!=null){
			setStorage('bindings',binds,true);
		}
	});
	$("#toggle").click(function(){
		if(this.checked){
			setStorage('toggle',1,true);
		}else{
			setStorage('toggle',0,true);
		}
	});
	$('#theme_select').change(function () {
	    var optionSelected = $(this).find("option:selected");
	    var theme_name = optionSelected.val();
	    var theme_id=optionSelected.data('id');

	    if(theme_id==null || theme_id==undefined){
	    }else{
	    	setStorage('theme',theme_id,true);
	   		initPlayers(theme_id);
	    }
	    
	});

});

function streamOutput(data,status){
	clearTimeout(stream_timeout); //remove the previous fadeOut timer
	var pretext=null;
	if(status){
		pretext='<p style="color:rgb(0,255,0);">';
	}else{
		pretext='<p style="color:rgb(255,0,0);">';
	}

	$("#stream").html(pretext+data+'</p>').fadeIn();
    stream_timeout = setTimeout(function(){
        $("#stream").fadeOut();
    },7000);
}

function setSelect(){
	var arr =$('#theme-list').children();
	if(arr.length>0){
		for(var i=0;i<arr.length;i++){
			var theme_id = $(arr[i]).data('id');
			var theme_name = $(arr[i]).text();

			var code = '<option data-id="'+theme_id+'">'+theme_name+'</option>';
			$('#theme_select').append(code);
		}
	}else{
		$('#theme_select').html("<option>NULL</option>");
	}
}