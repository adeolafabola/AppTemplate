/* set global variable i */

var i=1;
var imagei=1;
var audioi=1;
var videoi=1;
var texti=1;
 
function increment()
{
i +=1; /* function for automatic increament of feild's "Name" attribute*/
}

function imageIncrement()
{
imagei +=1; /* function for automatic increament of feild's "Name" attribute*/
}

function audioIncrement()
{
audioi +=1; /* function for automatic increament of feild's "Name" attribute*/
}

function videoIncrement()
{
videoi +=1; /* function for automatic increament of feild's "Name" attribute*/
}

function textIncrement()
{
texti +=1; /* function for automatic increament of feild's "Name" attribute*/
}
 
/*
---------------------------------------------
 
function to remove form elements dynamically
---------------------------------------------
 
*/

function removeThisChild(childId)
{
	var elem = document.getElementById('buttonsDiv').childNodes;
	
	for (j = 0; j < elem.length; j++) 
	{ 
		if (elem.children[j].getAttribute("id")==childId)
			elem.removeChild(elem.children[j]);
	}
}
 
function removeElement(parentDiv, childDiv){
 
 if (childDiv == parentDiv) 
 {
 alert("The parent div cannot be removed.");
 }
 else if (document.getElementById(childDiv)) 
 {
 var child = document.getElementById(childDiv);
 var parent = document.getElementById(parentDiv);
 parent.removeChild(child);
 }
 else 
 {
 alert("Child div has already been removed or does not exist.");
 return false;
 }
}
 
 /*
 ----------------------------------------------------------------------------
 
 functions that will be called upon, when user click on the Name text field
 
 ---------------------------------------------------------------------------
 */
function imageFunction()
{
	var r=document.createElement('span');

	var z = document.createElement("INPUT");
	z.setAttribute("type", "file");
	z.setAttribute("placeholder", "Upload image");
	z.setAttribute("Name","image_"+imagei);
	z.setAttribute("id","image_"+imagei);
	z.setAttribute("required", "required");
	
	var y = document.createElement("INPUT");
	y.setAttribute("type", "text");
	y.setAttribute("placeholder", "Image description");
	y.setAttribute("Name","imagedescription_"+imagei);
	y.setAttribute("id","imagedescription_"+imagei);
	y.setAttribute("size","50");
	
	
	
	var modern = document.createElement("INPUT");
	modern.setAttribute("type", "radio");
	modern.setAttribute("name","imageclassification_"+imagei);
	modern.setAttribute("value","modern");
	modern.setAttribute("required", "required");
	modern.setAttribute("checked", "checked");
	
	var historic = document.createElement("INPUT");
	historic.setAttribute("type", "radio");
	historic.setAttribute("name","imageclassification_"+imagei);
	historic.setAttribute("value","historic");
	historic.setAttribute("required", "required");
	
	var virtual = document.createElement("INPUT");
	virtual.setAttribute("type", "radio");
	virtual.setAttribute("name","imageclassification_"+imagei);
	virtual.setAttribute("value","virtual");
	virtual.setAttribute("required", "required");
	
	

	r.appendChild(z);
	r.innerHTML+='<br>';
	r.appendChild(y);
	r.innerHTML+='<br>';
	r.innerHTML+='Type: Modern';
	r.appendChild(modern);
	r.innerHTML+=' Historic';
	r.appendChild(historic);
	r.innerHTML+=' Virtual';
	r.appendChild(virtual);
	r.innerHTML+='<br>';
	r.innerHTML+='<br>';

	r.setAttribute("id", "imagespan_"+imagei);
	document.getElementById("imageDiv").appendChild(r);
	
	imageIncrement();
}


