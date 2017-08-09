
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
					if(data !='error'){

						$('tr.row_'+id).fadeOut();
						window.location.href = link +'wallets/getList';
					}else{
						alert('Can not delete !!! You need to delete the previous wallets transaction')
					}
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
						html += '<td>'+stt+'</td>';
						html += '<td>'+wallets['name']+'</td>';
						html += '<td><input type="color" name="" value="'+wallets['color']+'"></td>';
						html += '<td>'+wallets['amount']+'</td>';
						html += '<td>'+wallets['format_time']+'</td>';
						// html += '<td>'+wallets['updated_at']+'</td>';
						html += '<td>';
						html += '<a href="'+linkEdit+wallets['id']+'"  title="Edit" class=""><i class="fa fa-fw fa-edit"></i></a>';
						html += '<a   title="Delete" class="delete" id="'+wallets['id']+'"><i class="fa fa-fw fa-trash-o"></i></a>'
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

			$('#example1_paginate').hide();

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
						html += '<td>'+stt+'</td>';
						html += '<td>'+wallets['name']+'</td>';
						html += '<td><input type="color" name="" value="'+wallets['color']+'"></td>';
						html += '<td>'+wallets['amount']+'</td>';
						html += '<td>'+wallets['format_time']+'</td>';
						// html += '<td>'+wallets['updated_at']+'</td>';
						html += '<td>';
						html += '<a href="'+linkEdit+wallets['id']+'"  title="Edit" class=""><i class="fa fa-fw fa-edit"></i></a>';
						html += '<a   title="Delete" class="delete" id="'+wallets['id']+'"><i onclick=" return confirmDelete("You confirm the deletion")" class="fa fa-fw fa-trash-o"></i></a>';
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
		results  = '#transfer-wallets';
		$.ajax({
				url:link+'wallets/getAmountTransfers/'+id,
				type:'get',
				async:true,
		 		dataType:'text',
				data :{'id': id},
				success: function(data)
				{
					$(results).val(data);
					formatNumber(results);

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
					formatNumber('#receive-wallets');

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

        formatNumber('#exampleInputAmount');
    });

    $('#exampleInputAmount').focus(function(){

        formatNumber('#exampleInputAmount');
    });

    $('#exampleInputAmount').mousemove(function(){

        formatNumber('#exampleInputAmount');
    });

    /**
     * function formart number
     *
     * @param      {<type>}  results  The results
     */

    function formatNumber(results){
    	var val = $(results).val();
    	        val = val.replace(/,/igm, '');
    	        val = val.split('').reverse().join('');
        val = val.replace(/(\d{3})/ig, "$1 ").trim().split('').reverse().join('').replace(/\s/igm, ',');
        $(results).val(val);
    }

    $('body').on('click', '#btn-submit', function () {
    	var total=$('#exampleInputAmount').val().replace(/,/igm,'');
    	$('#exampleInputAmount').val(total);
    	$('#form-add').submit();
    });


    //Transaction
    //
    /**
	 * delete Transaction
	 */
	$('.delete-transfers').click(function(){

		var id = $(this).attr('id');
		if(!confirm('You confirm the deletion '+name+'?'))
		{
			return false;
		}
		$.ajax({
				url:link+'wallets/getDeleteTransfers/'+id,
				type:'get',
				async:true,
		 		dataType:'text',
				data :{'id': id},
				success: function(data)
				{
					console.log(data);
					$('tr.row_'+id).fadeOut();
				}

			});
	});
	/*
	 * search
	 */
	var linkEditTransfers = link+'wallets/getEditTransfers/';
	$('#search-transfers').keyup(function(){

		var key = $(this).val();
		console.log(key);
		$.ajax({
				url:link+'wallets/keySearchTransfers/'+key,
				type:'get',
				async:true,
		 		dataType:'json',
				data :{'key': key},
				success: function(data)
				{
					var html = '';
					var stt = 0;
					$.each (data, function (key, transfersMoney){

						stt = stt +1;
						html += '<tr class="row_' +transfersMoney['id']+' select" >';
						html += '<td class="sorting_1"><input type="checkbox" name="id[]"> </td>';
						html += '<td>'+stt+'</td>';
						html += '<td>'+transfersMoney['name_transfer_wallet']+'</td>';
						html += '<td>'+transfersMoney['name_receive_wallet']+'</td>';
						html += '<td>'+transfersMoney['amount']+'</td>';
						html += '<td>'+transfersMoney['created_at']+'</td>';
						// html += '<td>'+transfersMoney['updated_at']+'</td>';
						html += '<td>';
						html += '<a href="'+linkEditTransfers+transfersMoney['id']+'"  title="Edit" class=""><i class="fa fa-fw fa-edit"></i></a>';
						html += '<a   title="Delete" class="delete-transaction" id="'+transfersMoney['id']+'"><i class="fa fa-fw fa-trash-o"></i></a>'
         				html += '</td>'
						html += '</tr>';
					});

					$('#tbody-wallets').html(html);
				}

			});
	});

	// Category
	//
	$('.delete-categorys').click(function(){

		var id = $(this).attr('id');
		if(!confirm('You confirm the deletion '+name+'?'))
		{
			return false;
		}
		$.ajax({
				url:link+'categorys/getDelete/'+id,
				type:'get',
				async:true,
		 		dataType:'text',
				data :{'id': id},
				success: function(data)
				{
					console.log(data);
					if(data != 'error'){

						$('tr.row_'+id).fadeOut();

					}else if(data == 'error-transaction'){
						alert('Can not delete !!! You need to delete the previous category transaction.')
					}else{
						alert('Can not delete !!! You need to delete the subcategories first.')
					}
				}

			});
	});

	var linkEdit = link +'categorys/getEdit/';
	var linkAdd  = link + 'categorys/getAddSubcategories/';
	/**
	 * Number of products per page
	 */
	$('#number-list-category').change(function(){

			var num = $('#number-list-category').find(":selected").val();

			$('#example1_paginate').hide();

			$.ajax({
			 	url:link+'categorys/getList',
			 	type:'get',
			 	async:true,
			 	dataType:'json',
			 	data:{'num':num },
			 	success:function(data)
			 	{
			 		console.log(data);
			 		var html = '';
					var stt = 0;
					$.each (data, function (key,category){

						stt = stt +1;
						html += '<tr class="row_'+category['id']+' select" >';
						html += '<td>'+stt+'</td>';
						html += '<td>'+category['name']+'</td>';

						if(category['type'] == 1){
							html += '<td>Receipt</td>';
						}else if(category['type'] == 2){
							html +='<td>Credit transfer</td>';
						}

						html += '<td>'+category['nameParent']+'</td>';
						html += '<td>'+category['format_time']+'</td>';
						// html += '<td>'+category['updated_at']+'</td>';
						html += '<td>';
						if(category['parent_id'] == 0){
							html += '<a href="'+linkAdd +category['id']+'" class="btn btn-primary text-center">Add</a>'
						}
						html += '</td>';
						html += '<td>';
						html += '<a href="'+linkEdit+category['id']+'"  title="Edit" class=""><i class="fa fa-fw fa-edit"></i></a>';
						html += '<a   title="Delete" class="delete-categorys" id="'+category['id']+'"><i class="fa fa-fw fa-trash-o"></i></a>'
         				html += '</td>'
						html += '</tr>';
					});

					$('#tbody-wallets').html(html);
				}
			 });
		});


	//transaction
	$('.delete-transaction').click(function(){

		var id = $(this).attr('id');
		if(!confirm('You confirm the deletion ?'))
		{
			return false;
		}
		$.ajax({
				url:link+'transection/getDelete/'+id,
				type:'get',
				async:true,
		 		dataType:'text',
				data :{'id': id},
				success: function(data)
				{
					if(data != 'error'){

						$('tr.row_'+id).fadeOut();
						window.location.href = link +'transection/getList';

					}else{
						alert('Can not delete !!! You need to delete the subcategories first.')
					}
				}

			});
	});


	var linkEdit = link +'transection/getEdit/';
	/**
	 * Number of products per page
	 */
	$('#number-list-transaction').change(function(){

			var num = $('#number-list-transaction').find(":selected").val();

			$('#example1_paginate').hide();


			$.ajax({
			 	url:link+'transection/getList',
			 	type:'get',
			 	async:true,
			 	dataType:'json',
			 	data:{'num':num },
			 	success:function(data)
			 	{
			 		console.log(data);
			 		var html = '';
					var stt = 0;
					$.each (data, function (key,transaction){

						stt = stt +1;
						html += '<tr class="row_'+transaction['id']+' select" >';
						html += '<td>'+stt+'</td>';
						html += '<td>'+transaction['nameWallets']+'</td>';
						html += '<td>'+transaction['nameCategory']+'</td>';
						html += '<td style ="';
								if(transaction['nameType'] == 1){
									html += 'color : red;';
								}else if(transaction['nameType'] == 2){
									html += 'color : #31e915;';
								}
						html += '">';

						if(transaction['nameType'] == 1){
									html += '-';
								}else if(transaction['nameType'] == 2){
									html += '+';
								}

						html += transaction['amount']+'</td>';
						html += '<td>'+transaction['describe']+'</td>';
						html += '<td>'+transaction['format_time']+'</td>';
						// html += '<td>'+transaction['updated_at']+'</td>';
						html += '<td>';
						html += '<a href="'+linkEdit+transaction['id']+'"  title="Edit" class=""><i class="fa fa-fw fa-edit"></i></a>';
						html += '<a   title="Delete" class="delete-transaction" id="'+transaction['id']+'"><i class="fa fa-fw fa-trash-o"></i></a>'
         				html += '</td>'
						html += '</tr>';
					});

					$('#tbody-wallets').html(html);
					$('tr#total').show();
				}
			 });
		});


	$('#type-transaction').change(function(){

		var type = $('#type-transaction').find(":selected").val();
		console.log(type);
		$.ajax({
		 	url:link+'transection/getCategorys',
		 	type:'get',
		 	async:true,
		 	dataType:'json',
		 	data:{'type':type },
		 	success:function(data)
		 	{
		 		console.log(data);
		 		var html = '';
				$.each (data, function (key,category){

					html += '<option  value="'+category['id']+'">'+category['name']+'</option>';
				});

				$('#type-category').html(html);
			}
		 });
	});


	$('li.treeview').click(function(){
		 $(this).addClass("active");

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