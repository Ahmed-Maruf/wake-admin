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
		$('.ui.dropdown').dropdown();

        /*
        * @ Activate CKEDITOR for description
        * */

        if($('#description').length) CKEDITOR.replace('description');
        if($('#shortDescription').length) CKEDITOR.replace('shortDescription');
        /*If this event is clicked then
        * enter to the callback
        * */

		$('#manufacturer_event').click(function () {

			/*
			* List of all data related to database
			* and form field
			* */
            let formData = {
                manufacturerID: '',
                seriesID:'',
                manufacturerActivity: '',
                event: 'created', //Default event is created
                name:'',
                pageName:'',
                description:'',
                shortDescription:'',
                titleTag: '',
                descriptionTag: '',
                keywordTag: '',
                image: $('#manufacturerImage').val() ? $('#manufacturerImage').val(): '', //Check for already existing image in db
                imageFormat: ''
            };

            /*Set Image format during upload*/
            formData.imageFormat = imageFormat.split('.');
            formData.imageFormat = formData.imageFormat[1];

		/*	$(this).addClass('disabled loading');*/

            /*Set the data with new values if any*/
            formData.manufacturerID = $('#manufacturerID').val() ? $('#manufacturerID').val() : '';
            //formData.seriesID = $('#ID').val() ? $('#seriesID').val() : '';
            formData.name = $('#name').val() ? $('#name').val() : '';
            formData.titleTag = $('#titleTag').val() ? $('#titleTag').val() : '';
            formData.pageName = $("#pageName").val() ? $("#pageName").val() : '';
            formData.descriptionTag = $('#descriptionTag').val() ? $('#descriptionTag').val(): '';
            formData.keywordTag = $('#keywordTag').val() ? $('#keywordTag').val(): '';
            formData.description = $('#description').val() ? $('#description').val(): '';

            /*Set or Catch the error for empty instances thrown by ckeditor*/
            try {
                formData.description = CKEDITOR.instances.description.getData();
            }catch (e) {
                console.log('Empty Description and the error is '+e);
            }

            /*
             * Check for requested activity either update or create
             * */

            formData.manufacturerActivity = $('#manufacturerActivity').val() ? $('#manufacturerActivity').val(): '';
            if(formData.manufacturerActivity === 'update') {
                formData.manufacturerActivity = formData.manufacturerActivity+'/'+formData.manufacturerID;
                formData.event = 'updated';
            }

            console.log(formData);

            /*Dynamic call to ajax either create or update*/

            $.ajax({
                url: '/wake/admin/manufacturers/'+formData.manufacturerActivity,
                method: 'post',
                data: formData

            }).done(function (resp) {
                if (resp) {
                    console.log('success');
                    swal('Success!', 'The Event is '+formData.event, 'success');
                    swal({
                        title: 'Success!',
                        text: "The Event is "+formData.event,
                        type: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok',
                        preConfirm: function () {
                            return new Promise(function (resolve) {
                               window.location.reload();
                            })
                        }
                    }).catch(function (response) {
                        console.log(response);
                    });
                }
            });
		});


		/*If this event is clicked then
		* enter to the callback
		* */
		$('#series_event').click(function () {
			/*
			* List of all data related to database
			* and form field
			* */
			let formData = {
				manufacturerID: '',
				seriesID:'',
				seriesActivity: '',
				event: 'created', //Default event is created
				name:'',
				pageName:'',
				description:'',
				shortDescription:'',
				titleTag: '',
				descriptionTag: '',
				keywordTag: '',
				image: $('#seriesImage').val() ? $('#seriesImage').val(): '', //Check for already existing image in db
				imageFormat: ''
			};

			/*Set Image format during upload*/
			formData.imageFormat = imageFormat.split('.');
			formData.imageFormat = formData.imageFormat[1];

			//$(this).addClass('disabled loading');

			/*Set the data with new values if any*/
			formData.manufacturerID = $('#currentManufacturer').val() ? $('#currentManufacturer').val() : '';
			formData.seriesID = $('#seriesID').val() ? $('#seriesID').val() : '';
			formData.name = $('#name').val() ? $('#name').val() : '';
			formData.titleTag = $('#titleTag').val() ? $('#titleTag').val() : '';
			formData.pageName = $("#pageName").val() ? $("#pageName").val() : '';
			formData.descriptionTag = $('#descriptionTag').val() ? $('#descriptionTag').val(): '';
			formData.keywordTag = $('#keywordTag').val() ? $('#keywordTag').val(): '';

			/*Set or Catch the error for empty instances thrown by ckeditor*/
			try {
				formData.description = CKEDITOR.instances.description.getData();
			}catch (e) {
				console.log('Empty Description and the error is '+e);
			}

			/*Set or Catch the error for empty instances thrown by ckeditor*/
			try {
				formData.shortDescription = CKEDITOR.instances.shortDescription.getData();
			}catch (e) {
				console.log('Empty short Description and the error is '+e);
			}

			/*
			* Check for requested activity either update or create
			* */

			formData.seriesActivity = $('#seriesActivity').val() ? $('#seriesActivity').val(): '';
			if(formData.seriesActivity === 'update') {
				formData.seriesActivity = formData.seriesActivity+'/'+formData.seriesID;
				formData.event = 'updated';
			}

			console.log(formData);
			/*Dynamic call to ajax either create or update*/

			$.ajax({
				url: '/wake/admin/series/'+formData.seriesActivity,
				method: 'post',
				data: formData

			}).done(function (resp) {
				if (resp) {
					console.log('success');
					swal('Success!', 'The Series is '+formData.event, 'success');
					swal({
						title: 'Success!',
						text: "The Series is "+formData.event,
						type: 'success',
						confirmButtonColor: '#3085d6',
						confirmButtonText: 'Ok',
						preConfirm: function () {
							return new Promise(function (resolve) {
								window.location.reload();
							})
						}
					}).catch(function (response) {
						console.log(response);
					});
				}
			});
		});


		$('#bulkImageUpload').on('click',function () {

			let formData = {
				selectedItems: '',
				uploadedImage: '',
				imageFolder: '',
				imageFormat: '',
				imageFile: ''

			};
			var selectedItems = $('.search.dropdown').dropdown("get value");
            var file_data = $("#file").prop("files")[0];
            imageFormat = file_data.name;
            var form_data = new FormData();
            var imageFolder = $('#imageFolder').val();
            var imageName = $("#file").prop("files")[0].name;
            var imageType = $("#file").prop("files")[0].type;
            form_data.append("selectedItems", selectedItems);
            form_data.append("file", file_data);
            form_data.append("imageFolder",imageFolder);
            form_data.append("imageName",imageName);
            form_data.append("imageType",imageType);

            $.ajax({
                url: "/wake/admin/Images/bulkImageUpload", // Upload Script
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


		$('#newProductForm').on('change','#productManufacturer',function () {
			var manufacturerId = $('#newProductForm').form('get values').productManufacturer;
			$.ajax({
				url: "/wake/admin/series/getAllSeriesByManufacturerId/"+manufacturerId, // Upload Script

				data: manufacturerId, // Setting the data attribute of ajax with file_data
				type: 'POST',
			}).done(function (response) {
				$('option').val("");
				jQuery.each(response, function(key, val){
					console.log(key + ' | '+val['id']);
					$("#productSeries").append("<option value='" + val['id'] + "'>" + val['name'] + "</option>")
				});
				console.log(response);
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
                        if($('#manufacturerUpdate').form('get values').currentManufacturer !== undefined){
                            var manufacturer = $('#manufacturerUpdate').form('get values');
                        }else if ($('#seriesUpdate').form('get values').currentSeries !== undefined) {
                            var series = $('#seriesUpdate').form('get values');
                        }

						$.ajax({
							url:'/wake/admin/manufacturers/deleteManufacturerById?id='+manufacturer.currentManufacturer,
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


		/*When edit is clicked this will be the callback
		* and redirects to details page*/
		$('#findButton').click(function (e) {
			console.log('This');

			if($('#manufacturerUpdate').form('get values').currentManufacturer !== undefined){
				let manufacturer = $('#manufacturerUpdate').form('get values');
				window.location.assign('manufacturers/update/' + manufacturer.currentManufacturer + '?status=show');
			}else if ($('#seriesUpdate').form('get values').currentSeries !== undefined) {
				let series = $('#seriesUpdate').form('get values');
				window.location.assign('series/update/' + series.currentSeries + '?status=show');
			}
		});




		$("#imageUpload").click(function (event) {
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
		
		// faq delete
		$('#deleteFAQ')
		.click(function (e) {
			e.preventDefault();
			$(this).addClass('disabled');
			$(this).children('i').addClass('fa-spin');
			$.ajax({
				url: '/wake/admin/faqs/remove',
			}).done(function (r) {
				console.log(r);
				if(r) {
					swal('Success!', 'FAQ was deleted!', 'success').then(function () {
						window.location.reload();
					})
				}
			});
		});

		// faq add
		$('#addToDb')
		.click(function (e) {
			let d = $('#addfaq').form('get values');

			$.ajax({
				url: '/wake/admin/faqs/create',
				method: 'post',
				data: {d: d}
			}).done(function (r) {
				if (r) {
					swal('Success!', 'FAQ was added!', 'success').then(function () {
						window.location.reload();
					})
				}
			})
		})

		// faq updatw
		$('#updatefaq')
		.click(function (e) {
			let data = $('#existingfaq').form('get values');

			let d = data;

			$.ajax({
				url: '/wake/admin/faqs/update',
				method: 'post',
				data: {d:d}
			}).done(function (r) {
				if (r) {
					swal('Success!', 'The faq was updated', 'success').then(function () {
						window.location.reload();
					});

				}
			})
		})

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