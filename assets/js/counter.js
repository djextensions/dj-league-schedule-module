
!(function($){

// next game date counter
window.onload=function() {
	
	$('.dj-date-counter').each(function(){
		
		var counter = $(this);
		counter.data();
		var future_date = new Date(counter.data('time'));
		
		if(!future_date.isValid()) {
			var dateStr = counter.data('time');
			var game = dateStr.split(' ');
			var date = game[0].split('-');
			var time = game[1].split(':');
			future_date = new Date(date[0],(date[1]-1),date[2],time[0],time[1],time[2]);
		}
		
		if(future_date.isValid()) setInterval(function(){
			
			var current_date = new Date();
			var difference = (future_date - current_date);
			
			var days=Math.floor(difference/(60*60*1000*24)*1);
			var hours=Math.floor((difference%(60*60*1000*24))/(60*60*1000)*1);
			var mins=Math.floor(((difference%(60*60*1000*24))%(60*60*1000))/(60*1000)*1);
			var secs=Math.floor((((difference%(60*60*1000*24))%(60*60*1000))%(60*1000))/1000*1);
			
			if (days<10 && days>=0) { days='0'+days; }
			if (hours<10 && hours>=0) { hours='0'+hours; }
			if (mins<10 && mins>=0) { mins='0'+mins; }
			if (secs<10 && secs>=0) { secs='0'+secs; }
			
			if (days<0) { days='0'+'0'; }
			if (hours<0) { hours='0'+'0'; }
			if (mins<0) { mins='0'+'0'; }
			if (secs<0) { secs='0'+'0'; }
			
			counter.find('.days').text(days);
			counter.find('.hours').text(hours);
			counter.find('.mins').text(mins);
			counter.find('.secs').text(secs);
			
		}, 1000);
		
	});
};

}(jQuery));