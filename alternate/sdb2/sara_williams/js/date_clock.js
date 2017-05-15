				function jsClock24hr(){
					var time = new Date();
					var year = time.getFullYear();
					var month = time.getMonth();
					var day = time.getDate();
					var week_day = time.getUTCDay();
					var hour = time.getHours();
					var minute = time.getMinutes();
					var second = time.getSeconds();
					if (week_day == 1) week_day = 'Monday';
					if (week_day == 2) week_day = 'Tuesday';
					if (week_day == 3) week_day = 'Wednesday ';
					if (week_day == 4) week_day = 'Thursday';
					if (week_day == 5) week_day = 'Friday';
					if (week_day == 6) week_day = 'Saturday';
					if (week_day == 0) week_day = 'Sunday';
					
					if (month == 0) month = 'January';
					if (month == 1) month = 'February';
					if (month == 2) month = 'March';
					if (month == 3) month = 'April';
					if (month == 4) month = 'May';
					if (month == 5) month = 'June';
					if (month == 6) month = 'July';
					if (month == 7) month = 'August';
					if (month == 8) month = 'September';
					if (month == 9) month = 'October';
					if (month == 10) month = 'November';
					if (month == 11) month = 'December';
					

					var ap = "AM";
if (hour   > 11) { ap = "PM";        }
if (hour   > 12) { hour = hour - 12; }
if (hour   == 0) { hour = 12;        }

					var temp  = week_day+', '+month+' '+day+', '+year+'  &nbsp;&bull;&nbsp;  ' ;
					temp += "" + ((hour < 10) ? "0" : "") + hour;
					temp += ((minute < 10) ? ":0" : ":") + minute;
					temp += ((second < 10) ? ":0" : ":") + second + ' ' +ap;
					document.getElementById('clock').innerHTML=temp;				
				}
				setInterval(jsClock24hr,1000);