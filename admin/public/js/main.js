/**
 * Created by sn1p3r on 6/12/17.
 */


$.fn.api.settings.api = {
	'editSearch': '/wake/admin/products/searchProduct?q={query}'
};
(function ($) {
	$(document).ready(function () {

		$('#editPageSearch')
			.search({
				apiSettings: {
					action: 'editSearch',
					url: '/wake/admin/products/searchProduct?q={query}',
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
				error: function () {
					$(".inventory-grid-error").html("");
					$("#inventory-table").append('<tbody class="inventory-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody> ');
					$("#inventory-table_processing").css("display", "none");
				},
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

				{
					"column": 5, type: "list", options: [
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
				type: 'POST',
				url: 'updatedb.php',
				data: {arArray: JSON.stringify(ar)},
				success: function () {
					$("<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Upload completed successfully!</div>").appendTo('div.col-lg-10');
					setTimeout(function () {
						$('.alert').addClass('hidden');
					}, 2000)
				},
				error: function () {
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
			if (didChange == true) {
//                    console.log("It did change!");
				$("<div class='alert alert-warning' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> You changed the page! Your edits from the previous page were not saved. <br> Your change of column: " + updateCell[0][0].column + " row: " + updateCell[0][0].row + " to " + updateCell.data() + " has been reverted to " + oldVall + " </div> ").appendTo('div.col-lg-10');
				setTimeout(function () {
					$('.alert').addClass('hidden');
				}, 10000)

			}

		});

		let image = "";
		let imageFormat = "";
		//console.log(CKEDITOR);
		console.log(CKEDITOR);
		console.log($('#about'));
		if($('#about').length) CKEDITOR.replace('about');
		$('.ui.dropdown').dropdown();

		$('#manufacturer_event').click(function () {
			imageFormat = imageFormat.split('.');
			console.log(imageFormat);
			$(this).addClass('disabled loading');
			let manufacturer_id = $('#manufacturer_id').val();
			let pageName = $('#page-name').val();
			let manfName = $('#name').val();
			let titleTag = $('#titleTag').val();
			let descTag = $('#descTag').val();
			let keyTag = $('#keyTag').val();
			let about = CKEDITOR.instances.about.getData();
			let cru_event = $('#manufacturer_cru').val();
			let event = 'created';
			if(cru_event === 'update') {
				cru_event = cru_event+'/'+manufacturer_id;
				event = 'updated';
			}
			console.log(cru_event);
			$.ajax({
				url: '/wake/admin/manufacturers/'+cru_event,
				method: 'post',
				data: {
					n: manfName,
					p:pageName,
					t: titleTag,
					d: descTag,
					k: keyTag,
					a: about,
					image: image,
					imageFormat: imageFormat[1]
				}
			}).done(function (resp) {
				if (resp) {
					console.log('success');
					swal('Success!', 'The manufacturer was '+event, 'success');
				}
			});
		});


		$('#series_event').click(function () {
			console.log('series clicked0');
			imageFormat = imageFormat.split('.');
			console.log(imageFormat);
			$(this).addClass('disabled loading');
			let manufacturer_id = $('#manf').val();
			let Name = $('#name').val();
			let titleTag = $('#titleTag').val();
			let descTag = $('#descTag').val();
			let keyTag = $('#keyTag').val();
			let about = CKEDITOR.instances.about.getData();
			let cru_event = $('#series_cru').val();
			let event = 'created';
			if(cru_event === 'update') {
				cru_event = cru_event+'/'+manufacturer_id;
				event = 'updated';
			}
			console.log(cru_event);
			$.ajax({
				url: '/wake/admin/series/'+cru_event,
				method: 'post',
				data: {
					i: manufacturer_id,
					n:Name,
					t: titleTag,
					d: descTag,
					k: keyTag,
					a: about,
					image: image,
					imageFormat: imageFormat[1]
				}
			}).done(function (resp) {
				if (resp) {
					console.log('success');
					swal('Success!', 'The manufacturer was '+event, 'success');
				}
			});
		});


		$('#DeleteButton').click(function (event) {
			event.preventDefault();
			swal({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!',
				preConfirm: function () {
					return new Promise(function (resolve) {
						let manf = $('#findManfForm').form('get values');
						$.ajax({
							url:'/wake/admin/manufacturers/deleteManufacturerById?id='+manf.findManf,
							type:'post'
						}).done(function (response) {
							swal('Deleted!', response.message, response.status)
						}).fail(function () {
							swal('Opps...','Something went wrong', 'error');
						})
					})
				}
			}).catch(function (response) {
				console.log(response);
			});
		});

		$('#findButton').click(function (e) {
			let manf = $('#findManfForm').form('get values');
			window.location.assign('manufacturers/update/' + manf.findManf + '?status=show');
		});


		$("#filesubmit").click(function (event) {
			event.preventDefault();
			console.log('This is clicked');
			var file_data = $("#file").prop("files")[0];
			imageFormat = file_data.name;
			console.log(imageFormat);
			let name = $('#name').val();
			var form_data = new FormData();
			var imageFolder = $('#imageFolder').val();
			console.log(imageFolder);
			form_data.append("name", name);
			form_data.append("file", file_data);
			form_data.append("imageFolder",imageFolder);
			console.log(form_data.get('name'));
			$.ajax({
				url: "/wake/admin/Images/upload", // Upload Script
				cache: false,
				contentType: false,
				processData: false,
				data: form_data, // Setting the data attribute of ajax with file_data
				type: 'POST',
			}).done(function (r) {
				image = file_data.name;
				swal('Success!', 'Images uploaded', 'success');
				console.log(image);

			});
		});

		function readURL(input) {

			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#blah').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}

		}

		$("#file").change(function () {
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

		function trans(id){
			$('.' + id)
				.transition('fade down')
			;
			document.getElementById(id).style.display = "inline";

		}
		function transback(id){
			$('.' + id)
				.transition('fade up')
			;
			document.getElementById(id).style.display = "none";
		}
		alert('hi');
		$("#remove").click(function(event) {
			alert('Hi');
			event.preventDefault();
			let numb = $("#tableRow").val();
			console.log(numb);
			$.post("/wake/admin/manufacturers/updateHomePageOrderById", {numb: numb}).done(function(e){
				window.location.href = '/wake/admin/manufacturers/control';
			}).fail(function (err) {
				alert(err);
			})

		});

		$("#edit").click(function(event) {
			event.preventDefault();
			let id = $("#tableRow").val();


			window.location.href = "/admin/editManuf.php?m=" + id;



		});

		$("#replace").click(function(event) {
			event.preventDefault();
			let numb = $("#tableRow").val();
			let numb2 = $("#replaceRow").val();
			console.log(numb);
			console.log(numb2);
			$.post("func/replaceInTable.php", {numb: numb, numb2: numb2}).done(function(e){

			}).done(function (r) {
				window.location.href = "/admin/manageHomepage.php";

			});

		});

		$("#before").click(function(event) {
			event.preventDefault();
			let numb = $("#tableRow").val();
			let numb2 = $("#replaceRow").val();
			console.log(numb);
			console.log(numb2);
			$.post("/wake/admin/manufacturers/placeBefore", {numb: numb, numb2: numb2}).done(function(e){
				window.location.href = '/wake/admin/manufacturers/control';
			}).fail(function (err) {
				console.log(err);
			});

		});

		$("#after").click(function(event) {
			event.preventDefault();
			let numb = $("#tableRow").val();
			let numb2 = $("#replaceRow").val();
			console.log(numb);
			console.log(numb2);
			$.post("func/placeAfterInTable.php", {numb: numb, numb2: numb2}).done(function(e){

			}).done(function (r) {
				window.location.href = "/admin/manageHomepage.php";

			});

		});

	});
	$('.ui.dropdown')
		.dropdown();
})(jQuery);