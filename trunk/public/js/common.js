/**
 * 公共函数
 * @author kevin email:kevin177703@gmail.com
 * @version 0.0.1
 */
//判断是否为空
function isEmptyVal(B) {
    switch (typeof B) {
        case "undefined":
            return true;
        case "string":
            if (B.replace(/(^[ \t\n\r]*)|([ \t\n\r]*$)/g, "").length == 0) {
                return true
            }
            break;
        case "boolean":
            if (!B) {
                return true
            }
            break;
        case "number":
            if (isNaN(B)) {
                return true
            }
            break;
        case "object":
            if (null === B || B.length === 0) {
                return true
            }
            for (var A in B) {
                return false
            }
            return true
    }
    return false
}
//打开新窗口
function openWindow(B, E, A) {
    var C;
    if (window.screen.width == 800 && window.screen.height == 600) {
        C = "yes"
    } else {
        C = "no"
    }
    var D = "height=" + A + ", width=" + E + ", scrollbars= " + C + ",resizable=yes,toolbar=no,directories=no,menubar=no,locationbar=no,personalbar=no,statusbar=no";
    window.open(B, "_blank", D)
}
function showloading() {
    $.blockUI({message: '<p class="preload"><img src="/public/images/loading3.gif" /> waiting...</p>',css: {border: "none",padding: "15px",backgroundColor: "#000","-webkit-border-radius": "10px","-moz-border-radius": "10px",opacity: 0.8,color: "#fff"},fadeIn: 700,fadeOut: 700})
}
function msg_box_show(E, B, A, F, D) {
    var C;
    if (isEmptyVal(B) || B < 0) {
        B = 5
    }
    if (isEmptyVal(A)) {
        A = ""
    }
    if (isEmptyVal(F)) {
        F = "succeed"
    }
    if (isEmptyVal(D)) {
        D = ""
    }
    $.dialog({id: "KDf4315",lock: true,background: "#5F5C5C",opacity: 0.8,icon: F,content: E,init: function() {
            var H = this, G = B;
            var I = function() {
                H.title(G + "秒后关闭");
                !G && H.close();
                G--
            };
            C = setInterval(I, 1000);
            I()
        },close: function() {
            clearInterval(C);
            if (A !== "") {
                top.location.href = A
            }
            if (D !== "") {
                $("#" + D).focus()
            }
        }}).show()
}
var editIndex = undefined;
function endEditing(){
	if (editIndex == undefined){return true}
	if ($('#dg').datagrid('validateRow', editIndex)){
		$('#dg').datagrid('endEdit', editIndex);
		editIndex = undefined;
		return true;
	} else {
		return false;
	}
}
function onClickRow(index){
	if (editIndex != index){
		if (endEditing()){
			$('#dg').datagrid('selectRow', index)
					.datagrid('beginEdit', index);
			editIndex = index;
		} else {
			$('#dg').datagrid('selectRow', editIndex);
		}
	}
}
function deleteRow(){
	$('#dg').datagrid('cancelEdit', editIndex)
	.datagrid('deleteRow', editIndex);
	editIndex = undefined;
}
function message(msg,type){
	if(type=='error'){
		$.messager.alert('info',msg,'error');
	}else if(type=='info'){
		$.messager.alert('info',msg,'info');
	}else if(type=='question'){
		$.messager.alert('info',msg,'question');
	}else if(type=='warning'){
		$.messager.alert('info',msg,'warning');
	}else{
		$.messager.alert('info',msg);
	}
}
function wait_open(){
	$.messager.progress({
		title:'waitting..',
		msg:'waitting..'
	});
}
function wait_close(){
	$.messager.progress('close');
}
function ajax_post(url,data,rurl){
	$.ajax({   
        type: "POST",   
        url: url,   
        data: data, 
        //contentType: false,
        //processData: false,
        dataType:'json',
        beforeSend:function(){
        	wait_open();
        },		    
        complete: function() {   
        	wait_close();
        },   
        success: function(data){
			if(data.result == true){	
			    msg_box_show(data.msg,1,rurl,'succeed');
			}else {
			    msg_box_show(data.msg,2,'','error','');
		    }               
        }   
	});
}
