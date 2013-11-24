var NUMBER_OF_BUTTONS=10;

$(document).ready(function(){
    // Set to true to print debug messages to console
    BO.enableDebugging = true; 
    var host = window.location.hostname;
    // if the file is opened locally, set the host to "localhost"
    if (window.location.protocol.indexOf("file:") === 0) {
        host = "localhost";
    }
    
    arduino = new BO.IOBoard(host, 8887);
    arduino.addEventListener(BO.IOBoardEvent.READY, arduinoReady);

    initPlayers('theone');
    record = new record();

    setTimeout(function(){
    	$("#stream").fadeOut();
    },5000);
    
   setStorage('ribica','cka'); 
});
function arduinoReady(){
	button_array=new Array();
    for (var i=0;i<NUMBER_OF_BUTTONS;i++){
        button_array[i]=new Btn(i);
    }
}
function Btn(id){
	this.id=id;
	this.pin=new BO.io.Button(arduino,arduino.getDigitalPin(this.id+2)); //we need to add 2 to the id cause arduino uno's pins 0 and 1 are for serial communication.
	this.pin.addEventListener(BO.io.ButtonEvent.PRESS,function(){
		btnPressed(id);
	});
	this.pin.addEventListener(BO.io.ButtonEvent.RELEASE,function(){
		btnReleased(id);
	});
}

function initPlayers(theme){
	var jplayer_id_handlers = new Array();
	for(var id=0;id<NUMBER_OF_BUTTONS;id++){
		jplayer_id_handlers[id]= new CirclePlayer("#btn"+id,
		{
			oga: theme+'/'+id+'.ogg'
		}, {
			cssSelectorAncestor: "#cp_container_"+id
		});

		$("#btn" + id).jPlayer("load");
	}
}
function btnPressed(id){
	$("#btn" + id).jPlayer("play",0);
	$("#btn" + id).jPlayer("loop",true);
	
	if(record.recording){
		record.add(id,1,new Date());
	}
}
function btnReleased(id){
	$("#btn" + id).jPlayer("stop");
	if(record.recording){
		record.add(id,0,new Date());
	}
}


function record(){
	this.start=function(){
		this.recording=true;
		this.recData.length=0;
		this.prevTime=new Date();
	};
	this.stop=function(){
		this.recording=false;
		this.prevTime=null;
		console.log(this.recData);
		console.log(JSON.stringify(this.recData));
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
		return JSON.stringify(this.recData);
	};
	this.import=function(){	
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
function setStorage(property,value){
	if(typeof(Storage)!=="undefined"){//check if localStorage is supported
		if(typeof(localStorage[property])=='undefined'){
			//alert("property not set");
		}else{
			//alert('property set');
		}
	}else{
		alert("You have an old browser which doesn't support WebStorage. Consider downloading Google Chrome or Mozilla Firefox.");
	}
}
function checkStorage(property){

	return false;
}




firedArr = new Array(false,false,false,false,false,false,false,false,false,false);
$(document).keydown(function (e) {
	if(firedArr[e.which-96]==false){
		if (e.which >= 96 && e.which <=105){
	    	var num=parseInt(e.which)-96;
	    	btnPressed(num);

	    	firedArr[num]=true;
	    }
	}  
});
$(document).keyup(function (e) {
    if (e.which >= 96 && e.which <=105){
    	var num=parseInt(e.which)-96;
    	btnReleased(num);
    }
    firedArr[num]=false;
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
});