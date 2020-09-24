

$(document).ready(function(){
	$(".color-picker").spectrum({
	preferredFormat: "hex",
    showInput: true
});
$(".sortable-list").sortable({
	items: '.sortable-item',
	opacity: 0.6,
	cursor: 'move',
	update: function (event, ui) {
		$.ajax({
			data: {  value:$(this).attr("data-value"),ids:$(this).sortable("toArray") },
			type: 'POST',
			url: "../"+$(this).attr("data-target"),
			success: function (response) {
			iziToast.show({
				title: "İşlem Başarılı",
				message: "İşlem başarıyla tamamlandı",
				animateInside: !1,
				position: "bottomRight",
				progressBar: !1,
				timeout: 5200,
				transitionIn: "fadeInLeft",
				transitionOut: "fadeOut",
				transitionInMobile: "fadeIn",
				transitionOutMobile: "fadeOut",
				class:'iziToast-success'
			});
			},
			error: function (data) {
				console.log(data);
				console.log(data);
			},
		})
	}
});
    $.ajaxSetup({
        headers:
        { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

});
$(document).on('click',".group-delete",function(e ){
    e.preventDefault();
	var id = $(this).attr('data-id');
	var url = $(this).attr('href');
	var alert_message = confirm('Silmek istediğinize emin misiniz?');
    if (alert_message==true) {
		$.ajax( {
			url: url,
			type: 'POST',
			processData: false,
			contentType: false
		}).done(function( data ) {
			if(data=="success"){
				window.location = 'home';
			}else{
				iziToast.show({
					title: "İşlem Başarısız",
					message: "Bir hata meydana geldi.",
					animateInside: !1,
					position: "bottomRight",
					progressBar: !1,
					timeout: 5200,
					transitionIn: "fadeInLeft",
					transitionOut: "fadeOut",
					transitionInMobile: "fadeIn",
					transitionOutMobile: "fadeOut",
					class:'iziToast-success'
				});
			}
			
		});
    } 
	return false;
});
$(document).on('click',".election-delete",function(e ){
    e.preventDefault();
	var parent = $(this).parent().parent();
	var id = $(this).attr('data-id');
	var url = $(this).attr('href');
	var alert_message = confirm('Silmek istediğinize emin misiniz?');
    if (alert_message==true) {
		$.ajax( {
			url: url,
			type: 'POST',
			processData: false,
			contentType: false
		}).done(function( data ) {
			if(data=="success"){
				parent.remove();
				iziToast.show({
					title: "İşlem Başarılı",
					message: "İşlem başarıyla tamamlandı",
					animateInside: !1,
					position: "bottomRight",
					progressBar: !1,
					timeout: 5200,
					transitionIn: "fadeInLeft",
					transitionOut: "fadeOut",
					transitionInMobile: "fadeIn",
					transitionOutMobile: "fadeOut",
					class:'iziToast-success'
				});
			}else{
				iziToast.show({
					title: "İşlem Başarısız",
					message: "Bir hata meydana geldi.",
					animateInside: !1,
					position: "bottomRight",
					progressBar: !1,
					timeout: 5200,
					transitionIn: "fadeInLeft",
					transitionOut: "fadeOut",
					transitionInMobile: "fadeIn",
					transitionOutMobile: "fadeOut",
					class:'iziToast-success'
				});
			}
			
		});
    } 
	return false;
});

$(document).on('change',".election-item",function(e ){
    e.preventDefault();
	var img = $('[data-image="'+$(this).attr('data-id')+'"]');
    $.ajax( {
        url: $(this.form).attr('action'),
        type: 'POST',
        data: new FormData( this.form ),
        processData: false,
		dataType: 'json',
        contentType: false
    }).done(function( data ) {
		img.attr('src','../'+ data.image);
		$('.group-item[name="total_rate"][data-id="' + data.group + '"]').val(data.rate);
		iziToast.show({
			title: "İşlem Başarılı",
			message: "İşlem başarıyla tamamlandı",
			animateInside: !1,
			position: "bottomRight",
			progressBar: !1,
			timeout: 5200,
			transitionIn: "fadeInLeft",
			transitionOut: "fadeOut",
			transitionInMobile: "fadeIn",
			transitionOutMobile: "fadeOut",
			class:'iziToast-success'
		});
    });
});

$(document).on('change',".group-item",function(e ){
    e.preventDefault();
    $.ajax( {
        url: $(this.form).attr('action'),
        type: 'POST',
        data: new FormData( this.form ),
        processData: false,
        contentType: false
    }).done(function( data ) {
		iziToast.show({
			title: "İşlem Başarılı",
			message: "İşlem başarıyla tamamlandı",
			animateInside: !1,
			position: "bottomRight",
			progressBar: !1,
			timeout: 5200,
			transitionIn: "fadeInLeft",
			transitionOut: "fadeOut",
			transitionInMobile: "fadeIn",
			transitionOutMobile: "fadeOut",
			class:'iziToast-success'
		});
    });
});


var groups = [];
var group = 0;
$(document).ready(function(){
	groups = JSON.parse("[" + $('#group_ids').val() + "]");
	group = groups[0];
	load_data();
	setInterval(function(){ load_data(); }, 10000);
})
var color,letters = '0123456789ABCDEF'.split('')
function AddDigitToColor(limit)
{
    color += letters[Math.round(Math.random() * limit )]
}
function GetRandomColor() {
    color = '#'
    AddDigitToColor(5)
    for (var i = 0; i < 5; i++) {
        AddDigitToColor(15)
    }
    return color
}

function load_data(){
	var elections_list = $('#elections-list');
	var election_items = $('.election-items');
	//election_items.html('');
	//elections_list.html('');
	$.ajax( {
        url: '../election-data/' + group,
        type: 'GET',
		dataType: 'json',
		complete:function(result){
			var points = [];
			var json = $.parseJSON(result.responseText);
			$('#title').html(json.title)
			if(json.graphic=="true"){
				$('#graphic').show();
				$('#list').removeClass('col-sm-12');
				$('#list').addClass('col-sm-6');
				$('.elections-field').addClass('border-style');
			}else{
				$('#graphic').hide();
				$('#list').removeClass('col-sm-6');
				$('#list').addClass('col-sm-12');
				$('.elections-field').removeClass('border-style');
			}
			
			$(".election-items .item-field").each(function( index ) {
				if(index>(json.show_count-1)){
					$(this).remove();
				}
			});
			
			$("#elections-list tr").each(function( index ) {
				if(index>(json.data.length-1)){
					$(this).remove();
				}
			});
			
			$.each(json.data, function(i, item) {
				if(i<json.show_count){
					if(json.graphic=="true"){
						var result = $("#templateCol").tmpl(item);
						if ($(".election-items .item-field:eq(" + i + ")").length){
							$(".election-items .item-field:eq(" + i + ")").html(result.find('.item'));
						}else{
							result.appendTo(".election-items");
						}
					}else{
						var result = $("#template").tmpl(item);
						if ($(".election-items .item-field:eq(" + i + ")").length){
							$(".election-items .item-field:eq(" + i + ")").html(result.find('.item'));
						}else{
							result.appendTo(".election-items");
							//alert(item.title);
						}
					}
					
			        points.push({ label : item['title'], y : item['percent'], r : item['total'], color : item['color']});
				}
				
				var table_result = $("#templateList").tmpl(item);
				if ($("#elections-list tr:eq(" + i + ")").length){
					$("#elections-list tr:eq(" + i + ")").html(table_result.html());
					$("#elections-list tr:eq(" + i + ")").css('background-color',item.color);
				}else{
					table_result.appendTo("#elections-list");
				}
				console.log(item['color']);
			});
			console.log(points);
			var delay = 500;
			$(".progress-bar").each(function(i){
				$(this).delay( delay*i ).animate( { width: $(this).attr('aria-valuenow') + '%' }, delay );

				$(this).prop('Counter',0).animate({
					Counter: $(this).text()
				}, {
					duration: delay,
					easing: 'swing',
					step: function (now) {
						$(this).text(Math.ceil(now)+'%');
					}
				});
			});
			
			var options = {
				backgroundColor: "transparent",
				animationEnabled: true,
				data: [{
					type: "pie",
					startAngle: 45,
					showInLegend: "true",
					legendText: "{label}",
					indexLabel: "{label} ({r})",
					yValueFormatString:"#,##0.#"%"",
					dataPoints: points
				}]
			};
			$("#chartContainer").CanvasJSChart(options);
			group = groups[($.inArray(group, groups) + 1) % groups.length];
			points = [];
		}
    })
}