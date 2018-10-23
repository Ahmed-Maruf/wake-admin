/**
 * Created by sn1p3r on 6/12/17.
 */


$.fn.api.settings.api = {
	'editSearch': '/admin/func/editSearch.php?q={query}'
};
$(document).ready(function () {

	$('#editPageSearch')
		.search({
			apiSettings: {
				action: 'editSearch',
				url: '/admin/func/editSearch.php?q={query}',
				on: 'input'
			},
			minCharacters: 1,
			urlData: $(this).val()
		});
	$('.ui.accordion').accordion();

	var editor;
	console.log($('#inventory-table'));
	var invTable = $('#inventory-table').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": {
			url: "homes/check",
			type: "get",

			"columns": [
				{"data": 0},
				{"data": 1},
				{"data": 2},
				{"data": 3},
				{"data": 4},
				{"data": 5},
				{"data": 6}
			]
		},
		"pageLength": 25
	});
	invTable.MakeCellsEditable({
		"onUpdate": myCallbackFunction,
		"columns": [1, 2, 3, 4, 5, 6],
		"inputTypes": [

			{"column": 5, type: "list", options: [
					{"value": "In Stock", "display": "In Stock"},
					{"value": "Available", "display": "Available"},
					{"value": "Out Of Stock", "display": "Out of Stock"}

				]
			}
		]


	});

	var ar = [];
	var didChange = false;

	var updateCell;
	var oldVall;
	function myCallbackFunction(updatedCell, updatedRow, oldValue) {
		ar.push(updatedRow.data());
		console.log(ar);
		//console.log(oldValue);
		//console.log(updatedCell);
		didChange = updatedCell.data() != oldValue;

		updateCell = updatedCell;
		oldVall = oldValue;
	}

	$('#submit').on('click', function () {
		$.ajax({
			type    : 'POST',
			url     : 'updatedb.php',
			data    : {arArray: JSON.stringify(ar)},
			success : function() {
				$("<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Upload completed successfully!</div>").appendTo('div.col-lg-10');
				setTimeout(function () {
					$('.alert').addClass('hidden');
				},2000)
			},
			error : function(){
				$("<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Upload failed! Check the server immediately!</div>")
			}
		});

	});


	var table = $('#inventory-table').DataTable();
	$('#inventory-table').on('page.dt', function () {
		var info = table.page.info();
//                console.log(info.page+info.pages);
//                alert("it worked");
		ar = [];
		if (didChange == true){
//                    console.log("It did change!");
			$("<div class='alert alert-warning' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> You changed the page! Your edits from the previous page were not saved. <br> Your change of column: " + updateCell[0][0].column + " row: " + updateCell[0][0].row + " to " + updateCell.data() + " has been reverted to " + oldVall + " </div> ").appendTo('div.col-lg-10');
			setTimeout(function () {
				$('.alert').addClass('hidden');
			},10000)

		}

	});

	let image = "";
	console.log(CKEDITOR);
	CKEDITOR.replace('about');
	$('.ui.dropdown')
		.dropdown();
	$('#createManf')
		.click(function () {
			$(this).addClass('disabled loading');
			let manfName = $('#name').val();
			let titleTag = $('#titleTag').val();
			let descTag = $('#descTag').val();
			let keyTag = $('#keyTag').val();
			let about = CKEDITOR.instances.about.getData();
			console.log(manfName);
			$.ajax({
				url: 'manufacturers/add',
				method: 'post',
				data: {n: manfName, t: titleTag, d: descTag, k: keyTag, a: about, image: image }
			}).done(function (resp) {
				if (resp){
					console.log('success');
					swal('Success!', 'The manufacturer was added', 'success');
				}
			});
		});
	$('#findButton')
		.click(function (e) {
			let manf = $('#findManfForm').form('get values');
			window.location.assign('editManuf.php?m='+manf.findManf);
		});

	$("#filesubmit").click(function(event) {
		event.preventDefault();
		var file_data = $("#file").prop("files")[0];
		let name = $('#name').val();
		var form_data = new FormData();
		form_data.append("name", name);
		form_data.append("file", file_data);
		$.ajax({
			url: "uploadManufImage.php", // Upload Script
			cache: false,
			contentType: false,
			processData: false,
			data: form_data, // Setting the data attribute of ajax with file_data
			type: 'POST',
		}).done(function (r) {
			image  = file_data.name;
			window.alert(r);
			console.log(image);




		});
	});

	function readURL(input) {

		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#blah').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}

	}

	$("#file").change(function() {
		readURL(this);
	});

	//          console.log(window.location.toString());
	$('.ui.accordion')
		.accordion();
	$('.message .close')
		.on('click', function () {
			$(this)
				.closest('.row')
				.transition('fade')
				.fadeOut();
		});
	$('.ui.dropdown')
		.dropdown();

});