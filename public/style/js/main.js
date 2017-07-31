
$(document).ready(function($) {

	$('.alert').delay(3000).slideUp();

	// var link = 'http://192.168.56.56/project/';

	/**
	 * delete wallets
	 */
	$('.delete').click(function(){

		var id = $(this).attr('id');
		var name = $(this).attr('name');
		
		if(!confirm('You confirm the deletion '+name+'?'))
		{
			return false;
		}
		
		$.ajax({
				url:link+'wallets/getDelete/'+id, 
				type:'get',
				async:true,
		 		dataType:'text',
				data :{'id': id},
				success: function(data)
				{
					
					$('tr.row_'+id).fadeOut();
					
				}

			});
		
	});

	var linkEdit = link+'wallets/getEdit/';

	/**
	 * Search for data wallets by name and amount
	 * Call to function  keySearch in WalletsController.php 
	 */

	$('#search').keyup(function(){

		var key = $(this).val();
		
		$.ajax({
				url:link+'wallets/keySearch/'+key, 
				type:'get',
				async:true,
		 		dataType:'json',
				data :{'key': key},
				success: function(data)
				{
					
					var html = '';
					var stt = 0;
					$.each (data, function (key, wallets){

						stt = stt +1;
						html += '<tr class="row_' +wallets['id']+' select" >';
						html += '<td class="sorting_1"><input type="checkbox" name=""> </td>';
						html += '<td>'+stt+'</td>';
						html += '<td>'+wallets['name']+'</td>';
						html += '<td><input type="color" name="" value="'+wallets['color']+'"></td>';
						html += '<td>'+wallets['amount']+'</td>';
						html += '<td>'+wallets['created_at']+'</td>';
						html += '<td>'+wallets['updated_at']+'</td>';
						html += '<td>';
						html += '<a href="'+linkEdit+wallets['id']+'"  title="Edit" class=""><i class="fa fa-fw fa-edit"></i></a>';
						html += '<a   title="Delete" class="delete" id="'+wallets['id']+'"><i onclick=" return confirmDelete("You confirm the deletion")" class="fa fa-fw fa-trash-o"></i></a>'
         				html += '</td>'
						html += '</tr>';
					});

					$('#tbody-wallets').html(html); 
				}

			});
		
	});

	/**
	 * Number of products per page
	 */
	$('#number-list-wallets').change(function(){

			var num = $('#number-list-wallets').find(":selected").val();

			 $.ajax({
			 	url:link+'wallets/getList',
			 	type:'get',
			 	async:true,
			 	dataType:'json',
			 	data:{'num':num },
			 	success:function(data)
			 	{
			 		var html = '';
					var stt = 0;
					$.each (data, function (key, wallets){

						stt = stt +1;
						html += '<tr class="row_'+wallets['id']+' select" >';
						html += '<td class="sorting_1"><input type="checkbox" name=""> </td>';
						html += '<td>'+stt+'</td>';
						html += '<td>'+wallets['name']+'</td>';
						html += '<td><input type="color" name="" value="'+wallets['color']+'"></td>';
						html += '<td>'+wallets['amount']+'</td>';
						html += '<td>'+wallets['created_at']+'</td>';
						html += '<td>'+wallets['updated_at']+'</td>';
						html += '<td>';
						html += '<a href="'+linkEdit+wallets['id']+'"  title="Edit" class=""><i class="fa fa-fw fa-edit"></i></a>';
						html += '<a   title="Delete" class="delete" id="'+wallets['id']+'"><i onclick=" return confirmDelete("You confirm the deletion")" class="fa fa-fw fa-trash-o"></i></a>'
         				html += '</td>'
						html += '</tr>';
					});

					$('#tbody-wallets').html(html); 
				}
			 	
			 });
		});

	/**  * Check all  * @return {[type]} [description]  */ 
	$('.checkall').click(function() {     
			var checked = $(this).prop('checked');     
			$('.select').find('input:checkbox').prop('checked', checked);   
		}); 



	// delete all category 
		var $list_action 	= $('.delete-all-wallets');
		$list_action.find('#submit').click(function(){ //tim toi the co id = submit,su kien click
			if(!confirm('You definitely want to delete all your data ?'))
			{
				return false;
			}

			var ids = new Array();
			$('[name="id[]"]:checked').each(function()
			{
				ids.push($(this).val());
			});

			console.log(ids);


			if (!ids.length) return false;

			var url  = $(this).attr('url');
			console.log(url);
			$.ajax({
				url:link+'wallets/getDeleteAll',
				type: 'get',
				async:true,
			 	dataType:'text',
				data : {'ids': ids},
				success: function(data)
				{
					
					$(ids).each(function(id, val)
					{
						//console.log(val);
						$('tr.row_'+val).fadeOut();
					});
				}

			})
			return false;
		});

	

    $(".Choicefile").bind('click', function  () { 
    $("#uploadfile").click();
               
   });
   $(".removeimg").click(function () {
      $("#thumbimage").attr('src', '').hide();
      $("#myfileupload").html('<input type="file" id="uploadfile"  onchange="readURL(this);" />');
      $(".removeimg").hide();
      $(".Choicefile").bind('click', function  () {
       $("#uploadfile").click();
      });
      $('.Choicefile').css('background','#0877D8');
      $('.Choicefile').css('cursor', 'pointer');
      $(".filename").text("");
    });

   /**
    * show amount transfer wallet 
    */

   $('#transfer-wallet').change(function(){
		
		var id = $('#transfer-wallet').find(":selected").val();
		console.log(id);
		$.ajax({
				url:link+'wallets/getAmountTransfers/'+id, 
				type:'get',
				async:true,
		 		dataType:'text',
				data :{'id': id},
				success: function(data)
				{
					$('#transfer-wallets').val(data);
				}

			});
		
	});

   /**
    * show amount receive-wallet
    */

   $('#receive-wallet').change(function(){
		
		var id = $('#receive-wallet').find(":selected").val();
		console.log(id);
		$.ajax({
				url:link+'wallets/getAmountTransfers/'+id, 
				type:'get',
				async:true,
		 		dataType:'text',
				data :{'id': id},
				success: function(data)
				{
					$('#receive-wallets').val(data);
				}

			});
		
	});
   // hide input Image preview...
   $('.showimg').hide();

   // show input Image preview...
   $('#uploadfile').click(function(){
   		$('.showimg').show();
   });

   // format data input number
    $('#exampleInputAmount').keyup(function(){
        var val = $(this).val();        
        val = val.replace(/,/igm, '');        
        val = val.split('').reverse().join('');        
        val = val.replace(/(\d{3})/ig, "$1 ").trim().split('').reverse().join('').replace(/\s/igm, ',');        
        $(this).val(val);
    });

    $('#exampleInputAmount').onfocus(function(){
        var val = $(this).val();        
        val = val.replace(/,/igm, '');        
        val = val.split('').reverse().join('');        
        val = val.replace(/(\d{3})/ig, "$1 ").trim().split('').reverse().join('').replace(/\s/igm, ',');        
        $(this).val(val);
    });

    
    $('body').on('click', '#btn-submit', function () {        
    	var total=$('#exampleInputAmount').val().replace(/,/igm,'');        
    	$('#exampleInputAmount').val(total);        
    	$('#form-add').submit();    
    });
    




});
/**
 * show img 
 *
 * @param      {<type>}  input       The input
 * @param      {<type>}  thumbimage  The thumbimage
 */
function  readURL(input,thumbimage) {
   if  (input.files && input.files[0]) { 
   var  reader = new FileReader();
    reader.onload = function (e) {
    $("#thumbimage").attr('src', e.target.result);
     }
     reader.readAsDataURL(input.files[0]);
    }
    else  { // Sử dụng cho IE
      $("#thumbimage").attr('src', input.value);
  
    }
    $("#thumbimage").show();
    $('.filename').text($("#uploadfile").val());
    $('.Choicefile').css('background', '#C4C4C4');
    $('.Choicefile').css('cursor', 'default');
    $(".removeimg").show();
    $(".Choicefile").unbind('click'); 
          
  }



// Confirm Delete
	function confirmDelete(msg){

		if(window.confirm(msg)){
			return true;
		}
		else{
			return false;
		}
	}