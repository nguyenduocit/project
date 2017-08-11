
$(document).ready(function($) {

	$('.alert').delay(3000).slideUp();

	// var link = 'http://192.168.56.56/project/';

	/**
	 * delete wallets
	 */
	$('.delete-wallets').click(function(){

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
						html += '<a   title="Delete" class="delete-wallets" id="'+wallets['id']+'"><i class="fa fa-fw fa-trash-o"></i></a>'
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

			var linkEdit = link+'wallets/getEdit/';

			var num = $('#number-list-wallets').find(":selected").val();
			var key = $(this).val();

			$('#example1_paginate').hide();

			$.ajax({
			 	url:link+'wallets/getList',
			 	type:'get',
			 	async:true,
			 	dataType:'json',
			 	data:{'num':num,'key':key},
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
						html += '<a title="Delete" class="delete-wallets" id="'+wallets['id']+'"><i class="fa fa-fw fa-trash-o"></i></a>';
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
					if(data != 'error' && data != 'error-transaction'){

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


	// Chart
	
	
	$('.select-wallets').change(function(){

		var year = $('#type-transaction').val();
		var wallets = $('#select-category').val();

		$.ajax({
		 	url:link+'chart',
		 	type:'get',
		 	async:true,
		 	dataType:'json',
		 	data:{'year':year,'wallets':wallets},
		 	success:function(datachart)
		 	{
		 		console.log('1'+datachart);
		 		//--------------
		            //- AREA CHART -
		            //--------------

		            // Get context with jQuery - using jQuery's .get() method.
		            var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
		            // This will get the first returned node in the jQuery collection.
		            var areaChart = new Chart(areaChartCanvas);

		            var areaChartData = {
		              labels: ["January", "February", "March", "April", "May", "June", "July" ,"August", "September" ,"October","November" ,"December"],
		              datasets: [
		                {
		                  label: "Electronics",
		                  fillColor: "rgba(210, 214, 222, 1)",
		                  strokeColor: "rgba(210, 214, 222, 1)",
		                  pointColor: "rgba(210, 214, 222, 1)",
		                  pointStrokeColor: "#c1c7d1",
		                  pointHighlightFill: "#fff",
		                  pointHighlightStroke: "rgba(220,220,220,1)",
		                  data: [

		                  	   datachart['resultExpenses'][0],datachart['resultExpenses'][1],datachart['resultExpenses'][2],
		                       datachart['resultExpenses'][3],datachart['resultExpenses'][4],datachart['resultExpenses'][5],
		                       datachart['resultExpenses'][6],datachart['resultExpenses'][7],datachart['resultExpenses'][8],
		                       datachart['resultExpenses'][9],datachart['resultExpenses'][10],datachart['resultExpenses'][11],


		                  ]
		                },
		                {
		                  label: "Digital Goods",
		                  fillColor: "rgba(60,141,188,0.9)",
		                  strokeColor: "rgba(60,141,188,0.8)",
		                  pointColor: "#3b8bba",
		                  pointStrokeColor: "rgba(60,141,188,1)",
		                  pointHighlightFill: "#fff",
		                  pointHighlightStroke: "rgba(60,141,188,1)",
		                  data: [
		                       
		                       datachart['resultIncom'][0],datachart['resultIncom'][1],datachart['resultIncom'][2],
		                       datachart['resultIncom'][3],datachart['resultIncom'][4],datachart['resultIncom'][5],
		                       datachart['resultIncom'][6],datachart['resultIncom'][7],datachart['resultIncom'][8],
		                       datachart['resultIncom'][9],datachart['resultIncom'][10],datachart['resultIncom'][11],
		                  	]
		                }
		              ]
		            };

		            var areaChartOptions = {
		              //Boolean - If we should show the scale at all
		              showScale: true,
		              //Boolean - Whether grid lines are shown across the chart
		              scaleShowGridLines: false,
		              //String - Colour of the grid lines
		              scaleGridLineColor: "rgba(0,0,0,.05)",
		              //Number - Width of the grid lines
		              scaleGridLineWidth: 1,
		              //Boolean - Whether to show horizontal lines (except X axis)
		              scaleShowHorizontalLines: true,
		              //Boolean - Whether to show vertical lines (except Y axis)
		              scaleShowVerticalLines: true,
		              //Boolean - Whether the line is curved between points
		              bezierCurve: true,
		              //Number - Tension of the bezier curve between points
		              bezierCurveTension: 0.3,
		              //Boolean - Whether to show a dot for each point
		              pointDot: false,
		              //Number - Radius of each point dot in pixels
		              pointDotRadius: 4,
		              //Number - Pixel width of point dot stroke
		              pointDotStrokeWidth: 1,
		              //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
		              pointHitDetectionRadius: 20,
		              //Boolean - Whether to show a stroke for datasets
		              datasetStroke: true,
		              //Number - Pixel width of dataset stroke
		              datasetStrokeWidth: 2,
		              //Boolean - Whether to fill the dataset with a color
		              datasetFill: true,
		              //String - A legend template
		              legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
		              //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
		              maintainAspectRatio: true,
		              //Boolean - whether to make the chart responsive to window resizing
		              responsive: true
		            };

		            //Create the line chart
		            areaChart.Line(areaChartData, areaChartOptions);

		            //-------------
		            //- LINE CHART -
		            //--------------
		            //var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
		            // var lineChart = new Chart(lineChartCanvas);
		            // var lineChartOptions = areaChartOptions;
		            // lineChartOptions.datasetFill = false;
		            // lineChart.Line(areaChartData, lineChartOptions);
		            // 
		            //-------------
		            //- BAR CHART -
		            //-------------
		            var barChartCanvas = $("#barChart").get(0).getContext("2d");
		            var barChart = new Chart(barChartCanvas);
		            var barChartData = areaChartData;
		            barChartData.datasets[1].fillColor = "#00a65a";
		            barChartData.datasets[1].strokeColor = "#00a65a";
		            barChartData.datasets[1].pointColor = "#00a65a";
		            var barChartOptions = {
		              //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
		              scaleBeginAtZero: true,
		              //Boolean - Whether grid lines are shown across the chart
		              scaleShowGridLines: true,
		              //String - Colour of the grid lines
		              scaleGridLineColor: "rgba(0,0,0,.05)",
		              //Number - Width of the grid lines
		              scaleGridLineWidth: 1,
		              //Boolean - Whether to show horizontal lines (except X axis)
		              scaleShowHorizontalLines: true,
		              //Boolean - Whether to show vertical lines (except Y axis)
		              scaleShowVerticalLines: true,
		              //Boolean - If there is a stroke on each bar
		              barShowStroke: true,
		              //Number - Pixel width of the bar stroke
		              barStrokeWidth: 2,
		              //Number - Spacing between each of the X value sets
		              barValueSpacing: 5,
		              //Number - Spacing between data sets within X values
		              barDatasetSpacing: 1,
		              //String - A legend template
		              legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
		              //Boolean - whether to make the chart responsive
		              responsive: true,
		              maintainAspectRatio: true
		            };

		            barChartOptions.datasetFill = false;
		            barChart.Bar(barChartData, barChartOptions);

		 		//endkjdfffffffffffffffffffffffffffffffffffffffffffffffffdhs
			}
		});
	});

	$('.select-year').change(function(){

		var year = $('#type-transaction').val();
		$.ajax({
		 	url:link+'chartyear',
		 	type:'get',
		 	async:true,
		 	dataType:'json',
		 	data:{'year':year},
		 	success:function(datachartYear)
		 	{
		 		console.log('2'+datachartYear);
		 		//--------------
		            //- AREA CHART -
		            //--------------

		            // Get context with jQuery - using jQuery's .get() method.
		            var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
		            // This will get the first returned node in the jQuery collection.
		            var areaChart = new Chart(areaChartCanvas);

		            var areaChartData = {
		              labels: ["January", "February", "March", "April", "May", "June", "July" ,"August", "September" ,"October","November" ,"December"],
		              datasets: [
		                {
		                  label: "Electronics",
		                  fillColor: "rgba(210, 214, 222, 1)",
		                  strokeColor: "rgba(210, 214, 222, 1)",
		                  pointColor: "rgba(210, 214, 222, 1)",
		                  pointStrokeColor: "#c1c7d1",
		                  pointHighlightFill: "#fff",
		                  pointHighlightStroke: "rgba(220,220,220,1)",
		                  data: [

		                  	   datachartYear['dataresultExpenses'][0],datachartYear['dataresultExpenses'][1],datachartYear['dataresultExpenses'][2],
		                       datachartYear['dataresultExpenses'][3],datachartYear['dataresultExpenses'][4],datachartYear['dataresultExpenses'][5],
		                       datachartYear['dataresultExpenses'][6],datachartYear['dataresultExpenses'][7],datachartYear['dataresultExpenses'][8],
		                       datachartYear['dataresultExpenses'][9],datachartYear['dataresultExpenses'][10],datachartYear['dataresultExpenses'][11],


		                  ]
		                },
		                {
		                  label: "Digital Goods",
		                  fillColor: "rgba(60,141,188,0.9)",
		                  strokeColor: "rgba(60,141,188,0.8)",
		                  pointColor: "#3b8bba",
		                  pointStrokeColor: "rgba(60,141,188,1)",
		                  pointHighlightFill: "#fff",
		                  pointHighlightStroke: "rgba(60,141,188,1)",
		                  data: [
		                       
		                       datachartYear['dataresultIncom'][0],datachartYear['dataresultIncom'][1],datachartYear['dataresultIncom'][2],
		                       datachartYear['dataresultIncom'][3],datachartYear['dataresultIncom'][4],datachartYear['dataresultIncom'][5],
		                       datachartYear['dataresultIncom'][6],datachartYear['dataresultIncom'][7],datachartYear['dataresultIncom'][8],
		                       datachartYear['dataresultIncom'][9],datachartYear['dataresultIncom'][10],datachartYear['dataresultIncom'][11],
		                  	]
		                }
		              ]
		            };

		            var areaChartOptions = {
		              //Boolean - If we should show the scale at all
		              showScale: true,
		              //Boolean - Whether grid lines are shown across the chart
		              scaleShowGridLines: false,
		              //String - Colour of the grid lines
		              scaleGridLineColor: "rgba(0,0,0,.05)",
		              //Number - Width of the grid lines
		              scaleGridLineWidth: 1,
		              //Boolean - Whether to show horizontal lines (except X axis)
		              scaleShowHorizontalLines: true,
		              //Boolean - Whether to show vertical lines (except Y axis)
		              scaleShowVerticalLines: true,
		              //Boolean - Whether the line is curved between points
		              bezierCurve: true,
		              //Number - Tension of the bezier curve between points
		              bezierCurveTension: 0.3,
		              //Boolean - Whether to show a dot for each point
		              pointDot: false,
		              //Number - Radius of each point dot in pixels
		              pointDotRadius: 4,
		              //Number - Pixel width of point dot stroke
		              pointDotStrokeWidth: 1,
		              //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
		              pointHitDetectionRadius: 20,
		              //Boolean - Whether to show a stroke for datasets
		              datasetStroke: true,
		              //Number - Pixel width of dataset stroke
		              datasetStrokeWidth: 2,
		              //Boolean - Whether to fill the dataset with a color
		              datasetFill: true,
		              //String - A legend template
		              legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
		              //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
		              maintainAspectRatio: true,
		              //Boolean - whether to make the chart responsive to window resizing
		              responsive: true
		            };

		            //Create the line chart
		            areaChart.Line(areaChartData, areaChartOptions);

		            //-------------
		            //- LINE CHART -
		            //--------------
		            //var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
		            // var lineChart = new Chart(lineChartCanvas);
		            // var lineChartOptions = areaChartOptions;
		            // lineChartOptions.datasetFill = false;
		            // lineChart.Line(areaChartData, lineChartOptions);
		            // 
		            //-------------
		            //- BAR CHART -
		            //-------------
		            var barChartCanvas = $("#barChart").get(0).getContext("2d");
		            var barChart = new Chart(barChartCanvas);
		            var barChartData = areaChartData;
		            barChartData.datasets[1].fillColor = "#00a65a";
		            barChartData.datasets[1].strokeColor = "#00a65a";
		            barChartData.datasets[1].pointColor = "#00a65a";
		            var barChartOptions = {
		              //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
		              scaleBeginAtZero: true,
		              //Boolean - Whether grid lines are shown across the chart
		              scaleShowGridLines: true,
		              //String - Colour of the grid lines
		              scaleGridLineColor: "rgba(0,0,0,.05)",
		              //Number - Width of the grid lines
		              scaleGridLineWidth: 1,
		              //Boolean - Whether to show horizontal lines (except X axis)
		              scaleShowHorizontalLines: true,
		              //Boolean - Whether to show vertical lines (except Y axis)
		              scaleShowVerticalLines: true,
		              //Boolean - If there is a stroke on each bar
		              barShowStroke: true,
		              //Number - Pixel width of the bar stroke
		              barStrokeWidth: 2,
		              //Number - Spacing between each of the X value sets
		              barValueSpacing: 5,
		              //Number - Spacing between data sets within X values
		              barDatasetSpacing: 1,
		              //String - A legend template
		              legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
		              //Boolean - whether to make the chart responsive
		              responsive: true,
		              maintainAspectRatio: true
		            };

		            barChartOptions.datasetFill = false;
		            barChart.Bar(barChartData, barChartOptions);

		 		//endkjdfffffffffffffffffffffffffffffffffffffffffffffffffdhs
			}
		});
	});
	
	$('#select-category').multiselect();

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