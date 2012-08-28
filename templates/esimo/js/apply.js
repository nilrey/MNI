// VARIABLES
var counterShipBlock = 2;
var transBlockName = '<?=$transBlockName?>';

// FUNCTIONS
function deleteBlockTransport(nmbr){
	$('#selTransport'+nmbr).remove();
	$('#delTransport'+nmbr).remove();
	$('#descTransport'+nmbr).remove();
} 

// TRANSPORT

function getTransportType(elem, counter, placer){
	$.post("http://mymonitor/ajax.php", { name: elem.value, counter: counter, action: "getTransport" },
	   function(data) {
//			$("#name"+counter).attr({ value: data.name_eng });
//			$("#name_en"+counter).attr({value: data.name});

//			$('#'+transBlockName).append(data.fields);
			//alert(data.selector[1].name_eng );
			
			$('#descTransport'+counter).remove(); // очистим область записи
			$('#'+transBlockName+placer).append('<div id="descTransport'+counter+'"></div>'); // добавим область записи
			$('#descTransport'+counter).addClass( "descTransport" );
			$('#descTransport'+counter).append( 'Название: '+ data.selector );
			$('#descTransport'+counter).append( data.fields );
      
	   }, "json");
}

function getShipInfo(elem, counter){
	$.post("http://mymonitor/ajax.php", { elementId: elem.value, counter: counter, action: "shipInfo" },
	   function(data) {
//	   	alert(data.name );
			$('#nation__'+counter).val( data.nation);
			$('#shipowner__'+counter).val( data.shipowner);
			$('#homeport__'+counter).val( data.nation);
			$('#func__'+counter).val( data.homeport);
			$('#length__'+counter).val( data.length);
			$('#width__'+counter).val( data.width);
			$('#draught__'+counter).val( data.draught);
			$('#seaworth__'+counter).val( data.seaworth);
			$('#displace__'+counter).val( data.displace);
			$('#generator__'+counter).val( data.generator);
			$('#rdfreq__'+counter).val( data.rdfreq);
			$('#rdsign__'+counter).val( data.rdsign);
			$('#capt__'+counter).val( data.capt);
			$('#crew__'+counter).val( data.crew);
			$('#researchers__'+counter).val( data.researchers);
			$('#head__'+counter).val( data.head);
      
	   }, "json");
}

function newTransportBlock(placer){
	
//	var strInput = '<div id="block'+counterShipBlock+'"><input type="text" name="" id="id'+counterShipBlock+'" value="value'+counterShipBlock+'"><input type="button" onclick="deleteBlockTransport('+counterShipBlock+')" value="delete '+counterShipBlock+'"></div>';
	strOutput = '';
	strOutput += 'Тип транспорта: <select id="selTransport'+counterShipBlock+'" onchange="getTransportType(this, '+counterShipBlock+', 2)"><option value=0 /><option value="ship">Судно<option value="plane">Самолет<option value="helic">Вертолет<option value="x4">Вездеход</select>';
	strOutput += '<input type="button" id="delTransport'+counterShipBlock+'" onclick=" deleteBlockTransport('+counterShipBlock+')" value="Удалить">';
	strOutput += '';
	strOutput += '<div id="descTransport'+counterShipBlock+'">';
	strOutput += '</div>';
	$('#'+transBlockName+placer).append( strOutput);
//	$('#'+transBlockName).append( addShipParams(counterShipBlock));
	counterShipBlock++;
}

(function($) {
$(function() {

  $('div.tabs').each(function() {
    $(this).find('span').each(function(i) {
      $(this).click(function(){
        $(this).addClass('current').siblings().removeClass('current')
          .parents('div.section').find('div.box').hide().end().find('div.box:eq('+i+')').fadeIn(150);
      });
    });
  });

})
})(jQuery)

function showTab(nmb){
	for(i=1; i< 5; i++){
 		document.getElementById("tabPlace"+i).style.display= 'none';
		document.getElementById("tab"+i).className= 'tabInActive';
	}
	document.getElementById("tabPlace"+nmb).style.display= 'block';
	document.getElementById("tab"+nmb).className= 'tabActive';
}

