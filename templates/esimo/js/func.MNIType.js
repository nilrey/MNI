function generateMNIType(type){
	var row = '<select  name="MNITYPE['+type+']['+counterMNITypeBlock+'][mnitype]" id="'+type+counterMNITypeBlock+'_mnitype" onchange="generateMNISort(\''+type+'\', \''+counterMNITypeBlock+'\', \''+type+counterMNITypeBlock+'_mnitype\', \'placer'+type+counterMNITypeBlock+'\')"><option value="">';
		row += '<option value="B">Биология';
			row += '<option value="G">Геология, Геофизика';
			row += '<option value="H">Гидрология и гидрохимия моря';
			row += '<option value="L">Гидрология суши (реки, озёра)';
			row += '<option value="C">Гляциология';
			row += '<option value="D">Динамика моря';
			row += '<option value="P">Загрязнение (экология)';
			row += '<option value="F">Медицинские исследования';
			row += '<option value="M">Метрология';
			row += '<option value="I">Морские ледовые наблюдения';
			row += '<option value="S">Социально-экономические исследования';
			row += '</select>';

	return row;
}

function getOrgByMniType(idLetter){
	switch (idLetter){
		case 'M':
			var arOrgs = ['ГГО','ВНИГМИ-МЦД','ГНИНГИ'];
		break;		case 'H':
			var arOrgs = ['ВНИГМИ-МЦД','ГНИНГИ'];
		break;		case 'D':
			var arOrgs = ['ГНИНГИ'];
		break;		case 'P':
			var arOrgs = ['ВНИГМИ-МЦД','ГОИН'];
		break;		case 'B':
			var arOrgs = ['ВНИРО','ЗИН РАН'];
		break;		case 'G':
			var arOrgs = ['Южморгеология','ГЦ РАН','СевМорГео','ВСЕГЕИ'];
		break;		case 'C':
			var arOrgs = ['ВНИГМИ-МЦД'];
		break;		case 'I':
			var arOrgs = ['ВНИГМИ-МЦД'];
		break;		case 'L':
			var arOrgs = ['ВНИГМИ-МЦД'];
		break;		case 'S':
			var arOrgs = ['ВНИГМИ-МЦД'];
		break;		case 'F':
			var arOrgs = ['НИИ ПМ СГМУ'];
		break;
		default:
			var arOrgs = [];
		break;
	}
	return arOrgs;
}

function setValueToUseResult(){
	var separator = '\n';
	var exp_use_result = $('#exp_use_result');
	if($.browser.msie){
		separator = '\n\r';
	}
	var tmpValue = '';
	var preText = 'Список организаций получающих обязательный экземпляр отчета:'+separator;

	exp_use_result.empty();
	if($('#tablemnitypes > tbody tr').length > 1){
		exp_use_result.append(preText);
	}

	$('#tablemnitypes > tbody tr').each( function(){
		tmpValue = $(this).find('[id$=_mnitype]');
		if(tmpValue.length > 0){
			var arOrgs = getOrgByMniType(tmpValue.val()) ;
			for(var i = 0; i< arOrgs.length; i++){
				var strValue = $('#exp_use_result').val();
				if (strValue.indexOf(arOrgs[i]) == -1 ){
					exp_use_result.append(arOrgs[i]+separator);
				}
			}
		}
	});
	return true;
}

function generateMNISort(type, counter, elementId, placer){
//	alert(type +', '+ counter +' , '+ elementId +' , '+placer);
	setValueToUseResult();
	var id = $('#'+elementId).val();
	if(id.length == 1){
		var row = '<select  name="MNITYPE['+type+']['+counter+'][mnisort]" id="'+type+counter+'_mnisort"><option value="">';
		switch (id){
			case 'M':
					row += '<option value="M02">Актинометрические наблюдения';
							row += '<option value="M01">Аэрологические наблюдения';
							break;
			case 'H':
					row += '<option value="H03">Дискретное измерение температуры поверхностного слоя моря';
							row += '<option value="H02">Непрерывная регистрация солености на поверхности моря';
							row += '<option value="H01">Непрерывная регистрация температуры на поверхности моря';
							break;
			case 'D':
					row += '<option value="D02">Измерители скорости течения(средняя продолжительность измерения)';
							row += '<option value="D01">Измерители скорости течения(число станций)';
							break;
			case 'P':
					row += '<option value="P01">Взвешенные частицы';
							row += '<option value="P02">Тяжелые металлы';
							break;
			case 'B':
					row += '<option value="B01">Первичная продуктивность';
							row += '<option value="B02">Пигменты фитопланктона';
							break;
			case 'G':
					row += '<option value="G01">Драга';
							row += '<option value="G02">Захват';
							break;
			case 'C':
					row += '<option value="C01">Баланс массы ледников';
							row += '<option value="C02">Динамика ледников';
							break;
			case 'I':
					row += '<option value="I01">Определение морфометрических характеристик снежно-ледяного покрова на ледовых станциях';
							row += '<option value="I02">Определение физико-механических и химических характеристик снежно-ледяного покрова на ледовых станциях';
							break;
			case 'L':
					row += '<option value="L01">Гидрология суши (реки, озёра)';
							break;
			case 'S':
					row += '<option value="S01">Демографические  исследования';
							row += '<option value="S02">Этнографические  исследования';
							break;
			case 'F':
					row += '<option value="F01">Антропометрические исследования';
							row += '<option value="F02">Состояние здоровья населения';
							break;

		}

		row += '</select>';
		$('#'+placer).empty();
		$('#'+placer).append(row);

		return false;
		}
}

function generateMNIUnit(type){
	var row = '<select  name="MNITYPE['+type+']['+counterMNITypeBlock+'][mniunit]" id="'+type+counterMNITypeBlock+'_mniunit"><option value="">';
		row += '<option value="2">Вертикальное зондирование';
			row += '<option value="13">Визуальные наблюдения';
			row += '<option value="8">Геологический образец';
			row += '<option value="17">Документ (отчет,карточка,сводка,сообщение...)';
			row += '<option value="12">Инструментальная запись';
			row += '<option value="14">Инструментальное измерение';
			row += '<option value="11">Кадр, снимок, изображение';
			row += '<option value="16">Карта,схема';
			row += '<option value="20">Керн';
			row += '<option value="9">Километр';
			row += '<option value="10">Миля';
			row += '<option value="1">Океанографическая станция';
			row += '<option value="6">Определение';
			row += '<option value="5">Проба';
			row += '<option value="3">Разрез';
			row += '<option value="23">Респондент';
			row += '<option value="4">Серия измерений в точке';
			row += '<option value="19">Скважина';
			row += '<option value="21">Спил';
			row += '<option value="7">Траление';
			row += '<option value="22">Час';
			row += '<option value="18">Шурф';
			row += '<option value="15">Экземпляр';
			row += '</select>';

	return row;
}
