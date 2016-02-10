<?php

$masT['start']="
    <ol class='dd-list'>
         ";
$masT['end']="
    </ol>
         ";

$masT['start1']="
    <ol class='dd-list'>
         ";
$masT['end1']="
    </ol>
         ";

$masT['first']="
    <div class='dd-handle demo-icon  dd3-handle dd-nodrag dd-nodrag1'>&#xe869;</div>
    <div class='dd4-handle demo-icon  dd-nodrag1'>&#xe9f6;</div>
    <div class='dd3-content dd-nodrag1'><%Title%></div>
";

$masT['norm']="
    <div class='dd-handle demo-icon dd3-handle dd-nodrag1'>&#xe869;</div>
    <div class='dd5-handle demo-icon dd-nodrag1'>&#xea1c;</div>
    <div class='dd4-handle demo-icon dd-nodrag1'>&#xe9f6;</div>
    <div class='dd3-content dd-nodrag1'>
        <div class='grup'>
            <div class='colum2 col50'>
                <label>
                    Название
                </label>
                <input class='inp nam' type='text' name='Title[]' value='<%Title%>'>
            </div>
            <div class='colum2 col50'>
                <label>
                    Сылка
                </label>
               <input class='inp nam' type='text' name='Link[]' value='<%Link%>'>
            </div>
        </div>
        <input type='hidden' name='parent_id[]' value='<%parent_id%>'>
        <input type='hidden' name='id[]' value='<%id%>'>
    </div>
";

$masT['last']="
        <div class='dd-handle demo-icon dd3-handle dd-nodrag1'>&#xe869;</div>
        <div class='dd5-handle demo-icon dd-nodrag1'>&#xea1c;</div>
        <div class='dd3-content dd-nodrag1 max'>
            <div class='grup'>
                <div class='colum2 col50'>
                    <label>
                        Название
                    </label>
                    <input class='inp nam' type='text' name='Title[]' value='<%Title%>'>
                </div>
                <div class='colum2 col50'>
                    <label>
                        Сылка
                    </label>
                   <input class='inp nam' type='text' name='Link[]' value='<%Link%>'>
                </div>
            </div>
            <input type='hidden' name='parent_id[]' value='<%parent_id%>'>
            <input type='hidden' name='id[]' value='<%id%>'>
        </div>
";

