/*
Javascript controls for the editor:

1. All trashcans:	trashcan.hover(highlight element to be deleted)
					trashcan.click(delete element)
					
2. All pluses:		plus.click(insert new element to desired container)

3. Save button:		either compile form into javascript object, which then sends request to server or
					w/e just do it.
*/
$(document).ready(function() {

	//TRASH CAN HOVER EFFECTS.
	$(".workoutTitle>.trashcan").mouseover(function(){$(this).parent().parent().addClass("readyToDie");})
	$(".workoutTitle>.trashcan").mouseout(function(){$(this).parent().parent().removeClass("readyToDie");})
	
	$(".set .trashcan").mouseover(function(){$(this).parent().addClass("readyToDie");})
	$(".set .trashcan").mouseout(function(){$(this).parent().removeClass("readyToDie");})
	
	$(".activityTitle>.trashcan").mouseover(function(){$(this).parent().parent().addClass("readyToDie");})
	$(".activityTitle>.trashcan").mouseout(function(){$(this).parent().parent().removeClass("readyToDie");})
	
	
	//TRASH CAN CLICK EFFECTS.
	$(".workoutTitle>.trashcan").click(
		function(){
			$(this).parent().parent().hide(function(){
			$(this).remove();});})
	
	$(".set .trashcan").click(
		function(){
			s = $(this).parent();
			console.log(activityDataToURL(s))
			s.hide(function(){
				this.remove();});
				})
	
	$(".activityTitle>.trashcan").click(
		function(){
			a = $(this).parent().parent()
			console.log(activityToURL(a))
			a.hide('120',function(){this.remove();});})

	//PLUS CLICK EFFECTS.
	$(".activityTitle>.plus").click(
		function(){
			x = $(this).parent().parent()
			s = x.children().last().clone(true)
			s.find(".data-id").text("no-id")
			s.appendTo(x);})

	$(".save").click(function(){
		console.log(workoutToURL())
		})
		
	
			
})
			
			
	function workoutToURL() {
	
		w = $(".workout");
		workoutArray= new Array();
		title = w.find(".title").val();
		date = w.find("date").val();
		
		workoutArray[0] = date;
		workoutArray[1] = title;
		
		w.find(".activity").each(
			function(){
				workoutArray[2].push(activityToURL($(this)))
				})
				
		url="";
		for(i=0;i<workoutArray.length;i++){
			str = ["w[",i,"]="].join();
			if (!(workoutArray[i] instanceof Array)){
				url=url.concat(str).concat(w[i]).concat("&");
				continue;
			}
			for(j=0;j<workoutArray[i].length,j++){
				str.concat('[').concat(j).concat(']=');
				if (!(workoutArray[i][j] instanceof Array)){
					url=url.concat(str).concat(w[i][j]).concat("&");
					continue;
				}
				for(k=0;k<workoutArray[i][j].length,k++){
					str.concat("[").concat(k).concat("]=");
					if (!(workoutArray[i][j][k] instanceof Array)){
						url=url.concat(str).concat(w[i][j]).concat("&");
						continue;
					}
					for(l=0;l<workoutArray[i][j][k].length,l++){
						str.concat("[").concat(l).concat("]=").concat(w[i][j]).concat("&");
					}							
				}
			}
		}
		return url
	}
	
	//a is a jQuery object.
	//No clue where else to write this:
	//WHEN WE START ADDING ACTIVITIES, WE NEED TO MAKE SURE .activity-id gets set properly
	function activityToURL(a){
		activityArray = new Array();
		activityArray[0] = a.find(".activity-id").text();
		activityArray[1] = new Array()
		
		a.find('.set').each(
			function(){
				activityArray[1].push(activityDataToURL($(this)))
				})
		return activityArray;
	}
	
	
	//Returns an array in self-explanatory order. Select implies unit selector.
	function activityDataToURL(s){
	
		var dataArray = new Array();
		dataArray[0] = s.find(".data-id").text();
		dataArray[1] = s.find('.setInput').val();
		dataArray[2] = s.find(".repInput").val()		
		dataArray[3] = s.find(".distInput").val()
		dataArray[4] = s.find(".distSelect").val()
		dataArray[5] = s.find(".timeInput").val()
		dataArray[6] = s.find(".timeSelect").val()
		dataArray[7] = s.find(".weightInput").val()
		dataArray[8] = s.find(".weightSelect").val()
		
		return dataArray
	}
	
	
	
	
	
	
	
	
	
	
		
		

	