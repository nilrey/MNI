    function over(item)
    {
      item.style.color = "#cc3333";
      item.style.cursor = "hand";
    }

    function out(item) {
      item.style.color = "#003399";
      item.style.cursor = "";
    }
   function id_change(obj_id){

      var newId = "ul_"+obj_id;
      var image_id = "image_"+obj_id;
      var vis_id = "v_"+obj_id;
      var image = document.getElementById(image_id);
      var p_vis = document.getElementById(vis_id);

       var nested = document.getElementById(newId);
if (nested != null) {
      if (nested.style.display=="none") {
         nested.style.display='';
         if (image != null) image.src="img/nolines_minus.gif";
         if (p_vis != null) p_vis.value=obj_id;
      }
      else {
         nested.style.display="none" ;
          if (image != null) image.src="img/nolines_plus.gif";
          if (p_vis != null) p_vis.value="";
      }
   }
  }
   function openUp(id) {
              var sp = document.getElementById(id);
        if (sp != null) {
        var ll = sp.parentNode;
        while (ll != null )
              {
                   if (ll.tagName =="UL") {
                       ll.style.display='';
                       var idd = ll.id;
                       if (idd != null && idd.substr(3) != null) {
                              var image_id = "img_ul_"+idd.substr(3);
                              var mm = document.getElementById(image_id);
                              if (mm != null) mm.src="/img/submenu_ico_minus.gif";
                       }
                   }
                   ll = ll.parentNode;
              }
        }
   }


   function   selectObj(item, objName) {
      var exList = document.getElementsByName(objName);
      if (item != null && exList != null ) {
          for ( i=0; i<exList.length; i++ )  exList[i].checked = item.checked;
      }
   }

function checkValue(item){
 if (item.checked) item.value = "true";
 else    item.value="false";
}

 function isOk(okString) {
    var conf = window.confirm(okString);
    return conf;
    }

function setDis(item, objName) {
   var exList = document.getElementsByName(objName);
   if (item != null && item.checked) {
     for ( i=0; i<exList.length; i++ )  exList[i].disabled=false;
   }
    else
   {
     for ( i=0; i<exList.length; i++ )  exList[i].disabled=true;
   }

 }

function setVis( objName) {
   var exList = document.getElementsByName(objName);
   if (exList != null ) {
     for ( i=0; i<exList.length; i++ ) {
       var  nested = exList[i];
       if (nested.style.display=="none") nested.style.display='';
       else  nested.style.display="none" ;
   }

 }

}

function setVisId( objId) {
   var nested = document.getElementById(objId);
   if (nested != null ) {
       if (nested.style.display=="none") nested.style.display='';
       else  nested.style.display='none' ;
  }

}

 var tt=1800;   // tt - timeout

 function showTimeout() {
     var outstr="";
           if (tt >=-1) {
            m = parseInt(tt/60);
            s = tt%60;
            ms = m+":"+s;
            (tt>=0) ? outstr ="Соединение закроется через "+ms+" мин." : "Соединение закрыто";
            tt=tt-1;
            document.getElementById('timeout').innerHTML=outstr;
            id=setTimeout("showTimeout()",1000);
      }
 }

var ST=null;

function SystemClock(){

  var time=new Date()
  var stop_time = null;
  var period = new Date();

  var x=time

  var y=x.getDate();    (y<10) ? y="0"+y : y

  var z=x.getYear();    (z>70 && z<=99) ? z="19"+z : z=""+z

  var hs=x.getHours();  (hs<10) ? hs="0"+hs : hs

  var ms=x.getMinutes();(ms<10) ? ms="0"+ms : ms

  var ss=x.getSeconds();(ss<10) ? ss="0"+ss : ss

  ST=hs+":"+ms+":"+ss;

  document.getElementById('time').innerHTML=ST;
  id=setTimeout("SystemClock()",1000)

}

function isEmpty(str)
{
  for (var intLoop = 0; intLoop < str.length; intLoop++)
  if (" " != str.charAt(intLoop)) return false;
  return true;
 }

function checkRequired(f)
{
var re_zip = /[\D]/;
var re_phone = /[^\d\-\+\s]/;
var re_mail = /^[\w\.\-]+@[\w\.\-]+\.[a-z]{2,3}/i;
var re_comein = /[\W]/;

 var strError = "";
 for (var intLoop = 0; intLoop < f.elements.length; intLoop++)
  if (null!=f.elements[intLoop].getAttribute("required"))
  if (isEmpty(f.elements[intLoop].value))
      strError += " " + f.elements[intLoop].title + "\n";

if (strError != "")
{ alert("Пожалуйста, заполните :\n" + strError); return false; }
/*
else
{

 if ( re_zip.test(f.bis_zip.value))           { alert("Error!! Check your ZIP!"); return false;}
 if ( re_phone.test(f.bis_phone.value))       { alert("Error!! Check your phone!"); return false;}
 if (!re_mail.test(f.bis_email.value))        { alert("Error!! Check your email!"); return false;}
 if ( re_phone.test(f.bis_real_phone.value))  { alert("Error!! Check your contact phone!"); return false;}
 if (!re_mail.test(f.bis_real_email.value))   { alert("Error!! Check your contact email!"); return false;}
 if ( re_comein.test(f.bis_login.value))      { alert("Error!! Check your login!"); return false;}
 if ( re_comein.test(f.bis_password.value))   { alert("Error!! Check your password!"); return false;}

 if (f.bis_password.value != f.bis_password2.value) {
                                                      alert("Error!! Check your password and retype password!");
 													  f.bis_password.focus();
 													  return false;
 													 }
 }    */

}


