var akformsfront = {	id: null,
	spreadsheets: [],
	calcLast: 0,
	callStack: 0,
    init: function() {
		//ready the sheet's parser
		akformsfront.lexer = function() {};
		akformsfront.lexer.prototype = parser.lexer;
		akformsfront.parser = function() {
			this.lexer = new akformsfront.lexer();
			this.yy = {};
		};
		akformsfront.parser.prototype = parser;

		akformsfront.Parser = new akformsfront.parser;
    },

	initParser: function($id) {		akformsfront.id = $id;
		jQuery('#field_table' + $id + ' input').each( function() {			var td = jQuery(this);			var loc = akformsfront.parseLocation(td.attr('id'));
			akformsfront.createCell($id, loc.row, loc.col, td.text(), td.attr('formula'))
		});

		jQuery('#field_table' + $id + ' input').change( function() {			akformsfront.updateCells($id);
		});
	},
	createCell: function(table, row, col, value, formula, calcCount, calcLast) {
		if (!akformsfront.spreadsheets[table]) akformsfront.spreadsheets[table] = [];
		if (!akformsfront.spreadsheets[table][row]) akformsfront.spreadsheets[table][row] = [];

		akformsfront.spreadsheets[table][row][col] = {
			formula: formula,
			value: value,
			calcCount: (calcCount ? calcCount : 0),
			calcLast: (calcLast ? calcLast : -1)
		};

		return akformsfront.spreadsheets[table][row][col];
	},
	updateCellValue: function($table, row, col) {		//first detect if the cell exists if not return nothing
		if (!akformsfront.spreadsheets[$table][row]) return 'Error: Row not found';
		if (!akformsfront.spreadsheets[$table][row][col]) return 'Error: Column not found';

		var cell = akformsfront.spreadsheets[$table][row][col];
		cell.value = jQuery('#field_table' + $table + ' input#' + akformsfront.parseCellName(col, row)).val();

		if (cell.state) throw("Error: Loop Detected");
		cell.state = "red";

		cell.calcLast = akformsfront.calcLast;
		cell.calcCount++;
		if (cell.formula) {
			try {
				if (cell.formula.charAt(0) == '=') {
					cell.formula = cell.formula.substring(1, cell.formula.length);
				}

				var _parser;
				if (akformsfront.callStack) {
					if (!cell.parser) {
						cell.parser = (new akformsfront.parser);
					}
					_parser = cell.parser
				} else {
					_parser = akformsfront.Parser;
				}

				akformsfront.callStack++
				cell.value = _parser.parse(cell.formula, akformsfront.cellIdHandlers, {					table: $table,
					row: row,
					col: col,
					cell: cell
				});
			} catch(e) {
				cell.value = e.toString().replace(/\n/g, '<br />'); //error

				akformsfront.alertFormulaError(row, col, cell.formula, cell.value);
			}
			akformsfront.callStack--;
		}

		jQuery('#field_table' + $table + ' input#' + akformsfront.parseCellName(col, row)).val(cell.value);

		cell.state = null;

		return cell.value;
	},
	updateCells: function($table) {
		jQuery('#field_table' + $table + ' input[formula]').each( function() {
			var cell = akformsfront.parseLocation(jQuery(this).attr('id'));
			akformsfront.updateCellValue($table, cell.row, cell.col);
		});
	},
	cellIdHandlers: {
		cellValue: function(id) { //Example: A1
			var loc = akformsfront.parseLocation(id);
			return akformsfront.updateCellValue(this.table, loc.row, loc.col);
		},
		cellRangeValue: function(ids) {//Example: A1:B1
			ids = ids.split(':');
			var start = akformsfront.parseLocation(ids[0]);
			var end = akformsfront.parseLocation(ids[1]);
			var result = [];

			for (var i = start.row; i <= end.row; i++) {
				for (var j = start.col; j <= end.col; j++) {					result.push(akformsfront.updateCellValue(this.table, i, j));
				}
			}
			return [result];
		},
		fixedCellValue: function(id) {
			return akformsfront.cellIdHandlers.cellValue.apply(this, [(id + '').replace(/[$]/g, '')]);
		},
		fixedCellRangeValue: function(ids) {
			return akformsfront.cellIdHandlers.cellRangeValue.apply(this, [(ids + '').replace(/[$]/g, '')]);
		},
		callFunction: function(fn, args, cell) {
			if (!args) {
				args = [''];
			} else if (jQuery.isArray(args)) {
				args = args.reverse();
			} else {
				args = [args];
			}
			return (akformsfront.fn[fn] ? akformsfront.fn[fn].apply(cell, args) : "Error: Function Not Found");
		}
	},
	alertFormulaError: function(row, col, formula, e) {
		alert(
			'cell:' + row + ' ;' + col + '\n' +
			'value: "' + formula + '"\n' +
			'error: \n' + e
		);
	},
	parseLocation: function(locStr) { // With input of "A1", "B4", "F20", will return {row: 0,col: 0}, {row: 3,col: 1}, {row: 19,col: 5}.
		for (var firstNum = 0; firstNum < locStr.length; firstNum++) {
			if (locStr.charCodeAt(firstNum) <= 57) {// 57 == '9'
				break;
			}
		}
		return {
			row: parseInt(locStr.substring(firstNum)) - 1,
			col: this.columnLabelIndex(locStr.substring(0, firstNum))
		};
	},
	parseCellName: function(col, row){
		return akformsfront.columnLabelString(col) + (row + 1);
	},
	columnLabelIndex: function(str) {
		// Converts A to 0, B to 1, Z to 25, AA to 26.
		var num = 0;
		for (var i = 0; i < str.length; i++) {
			var digit = str.toUpperCase().charCodeAt(i) - 65;	   // 65 == 'A'.
			num = (num * 26) + digit;
		}
		return (num >= 0 ? num : 0);
	},
	columnLabelString: function(index) {//0 = A, 1 = B
		var b = (index).toString(26).toUpperCase();   // Radix is 26.
		var c = [];
		for (var i = 0; i < b.length; i++) {
			var x = b.charCodeAt(i);
			if (i <= 0 && b.length > 1) {				   // Leftmost digit is special, where 1 is A.
				x = x - 1;
			}
			if (x <= 57) {								  // x <= '9'.
				c.push(String.fromCharCode(x - 48 + 65)); // x - '0' + 'A'.
			} else {
				c.push(String.fromCharCode(x + 10));
			}
		}
		return c.join("");
	},
	cFN: {//cFN = compiler functions, usually mathmatical
		sum: 	function(x, y) { return x + y; },
		max: 	function(x, y) { return x > y ? x: y; },
		min: 	function(x, y) { return x < y ? x: y; },
		count: 	function(x, y) { return (y != null) ? x + 1: x; },
		divide: function(x, y) { return x / y; },
		clean: function(v) {
			if (typeof(v) == 'string') {
				v = v.replace(akformsfront.regEx.amp, '&')
					.replace(akformsfront.regEx.nbsp, ' ')
					.replace(/\n/g,'')
					.replace(/\r/g,'');
			}
			return v;
		},
		sanitize: function(v) {
			if (v) {
				if (isNaN(v)) {
					return v;
				} else {
					return v * 1;
				}
			}
			return "";
		}
	},
	regEx: {
		n: 			/[\$,\s]/g,
		cell: 			/\$?([a-zA-Z]+)\$?([0-9]+)/gi, //a1
		range: 			/\$?([a-zA-Z]+)\$?([0-9]+):\$?([a-zA-Z]+)\$?([0-9]+)/gi, //a1:a4
		amp: 			/&/g,
		gt: 			/</g,
		lt: 			/>/g,
		nbsp: 			/&nbsp;/g
	},
	str: {
		amp: 	'&amp;',
		lt: 	'&lt;',
		gt: 	'&gt;',
		nbsp: 	'&nbps;'
	}
}

