/*
Javascript controls for the editor:

Activity list: stores id's (or maybe names?) for all the activities currently on the page.
UX: 
	*ACTIVITIES GET ADDED ON THE SERVER SIDE*
	USER	->	add activity named "squat"
	JS		->	AJAX call to get form for "squat"
	SERVER	->	response text contains form for given activity.
	JS		->	save form in associative array
			->	actually display user's request.
	____________________________________________
	*SETS GET ADDED ON THE CLIENT SIDE*
	USER	->	add set within activity "squat";
	JS		->	look up activity "squat" in activity list.
			->	display form in appropriate place.

			
1.	delete-set objects:
2.	delete-activity objects
3.	
*/
$(document).ready(function() {

	//	*handle delete-XXXXX objects*	//
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

	//	*handle add-set objects*	//
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
			