function new_imageFunction()
{
	var r=document.createElement('span');

	var z = document.createElement("INPUT");
	z.setAttribute("type", "file");
	z.setAttribute("placeholder", "Upload image");
	z.setAttribute("Name","new_image_"+imagei);
	z.setAttribute("id","new_image_"+imagei);
	z.setAttribute("required", "required");
	
	var y = document.createElement("INPUT");
	y.setAttribute("type", "text");
	y.setAttribute("placeholder", "Image description");
	y.setAttribute("Name","new_imagedescription_"+imagei);
	y.setAttribute("id","new_imagedescription_"+imagei);
	y.setAttribute("size","50");
	
	
	
	var modern = document.createElement("INPUT");
	modern.setAttribute("type", "radio");
	modern.setAttribute("name","new_imageclassification_"+imagei);
	modern.setAttribute("value","modern");
	modern.setAttribute("required", "required");
	modern.setAttribute("checked", "checked");
	
	var historic = document.createElement("INPUT");
	historic.setAttribute("type", "radio");
	historic.setAttribute("name","new_imageclassification_"+imagei);
	historic.setAttribute("value","historic");
	historic.setAttribute("required", "required");
	
	var virtual = document.createElement("INPUT");
	virtual.setAttribute("type", "radio");
	virtual.setAttribute("name","new_imageclassification_"+imagei);
	virtual.setAttribute("value","virtual");
	virtual.setAttribute("required", "required");
	
	

	r.appendChild(z);
	r.innerHTML+='<br>';
	r.appendChild(y);
	r.innerHTML+='<br>';
	r.innerHTML+='Type: Modern';
	r.appendChild(modern);
	r.innerHTML+=' Historic';
	r.appendChild(historic);
	r.innerHTML+=' Virtual';
	r.appendChild(virtual);
	r.innerHTML+='<br>';
	r.innerHTML+='<br>';

	r.setAttribute("id", "new_imagespan_"+imagei);
	document.getElementById("new_imageDiv").appendChild(r);
	
	imageIncrement();
}
 
/*
-----------------------------------------------------------------------------
 
functions that will be called upon, when user click on the Email text field
 
------------------------------------------------------------------------------
*/
function audioFunction()
{
	var r=document.createElement('span');

	var z = document.createElement("INPUT");
	z.setAttribute("type", "file");
	z.setAttribute("placeholder", "Upload audio file");
	z.setAttribute("Name","audio_"+audioi);
	z.setAttribute("id","audio_"+audioi);
	z.setAttribute("required", "required");
	
	var y = document.createElement("INPUT");
	y.setAttribute("type", "text");
	y.setAttribute("placeholder", "Audio description");
	y.setAttribute("Name","audiodescription_"+audioi);
	y.setAttribute("id","audiodescription_"+audioi);
	y.setAttribute("size","50");

	r.appendChild(z);
	r.innerHTML+='<br>';
	r.appendChild(y);
	r.innerHTML+='<br>';
	r.innerHTML+='<br>';

	r.setAttribute("id", "audiospan_"+audioi);
	document.getElementById("audioDiv").appendChild(r);
	
	audioIncrement();
}

function new_audioFunction()
{
	var r=document.createElement('span');

	var z = document.createElement("INPUT");
	z.setAttribute("type", "file");
	z.setAttribute("placeholder", "Upload audio file");
	z.setAttribute("Name","new_audio_"+audioi);
	z.setAttribute("id","new_audio_"+audioi);
	z.setAttribute("required", "required");
	
	var y = document.createElement("INPUT");
	y.setAttribute("type", "text");
	y.setAttribute("placeholder", "Audio description");
	y.setAttribute("Name","new_audiodescription_"+audioi);
	y.setAttribute("id","new_audiodescription_"+audioi);
	y.setAttribute("size","50");

	r.appendChild(z);
	r.innerHTML+='<br>';
	r.appendChild(y);
	r.innerHTML+='<br>';
	r.innerHTML+='<br>';

	r.setAttribute("id", "new_audiospan_"+audioi);
	document.getElementById("new_audioDiv").appendChild(r);
	
	audioIncrement();
}
 
/*
-----------------------------------------------------------------------------
 
functions that will be called upon, when user click on the Contact text field
 
------------------------------------------------------------------------------
*/
 
