<?php

$masT['start'] = "
    <ol class='dd-list'>
         ";
$masT['end'] = "
    </ol>
         ";

function first($mas) {
    return "
    <div class='input-group'>
        <span class='input-group-addon plus'><i class='fa fa-plus'></i></span>
        {$mas['Title']}
    </div>
";
}

;

function norm($mas) {
    return "
        <div class='input-group'>
            <span class='input-group-addon dd3-handle'><i class='fa fa-arrows-alt'></i></span>
            <span class='input-group-addon' title='создать страницу'><input name='Create[]' value='checked' {$mas['Create']} type='checkbox'></span>
            <span class='input-group-addon dell'><i class='fa fa-close'></i></span>
            <span class='input-group-addon plus'><i class='fa fa-plus'></i></span>
            <input class='form-control w50' name='Title[]' value='{$mas['Title']}' placeholder='имя' type='text'>
            <input class='form-control w50' name='Link[]' value='{$mas['Link']}' placeholder='Ссылка' type='text'>
            <input type='hidden' name='Parent_id[]' value='{$mas['Parent_id']}'>
            <input type='hidden' name='id[]' value='{$mas['id']}'>
        </div> 
        ";
}

function last($mas) {
    return "
        <div class='input-group'>
            <span class='input-group-addon dd3-handle'><i class='fa fa-arrows-alt'></i></span>
            <span class='input-group-addon' title='создать страницу'><input  name='Create[]' value='checked' {$mas['Create']} type='checkbox'></span>
            <span class='input-group-addon dell'><i class='fa fa-close'></i></span>
            <input class='form-control w50' name='Title[]' value='{$mas['Title']}' placeholder='имя' type='text'>
            <input class='form-control w50' name='Link[]' value='{$mas['Link']}' placeholder='Ссылка' type='text'>
            <input type='hidden' name='Parent_id[]' value='{$mas['Parent_id']}'>
            <input type='hidden' name='id[]' value='{$mas['id']}'>
        </div>  
";
}

function jsPast() {
    return "
        function getNewEl(mas){
        return  \"<div class='input-group'>\"+
            \"<span class='input-group-addon dd3-handle'><i class='fa fa-arrows-alt'></i></span>\"+
            \"<span class='input-group-addon' title='создать страницу'><input name='Create[]' value='checked' type='checkbox'></span>\"+
            \"<span class='input-group-addon dell'><i class='fa fa-close'></i></span>\"+
            \"<input class='form-control w50' name='Title[]' value='' placeholder='имя' type='text'>\"+
            \"<input class='form-control w50' name='Link[]' value='' placeholder='Ссылка' type='text'>\"+
            \"<input type='hidden' name='Parent_id[]' value='\"+mas.Parent_id+\"'>\"+
            \"<input type='hidden' name='id[]' value=''>\"+
        \"</div>\";
        }
";
}


