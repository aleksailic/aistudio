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

    record = new record();

    setTimeout(function(){
    	$("#stream").fadeOut();
    },5000);
    
    //defaults
    setStorage('theme',null,false);
    setStorage('bindings','96,97,98,99,100,101,102,103,104,105',false);
    setStorage('toggle',0,false);

    if(checkStorage('theme')==null){
    	streamOutput('<p span="color:rgb(255,0,0);">You do not have a theme selected');
    }

    setSelect();
    initPlayers(checkStorage('theme'));
    document.getElementById('toggle').checked=false;
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
	$("#btn" + id).jPlayer("play",0);
	$("#btn" + id).jPlayer("loop",true);
	
	if(record.recording){
		record.add(id,1,new Date());
	}
}
function btnReleased(id){
	if(checkStorage('toggle')==0){
		$("#btn" + id).jPlayer("stop");
	}
	
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
function setStorage(property,value,override){
	if(typeof(override)=="undefined"){
		override=false;
	}
	if(typeof(Storage)!=="undefined"){//check if localStorage is supported
		if(typeof(localStorage[property])=='undefined'){ //property not set
			localStorage[property]=value;
			console.log('localStorage: '+property+' set to: '+value);
		}else{//property set
			if(override){
				localStorage[property]=value;
				console.log('localStorage: '+property+' set to: '+value);
			}
		}
	}else{
		window['global_'+property]=value;
		console.log('global: '+property+' set to: '+value);
		streamOutput("You have an old browser which doesn't support WebStorage. Consider downloading Google Chrome or Mozilla Firefox.");
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




firedArr = new Array(false,false,false,false,false,false,false,false,false,false);
$(document).keydown(function (e) {
	var bind_arr = checkStorage('bindings').split(',');
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

function streamOutput(data){
    $("#stream").html(data).fadeIn();
    setTimeout(function(){
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