function videoFunction()
{
	var r=document.createElement('span');

	var z = document.createElement("INPUT");
	z.setAttribute("type", "file");
	z.setAttribute("placeholder", "Upload video file");
	z.setAttribute("Name","video_"+videoi);
	z.setAttribute("id","video_"+videoi);
	z.setAttribute("required", "required");
	
	var y = document.createElement("INPUT");
	y.setAttribute("type", "text");
	y.setAttribute("placeholder", "Video description");
	y.setAttribute("Name","videodescription_"+videoi);
	y.setAttribute("id","videodescription_"+videoi);
	y.setAttribute("size","50");

	r.appendChild(z);
	r.innerHTML+='<br>';
	r.appendChild(y);
	r.innerHTML+='<br>';
	r.innerHTML+='<br>';

	r.setAttribute("id", "videospan_"+videoi);
	document.getElementById("videoDiv").appendChild(r);
	
	videoIncrement();
	
}

function new_videoFunction()
{
	var r=document.createElement('span');

	var z = document.createElement("INPUT");
	z.setAttribute("type", "file");
	z.setAttribute("placeholder", "Upload video file");
	z.setAttribute("Name","new_video_"+videoi);
	z.setAttribute("id","new_video_"+videoi);
	z.setAttribute("required", "required");
	
	var y = document.createElement("INPUT");
	y.setAttribute("type", "text");
	y.setAttribute("placeholder", "Video description");
	y.setAttribute("Name","new_videodescription_"+videoi);
	y.setAttribute("id","new_videodescription_"+videoi);
	y.setAttribute("size","50");

	r.appendChild(z);
	r.innerHTML+='<br>';
	r.appendChild(y);
	r.innerHTML+='<br>';
	r.innerHTML+='<br>';

	r.setAttribute("id", "new_videospan_"+videoi);
	document.getElementById("new_videoDiv").appendChild(r);
	
	videoIncrement();
	
}
 
/*
-----------------------------------------------------------------------------
 
functions that will be called upon, when user click on the Messege textarea field
 
------------------------------------------------------------------------------
*/
 
function textFunction()
{
	var r=document.createElement('span');

	var z = document.createElement("TEXTAREA");
	z.setAttribute("placeholder", "Add text");
	z.setAttribute("Name","text_"+texti);
	z.setAttribute("id","text_"+texti);
	z.setAttribute("cols","51");
	z.setAttribute("rows","4");
	z.setAttribute("required", "required");
	
	var y = document.createElement("INPUT");
	y.setAttribute("type", "text");
	y.setAttribute("placeholder", "Text description");
	y.setAttribute("Name","textdescription_"+texti);
	y.setAttribute("id","textdescription_"+texti);
	y.setAttribute("size","50");

	r.appendChild(z);
	r.innerHTML+='<br>';
	r.appendChild(y);
	r.innerHTML+='<br>';
	r.innerHTML+='<br>';

	r.setAttribute("id", "textspan_"+texti);
	document.getElementById("textDiv").appendChild(r);
	
	textIncrement();
}

function new_textFunction()
{
	var r=document.createElement('span');

	var z = document.createElement("TEXTAREA");
	z.setAttribute("placeholder", "Add text");
	z.setAttribute("Name","new_text_"+texti);
	z.setAttribute("id","new_text_"+texti);
	z.setAttribute("cols","51");
	z.setAttribute("rows","4");
	z.setAttribute("required", "required");
	
	var y = document.createElement("INPUT");
	y.setAttribute("type", "text");
	y.setAttribute("placeholder", "Text description");
	y.setAttribute("Name","new_textdescription_"+texti);
	y.setAttribute("id","new_textdescription_"+texti);
	y.setAttribute("size","50");

	r.appendChild(z);
	r.innerHTML+='<br>';
	r.appendChild(y);
	r.innerHTML+='<br>';
	r.innerHTML+='<br>';

	r.setAttribute("id", "new_textspan_"+texti);
	document.getElementById("new_textDiv").appendChild(r);
	
	textIncrement();
}