var jFN = akformsfront.fn = {//fn = standard functions used in cells
	AVERAGE:	function(values) {
		var arr = arrHelpers.foldPrepare(values, arguments);
		return jFN.SUM(arr) / jFN.COUNT(arr);
	},
	AVG: 		function(values) {		return jFN.AVERAGE(values);
	},
	COUNT: 		function(values) { return arrHelpers.fold(arrHelpers.foldPrepare(values, arguments), akformsfront.cFN.count, 0); },
	COUNTA:		function() {
		var count = 0;
		var args = arrHelpers.flatten(arguments);
		for (var i = 0; i < args.length; i++) {
			if (args[i]) {
				count++;
			}
		}
		return count;
	},
	SUM: 		function(values) { return arrHelpers.fold(arrHelpers.foldPrepare(values, arguments), akformsfront.cFN.sum, 0, true, jFN.N); },
	MAX: 		function(values) { return arrHelpers.fold(arrHelpers.foldPrepare(values, arguments), akformsfront.cFN.max, Number.MIN_VALUE, true, jFN.N); },
	MIN: 		function(values) { return arrHelpers.fold(arrHelpers.foldPrepare(values, arguments), akformsfront.cFN.min, Number.MAX_VALUE, true, jFN.N); },
	MEAN:		function(values) { return jFN.SUM(values) / values.length; },
	ABS	: 		function(v) { return Math.abs(jFN.N(v)); },
	CEILING: 	function(v) { return Math.ceil(jFN.N(v)); },
	FLOOR: 		function(v) { return Math.floor(jFN.N(v)); },
	INT: 		function(v) { return Math.floor(jFN.N(v)); },
	ROUND: 		function(v, decimals) {		return jFN.FIXED(v, (decimals ? decimals : 0), false);
	},
	RAND: 		function() { return Math.random(); },
	RND: 		function() { return Math.random(); },
	TRUE: 		function() { return 'TRUE'; },
	FALSE: 		function() { return 'FALSE'; },
	NOW: 		function() { return new Date(); },
	TODAY: 		function() { return Date( Math.floor( new Date ( ) ) ); },
	DAYSFROM: 	function(year, month, day) {
		return Math.floor( (new Date() - new Date (year, (month - 1), day)) / 86400000);
	},
	DAYS: function(v1, v2) {
		var date1 = new Date(v1);
		var date2 = new Date(v2);
		var ONE_DAY = 1000 * 60 * 60 * 24;
		return Math.round(Math.abs(date1.getTime() - date2.getTime()) / ONE_DAY);
	},
	DATEVALUE: function(v) {
		var d = new Date(v);
		return d.getDate() + '/' + (d.getMonth() + 1) + '/' + d.getFullYear();
	},
	IF: function(expression, resultTrue, resultFalse){
		//return [expression, resultTrue, resultFalse] + "";
		return (expression ? resultTrue : resultFalse);
	},
	FIXED: 		function(v, decimals, noCommas) {
		if (decimals == null) {
			decimals = 2;
		}
		var x = Math.pow(10, decimals);
		var n = String(Math.round(jFN.N(v) * x) / x);
		var p = n.indexOf('.');
		if (p < 0) {
			p = n.length;
			n += '.';
		}
		for (var i = n.length - p - 1; i < decimals; i++) {
			n += '0';
		}
		if (noCommas == true) {// Treats null as false.
			return n;
		}
		var arr	= n.replace('-', '').split('.');
		var result = [];
		var first  = true;
		while (arr[0].length > 0) { // LHS of decimal point.
			if (!first) {
				result.unshift(',');
			}
			result.unshift(arr[0].slice(-3));
			arr[0] = arr[0].slice(0, -3);
			first = false;
		}
		if (decimals > 0) {
			result.push('.');
			var first = true;
			while (arr[1].length > 0) { // RHS of decimal point.
				if (!first) {
					result.push(',');
				}
				result.push(arr[1].slice(0, 3));
				arr[1] = arr[1].slice(3);
				first = false;
			}
		}
		if (v < 0) {
			return '-' + result.join('');
		}
		return result.join('');
	},
	TRIM: function(v) {
		if (typeof(v) == 'string') {
			v = jQuery.trim(v);
		}
		return v;
	},
	DOLLAR: function(v, decimals, symbol) {
		if (decimals == null) {
			decimals = 2;
		}

		if (symbol == null) {
			symbol = '$';
		}

		var r = jFN.FIXED(v, decimals, false);

		if (v >= 0) {
			this.cell.html = symbol + r;
		} else {
			this.cell.html = '-' + symbol + r.slice(1);
		}
		return v;
	},
	VALUE: function(v) { return parseFloat(v); },
	N: function(v) {
		if (v == null) {return 0;}
		if (v instanceof Date) {return v.getTime();}
		if (typeof(v) == 'object') {v = v.toString();}
		if (typeof(v) == 'string') {v = parseFloat(v.replace(akformsfront.regEx.n, ''));}
		if (isNaN(v)) {return 0;}
		if (typeof(v) == 'number') {return v;}
		if (v == true) {return 1;}
		return 0;
	},
	PI: function() { return Math.PI; },
	POWER: function(x, y) {
		return Math.pow(x, y);
	},
	SQRT: function(v) {
		return Math.sqrt(v);
	},
	CELLREF: function(v) {
		return (this.akformsfront.spreadsheets[this.table][v] ? this.akformsfront.spreadsheets[this.table][v] : 'Cell Reference Not Found');
	}
};

