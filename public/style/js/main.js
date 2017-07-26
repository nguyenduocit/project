
$(document).ready(function($) {

	// ẩn thông báo
	$('.alert').delay(3000).slideUp();

	$('.delete').click(function(){
		
		var id = $(this).attr('id');
		$.ajax({
				url:link+'getDelete/'+id,
				type:'get',
				data :{'id': id},
				success: function(data)
				{
					
					$('tr.row_'+id).fadeOut();
					
					
					console.log(data);
				}

			});
		
	});

});



// xác nhận xóa
function xacnhanxoa(msg)
	{
		if(window.confirm(msg)){
			return true;
		}
		else
		{
			return false;
		}
	}
