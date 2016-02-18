function getSeoCat(mas){
	//console.log(mas);
	mas.find(" > li ").each(function(){
		if ($(this).find("input[name='title[]']").length){
			var i=0;
			var cont=$(this);
			 cont.find("input[name='title[]']").each(function(){
				tttrran($(this),cont.find("input[name='Link[]']").eq(i))
				i++;
			});
		}
		if ($(this).find(" > ul").length){
			getSeoCat($(this).find(" > ul"));
		}
	});
}

function tttrran(el1,el2){
	var trans=get_trans1(el1.val());
	//el2.val(trans);
	el1.input(function(){
		var trans=get_trans1(el1.val());
		el2.val(trans);
	});
}

function get_trans1(str) {
	var entoru = [[['а'],[ 'a']],
	[['б'],[ 'b']],
	[['в'],[ 'v']],
	[['г'],[ 'g']],
	[['д'],[ 'd']],
	[['е'],[ 'e']],
	[['ё'],[ 'yo']],
	[['ж'],[ 'zh']],
	[['з'],[ 'z']],
	[['и'],[ 'i']],
	[['й'],[ 'j']],
	[['к'],[ 'k']],
	[['л'],[ 'l']],
	[['м'],[ 'm']],
	[['н'],[ 'n']],
	[['о'],[ 'o']],
	[['п'],[ 'p']],
	[['р'],[ 'r']],
	[['с'],[ 's']],
	[['т'],[ 't']],
	[['у'],[ 'u']],
	[['ф'],[ 'f']],
	[['х'],[ 'h']],
	[['ц'],[ 'c']],
	[['ч'],[ 'ch']],
	[['ш'],[ 'sh']],
	[['щ'],[ 'shch']],
	[['ъ'],[ '']],
	[['ы'],[ 'y']],
	[['ь'],[ '']],
	[['э'],[ 'e']],
	[['ю'],[ 'yu']],
	[['я'],[ 'ya']],
	[['і'],[ 'i']],
	[['ї'],[ 'i']],
	[['є'],[ 'e']],
	[['А'],[ 'A']],
	[['Б'],[ 'B']],
	[['В'],[ 'V']],
	[['Г'],[ 'G']],
	[['Д'],[ 'D']],
	[['Е'],[ 'E']],
	[['Ё'],[ 'Yo']],
	[['Ж'],[ 'Zh']],
	[['З'],[ 'Z']],
	[['И'],[ 'I']],
	[['Й'],[ 'J']],
	[['К'],[ 'K']],
	[['Л'],[ 'L']],
	[['М'],[ 'M']],
	[['Н'],[ 'N']],
	[['О'],[ 'O']],
	[['П'],[ 'P']],
	[['Р'],[ 'R']],
	[['С'],[ 'S']],
	[['Т'],[ 'T']],
	[['У'],[ 'U']],
	[['Ф'],[ 'F']],
	[['Х'],[ 'H']],
	[['Ц'],[ 'C']],
	[['Ч'],[ 'Ch']],
	[['Ш'],[ 'Sh']],
	[['Щ'],[ 'Shch']],
	[['Ъ'],[ '']],
	[['Ы'],[ 'Y']],
	[['Ь'],[ '']],
	[['Э'],[ 'E']],
	[['Ю'],[ 'Yu']],
	[['Я'],[ 'Ya']],
	[[' '],[ '-']],
	[['І'],[ 'I']],
	[['Ї'],[ 'I']],
	[['Є'],[ 'E']]];
	var nameVal = trim(str);
	var trans = new String();	
	for (i = 0; i < entoru.length; i++) {
		var regex = new RegExp(entoru[i][0][0], "g");
		nameVal=nameVal.replace(regex, entoru[i][1][0]); 
	}
	return nameVal.toLowerCase();
}

function trim(string) {
	//Удаляем пробел в начале строки и ненужные символы
	string = string.replace(/(^\s+)|'|"|<|>|\!|\||@|#|$|%|^|\^|\$|\\|\/|&|\*|\(\)|\|\/|;|\+|№|,|\?|:|{|}|\[|\]/g, "");
	return string;
}; 