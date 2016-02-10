<?php

$masT['start'] = "
    <ol class='dd-list'>
         ";
$masT['end'] = "
    </ol>
         ";

$masT['start1'] = "
    <ol class='dd-list'>
         ";
$masT['end1'] = "
    </ol>
         ";

function first($mas) {
    return "
    <div class='dd-handle demo-icon  dd3-handle dd-nodrag dd-nodrag1 btn btn-social-icon'><i class='fa fa-arrows-alt'></i></div>
    <div class='dd4-handle demo-icon  dd-nodrag1 btn btn-social-icon'><i class='fa fa-plus'></i></div>
    <div class='dd3-content dd-nodrag1'>{$mas['Title']}</div>
";
}

;

function norm($mas) {
    return "
    <div class='dd-handle demo-icon dd3-handle dd-nodrag1 btn btn-social-icon'><i class='fa fa-arrows-alt'></i></div>
    <div class='dd5-handle  demo-icon dd-nodrag1 btn btn-social-icon'><i class='fa fa-close'></i></div>
    <div class='dd4-handle demo-icon dd-nodrag1 btn btn-social-icon'><i class='fa fa-plus'></i></div>
    <div class='dd3-content dd-nodrag1'>
		<div class='grup'>
			<div class='colum2 col50'>
				<label>
					Название
				</label>
				<input class='inp nam' type='text' name='Title[]' value='{$mas['Title']}'>
			</div>
			<div class='colum2 col50'>
				<label>
					Сылка
				</label>
			   <input class='inp nam' type='text' name='Link[]' value='{$mas['Link']}'>
			</div>
		</div>
        <input type='hidden' name='Parent_id[]' value='{$mas['Parent_id']}'>
        <input type='hidden' name='id[]' value='{$mas['id']}'>
    </div>
";
}

function last($mas) {
    return "
        <div class='dd-handle demo-icon dd3-handle dd-nodrag1 btn btn-social-icon'><i class='fa fa-arrows-alt'></i></div> 
        <div class='dd5-handle demo-icon dd-nodrag1 btn btn-social-icon'><i class='fa fa-close'></i></div>
        <div class='dd3-content dd-nodrag1 max'>
            		<div class='grup'>
			<div class='colum2 col50'>
				<label>
					Название
				</label>
				<input class='inp nam' type='text' name='Title[]' value='{$mas['Title']}'>
			</div>
			<div class='colum2 col50'>
				<label>
					Сылка
				</label>
			   <input class='inp nam' type='text' name='Link[]' value='{$mas['Link']}'>
			</div>
		</div>
            <input type='hidden' name='Parent_id[]' value='{$mas['Parent_id']}'>
            <input type='hidden' name='id[]' value='{$mas['id']}'>
        </div>
";
}

function jsPast() {
    return "
        function getNewEl(mas){
        return  \"<div class='dd-handle demo-icon dd3-handle dd-nodrag1 btn btn-social-icon'><i class='fa fa-arrows-alt'></i></div>\"+
        \"<div class='dd5-handle demo-icon dd-nodrag1 btn btn-social-icon'><i class='fa fa-close'></i></div>\"+
        \"<div class='dd3-content dd-nodrag1 max'>\"+
            		\"<div class='grup'>\"+
			\"<div class='colum2 col50'>\"+
				\"<label>\"+
					\"Название\"+
				\"</label>\"+
				\"<input class='inp nam' type='text' name='Title[]' value=''>\"+
			\"</div>\"+
			\"<div class='colum2 col50'>\"+
				\"<label>\"+
					\"Сылка\"+
				\"</label>\"+
			   \"<input class='inp nam' type='text' name='Link[]' value=''>\"+
			\"</div>\"+
		\"</div>\"+
            \"<input type='hidden' name='Parent_id[]' value='\"+mas.Parent_id+\"'>\"+
            \"<input type='hidden' name='id[]' value=''>\"+
        \"</div>\";
        }
";
}


