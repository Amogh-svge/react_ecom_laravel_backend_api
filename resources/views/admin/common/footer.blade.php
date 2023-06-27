<div class="az-footer ht-40">
    <div class="container ht-100p pd-t-0-f">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com
            2020</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin
                templates</a> from Bootstrapdash.com</span>
    </div><!-- container -->
</div>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>

<script src="/../lib/jquery/jquery.min.js"></script>
{{-- datatables  --}}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
{{-- datatables  --}}
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
        toastDisplay.style.display = 'inline-block';
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

    // display image when file is selected

    let show_image = document.getElementById("showImage"); //image id
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

    // display image when file is selected ends



    // side drop down starts
    const showMenuOnOver = (event) => {
        // console.log(event.nextElementSibling);
        event.nextElementSibling.classList.add('show_menu');
    }

    const hideMenuOnOver = (event) => {
        event.childNodes[3].classList.remove('show_menu');
    }
    // side drop down ends



    // confirmDelete Starts

    const confirmDelete = (info) => {
        event.preventDefault();
        //parent class of current node taken 
        var parentNode_class = info.parentNode.className;
        var element = document.querySelectorAll('.' + parentNode_class);
        let data_id = (info.parentNode.dataset.id);

        element.forEach(item => {
            //if the items id matches the info's id
            if (item.dataset.id.match(data_id)) {
                //submit the element if delete is true
                this.confirm('Do you want to delete?') === true && item.submit();
            }
        });
    }

    // ConfirmDelete Ends
</script>

<script>
    // $(document).ready(function() {
    //     $('.clonebtn').click(function(event) {
    //         event.preventDefault();
    //         if ($('.custom-file').length < 5)
    //             $("#sliderFileInput").clone().appendTo('.form_div')
    //         else
    //             console.log($('.clonebtn').next());
    //     });
    // })
</script>
