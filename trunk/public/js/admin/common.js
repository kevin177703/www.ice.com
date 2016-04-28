/**
 * 后台js
 */
function undo_ajax(){
	var uid = $("#uid_undo").val();
	var money = $("#money").val();
	var note = $("#note").val();
	if(isEmptyVal(money)){
		message('请填写金额','warning');
		return false;
	}
	if(isEmptyVal(note)){
		message('请填写说明','warning');
		return false;
	}
	$.ajax({   
        type: 'POST', 
        url: '/admin/ajax/undo.html',   
        data: {uid:uid,money:money,note:note},
        dataType:'json',
        beforeSend:function(){
        	wait_open();
        },		    
        complete: function() {   
        	wait_close();
        },  
        success: function(data){
        	if(data.result==true){
        		message('冲正负成功','info');
        		$('#dlg_undo').dialog('close');
        		$('#dg').datagrid('reload');
			}else {
			    message(data.msg,'warning');
		    }               
        }   
	});
}