function triviumFunction()
{
	var r=document.createElement('span');

	var z = document.createElement("TEXTAREA");
	z.setAttribute("placeholder", "Trivium question");
	z.setAttribute("Name","trivium_question_"+i);
	z.setAttribute("id","trivium_question_"+i);
	z.setAttribute("cols","51");
	z.setAttribute("required", "required");
	
	var y = document.createElement("TEXTAREA");
	y.setAttribute("type", "text");
	y.setAttribute("placeholder", "Answer");
	y.setAttribute("Name","trivium_answer_"+i);
	y.setAttribute("id","trivium_answer_"+i);
	y.setAttribute("cols","51");
	y.setAttribute("required", "required");
	
	var x = document.createElement("TEXTAREA");
	x.setAttribute("type", "text");
	x.setAttribute("placeholder", "Response for correct answer");
	x.setAttribute("Name","trivium_correct_response_"+i);
	x.setAttribute("id","trivium_correct_response_"+i);
	x.setAttribute("cols","51");
	x.setAttribute("required", "required");
	
	var w = document.createElement("TEXTAREA");
	w.setAttribute("type", "text");
	w.setAttribute("placeholder", "Response for wrong answer");
	w.setAttribute("Name","trivium_wrong_response_"+i);
	w.setAttribute("id","trivium_wrong_response_"+i);
	w.setAttribute("cols","51");
	w.setAttribute("required", "required");
	
	r.appendChild(z);
	r.innerHTML+='<br>';
	r.appendChild(y);
	r.innerHTML+='<br>';
	r.appendChild(x);
	r.innerHTML+='<br>';
	r.appendChild(w);
	r.innerHTML+='<br>';
	r.innerHTML+='<br>';

	r.setAttribute("id", "triviumspan_"+i);
	document.getElementById("triviumDiv").appendChild(r);
	
	increment();
}

function optionFunction()
{
	var r=document.createElement('span');

	
	var e = document.createElement("TEXTAREA");
	e.setAttribute("placeholder", "Answer Explanation");
	e.setAttribute("Name","explanation");
	e.setAttribute("id","explanation");
	e.setAttribute("cols","51");
	e.setAttribute("required", "required");
	
	
	var z = document.createElement("INPUT");
	z.setAttribute("type", "text");
	z.setAttribute("placeholder", "Option "+i);
	z.setAttribute("Name","option_"+i);
	z.setAttribute("id","option_"+i);
	z.setAttribute("size", "50");
	z.setAttribute("required", "required");
	
	var y = document.createElement("INPUT");
	y.setAttribute("type", "radio");
	y.setAttribute("name","options");
	y.setAttribute("value",i);
	y.setAttribute("required", "required");
	
	if(i==1)
	{
		r.appendChild(e);
		r.innerHTML+='<br><br>';
		
		y.setAttribute("checked", "checked");
	}
	
	r.appendChild(z);
	r.innerHTML+='<br>';
	r.innerHTML+='Correct option? ';
	r.appendChild(y);
	r.innerHTML+='<br>';
	r.innerHTML+='<br>';

	r.setAttribute("id", "optionspan_"+i);
	document.getElementById("optionDiv").appendChild(r);
	
	increment();
}




/*
-----------------------------------------------------------------------------
 
functions that will be called upon, when user click on the Reset Button
 
------------------------------------------------------------------------------
*/
function resetElements(container)
{
	document.getElementById(container).innerHTML = '';
	i=1;
	
	if(container=='imageDiv')
	{
		imagei=1;
	}
	
	if(container=='audioDiv')
	{
		audioi=1;
	}
	
	if(container=='videoDiv')
	{
		videoi=1;
	}
	
	if(container=='textDiv')
	{
		texti=1;
	}
	
	if(container=='new_imageDiv')
	{
		imagei=1;
	}
	
	if(container=='new_audioDiv')
	{
		audioi=1;
	}
	
	if(container=='new_videoDiv')
	{
		videoi=1;
	}
	
	if(container=='new_textDiv')
	{
		texti=1;
	}
	
	//document.getElementById('imageDiv').innerHTML = '';
	//document.getElementById('audioDiv').innerHTML = '';
	//document.getElementById('videoDiv').innerHTML = '';
	//document.getElementById('textDiv').innerHTML = '';
	//document.getElementById('triviumDiv').innerHTML = '';
	//document.getElementById('optionDiv').innerHTML = '';
	
}