var arrHelpers = {
	foldPrepare: function(firstArg, theArguments, unique) { // Computes the best array-like arguments for calling fold().
		var result;
		if (firstArg != null &&
			firstArg instanceof Object &&
			firstArg["length"] != null) {
			result = firstArg;
		} else {
			result = theArguments;
		}

		if (unique) {
			result = this.unique(result);
		}

		return result;
	},
	fold: function(arr, funcOfTwoArgs, result, castToN, N) {
		for (var i = 0; i < arr.length; i++) {
			result = funcOfTwoArgs(result, (castToN == true ? N(arr[i]): arr[i]));
		}
		return result;
	},
	toNumbers: function(arr) {
		arr = this.flatten(arr);

		for (var i = 0; i < arr.length; i++) {
			if (arr[i]) {
				arr[i] = jQuery.trim(arr[i]);
				if (isNaN(arr[i])) {
					arr[i] = 0;
				} else {
					arr[i] = arr[i] * 1;
				}
			} else {
				arr[i] = 0;
			}
		}

		return arr;
	},
	unique: function(arr) {
		var a = [];
		var l = arr.length;
		for (var i=0; i<l; i++) {
			for(var j=i+1; j<l; j++) {
				// If this[i] is found later in the array
				if (arr[i] === arr[j])
					j = ++i;
			}
			a.push(arr[i]);
		}
		return a;
	},
	flatten: function(arr) {
		var flat = [];
		for (var i = 0, l = arr.length; i < l; i++){
			var type = Object.prototype.toString.call(arr[i]).split(' ').pop().split(']').shift().toLowerCase();
			if (type) {
				flat = flat.concat(/^(array|collection|arguments|object)$/.test(type) ? this.flatten(arr[i]) : arr[i]);
			}
		}
		return flat;
	},
	insertAt: function(arr, val, index){
		jQuery(val).each(function(){
			if (index > -1 && index <= arr.length) {
				arr.splice(index, 0, this);
			}
		});
		return arr;
	}
};

var jSE = akformsfront;


jQuery(document).ready(function(){ akformsfront.init(); });