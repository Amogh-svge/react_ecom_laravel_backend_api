<div class="az-footer ht-40">
    <div class="container ht-100p pd-t-0-f">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com
            2020</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin
                templates</a> from Bootstrapdash.com</span>
    </div><!-- container -->
</div>


<script src="/../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/../lib/ionicons/ionicons.js"></script>
<script src="/../js/azia.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>
@yield('script')
{{-- Toast Starts --}}
<script>
    var toastDisplay = document.getElementById('liveToast');
    var toastBody = document.getElementById('toastBody');
    var toast_alert = toastBody.dataset.alert;

    let failure_icon = '<ion-icon name="close-circle" class="mx-1 icon-size">' + '</ion-icon>';
    let success_icon = '<ion-icon name="checkmark-circle" class="mx-1 icon-size">' + '</ion-icon>';

    setTimeout(() => {
        toastDisplay.style.opacity = 0;
    }, 3500);

    if (toastBody.dataset.message) {
        toastDisplay.classList.add('anime');
        if (toast_alert === 'success')
            toastBody.classList.add('success');
        else {
            toastBody.classList.add('failed');
        }
        toastDisplay.style.opacity = 1;
        toastBody.innerHTML = (toast_alert === 'success' ? success_icon : failure_icon) + " " + toastBody.dataset
            .message;
    } else toastDisplay.style.opacity = 0;
</script>
{{-- Toast Ends --}}
<script>
    //DataTables starts
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
    //DataTables end

    // Ckeditor starts
    for (let index = 0; index < 5; index++) {
        ClassicEditor
            .create(document.querySelector('#editor' + index.toString()))
            .catch((error) => {
                // console.error(error);
            });
    }
    // Ckeditor ends


    let show_image = document.getElementById("showImage"); //displays image

    let file_path = document.getElementById("customFile");
    let slider_path = document.getElementById("slider");

    function getPath(event) {
        //splits the extension after the dot and then retrieves it
        let file_extension = event.target.files[0].name.split(".").pop();
        image_type = ['png', 'jpg', 'jpeg'];

        //checks if file extension matches
        let extension_supported = image_type.find(element => element === file_extension);
        if (extension_supported) {
            show_image.src = URL.createObjectURL(event.target.files[0]);
            show_image.onload = function() {
                URL.revokeObjectURL(show_image.src) // free memory
            }
        }
    }

    // if file_path available then function gets executed
    file_path && file_path.addEventListener('change', getPath);
    slider_path && slider_path.addEventListener('change', getPath);


    // side drop down
    const showMenuOnOver = (event) => {
        // console.log(event.nextElementSibling);
        event.nextElementSibling.classList.add('show_menu');
    }

    const hideMenuOnOver = (event) => {
        event.childNodes[3].classList.remove('show_menu');
    }
    // side drop down


    // confirmDelete Starts
    //confirms before deleting and cancels event if clicked cancel 
    const confirmDelete = (info) => {
        event.preventDefault();
        //parent id of current node taken 
        var parentNode_id = info.parentNode.id;
        var element = document.getElementById(parentNode_id);

        //submit the element if delete is true
        this.window.confirm('Do you want to delete?') === true && element.submit();
        // this.window.confirm('Do you want to delete?') === true && document.form.submit();
    }
    // ConfirmDelete Ends
</script>
